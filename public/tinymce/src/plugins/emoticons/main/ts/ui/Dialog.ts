/**
 * Copyright (c) Tiny Technologies, Inc. All rights reserved.
 * Licensed under the LGPL or a commercial license.
 * For LGPL see License.txt in the project root for license information.
 * For commercial licenses see https://www.tiny.cloud/
 */

import { Arr, Cell, Throttler, Option } from '@ephox/katamari';

import { ALL_CATEGORY, EmojiDatabase } from '../core/EmojiDatabase';
import { emojisFrom } from '../core/Lookup';
import { insertEmoticon } from '../core/Actions';
import Editor from 'tinymce/core/api/Editor';
import { Types } from '@ephox/bridge';

const patternName = 'pattern';

const open = function (editor: Editor, database: EmojiDatabase) {

  const initialState = {
    pattern: '',
    results: emojisFrom(database.listAll(), '', Option.some(300))
  };

  const scan = (dialogApi, category: string) => {
    const dialogData = dialogApi.getData();
    const candidates = database.listCategory(category);
    const results = emojisFrom(candidates, dialogData[patternName], category === ALL_CATEGORY ? Option.some(300) : Option.none());
    dialogApi.setData({
      results
    });
  };

  const updateFilter = Throttler.last((dialogApi) => {
    const category = currentTab.get();
    scan(dialogApi, category);
  }, 200);

  const currentTab = Cell(ALL_CATEGORY);

  const searchField: Types.Dialog.BodyComponentApi = {
    label: 'Search',
    type: 'input',
    name: patternName
  };

  const resultsField: Types.Dialog.BodyComponentApi = {
    type: 'collection',
    name: 'results',
    // TODO TINY-3229 implement collection columns properly
    // columns: 'auto'
  };

  const getInitialState = (): Types.Dialog.DialogApi<typeof initialState> => {
    const body: Types.Dialog.TabPanelApi = {
      type: 'tabpanel',
      // All tabs have the same fields.
      tabs: Arr.map(database.listCategories(), (cat) => ({
        title: cat,
        items: [searchField, resultsField]
      }))
    };
    return {
      title: 'Emoticons',
      size: 'normal',
      body,
      initialData: initialState,
      onTabChange: (dialogApi, title: string) => {
        currentTab.set(title);
        updateFilter.throttle(dialogApi);
      },
      onChange: updateFilter.throttle,
      onAction: (dialogApi, actionData) => {
        if (actionData.name === 'results') {
          insertEmoticon(editor, actionData.value);
          dialogApi.close();
        }
      },
      buttons: [
        {
          type: 'cancel',
          text: 'Close',
          primary: true
        }
      ]
    };
  };

  const dialogApi = editor.windowManager.open(getInitialState());

  dialogApi.focus(patternName);

  if (!database.hasLoaded()) {
    dialogApi.block('Loading emoticons...');
    database.waitForLoad().then(() => {
      dialogApi.redial(getInitialState());
      updateFilter.throttle(dialogApi);
      dialogApi.focus(patternName);
      dialogApi.unblock();
    }).catch((err) => {
      dialogApi.redial({
        title: 'Emoticons',
        body: {
          type: 'panel',
          items: [
            {
              type: 'alertbanner',
              level: 'error',
              icon: 'warning',
              text: '<p>Could not load emoticons</p>'
            }
          ]
        },
        buttons: [
          {
            type: 'cancel',
            text: 'Close',
            primary: true
          }
        ],
        initialData: {
          pattern: '',
          results: []
        }
      });
      dialogApi.focus(patternName);
      dialogApi.unblock();
    });
  }
};

export default {
  open
};