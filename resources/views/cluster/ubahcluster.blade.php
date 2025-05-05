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
            <form action="{{ route('cluster/update', $Cluster->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Tambah Cluster</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Cluster</label>
                                    <input type="text" class="form-control @error('nama_cluster') is-invalid @enderror" name="nama_cluster" value="{{ $Cluster->nama_cluster }}">
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ $Cluster->no_hp }}">
                                </div>
                                <div class="form-group">
                                    <label>Luas Tanah M2</label>
                                    <input type="text" class="form-control @error('luas_tanah') is-invalid @enderror" name="luas_tanah" value="{{ $Cluster->luas_tanah }}">
                                </div>
                                <div class="form-group">
                                    <label>Total Unit</label>
                                    <input type="text" class="form-control @error('total_unit') is-invalid @enderror" name="total_unit" value="{{ $Cluster->total_unit }}">
                                </div>
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <select class="form-control @error('provinsi') is-invalid @enderror" name="provinsi">
                                        <option selected disabled {{ old('provinsi', $Cluster->provinsi) ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                        @foreach ($provinsi as $items )
                                            <option value="{{ $items->nama }}" {{ old('provinsi', $Cluster->provinsi) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>  
                                <div class="form-group">
                                    <label>Kota</label>
                                    <select class="form-control @error('kota') is-invalid @enderror"  name="kota">
                                        <option selected disabled {{ old('kota', $Cluster->kota) ? '' : 'selected' }}> --Pilih Kota-- </option>
                                        @foreach ($kota as $items )
                                            <option value="{{ $items->nama }}" {{ old('kota', $Cluster->kota) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" value="{{ $Cluster->kecamatan }}">
                                </div>
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" name="kelurahan" value="{{ $Cluster->kelurahan }}">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control @error('alamat_cluster') is-invalid @enderror" name="alamat_cluster" value="{{ old('alamat_cluster') }}">{{ old('alamat_cluster', $Cluster->alamat_cluster) }}</textarea>
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