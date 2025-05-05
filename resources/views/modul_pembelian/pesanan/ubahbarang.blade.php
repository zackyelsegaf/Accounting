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
            <form action="{{ route('barang/update', $Barang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"> 
                                <a class="nav-link active" data-toggle="tab" href="#umum">Umum</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#dokumen">Dokumen</a> 
                            </li>
                        </ul>
                    </div>
                    <div id="umum" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tipe Barang</label>
                                                    <select class="form-control @error('tipe_barang') is-invalid @enderror"  name="tipe_barang">
                                                        <option selected disabled {{ old('tipe_barang', $Barang->tipe_barang) ? '' : 'selected' }}> --Pilih Gender-- </option>
                                                        @foreach ($tipe_barang as $items )
                                                            <option value="{{ $items->nama }}" {{ old('tipe_barang', $Barang->tipe_barang) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tipe Persediaan</label>
                                                    <select class="form-control @error('tipe_persediaan') is-invalid @enderror"  name="tipe_persediaan">
                                                        <option selected disabled {{ old('tipe_persediaan', $Barang->tipe_persediaan) ? '' : 'selected' }}> --Pilih Tipe-- </option>
                                                        @foreach ($tipe_persediaan as $items )
                                                            <option value="{{ $items->nama }}" {{ old('tipe_persediaan', $Barang->tipe_persediaan) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kategori Barang</label>
                                                    <select class="form-control @error('kategori_barang') is-invalid @enderror"  name="kategori_barang">
                                                        <option selected disabled {{ old('kategori_barang', $Barang->kategori_barang) ? '' : 'selected' }}> --Pilih Tipe-- </option>
                                                        @foreach ($kategori_barang as $items )
                                                            <option value="{{ $items->nama }}" {{ old('kategori_barang', $Barang->kategori_barang) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>No. Barang</label>
                                                    <input type="text" class="form-control @error('no_barang') is-invalid @enderror" name="no_barang" value="{{ $Barang->no_barang }}">
                                                </div>                                                
                                                <div class="form-group">
                                                    <label>Nama Barang</label>
                                                    <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{ $Barang->nama_barang }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="sub_barang_check">Sub Barang Dari</label>
                                                    <label class="switch">
                                                        <input type="hidden" name="sub_barang_check" value="0">
                                                        <input type="checkbox" name="sub_barang_check" id="sub_barang_check" value="1" {{ old('sub_barang_check', $Barang->sub_barang_check) ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>  
                                                <div class="form-group" id="tipe_barang_form" style="display: none;">
                                                    {{-- <label>Subdari</label> --}}
                                                    <select class="form-control @error('sub_barang') is-invalid @enderror"  name="sub_barang">
                                                        <option selected disabled {{ old('sub_barang', $Barang->sub_barang) ? '' : 'selected' }}> --Pilih Tipe-- </option>
                                                        @foreach ($nama_barang as $items )
                                                            <option value="{{ $items->nama_barang }}" {{ old('sub_barang', $Barang->sub_barang) == $items->nama_barang ? 'selected' : '' }}>{{ $items->nama_barang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi 1</label>
                                                    <textarea class="form-control @error('deskripsi_1') is-invalid @enderror" name="deskripsi_1">{{ old('deskripsi_1', $Barang->deskripsi_1) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi 1</label>
                                                    <textarea class="form-control @error('deskripsi_2') is-invalid @enderror" name="deskripsi_2">{{ old('deskripsi_2', $Barang->deskripsi_2) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Default Gudang</label>
                                                    <select class="form-control @error('default_gudang') is-invalid @enderror"  name="default_gudang">
                                                        <option selected disabled {{ old('default_gudang', $Barang->default_gudang) ? '' : 'selected' }}> --Pilih Tipe-- </option>
                                                        @foreach ($gudang as $items )
                                                            <option value="{{ $items->nama_gudang }}" {{ old('default_gudang', $Barang->default_gudang) == $items->nama_gudang ? 'selected' : '' }}>{{ $items->nama_gudang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Departemen</label>
                                                    <select class="form-control @error('departemen') is-invalid @enderror"  name="departemen">
                                                        <option selected disabled {{ old('departemen', $Barang->departemen) ? '' : 'selected' }}> --Pilih Tipe-- </option>
                                                        @foreach ($departemen as $items )
                                                            <option value="{{ $items->nama_departemen }}" {{ old('departemen', $Barang->departemen) == $items->nama_departemen ? 'selected' : '' }}>{{ $items->nama_departemen }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Proyek</label>
                                                    <select class="form-control @error('proyek') is-invalid @enderror"  name="proyek">
                                                        <option selected disabled {{ old('proyek', $Barang->proyek) ? '' : 'selected' }}> --Pilih Tipe-- </option>
                                                        @foreach ($proyek as $items )
                                                            <option value="{{ $items->nama_proyek }}" {{ old('proyek', $Barang->proyek) == $items->nama_proyek ? 'selected' : '' }}>{{ $items->nama_proyek }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="dihentikan">Dihentikan</label>
                                                    <label class="switch">
                                                        <input type="hidden" name="dihentikan" value="0">
                                                        <input type="checkbox" name="dihentikan" id="dihentikan" value="1" {{ old('dihentikan', $Barang->dihentikan) ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                    <span class="ml-2" id="dihentikan-status">{{ old('dihentikan', $Barang->dihentikan) ? 'Aktif' : 'Tidak Aktif' }}</span>
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
                                        @while (!empty($Barang["fileupload_$i"]))
                                            <div class="row formtype mb-2" id="fieldRow_{{ $i }}">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fileupload_{{ $i }}">File {{ $i }}</label>
                                                        <input type="text" class="form-control" name="fileupload_{{ $i }}" value="{{ $Barang["fileupload_$i"] }}" placeholder="Link dokumen Anda">
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
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#detail">Detail</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#satuan">Satuan</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#bebandanharga">Beban dan Harga</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#upc">UPC dan PLU</a> 
                            </li>
                        </ul>
                    </div>
                    <div id="detail" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <h5 class="card-title">Informasi Penjualan</h5>
                                                <label>Diskon</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="diskon" value="{{ $Barang->diskon }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Kode Pajak</label>
                                                <input type="text" class="form-control @error('kode_pajak') is-invalid @enderror" name="kode_pajak" value="{{ $Barang->kode_pajak }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <h5 class="card-title">Informasi Pembelian</h5>
                                                <label>Pemasok</label>
                                                <select class="form-control @error('pemasok') is-invalid @enderror"  name="pemasok">
                                                    <option selected disabled {{ old('pemasok', $Barang->pemasok) ? '' : 'selected' }}> --Pilih Tipe-- </option>
                                                    @foreach ($pemasok as $items )
                                                        <option value="{{ $items->nama }}" {{ old('pemasok', $Barang->pemasok) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Min. Kts Pesan Ulang</label>
                                                <input type="text" class="form-control @error('minimum_kuantitas_pesan_ulang') is-invalid @enderror" name="minimum_kuantitas_pesan_ulang" value="{{ $Barang->minimum_kuantitas_pesan_ulang }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-8">
                                            <h5 class="card-title">Informasi Persediaan</h5>
                                            <h7 class="font-weight-bold">Saldo Awal</h7>
                                            <div class="form-group">
                                                <label>KTS</label>
                                                <input type="text" id="kuantitas_saldo_awal" class="form-control @error('kuantitas_saldo_awal') is-invalid @enderror" name="kuantitas_saldo_awal" value="{{ $Barang->kuantitas_saldo_awal }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Biaya/Satuan</label>
                                                <input type="text" id="biaya_satuan_saldo_awal" class="form-control @error('biaya_satuan_saldo_awal') is-invalid @enderror" name="biaya_satuan_saldo_awal" value="{{ $Barang->biaya_satuan_saldo_awal }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input type="text" id="total_saldo_awal" class="form-control" value="{{ number_format($Barang->total_saldo_awal ?? 0, 0, ',', '.') }}" readonly>
                                                <input type="hidden" id="total_saldo_awal" name="total_saldo_awal" value="{{ $Barang->total_saldo_awal ?? 0 }}">
                                            </div>         
                                            <div class="form-group">
                                                <h5 class="card-title">Informasi Pembelian</h5>
                                                <label>Gudang</label>
                                                <select class="form-control @error('gudang') is-invalid @enderror"  name="gudang">
                                                    <option selected disabled {{ old('gudang', $Barang->gudang) ? '' : 'selected' }}> --Pilih Tipe-- </option>
                                                    @foreach ($gudang as $items )
                                                        <option value="{{ $items->nama_gudang }}" {{ old('gudang', $Barang->gudang) == $items->nama_gudang ? 'selected' : '' }}>{{ $items->nama_gudang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control datetimepicker @error('tanggal_mulai') is-invalid @enderror" name="tanggal_mulai" value="{{ $Barang->tanggal_mulai }}"> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-8">
                                            <h7 class="font-weight-bold">Saldo Saat ini</h7>
                                            <div class="form-group">
                                                <label>KTS</label>
                                                <input type="text" id="kuantitas_saldo_sekarang" class="form-control @error('kuantitas_saldo_sekarang') is-invalid @enderror" name="kuantitas_saldo_sekarang" value="{{ $Barang->kuantitas_saldo_sekarang }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Harga/Satuan</label>
                                                <input type="text" id="harga_satuan_sekarang" class="form-control @error('harga_satuan_sekarang') is-invalid @enderror" name="harga_satuan_sekarang" value="{{ $Barang->harga_satuan_sekarang }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Harga Pokok</label>
                                                <input type="text" id="biaya_pokok_sekarang" class="form-control @error('biaya_pokok_sekarang') is-invalid @enderror" name="biaya_pokok_sekarang" value="{{ $Barang->biaya_pokok_sekarang }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="satuan" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-center mb-0" id="DataBarangAddSatuan">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Nama Satuan</th>
                                                <th>Ratio</th>
                                                <th>Level Harga 1</th>
                                                <th>Level Harga 2</th>
                                                <th>Level Harga 3</th>
                                                <th>Level Harga 4</th>
                                                <th>Level Harga 5</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-control @error('satuan') is-invalid @enderror"  name="satuan">
                                                        <option selected disabled {{ old('satuan', $Barang->satuan) ? '' : 'selected' }}> --Pilih Tipe-- </option>
                                                        @foreach ($satuan as $items )
                                                            <option value="{{ $items->nama }}" {{ old('satuan', $Barang->satuan) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control @error('rasio') is-invalid @enderror" name="rasio" value="{{ $Barang->rasio }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control @error('level_harga_1') is-invalid @enderror" name="level_harga_1" value="{{ $Barang->level_harga_1 }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control @error('level_harga_2') is-invalid @enderror" name="level_harga_2" value="{{ $Barang->level_harga_2 }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control @error('level_harga_3') is-invalid @enderror" name="level_harga_3" value="{{ $Barang->level_harga_3 }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control @error('level_harga_4') is-invalid @enderror" name="level_harga_4" value="{{ $Barang->level_harga_4 }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control @error('level_harga_5') is-invalid @enderror" name="level_harga_5" value="{{ $Barang->level_harga_5 }}">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div id="bebandanharga" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row formtype">
                                            <div class="col-md-8">                                              
                                                <div class="form-group">
                                                    <label>Minimal Harga Jual</label>
                                                    <input type="text" class="form-control @error('minimal_harga_jual') is-invalid @enderror" name="minimal_harga_jual" value="{{ $Barang->minimal_harga_jual }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Maksimal Harga Jual</label>
                                                    <input type="text" class="form-control @error('maksimal_harga_jual') is-invalid @enderror" name="maksimal_harga_jual" value="{{ $Barang->maksimal_harga_jual }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Minimal Harga Beli</label>
                                                    <input type="text" class="form-control @error('minimal_harga_beli') is-invalid @enderror" name="minimal_harga_beli" value="{{ $Barang->minimal_harga_beli }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Maksimal Harga Beli</label>
                                                    <input type="text" class="form-control @error('maksimal_harga_beli') is-invalid @enderror" name="maksimal_harga_beli" value="{{ $Barang->maksimal_harga_beli }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="upc" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row formtype">
                                            <div class="col-md-8">                                              
                                                <div class="form-group">
                                                    <label>No. UPC/Barcode</label>
                                                    <input type="text" class="form-control @error('nomor_upc') is-invalid @enderror" name="nomor_upc" value="{{ $Barang->nomor_upc }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>No. PLU</label>
                                                    <input type="text" class="form-control @error('nomor_plu') is-invalid @enderror" name="nomor_plu" value="{{ $Barang->nomor_plu }}">
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
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("sub_barang_check");
            const tipeAkunForm = document.getElementById("tipe_barang_form");
    
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
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("sub_barang_check");
            const tipeAkunForm = document.getElementById("tipe_barang_form");
    
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
            const input = document.getElementById('kuantitas_saldo_awal');
    
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
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('biaya_satuan_saldo_awal');
    
            input.addEventListener('input', () => {
                let angka = input.value.replace(/\D/g, '');
                input.value = formatRupiah(angka);
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
        document.addEventListener('DOMContentLoaded', () => {
            const tampil = document.getElementById('total_saldo_awal');
            if (tampil) {
                let angka = tampil.value.replace(/\D/g, '');
                tampil.value = formatRupiah(angka);
            }
    
            function formatRupiah(angka, prefix = '') {
                angka = angka.toString().replace(/[^,\d]/g, '');
                return prefix + angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const biaya_satuan_saldo_awal = document.getElementById('biaya_satuan_saldo_awal');
            const kuantitas_saldo_awal = document.getElementById('kuantitas_saldo_awal');
            const total_saldo = document.getElementById('total_saldo_awal');

            function handleInputFormat(input) {
                input.addEventListener('input', () => {
                    let angka = input.value.replace(/\D/g, '');
                    input.value = formatRupiah(angka);
                    hitungTotal();
                });
            }
    
            handleInputFormat(biaya_satuan_saldo_awal);
            handleInputFormat(kuantitas_saldo_awal);
    
            function hitungTotal() {
                let saldo = parseInt(biaya_satuan_saldo_awal.value.replace(/\D/g, '')) || 0;
                let tambahan = parseInt(kuantitas_saldo_awal.value.replace(/\D/g, '')) || 0;
                let total = saldo * tambahan;
                total_saldo.value = formatRupiah(String(total));
                document.getElementById('total_saldo_awal').value = total;
            }
    
            function formatRupiah(angka, prefix = '') {
                return prefix + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
    
            const form = biaya_satuan_saldo_awal.closest('form');
            if (form) {
                form.addEventListener('submit', () => {
                    biaya_satuan_saldo_awal.value = biaya_satuan_saldo_awal.value.replace(/\D/g, '');
                    kuantitas_saldo_awal.value = kuantitas_saldo_awal.value.replace(/\D/g, '');
                });
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