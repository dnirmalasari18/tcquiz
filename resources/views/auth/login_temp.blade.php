<!doctype html>
<html lang="en">
<head>
    <title>TCQUIZ</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/assets/css/login.css')}}">
</head>
<body class="antialiased font-sans bg-blue-dark">
<div class="md:flex min-h-screen">
    <div class="w-full md:w-1/2 bg-white flex items-center justify-center">
        <div class="max-w-sm m-8">
            <div class="text-black text-5xl md:text-15xl font-black">
                TCQUIZ
            </div>

            <div class="w-16 h-1 bg-teal-light my-3 md:my-6"></div>

            <p class="text-grey-darker text-2xl md:text-3xl font-light mb-8 leading-normal">
                Sistem Informasi TC Quiz. Untuk Teknik Informatika ITS
            </p>

            <a href="#">
                <button class="bg-transparent text-grey-darkest font-bold uppercase tracking-wide py-3 px-6 border-2 border-grey-light hover:border-grey rounded-lg">
                    Login
                </button>
            </a>
            <div class="w-16 h-1 my-3 md:my-6"></div>
            <p class="text-grey-darker text-2xl md:text-1xl font-light mb-8 leading-normal">
                Copyright © 2019 PBKK Dwi S.
            </p>
        </div>
    </div>

    <div class="relative pb-full md:flex md:pb-0 md:min-h-screen w-full md:w-1/2">
        <div style="background-image: url({{asset('img/welcome.png')}});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
        </div>
    </div>
</div>
</body>
</html>
