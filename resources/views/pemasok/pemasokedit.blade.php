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
            <form action="{{ route('pemasok/update', $Pemasok->id) }}" method="POST" enctype="multipart/form-data">
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
                                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="pemasok_id" name="pemasok_id" value="{{ $Pemasok->pemasok_id }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Pemasok</label>
                                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $Pemasok->nama }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                                                        <option selected disabled {{ old('status', $Pemasok->status) ? '' : 'selected' }}> --Pilih Status-- </option>
                                                        @foreach ($data as $items)
                                                            <option value="{{ $items->nama }}" {{ old('status', $Pemasok->status) == $items->nama ? 'selected' : '' }}>
                                                                {{ $items->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>    
                                                <div class="form-group">
                                                    <label for="dihentikan">Dihentikan</label>
                                                    <label class="switch">
                                                        <input type="hidden" name="dihentikan" value="0">
                                                        <input type="checkbox" name="dihentikan" id="dihentikan" value="1" {{ old('dihentikan', $Pemasok->dihentikan) ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                    <span class="ml-2" id="dihentikan-status">{{ old('dihentikan', $Pemasok->dihentikan) ? 'Aktif' : 'Tidak Aktif' }}</span>
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
                                                    <input type="text" class="form-control @error('fileupload_1') is-invalid @enderror" name="fileupload_1" placeholder="Link dokumen Anda" value="{{ $Pemasok->fileupload_1 }}">
                                                </div>
                                            </div>
                                        </div>
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
                                                    <textarea class="form-control @error('alamat_1') is-invalid @enderror" name="alamat_1">{{ old('alamat_1', $Pemasok->alamat_1) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat 2</label>
                                                    <textarea class="form-control @error('alamat_2') is-invalid @enderror" name="alamat_2">{{ old('alamat_2', $Pemasok->alamat_2) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Pajak 1</label>
                                                    <textarea class="form-control @error('alamatpajak_1') is-invalid @enderror" name="alamatpajak_1">{{ old('alamatpajak_1', $Pemasok->alamatpajak_1) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Pajak 2</label>
                                                    <textarea class="form-control @error('alamatpajak_2') is-invalid @enderror" name="alamatpajak_2">{{ old('alamatpajak_2', $Pemasok->alamatpajak_2) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Provinsi</label>
                                                    <select class="form-control @error('provinsi') is-invalid @enderror" name="provinsi">
                                                        <option selected disabled {{ old('provinsi', $Pemasok->provinsi) ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                                        @foreach ($provinsi as $items )
                                                            <option value="{{ $items->nama }}" {{ old('provinsi', $Pemasok->provinsi) == $items->nama ? 'selected' : '' }}>
                                                                {{ $items->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>   
                                                <div class="form-group">
                                                    <label>Kota</label>
                                                    <select class="form-control @error('kota') is-invalid @enderror"  name="kota">
                                                        <option selected disabled {{ old('kota', $Pemasok->kota) ? '' : 'selected' }}> --Pilih Kota-- </option>
                                                        @foreach ($kota as $items )
                                                            <option value="{{ $items->nama }}" {{ old('kota', $Pemasok->kota) == $items->nama ? 'selected' : '' }}>
                                                                {{ $items->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Negara</label>
                                                    <select class="form-control @error('negara') is-invalid @enderror"  name="negara">
                                                        <option selected disabled {{ old('negara', $Pemasok->negara) ? '' : 'selected' }}> --Pilih Negara-- </option>
                                                        @foreach ($negara as $items )
                                                            <option value="{{ $items->nama }}" {{ old('negara', $Pemasok->negara) == $items->nama ? 'selected' : '' }}>
                                                                {{ $items->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kode Pos</label>
                                                    <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos" value="{{ $Pemasok->kode_pos }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Kontak</label>
                                                    <input type="text" class="form-control @error('kontak') is-invalid @enderror" name="kontak" value="{{ $Pemasok->kontak }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>No. Telp</label>
                                                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ $Pemasok->no_telp }}">
                                                </div><div class="form-group">
                                                    <label>No. FAX</label>
                                                    <input type="text" class="form-control @error('no_fax') is-invalid @enderror"  name="no_fax" value="{{ $Pemasok->no_fax }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $Pemasok->email }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Website</label>
                                                    <input type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ $Pemasok->website }}">
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
                                                    <label>NPWP</label>
                                                    <input type="text" class="form-control @error('npwp') is-invalid @enderror" name="npwp" value="{{ $Pemasok->npwp }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Pajak 1</label>
                                                    <select class="form-control @error('pajak_1') is-invalid @enderror" name="pajak_1">
                                                        <option selected disabled {{ old('pajak_1', $Pemasok->pajak_1) ? '' : 'selected' }}> --Pilih Pajak 1-- </option>
                                                        @foreach ($pajak as $items )
                                                            <option value="{{ $items->nama }}" {{ old('pajak_1', $Pemasok->pajak_1) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pajak 2</label>
                                                    <select class="form-control @error('pajak_2') is-invalid @enderror"  name="pajak_2">
                                                        <option selected disabled  {{ old('pajak_2', $Pemasok->pajak_2) ? '' : 'selected' }}> --Pilih Pajak 2-- </option>
                                                        @foreach ($pajak as $items )
                                                            <option value="{{ $items->nama }}" {{ old('pajak_2', $Pemasok->pajak_2) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Syarat</label>
                                                    <select class="form-control @error('syarat') is-invalid @enderror"  name="syarat">
                                                        <option selected disabled  {{ old('syarat', $Pemasok->syarat) ? '' : 'selected' }}> --Pilih Syarat-- </option>
                                                        @foreach ($syarat as $items )
                                                            <option value="{{ $items->nama }}" {{ old('syarat', $Pemasok->syarat) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mata Uang</label>
                                                    <select class="form-control @error('mata_uang') is-invalid @enderror"  name="mata_uang">
                                                        <option selected disabled  {{ old('mata_uang', $Pemasok->mata_uang) ? '' : 'selected' }}> --Pilih Mata Uang-- </option>
                                                        @foreach ($mata_uang as $items )
                                                            <option value="{{ $items->nama }}" {{ old('mata_uang', $Pemasok->mata_uang) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Saldo Awal</label>
                                                            <input type="text" id="saldo_awal" class="form-control @error('saldo_awal') is-invalid @enderror" name="saldo_awal" value="{{ 'Rp ' . number_format($Pemasok->saldo_awal, 0, ',', '.') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal</label>
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control datetimepicker @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ $Pemasok->tanggal }}"> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label>Deskripsi</label>
                                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi">{{ old('deskripsi', $Pemasok->deskripsi) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>No. PKP</label>
                                                    <input type="text" class="form-control @error('no_pkp') is-invalid @enderror" name="no_pkp" value="{{ $Pemasok->no_pkp }}">
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
                                                    <textarea class="form-control @error('memo') is-invalid @enderror" name="memo">{{ old('memo', $Pemasok->memo) }}</textarea>
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
            const input = document.getElementById('saldo_awal');
    
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
    @endsection
@endsection