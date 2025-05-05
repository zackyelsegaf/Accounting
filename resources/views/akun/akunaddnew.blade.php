@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Akun</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/akun/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row formtype">
                            <div class="col-md-6">                
                                <div class="form-group">
                                    <label>Tipe Akun</label>
                                    <select class="form-control @error('tipe_akun') is-invalid @enderror" name="tipe_akun">
                                        <option selected disabled> --Pilih Tipe Akun-- </option>
                                        @foreach ($tipe_akun as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>                              
                                <div class="form-group">
                                    <label>No. Akun</label>
                                    <input type="text" class="form-control @error('no_akun') is-invalid @enderror" name="no_akun" value="{{ old('no_akun') }}">
                                </div>
                                <div class="form-group">
                                    <label>Nama Akun (Indonesia)</label>
                                    <textarea class="form-control derror" name="nama_akun_indonesia" value="{{ old('nama_akun_indonesia') }}">{{ old('nama_akun_indonesia') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nama Akun (English)</label>
                                    <textarea class="form-control" name="nama_akun_inggris" value="{{ old('nama_akun_inggris') }}">{{ old('nama_akun_inggris') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Mata Uang</label>
                                    <select class="form-control @error('mata_uang') is-invalid @enderror" name="mata_uang">
                                        <option selected disabled> --Pilih Mata Uang-- </option>
                                        @foreach ($mata_uang as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sub_akun_check">Sub Akun Dari</label>
                                    <label class="switch">
                                        <input type="hidden" name="sub_akun_check" value="0">
                                        <input type="checkbox" name="sub_akun_check" id="sub_akun_check" value="1" {{ old('sub_akun_check') ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="form-group" id="tipe_akun_form" style="display: none;">
                                    {{-- <label>Subdari</label> --}}
                                    <select class="form-control" name="sub_akun">
                                        <option selected disabled> --Pilih Sub-- </option>
                                        @foreach ($nama_akun as $items )
                                            <option value="{{ $items->no_akun }}">{{ $items->no_akun .' '. $items->nama_akun_indonesia }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Saldo</label>
                                    <input type="text" id="saldo_akun" class="form-control @error('saldo_akun') is-invalid @enderror" name="saldo_akun" value="{{ old('saldo_akun') }}">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal') }}"> 
                                    </div>
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
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <button type="submit" class="btn btn-primary buttonedit1"><i class="fa fa-check mr-2"></i>Simpan</button>
                                <a href="{{ route('akun/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('script') 
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("sub_akun_check");
            const tipeAkunForm = document.getElementById("tipe_akun_form");
    
            function toggleTipeAkunForm() {
                if (checkbox.checked) {
                    tipeAkunForm.style.display = "block";
                } else {
                    tipeAkunForm.style.display = "none";
                }
            }
    
            toggleTipeAkunForm();
    
            checkbox.addEventListener("change", toggleTipeAkunForm);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('saldo_akun');
    
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