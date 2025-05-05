@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Pegawai</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/pegawai/save') }}" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control @error('nik_pegawai') is-invalid @enderror" name="nik_pegawai" value="{{ old('nik_pegawai') }}">
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" name="nama_pegawai" value="{{ old('nama_pegawai') }}">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker @error('tanggal_lahir_pegawai') is-invalid @enderror" name="tanggal_lahir_pegawai" value="{{ old('tanggal_lahir_pegawai') }}"> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Kota Kelahiran</label>
                                    <select class="form-control @error('tempat_lahir_pegawai') is-invalid @enderror"  name="tempat_lahir_pegawai">
                                        <option selected disabled> --Pilih Kota-- </option>
                                        @foreach ($kota as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control @error('jenis_kelamin_pegawai') is-invalid @enderror"  name="jenis_kelamin_pegawai">
                                        <option selected disabled> --Pilih Gender-- </option>
                                        @foreach ($gender as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Agama</label>
                                    <select class="form-control @error('agama_pegawai') is-invalid @enderror"  name="agama_pegawai">
                                        <option selected disabled> --Pilih Agama-- </option>
                                        @foreach ($agama as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status Pernikahan</label>
                                    <select class="form-control"  name="status_pernikahan_pegawai">
                                        <option selected disabled> --Pilih Status Pernikahan-- </option>
                                        @foreach ($data as $items )
                                        <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Golongan Darah</label>
                                    <select class="form-control"  name="golongan_darah_pegawai">
                                        <option selected disabled> --Pilih Golongan Darah-- </option>
                                        @foreach ($golongan_darah as $items )
                                        <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Informasi Bank</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Bank</label>
                                    <input type="text" class="form-control @error('nama_bank_pegawai') is-invalid @enderror" name="nama_bank_pegawai" value="{{ old('nama_bank_pegawai') }}">
                                </div>
                                <div class="form-group">
                                    <label>Nomor Rekening</label>
                                    <input type="text" class="form-control @error('nomor_rekening_pegawai') is-invalid @enderror" name="nomor_rekening_pegawai" value="{{ old('nomor_rekening_pegawai') }}">
                                </div>
                                <div class="form-group">
                                    <label>Atas Nama No. Rekening</label>
                                    <input type="text" class="form-control @error('atas_nama_pegawai') is-invalid @enderror" name="atas_nama_pegawai" value="{{ old('atas_nama_pegawai') }}">
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Data Orangtua</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Ayah</label>
                                    <input type="text" class="form-control @error('nama_ayah_pegawai') is-invalid @enderror" name="nama_ayah_pegawai" value="{{ old('nama_ayah_pegawai') }}">
                                </div>
                                <div class="form-group">
                                    <label>Nama Ibu</label>
                                    <input type="text" class="form-control @error('nama_ibu_pegawai') is-invalid @enderror" name="nama_ibu_pegawai" value="{{ old('nama_ibu_pegawai') }}">
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Data Pekerjaan</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control @error('status_pekerjaan_pegawai') is-invalid @enderror"  name="status_pekerjaan_pegawai">
                                        <option selected disabled> --Pilih Status-- </option>
                                        @foreach ($status_pekerjaan as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Foto</label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="customFile" name="foto_pegawai" value="{{ old('foto_pegawai') }}">
                                        <label class="custom-file-label" for="customFile">Pilih Foto</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Terima</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" name="tanggal_masuk_pegawai" value="{{ old('tanggal_masuk_pegawai') }}"> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Keluar</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" name="tanggal_keluar_pegawai" value="{{ old('tanggal_keluar_pegawai') }}"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Kontak</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control @error('email_pegawai') is-invalid @enderror" name="email_pegawai" value="{{ old('email_pegawai') }}">
                                </div>
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="text" class="form-control @error('no_telp_pegawai') is-invalid @enderror" name="no_telp_pegawai" value="{{ old('no_telp_pegawai') }}">
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Data Alamat</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <select class="form-control @error('provinsi') is-invalid @enderror"  name="provinsi">
                                        <option selected disabled> --Pilih Provinsi-- </option>
                                        @foreach ($provinsi as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kota</label>
                                    <select class="form-control @error('kota') is-invalid @enderror"  name="kota">
                                        <option selected disabled> --Pilih Kota-- </option>
                                        @foreach ($kota as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" value="{{ old('kecamatan') }}">
                                </div>
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" name="kelurahan" value="{{ old('kelurahan') }}">
                                </div>
                                <div class="form-group">
                                    <label>RT</label>
                                    <input type="text" class="form-control @error('rt_pegawai') is-invalid @enderror" name="rt_pegawai" value="{{ old('rt_pegawai') }}">
                                </div>
                                <div class="form-group">
                                    <label>RW</label>
                                    <input type="text" class="form-control @error('rw_pegawai') is-invalid @enderror" name="rw_pegawai" value="{{ old('rw_pegawai') }}">
                                </div>
                                <div class="form-group">
                                    <label>Jalan</label>
                                    <textarea class="form-control @error('alamat_pegawai') is-invalid @enderror" name="alamat_pegawai" value="{{ old('alamat_pegawai') }}">{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Nomor Identitas</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Jenis Identitas</label>
                                    <select class="form-control @error('jenis_identitas_pegawai') is-invalid @enderror"  name="jenis_identitas_pegawai">
                                        <option selected disabled> --Pilih Kartu Pengenal-- </option>
                                        @foreach ($kartu_identitas as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Identitas</label>
                                    <input type="text" class="form-control @error('nomor_identitas_pegawai') is-invalid @enderror" name="nomor_identitas_pegawai" value="{{ old('nomor_identitas_pegawai') }}">
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Kontak Darurat</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control @error('nama_kontak_darurat_pegawai') is-invalid @enderror" name="nama_kontak_darurat_pegawai" value="{{ old('nama_kontak_darurat_pegawai') }}">
                                </div>
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="text" class="form-control @error('no_telp_darurat_pegawai') is-invalid @enderror" name="no_telp_darurat_pegawai" value="{{ old('no_telp_darurat_pegawai') }}">
                                </div>
                                <div class="form-group">
                                    <label>Hubungan</label>
                                    <select class="form-control @error('hubungan_pegawai') is-invalid @enderror"  name="hubungan_pegawai">
                                        <option selected disabled> --Pilih Hubungan-- </option>
                                        @foreach ($hubungan_pegawai as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Sosial Media</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Twitter</label>
                                    <input type="text" class="form-control" name="twitter" value="{{ old('twitter') }}">
                                </div>
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" class="form-control" name="instagram" value="{{ old('instagram') }}">
                                </div>
                                <div class="form-group">
                                    <label>Youtube</label>
                                    <input type="text" class="form-control" name="youtube" value="{{ old('youtube') }}">
                                </div>
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" class="form-control" name="facebook" value="{{ old('facebook') }}">
                                </div>
                                <div class="form-group">
                                    <label>Linkedin</label>
                                    <input type="text" class="form-control" name="linkedin" value="{{ old('linkedin') }}">
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
                                <a href="{{ route('pegawai/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
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
