@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Mata Uang</h3> 
                    </div>
                </div>
            </div>
            <form action="{{ route('pelanggan/update', $Pelanggan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"> 
                                <a class="nav-link active" data-toggle="tab" href="#detail">Detail</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#dokumen">Dokumen</a> 
                            </li>
                        </ul>
                    </div>
                    <div id="detail" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No</label>
                                                    <input type="text" class="form-control" id="pelanggan_id" name="pelanggan_id" value="{{ $Pelanggan->pelanggan_id }}">
                                                </div>                                                
                                                <div class="form-group">
                                                    <label>Nama Pelanggan</label>
                                                    <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" name="nama_pelanggan" value="{{ $Pelanggan->nama_pelanggan }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                                                        <option selected disabled {{ old('status', $Pelanggan->status) ? '' : 'selected' }}> --Pilih Status-- </option>
                                                        @foreach ($data as $items)
                                                            <option value="{{ $items->nama }}" {{ old('status', $Pelanggan->status) == $items->nama ? 'selected' : '' }}>
                                                                {{ $items->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>  
                                                <div class="form-group">
                                                    <label>NIK</label>
                                                    <input type="text" class="form-control @error('nik_pelanggan') is-invalid @enderror" name="nik_pelanggan" value="{{ $Pelanggan->nik_pelanggan }}">
                                                </div>
                                                <h7 class="font-weight-bold">Tempat dan Tanggal Lahir</h7>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Kota</label>
                                                            <select class="form-control @error('tempat_lahir') is-invalid @enderror"  name="tempat_lahir">
                                                                <option selected disabled {{ old('tempat_lahir', $Pelanggan->tempat_lahir) ? '' : 'selected' }}> --Pilih Kota-- </option>
                                                                @foreach ($kota as $items )
                                                                    <option value="{{ $items->nama }}" {{ old('tempat_lahir', $Pelanggan->tempat_lahir) == $items->nama ? 'selected' : '' }}>
                                                                        {{ $items->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal Lahir</label>
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control datetimepicker @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ $Pelanggan->tanggal_lahir }}"> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- <div class="form-group">
                                                            <label>Negara</label>
                                                            <select class="form-control @error('negara') is-invalid @enderror"  name="negara">
                                                                <option selected disabled> --Pilih Negara-- </option>
                                                                @foreach ($negara as $items )
                                                                    <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div> --}}
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label>Agama</label>
                                                    <select class="form-control @error('agama') is-invalid @enderror" name="agama">
                                                        <option selected disabled {{ old('agama', $Pelanggan->agama) ? '' : 'selected' }}> --Pilih Agama-- </option>
                                                        @foreach ($agama as $items )
                                                            <option value="{{ $items->nama }}" {{ old('agama', $Pelanggan->agama) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror"  name="jenis_kelamin">
                                                        <option selected disabled {{ old('jenis_kelamin', $Pelanggan->jenis_kelamin) ? '' : 'selected' }}> --Pilih Gender-- </option>
                                                        @foreach ($gender as $items )
                                                            <option value="{{ $items->nama }}" {{ old('jenis_kelamin', $Pelanggan->jenis_kelamin) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Ayah</label>
                                                    <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror" name="nama_ayah" value="{{ $Pelanggan->nama_ayah }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Ibu</label>
                                                    <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror" name="nama_ibu" value="{{ $Pelanggan->nama_ibu }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="dihentikan">Dihentikan</label>
                                                    <label class="switch">
                                                        <input type="hidden" name="dihentikan" value="0">
                                                        <input type="checkbox" name="dihentikan" id="dihentikan" value="1" {{ old('dihentikan', $Pelanggan->dihentikan) ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                    <span class="ml-2" id="dihentikan-status">{{ old('dihentikan', $Pelanggan->dihentikan) ? 'Aktif' : 'Tidak Aktif' }}</span>
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
                                <div class="page-header">
                                    <div class="row float-right">
                                        <button type="button" id="fileuploads_btn_update" class="btn btn-primary buttonedit1 float-right"><i class="fa fa-plus mr-2"></i>Tambah Field</button>
                                    </div>
                                </div>
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12" id="fileuploads_loop">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @while (!empty($Pelanggan["fileupload_$i"]))
                                            <div class="row formtype mb-2" id="fieldRow_{{ $i }}">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fileupload_{{ $i }}">File {{ $i }}</label>
                                                        <input type="text" class="form-control" name="fileupload_{{ $i }}" value="{{ $Pelanggan["fileupload_$i"] }}" placeholder="Link dokumen Anda">
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-1 d-flex align-items-end">
                                                    <button type="button" class="btn btn-danger btn-sm removeField" data-id="{{ $i }}">Hapus</button>
                                                </div> --}}
                                            </div>
                                            @php $i++; @endphp
                                        @endwhile
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"> 
                                <a class="nav-link active" data-toggle="tab" href="#info">Info</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#penjualan">Penjualan</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#syarat">Syarat</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#memo">Memo</a> 
                            </li>
                        </ul>
                    </div>
                    <div id="info" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Alamat 1</label>
                                                    <textarea class="form-control @error('alamat_1') is-invalid @enderror" name="alamat_1">{{ old('alamat_1', $Pelanggan->alamat_1) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat 2</label>
                                                    <textarea class="form-control @error('alamat_2') is-invalid @enderror" name="alamat_2">{{ old('alamat_2', $Pelanggan->alamat_2) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Pajak 1</label>
                                                    <textarea class="form-control @error('alamatpajak_1') is-invalid @enderror" name="alamatpajak_1">{{ old('alamatpajak_1', $Pelanggan->alamatpajak_1) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Pajak 2</label>
                                                    <textarea class="form-control @error('alamatpajak_2') is-invalid @enderror" name="alamatpajak_2">{{ old('alamatpajak_2', $Pelanggan->alamatpajak_2) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Provinsi</label>
                                                    <select class="form-control @error('provinsi') is-invalid @enderror" name="provinsi">
                                                        <option selected disabled {{ old('provinsi', $Pelanggan->provinsi) ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                                        @foreach ($provinsi as $items )
                                                            <option value="{{ $items->nama }}" {{ old('provinsi', $Pelanggan->provinsi) == $items->nama ? 'selected' : '' }}>
                                                                {{ $items->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>   
                                                <div class="form-group">
                                                    <label>Kota</label>
                                                    <select class="form-control @error('kota') is-invalid @enderror"  name="kota">
                                                        <option selected disabled {{ old('kota', $Pelanggan->kota) ? '' : 'selected' }}> --Pilih Kota-- </option>
                                                        @foreach ($kota as $items )
                                                            <option value="{{ $items->nama }}" {{ old('kota', $Pelanggan->kota) == $items->nama ? 'selected' : '' }}>
                                                                {{ $items->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Negara</label>
                                                    <select class="form-control @error('negara') is-invalid @enderror"  name="negara">
                                                        <option selected disabled {{ old('negara', $Pelanggan->negara) ? '' : 'selected' }}> --Pilih Negara-- </option>
                                                        @foreach ($negara as $items )
                                                            <option value="{{ $items->nama }}" {{ old('negara', $Pelanggan->negara) == $items->nama ? 'selected' : '' }}>
                                                                {{ $items->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kode Pos</label>
                                                    <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos" value="{{ $Pelanggan->kode_pos }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Kontak</label>
                                                    <input type="text" class="form-control @error('kontak') is-invalid @enderror" name="kontak" value="{{ $Pelanggan->kontak }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>No. Telp</label>
                                                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ $Pelanggan->no_telp }}">
                                                </div><div class="form-group">
                                                    <label>No. FAX</label>
                                                    <input type="text" class="form-control @error('no_fax') is-invalid @enderror"  name="no_fax" value="{{ $Pelanggan->no_fax }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $Pelanggan->email }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Website</label>
                                                    <input type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ $Pelanggan->website }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="penjualan" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>NPWP</label>
                                                    <input type="text" class="form-control mb-3 @error('npwp_pelanggan') is-invalid @enderror" name="npwp_pelanggan" value="{{ $Pelanggan->npwp_pelanggan }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>NPPKP</label>
                                                    <input type="text" class="form-control mb-3 @error('nppkp_pelanggan') is-invalid @enderror" name="nppkp_pelanggan" value="{{ $Pelanggan->nppkp_pelanggan }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Pajak 1</label>
                                                    <select class="form-control @error('pajak_1_pelanggan') is-invalid @enderror" name="pajak_1_pelanggan">
                                                        <option selected disabled {{ old('pajak_1_pelanggan', $Pelanggan->pajak_1_pelanggan) ? '' : 'selected' }}> --Pilih Pajak 1-- </option>
                                                        @foreach ($pajak as $items )
                                                            <option value="{{ $items->nama }}" {{ old('pajak_1_pelanggan', $Pelanggan->pajak_1_pelanggan) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pajak 2</label>
                                                    <select class="form-control @error('pajak_2_pelanggan') is-invalid @enderror"  name="pajak_2_pelanggan">
                                                        <option selected disabled {{ old('pajak_2_pelanggan', $Pelanggan->pajak_2_pelanggan) ? '' : 'selected' }}> --Pilih Pajak 2-- </option>
                                                        @foreach ($pajak as $items )
                                                            <option value="{{ $items->nama }}" {{ old('pajak_2_pelanggan', $Pelanggan->pajak_2_pelanggan) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label>Penjual</label>
                                                    <select class="form-control @error('penjual') is-invalid @enderror"  name="penjual">
                                                        <option selected disabled> --Pilih Penjual-- </option>
                                                        @foreach ($penjual as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                                <div class="form-group">
                                                    <label>Tipe Pelanggan</label>
                                                    <select class="form-control @error('tipe_pelanggan') is-invalid @enderror"  name="tipe_pelanggan">
                                                        <option selected disabled {{ old('tipe_pelanggan', $Pelanggan->tipe_pelanggan) ? '' : 'selected' }}> --Pilih Tipe Pelanggan-- </option>
                                                        @foreach ($tipe_pelanggan as $items )
                                                            <option value="{{ $items->nama }}" {{ old('tipe_pelanggan', $Pelanggan->tipe_pelanggan) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Level Harga</label>
                                                    <select class="form-control @error('level_harga_pelanggan') is-invalid @enderror"  name="level_harga_pelanggan">
                                                        <option selected disabled {{ old('level_harga_pelanggan', $Pelanggan->level_harga_pelanggan) ? '' : 'selected' }}> --Pilih Level Harga-- </option>
                                                        @foreach ($level_harga as $items )
                                                            <option value="{{ $items->nama }}" {{ old('level_harga_pelanggan', $Pelanggan->level_harga_pelanggan) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Diskon Penjualan</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control @error('diskon_penjualan_pelanggan') is-invalid @enderror" name="diskon_penjualan_pelanggan" placeholder="Persentase Pajak" value="{{ $Pelanggan->diskon_penjualan_pelanggan }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                    </div>                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="syarat" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row formtype">
                                            <div class="col-md-8">     
                                                <div class="form-group">
                                                    <label>Syarat</label>
                                                    <select class="form-control @error('syarat_pelanggan') is-invalid @enderror"  name="syarat_pelanggan">
                                                        <option selected disabled  {{ old('syarat_pelanggan', $Pelanggan->syarat_pelanggan) ? '' : 'selected' }}> --Pilih Syarat-- </option>
                                                        @foreach ($syarat as $items )
                                                            <option value="{{ $items->nama }}" {{ old('syarat_pelanggan', $Pelanggan->syarat_pelanggan) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>                                          
                                                <div class="form-group">
                                                    <label>Batas Maksimal Hutang</label>
                                                    <input type="text" class="form-control @error('batas_maks_hutang') is-invalid @enderror" name="batas_maks_hutang" value="{{ $Pelanggan->batas_maks_hutang }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Batas Umur Hutang</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control @error('batas_umur_hutang') is-invalid @enderror" name="batas_umur_hutang" placeholder="Batas Umur Hutang" value="{{ $Pelanggan->batas_umur_hutang }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Hari</span>
                                                        </div>
                                                    </div>                                
                                                </div>         
                                                <div class="form-group">
                                                    <label>Mata Uang</label>
                                                    <select class="form-control @error('mata_uang_pelanggan') is-invalid @enderror"  name="mata_uang_pelanggan">
                                                        <option selected disabled  {{ old('mata_uang_pelanggan', $Pelanggan->mata_uang_pelanggan) ? '' : 'selected' }}> --Pilih Mata Uang-- </option>
                                                        @foreach ($mata_uang as $items )
                                                            <option value="{{ $items->nama }}" {{ old('mata_uang_pelanggan', $Pelanggan->mata_uang_pelanggan) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> 
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Saldo Awal</label>
                                                            <input type="text" id="saldo_awal_pelanggan" class="form-control @error('saldo_awal_pelanggan') is-invalid @enderror" name="saldo_awal_pelanggan" value="{{ 'Rp ' . number_format($Pelanggan->saldo_awal_pelanggan, 0, ',', '.') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal</label>
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control datetimepicker @error('tanggal_pelanggan') is-invalid @enderror" name="tanggal_pelanggan" value="{{ $Pelanggan->tanggal_pelanggan }}"> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label>Deskripsi</label>
                                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi">{{ old('deskripsi', $Pelanggan->deskripsi) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="memo" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {{-- <label>Memo</label> --}}
                                                    <textarea class="form-control @error('memo') is-invalid @enderror" name="memo">{{ old('memo', $Pelanggan->memo) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('dihentikan');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script>    
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('saldo_awal_pelanggan');
    
            input.addEventListener('input', () => {
                let angka = input.value.replace(/\D/g, '');
                input.value = formatRupiah(angka, 'Rp ');
            });
    
            input.closest('form').addEventListener('submit', () => {
                input.value = input.value.replace(/\D/g, '');
            });
    
            function formatRupiah(angka, prefix = '') {
                return prefix + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
        });
    </script>
    <script>
        let fieldCount = {{ $i - 1 }};
        const maxFields = 7;
    
        document.getElementById('fileuploads_btn_update').addEventListener('click', function () {
            if (fieldCount >= maxFields) {
                alert('Maksimal hanya boleh 7 file.');
                return;
            }
            
            fieldCount++;
    
            const fieldRow = `
                <div class="row formtype mb-2" id="fieldRow_${fieldCount}">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fileupload_${fieldCount}">File ${fieldCount}</label>
                            <input type="text" class="form-control" name="fileupload_${fieldCount}" placeholder="Link dokumen Anda">
                        </div>
                    </div>
                </div>
            `;
    
            document.getElementById('fileuploads_loop').insertAdjacentHTML('beforeend', fieldRow);
        });
    
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('removeField')) {
                const id = e.target.dataset.id;
                document.getElementById('fieldRow_' + id).remove();
            }
        });
    </script>    
    @endsection
@endsection