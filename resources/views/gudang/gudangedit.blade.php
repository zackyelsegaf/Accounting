@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Gudang</h3> 
                    </div>
                </div>
            </div>
            <form action="{{ route('gudang/update', $Gudang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-6">                                              
                                <div class="form-group">
                                    <label>Nama Gudang</label>
                                    <input type="text" class="form-control @error('nama_gudang') is-invalid @enderror" name="nama_gudang" value="{{ $Gudang->nama_gudang }}">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control @error('alamat_gudang_1') is-invalid @enderror" name="alamat_gudang_1">{{ old('alamat_gudang_1', $Gudang->alamat_gudang_1) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Alamat 2</label>
                                    <textarea class="form-control @error('alamat_gudang_2') is-invalid @enderror" name="alamat_gudang_2">{{ old('alamat_gudang_2', $Gudang->alamat_gudang_2) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Alamat 3</label>
                                    <textarea class="form-control @error('alamat_gudang_3') is-invalid @enderror" name="alamat_gudang_3">{{ old('alamat_gudang_3', $Gudang->alamat_gudang_3) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Penanggung Jawab</label>
                                    <input type="text" class="form-control @error('penanggung_jawab') is-invalid @enderror" name="penanggung_jawab" value="{{ $Gudang->penanggung_jawab }}">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi">{{ old('deskripsi', $Gudang->deskripsi) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary buttonedit">Update</button>
            </form>
        </div>
    </div>
    @section('script')
    @endsection
@endsection