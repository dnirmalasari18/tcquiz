@extends('layouts.admin')

@section('classes', 'active')

@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li class="active">Classes</li>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">
                            <h3 class="m-0">Add Class</h3>
                        </div>
                        <div class="col ">
                            <a class="btn btn-secondary float-right" href="/admin/classes" role="button">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST" accept-charset="UTF-8">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="">Mata Kuliah</label>
                            <select class="form-control">
                                <option>Manajemen Proyek Perangkat Lunak</option>
                                <option>Pemrograman Berbasis Kerangka Kerja</option>
                                <option>Rekayasa Kebutuhan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="">Kelas</label>
                            <input type="text" class="form-control" id="" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="">SKS</label>
                            <input type="number" min="1" class="form-control" id="" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="">Semester</label>
                            <input type="number" min="1" class="form-control" id="" placeholder="">
                        </div>
                        <div class="form-group col-md-12">
                            <label class="font-weight-bold" for="">Dosen Pengajar</label>
                            <select class="form-control">
                                <option>Dwi Sunaryono, S. Kom., M. Kom</option>
                                <option>Sarwosri, S.Kom. , MT</option>
                                <option>Dr. Eng Darlis Herumurti, S.Kom, M.Kom</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold" for="">Ruangan</label>
                            <select class="form-control">
                                <option>IF-101</option>
                                <option>IF-102</option>
                                <option>IF-103</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold" for="">Hari</label>
                            <select class="form-control">
                                <option>Senin</option>
                                <option>Selasa</option>
                                <option>Rabu</option>
                                <option>Kamis</option>
                                <option>Jumat</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold" for="">Jam</label>
                            <select class="form-control">
                                <option>08.30 - 10.00</option>
                                <option>10.00 - 12.30</option>
                                <option>13.00 - 15.30</option>
                                <option>15.30 - 18.00</option>
                            </select>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <button id="" type="submit" class="btn btn-lg btn-info btn-block ">
                                Add Class
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
@endsection