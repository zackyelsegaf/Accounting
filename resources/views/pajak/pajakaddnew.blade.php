@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Pajak</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/pajak/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kode</label>
                                    <input type="text" class="form-control @error('kode_pajak') is-invalid @enderror" name="kode_pajak" placeholder="Kode pajak pelanggan" value="{{ old('kode_pajak') }}">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Nama pajak" value="{{ old('nama') }}">
                                </div>
                                <div class="form-group">
                                    <label>Nilai</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control @error('nilai_persentase') is-invalid @enderror" name="nilai_persentase" placeholder="Persentase Pajak" value="{{ old('nilai_persentase', 1) }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>                                
                                </div>
                                <div class="form-group">
                                    <label>Akun Pajak Penjualan</label>
                                    <input type="text" class="form-control" name="akun_pajak_penjualan" placeholder="Akun pajak penjualan" value="{{ old('akun_pajak_penjualan') }}">
                                </div>
                                <div class="form-group">
                                    <label>Akun Pajak Pembelian</label>
                                    <input type="text" class="form-control" name="akun_pajak_pembelian" placeholder="Akun pajak pembelian" value="{{ old('akun_pajak_pembelian') }}">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}">{{ old('deskripsi') }}</textarea>
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
                                <a href="{{ route('statuspemasok/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
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