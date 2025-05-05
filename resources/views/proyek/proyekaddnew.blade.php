@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Proyek</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/proyek/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"> 
                                <a class="nav-link active" data-toggle="tab" href="#general">General</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#">Anggaran</a> 
                            </li>
                        </ul>
                    </div>
                    <div id="general" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No. Proyek</label>
                                                    <input type="text" class="form-control @error('proyek_id') is-invalid @enderror" name="proyek_id" value="{{ old('proyek_id') }}">
                                                </div>                                                
                                                <div class="form-group">
                                                    <label>Nama Proyek</label>
                                                    <input type="text" class="form-control @error('nama_proyek') is-invalid @enderror" name="nama_proyek" value="{{ old('nama_proyek') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Kontak</label>
                                                    <input type="text" class="form-control" name="nama_kontak" value="{{ old('nama_kontak') }}">
                                                </div>
                                                <h7 class="font-weight-bold">Tanggal Projek</h7>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Mulai</label>
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control datetimepicker" name="tanggal_from" value="{{ old('tanggal_from') }}"> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Selesai</label>
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control datetimepicker" name="tanggal_to" value="{{ old('tanggal_to') }}"> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Komplet</label>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" name="persentase_komplet" value="{{ old('persentase_komplet') }}">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="dd"></div>
                                                            <div class="checkbox-wrapper-4">
                                                                <input type="hidden" name="persentase_komplet_check" value="0">
                                                                <input class="inp-cbx" name="persentase_komplet_check" id="persentase_komplet_check" type="checkbox" value="1" {{ old('dihentikan') ? 'checked' : '' }}>
                                                                <label class="cbx" for="persentase_komplet_check">
                                                                    <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                                    <span>Selesai</span>
                                                                </label>
                                                                <svg class="inline-svg">
                                                                    <symbol id="check-4" viewbox="0 0 12 10">
                                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                                    </symbol>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi</label>
                                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}">{{ old('deskripsi') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="dihentikan">Dihentikan</label>
                                                    <label class="switch">
                                                        <input type="hidden" name="dihentikan" value="0">
                                                        <input type="checkbox" name="dihentikan" id="dihentikan" value="1" {{ old('dihentikan') ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dokumen" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>File 1</label>
                                                    <input type="text" class="form-control" name="fileupload_1" placeholder="Link dokumen Anda" value="{{ old('fileupload_1') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <button type="submit" class="btn btn-primary buttonedit1"><i class="fa fa-check mr-2"></i>Simpan</button>
                                <a href="{{ route('proyek/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('script')        
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
    @endsection
@endsection