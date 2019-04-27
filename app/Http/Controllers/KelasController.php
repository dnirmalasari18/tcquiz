<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\User;
use App\MataKuliah;
use App\Ruangan;
use App\MahasiswaMengambil;
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
        return view('dosen.classes',compact('classes'));
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
        return view ('dosen.createclass',compact('dosen', 'matakuliah', 'ruang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kelas_taken = Kelas::where('mata_kuliah_id', $request->mata_kuliah_id)->where('kelas', $request->kelas)->count();
        if($kelas_taken) {
            return redirect()->back()->with('error', 'Kelas already exists.');
        }
        Kelas::create($request->all());      
        return redirect('/dosen/kelas');
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
        return view('dosen.editclass',compact('class', 'dosen', 'matakuliah', 'ruang'));
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
        return redirect('/dosen/kelas');
    }

    public function detailkelas($kelas)
    {
        $mahasiswa = MahasiswaMengambil::where('kelas_id', $kelas)->orderBy('mahasiswa_nrp', 'asc')->get();
        $namakelas = Kelas::where('id', $kelas)->first();
        return view ('dosen.classdetail',compact('mahasiswa', 'namakelas'));
    }

     public function addmahasiswa($kelas)
    {
        $class = Kelas::findorfail($kelas);
        $users = User::where('role', 'Mahasiswa')->get();
        return view('dosen.listmahasiswa', compact('users', 'class'));
    }
}
