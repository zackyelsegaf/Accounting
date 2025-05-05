@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                    </div>
                </div>
            </div>
            <form action="{{ route('konsumen/update', $Konsumen->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control @error('nik_konsumen') is-invalid @enderror" name="nik_konsumen" value="{{ $Konsumen->nik_konsumen }}">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control @error('nama_konsumen') is-invalid @enderror" name="nama_konsumen" value="{{ $Konsumen->nama_konsumen }}">
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ $Konsumen->no_hp }}">
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                        <option selected disabled {{ old('jenis_kelamin', $Konsumen->jenis_kelamin) ? '' : 'selected' }}> --Pilih Jenis Kelamin-- </option>
                                        @foreach ($jenis_kelamin as $items )
                                            <option value="{{ $items->nama }}" {{ old('jenis_kelamin', $Konsumen->jenis_kelamin) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <h5>Pekerjaan</h5>
                                <div class="form-group">
                                    {{-- <label>Pekerjaan</label> --}}
                                    <select class="form-control @error('pekerjaan') is-invalid @enderror" name="pekerjaan">
                                        <option selected disabled {{ old('pekerjaan', $Konsumen->pekerjaan) ? '' : 'selected' }}> --Pilih Pekerjaan-- </option>
                                        @foreach ($pekerjaan as $items )
                                            <option value="{{ $items->nama }}" {{ old('pekerjaan', $Konsumen->pekerjaan) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Marketing</label>
                                    <input type="text" class="form-control @error('marketing') is-invalid @enderror" name="marketing" value="{{ $Konsumen->marketing }}" readonly>
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
                                    <select class="form-control @error('cluster') is-invalid @enderror" name="cluster">
                                        <option selected disabled {{ old('cluster', $Konsumen->cluster) ? '' : 'selected' }}> --Pilih Perumahan-- </option>
                                        @foreach ($cluster as $items )
                                            <option value="{{ $items->nama_cluster }}" {{ old('cluster', $Konsumen->cluster) == $items->nama_cluster ? 'selected' : '' }}>
                                                {{ $items->nama_cluster }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status Pengajuan</label>
                                    <select class="form-control @error('status_pengajuan') is-invalid @enderror" name="status_pengajuan">
                                        <option selected disabled {{ old('status_pengajuan', $Konsumen->status_pengajuan) ? '' : 'selected' }}> --Pilih Status Pengajuan-- </option>
                                        @foreach ($status_pengajuan as $items )
                                            <option value="{{ $items->nama }}" {{ old('status_pengajuan', $Konsumen->status_pengajuan) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
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
                                    <select class="form-control @error('provinsi') is-invalid @enderror" name="provinsi">
                                        <option selected disabled {{ old('provinsi', $Konsumen->provinsi) ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                        @foreach ($provinsi as $items )
                                            <option value="{{ $items->nama }}" {{ old('provinsi', $Konsumen->provinsi) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kota KTP</label>
                                    <select class="form-control @error('kota') is-invalid @enderror"  name="kota">
                                        <option selected disabled {{ old('kota', $Konsumen->kota) ? '' : 'selected' }}> --Pilih Kota-- </option>
                                        @foreach ($kota as $items )
                                            <option value="{{ $items->nama }}" {{ old('kota', $Konsumen->kota) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" class="form-control" name="kecamatan" value="{{ $Konsumen->kecamatan }}">
                                </div>
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input type="text" class="form-control" name="kelurahan" value="{{ $Konsumen->kelurahan}}">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat_konsumen" value="{{ old('alamat_konsumen') }}">{{ old('alamat_konsumen', $Konsumen->alamat_konsumen) }}</textarea>
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