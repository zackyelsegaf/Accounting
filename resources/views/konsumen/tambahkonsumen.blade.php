@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Konsumen</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/konsumen/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Data Pribadi</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" class="form-control @error('nik_konsumen') is-invalid @enderror" name="nik_konsumen" value="{{ old('nik_konsumen') }}">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control @error('nama_konsumen') is-invalid @enderror" name="nama_konsumen" value="{{ old('nama_konsumen') }}">
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}">
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror"  name="jenis_kelamin">
                                        <option selected disabled> --Pilih Jenis Kelamin-- </option>
                                        @foreach ($jenis_kelamin as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <h5>Pekerjaan</h5>
                                <div class="form-group">
                                    {{-- <label>Pekerjaan</label> --}}
                                    <select class="form-control @error('pekerjaan') is-invalid @enderror"  name="pekerjaan">
                                        <option selected disabled> --Pilih Pekerjaan-- </option>
                                        @foreach ($pekerjaan as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Marketing</label>
                                    <input type="text" class="form-control @error('marketing') is-invalid @enderror" name="marketing" value="{{ old('marketing', Auth::user()->name) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Lain-lain</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Cluster</label>
                                    <select class="form-control @error('cluster') is-invalid @enderror"  name="cluster">
                                        <option selected disabled> --Pilih Perumahan-- </option>
                                        @foreach ($cluster as $items )
                                            <option value="{{ $items->nama_cluster }}">{{ $items->nama_cluster }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status Pengajuan</label>
                                    <select class="form-control @error('status_pengajuan') is-invalid @enderror"  name="status_pengajuan">
                                        <option selected disabled> --Pilih Status-- </option>
                                        @foreach ($status_pengajuan as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Data Alamat</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Provinsi KTP</label>
                                    <select class="form-control @error('provinsi') is-invalid @enderror"  name="provinsi">
                                        <option selected disabled> --Pilih Provinsi-- </option>
                                        @foreach ($provinsi as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kota KTP</label>
                                    <select class="form-control @error('kota') is-invalid @enderror"  name="kota">
                                        <option selected disabled> --Pilih Kota-- </option>
                                        @foreach ($kota as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" class="form-control" name="kecamatan" value="{{ old('kecamatan') }}">
                                </div>
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input type="text" class="form-control" name="kelurahan" value="{{ old('kelurahan') }}">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat_konsumen" value="{{ old('alamat_konsumen') }}">{{ old('alamat_konsumen') }}</textarea>
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
                                <a href="{{ route('konsumen/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
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
