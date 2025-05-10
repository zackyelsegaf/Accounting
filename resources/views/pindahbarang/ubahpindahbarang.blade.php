@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Pindah Barang</h3> 
                    </div>
                </div>
            </div>
            <form action="{{ route('pindahbarang/update', $pindahBarang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Change Password</h5> --}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row formtype">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No. Penyesuaian</label>
                                                <input type="text" class="form-control" id="no_pindah" name="no_pindah" value="{{ $pindahBarang->no_pindah }}">
                                                <input type="hidden" name="pindah_barang_id" value="{{ $pindahBarang->detail->id ?? '' }}">
                                            </div>  
                                            <div class="form-group" style="display: none">
                                                <label>Pengguna</label>
                                                <input type="text" class="form-control" name="pengguna_pindah" value="{{ $pindahBarang->detail->pengguna_pindah }}">
                                            </div>  
                                            <div class="form-group">
                                                <label>Tanggal Penyesuaian</label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control datetimepicker @error('tgl_pindah') is-invalid @enderror" name="tgl_pindah" value="{{ $pindahBarang->tgl_pindah }}"> 
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
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#rincian">Rincian Data</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#dokumen">Dokumen</a> 
                            </li>
                        </ul>
                    </div>
                    <div id="rincian" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Dari Gudang</strong></label>
                                                 <select class="form-control"  name="dari_gudang">
                                                    <option {{ old('dari_gudang', $pindahBarang->dari_gudang) ? '' : 'selected' }} disabled></option>
                                                    @foreach ($gudang as $items )
                                                    <option value="{{ $items->nama_gudang }}" {{ old('dari_gudang', $pindahBarang->dari_gudang) == $items->nama_gudang ? 'selected' : '' }}>{{ $items->nama_gudang }}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                            <div class="form-group">
                                                <textarea class="form-control @error('dari_alamat') is-invalid @enderror" name="dari_alamat" value="{{ old('dari_alamat') }}">{{ old('dari_alamat', $pindahBarang->dari_alamat) }}</textarea>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Ke Gudang</strong></label>
                                                <select class="form-control"  name="ke_gudang">
                                                    <option {{ old('ke_gudang', $pindahBarang->ke_gudang) ? '' : 'selected' }} disabled></option>
                                                    @foreach ($gudang as $items )
                                                    <option value="{{ $items->nama_gudang }}" {{ old('ke_gudang', $pindahBarang->ke_gudang) == $items->nama_gudang ? 'selected' : '' }}>{{ $items->nama_gudang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>  
                                            <div class="form-group">
                                                <textarea class="form-control" name="ke_alamat" value="{{ old('ke_alamat') }}" placeholder="Ke Alamat">{{ old('ke_alamat', $pindahBarang->ke_alamat) }}</textarea>
                                            </div>                                         
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><strong>Deskripsi</strong></label>
                                                <textarea class="form-control" name="deskripsi" value="{{ old('deskripsi') }}">{{ old('deskripsi' , $pindahBarang->deskripsi) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row float-right mr-0">
                                    <button type="button" class="btn btn-primary buttonedit mb-3" id="tambahBarangBtn"><strong><i class="fas fa-cube mr-3 ml-1"></i>Tambah</strong></button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-center mb-0" id="DataBarangAddSatuan">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No. Barang</th>
                                                <th>Deskripsi Barang</th>
                                                <th>Kts Barang</th>
                                                <th>Satuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="barangTableBody">
                                            <tr class="barang-row">
                                                <td>
                                                    <select style="width: 160px; cursor: pointer;" class="form-control no-barang-select" name="no_barang[]">
                                                        <option disabled {{ old('no_barang', $pindahBarang->detail->no_barang) ? '' : 'selected' }}></option>
                                                        @foreach ($nama_barang as $items)
                                                            <option value="{{ $items->no_barang }}" 
                                                                data-nama="{{ $items->nama_barang }}"
                                                                data-kts="{{ $items->kuantitas_saldo_awal }}"
                                                                data-satuan="{{ $items->satuan }}"
                                                                {{ old('no_barang', $pindahBarang->detail->no_barang) == $items->no_barang ? 'selected' : '' }}>
                                                                {{ $items->no_barang . " - " . $items->nama_barang }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input style="width: 160px;" class="form-control deskripsi-barang-input" name="deskripsi_barang[]" value="{{ $pindahBarang->detail->deskripsi_barang }}" readonly>
                                                </td>
                                                <td>
                                                    <input style="width: 160px; cursor: pointer;" class="form-control kts-barang-input" name="kts_barang[]" value="{{ $pindahBarang->detail->kts_barang }}">
                                                </td>
                                                <td>
                                                    <select style="width: 160px; cursor: pointer;" class="form-control" name="satuan[]">
                                                        <option disabled {{ old('satuan', $pindahBarang->detail->satuan) ? '' : 'selected' }}></option>
                                                        @foreach ($satuan as $items)
                                                            <option value="{{ $items->nama }}" {{ old('satuan', $pindahBarang->detail->satuan) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="button" style="width: 120px;" class="btn btn-primary buttonedit2 mr-2 remove-row"><strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <button type="submit" class="btn btn-primary buttonedit">Update</button>
                                <a href="{{ route('pindahbarang/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3 mb-5"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('script')
    <script>
        function hitungPenyesuaian() {
            let ktsBaru = parseFloat(document.querySelector('input[name="kts_baru"]').value) || 0;
            let nilaiSaatIni = parseFloat(document.getElementById('nilaiSaatIniInput').value.replace(/\./g, '').replace(',', '.')) || 0;
            let ktsSaatIni = parseFloat(document.querySelector('input[name="kts_saat_ini"]').value) || 0;
    
            let hargaPerUnit = ktsSaatIni !== 0 ? nilaiSaatIni / ktsSaatIni : 0;
            let nilaiBaru = ktsBaru * hargaPerUnit;
            let totalPenyesuaian = nilaiBaru - nilaiSaatIni;

            const inputNilaiBaru = document.querySelector('input[name="nilai_baru"]');
            inputNilaiBaru.value = Math.round(nilaiBaru).toLocaleString('id-ID');
    
            document.getElementById('displayTotalPenyesuaian').value = formatRupiah(totalPenyesuaian);
    
            document.querySelector('input[name="total_nilai_penyesuaian"]').value = Math.round(totalPenyesuaian);
        }
    
        function formatRupiah(angka) {
            return angka.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
        }
    
        document.querySelector('input[name="kts_baru"]').addEventListener('input', hitungPenyesuaian);
    
        document.getElementById('namaBarangSelect').addEventListener('change', function () {
            let selectedOption = this.options[this.selectedIndex];
            document.getElementById('ktsSaatIniInput').value = selectedOption.getAttribute('data-ktssaatini');
            document.getElementById('nilaiSaatIniInput').value = selectedOption.getAttribute('data-nilaisaatini');
            document.getElementById('deskripsiBarangInput').value = selectedOption.getAttribute('data-nama');
            document.getElementById('departemenSelect').value = selectedOption.getAttribute('data-departemen');
            document.getElementById('proyekSelect').value = selectedOption.getAttribute('data-proyek');
            document.getElementById('gudangSelect').value = selectedOption.getAttribute('data-gudang');
    
            hitungPenyesuaian();
        });
    </script>              
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('nilai_penyesuaian_check');
            const kolomNilai = document.querySelectorAll('.kolom-nilai');
    
            function toggleKolomNilai() {
                const show = checkbox.checked;
                kolomNilai.forEach(kolom => {
                    kolom.style.display = show ? '' : 'none';
                });
            }
    
            toggleKolomNilai();
            checkbox.addEventListener('change', toggleKolomNilai);
        });
    </script>    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const namaBarangSelect = document.getElementById('namaBarangSelect');
            const deskripsiBarangInput = document.getElementById('deskripsiBarangInput');
            const departemenSelect = document.getElementById('departemenSelect');
            const proyekSelect = document.getElementById('proyekSelect');
            const gudangSelect = document.getElementById('gudangSelect');
            const ktsSaatIniInput = document.getElementById('ktsSaatIniInput');
            const nilaiSaatIniInput = document.getElementById('nilaiSaatIniInput');
        
        namaBarangSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            deskripsiBarangInput.value = selectedOption.getAttribute('data-nama') || '';
            departemenSelect.value = selectedOption.getAttribute('data-departemen') || '';
            proyekSelect.value = selectedOption.getAttribute('data-proyek') || '';
            gudangSelect.value = selectedOption.getAttribute('data-gudang') || '';
            ktsSaatIniInput.value = selectedOption.getAttribute('data-ktssaatini') || '';
            nilaiSaatIniInput.value = selectedOption.getAttribute('data-nilaisaatini') || '';
        });
    });
    </script>        
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const noAkunSelect = document.getElementById('noAkunSelect');
            const namaAkunSelect = document.getElementById('namaAkunSelect');
        
        noAkunSelect.addEventListener('change', function () {
            const selectedNo = this.value;
            const nama = this.options[this.selectedIndex].getAttribute('data-nama');
    
            for (let i = 0; i < namaAkunSelect.options.length; i++) {
                if (namaAkunSelect.options[i].value === nama) {
                    namaAkunSelect.selectedIndex = i;
                    break;
                }
            }
        });
    
        namaAkunSelect.addEventListener('change', function () {
            const selectedNama = this.value;
            const no = this.options[this.selectedIndex].getAttribute('data-no');
    
            for (let i = 0; i < noAkunSelect.options.length; i++) {
                if (noAkunSelect.options[i].value === no) {
                    noAkunSelect.selectedIndex = i;
                    break;
                }
            }
        });
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
            const input = document.getElementById('nilaiSaatIniInput');
    
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
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('nilai_penyesuaian_check');
            const statusText = document.getElementById('persentase-komplet-check-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script>  
    @endsection
@endsection