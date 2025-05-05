@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Pemasok</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/departemen/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <label>No</label>
                                    <input type="text" class="form-control" name="departemen_id" value="{{ $kodeBaru }}">
                                </div> 
                                <div class="form-group">
                                    <label>Nama Departemen</label>
                                    <input type="text" class="form-control @error('nama_departemen') is-invalid @enderror"name="nama_departemen" value="{{ old('nama_departemen') }}">
                                </div>
                                <div class="form-group">
                                    <label>Nama Kontak</label>
                                    <input type="text" class="form-control @error('nama_kontak') is-invalid @enderror"name="nama_kontak" value="{{ old('nama_kontak') }}">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}">{{ old('deskripsi') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tipe</label>
                                    <select class="form-control"  name="tipe_departemen">
                                        <option selected disabled> --Pilih Tipe-- </option>
                                        @foreach ($tipe_departemen as $items )
                                        <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dihentikan">Cash on Delivery</label>
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
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <button type="submit" class="btn btn-primary buttonedit1"><i class="fa fa-check mr-2"></i>Simpan</button>
                                <a href="{{ route('departemen/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('script')        
    @endsection
@endsection