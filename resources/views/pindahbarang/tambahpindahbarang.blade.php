@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Pindah Barang</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/pindahbarang/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Change Password</h5> --}}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>No. Pindah</label>
                                        <input type="text" class="form-control" name="no_pindah" value="{{ $kodeBaru }}">
                                    </div>  
                                    <div class="form-group" style="display: none">
                                        <label>Pengguna</label>
                                        <input type="text" class="form-control" name="pengguna_pindah" value="{{ old('pengguna_pindah', Auth::user()->email) }}">
                                    </div>  
                                    <div class="form-group">
                                        <label>Tanggal Pindah</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker @error('tgl_pindah') is-invalid @enderror" name="tgl_pindah" value="{{ old('tgl_pindah') }}"> 
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
                                                    <option {{ old('dari_gudang') ? '' : 'selected' }} disabled></option>
                                                    @foreach ($gudang as $items )
                                                    <option value="{{ $items->nama_gudang }}">{{ $items->nama_gudang }}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                            <div class="form-group">
                                                <textarea class="form-control @error('dari_alamat') is-invalid @enderror" name="dari_alamat" value="{{ old('dari_alamat') }}" placeholder="Dari Alamat">{{ old('dari_alamat') }}</textarea>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Ke Gudang</strong></label>
                                                <select class="form-control"  name="ke_gudang">
                                                    <option selected disabled></option>
                                                    @foreach ($gudang as $items )
                                                    <option value="{{ $items->nama_gudang }}">{{ $items->nama_gudang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>  
                                            <div class="form-group">
                                                <textarea class="form-control" name="ke_alamat" value="{{ old('ke_alamat') }}" placeholder="Ke Alamat">{{ old('ke_alamat') }}</textarea>
                                            </div>                                         
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><strong>Deskripsi</strong></label>
                                                <textarea class="form-control" name="deskripsi" value="{{ old('deskripsi') }}">{{ old('deskripsi') }}</textarea>
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
                                                        <option disabled selected></option>
                                                        @foreach ($nama_barang as $items)
                                                            <option value="{{ $items->no_barang }}" 
                                                                data-nama="{{ $items->nama_barang }}"
                                                                data-kts="{{ $items->kuantitas_saldo_awal }}"
                                                                data-satuan="{{ $items->satuan }}">
                                                                {{ $items->no_barang . " - " . $items->nama_barang }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input style="width: 160px;" class="form-control deskripsi-barang-input" name="deskripsi_barang[]" readonly>
                                                </td>
                                                <td>
                                                    <input style="width: 160px; cursor: pointer;" class="form-control kts-barang-input" name="kts_barang[]" value="0">
                                                </td>
                                                <td>
                                                    <select style="width: 160px; cursor: pointer;" class="form-control" name="satuan[]">
                                                        <option disabled selected></option>
                                                        @foreach ($satuan as $items)
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
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
                    <div id="dokumen" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="page-header">
                                    <div class="row float-right">
                                        <button type="button" id="fileuploads_btn_add" class="btn btn-primary buttonedit1 float-right">
                                            <i class="fa fa-plus mr-2"></i>Tambah Field
                                        </button>
                                    </div>
                                </div>
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12" id="fileuploads_loop_add">
                                        <div class="row formtype">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fileupload_1">File 1</label>
                                                    <input type="text" class="form-control" name="fileupload_1" placeholder="Link dokumen Anda" value="{{ old('fileupload_1') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header"></div>
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-check mr-2"></i>Simpan</button>
                                <a href="{{ route('pindahbarang/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('script')
    <script>
        $(document).ready(function () {
            $('#tambahBarangBtn').click(function () {
                let row = $('.barang-row:first').clone();
    
                row.find('select').val('');
                row.find('input').val('');
                $('#barangTableBody').append(row);
            });
    
            $(document).on('change', '.no-barang-select', function () {
                let selected = $(this).find(':selected');
                let row = $(this).closest('tr');
    
                row.find('.deskripsi-barang-input').val(selected.data('nama'));
                row.find('.kts-barang-input').val(selected.data('kts'));
                row.find('select[name="satuan[]"]').val(selected.data('satuan'));
            });
    
            // Hapus baris
            $(document).on('click', '.remove-row', function () {
                if ($('#barangTableBody .barang-row').length > 1) {
                    $(this).closest('tr').remove();
                } else {
                    alert("Minimal satu barang harus ada.");
                }
            });
        });
    </script>    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const namaBarangSelect = document.getElementById('namaBarangSelect');
            const deskripsiBarangInput = document.getElementById('deskripsiBarangInput');
            const kuantitasBarangInput = document.getElementById('kuantitasBarangInput');
            const satuanSelect = document.getElementById('satuanSelect');
        
        namaBarangSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            deskripsiBarangInput.value = selectedOption.getAttribute('data-nama') || '';
            kuantitasBarangInput.value = selectedOption.getAttribute('data-kts') || '';
            satuanSelect.value = selectedOption.getAttribute('data-satuan') || '';
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
        let fieldIndex = 1;
        const maxFields = 7;

        document.getElementById('fileuploads_btn_add').addEventListener('click', function () {
            if (fieldIndex >= maxFields) {
                alert('Maksimal hanya boleh 7 file.');
                return;
            }

            fieldIndex++;

            const fieldContainer = document.getElementById('fileuploads_loop_add');

            const newField = document.createElement('div');
            newField.className = 'form-group';
            newField.innerHTML = `
                <div class="row formtype mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fileupload_${fieldIndex}">File ${fieldIndex}</label>
                            <input type="text" name="fileupload_${fieldIndex}" class="form-control" />
                        </div>
                    </div>
                </div>
            
            `;

            fieldContainer.appendChild(newField);
        });
    </script>
    @endsection
@endsection