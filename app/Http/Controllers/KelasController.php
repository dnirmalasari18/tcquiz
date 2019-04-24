<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\User;
use App\MataKuliah;
use App\Ruangan;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Kelas::all();
        return view('admin.classes',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dosen = User::where('role','Dosen')->orderBy('name', 'asc')->get();
        $matakuliah = MataKuliah::orderBy('id', 'asc')->orderBy('nama_mata_kuliah', 'asc')->get();
        $ruang = Ruangan::get();
        return view ('admin.createclass',compact('dosen', 'matakuliah', 'ruang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Kelas::create($request->all());      
        return redirect('/admin/kelas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($kelas)
    {
        $class = Kelas::findorfail($kelas);

        $dosen = User::where('role','Dosen')->orderBy('name', 'asc')->pluck('name','username');
        $matakuliah = MataKuliah::orderBy('id', 'asc')->orderBy('nama_mata_kuliah', 'asc')->pluck('nama_mata_kuliah','id');
        $ruang = Ruangan::pluck('nama_ruangan','id');
        return view('admin.editclass',compact('class', 'dosen', 'matakuliah', 'ruang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kelas)
    {
        $class = Kelas::findorfail($kelas);
        $class->update($request->all());
        return redirect()->back()->with(['update_done' => 'Data berhasil diupdate', 'user' => $class]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($kelas)
    {
        $class = Kelas::findorfail($kelas);
        $class->delete();
        return redirect('/admin/kelas');
    }
}
