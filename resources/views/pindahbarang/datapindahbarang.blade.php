@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Data Pindah Barang</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="filterBox" class="col-md-4" style="{{ request('filter') == '1' ? '' : 'display: none;' }}">
                <div class="card rounded-default p-3 bg-dark text-white">
                    <form method="GET" action="{{ route('pindahbarang/list/page') }}">
                        <input type="hidden" name="filter" value="1">
                        <div class="form-group">
                            <label>Pencarian</label>
                            <input type="text" name="no_barang" class="form-control" onchange="this.form.submit()" placeholder="Cari berdasarkan ID" value="{{ request('no_barang') }}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="nama_barang" class="form-control" onchange="this.form.submit()" placeholder="Nama Barang" value="{{ request('nama_barang') }}">
                        </div>   
                        <div class="form-group">
                            <label>Dihentikan</label><br>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" onchange="this.form.submit()" name="dihentikan" value="" {{ request('dihentikan') === null ? 'checked' : '' }}>
                                <label class="form-check-label">Semua</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" onchange="this.form.submit()" name="dihentikan" value="1" {{ request('dihentikan') === '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Ya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" onchange="this.form.submit()" name="dihentikan" value="0" {{ request('dihentikan') === '0' ? 'checked' : '' }}>
                                <label class="form-check-label">Tidak</label>
                            </div>
                        </div>    
                        <div class="form-group">
                            <label>Tipe Barang</label>
                            <select class="form-control" name="tipe_barang" onchange="this.form.submit()">
                                <option value="" selected></option>
                                @foreach ($tipe_barang as $items)
                                    <option value="{{ $items->nama }}" {{ request('tipe_barang') == $items->nama ? 'selected' : '' }}>
                                        {{ $items->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kategori Barang</label>
                            <select class="form-control" name="kategori_barang" onchange="this.form.submit()">
                                <option value="" selected> Tipe Pelanggan </option>
                                @foreach ($kategori_barang as $items)
                                    <option value="{{ $items->nama }}" {{ request('kategori_barang') == $items->nama ? 'selected' : '' }}>
                                        {{ $items->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>     
                        <div class="form-group">
                            <label>Tipe Persediaan</label>
                            <select class="form-control" name="tipe_persediaan" onchange="this.form.submit()">
                                <option value="" selected> Tipe Pelanggan </option>
                                @foreach ($tipe_persediaan as $items)
                                    <option value="{{ $items->nama }}" {{ request('tipe_persediaan') == $items->nama ? 'selected' : '' }}>
                                        {{ $items->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>   
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-table">
                    <div class="card-body booking_card">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-center mb-0" id="PindahBarangList">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="20"><input type="checkbox" id="select_all"></th>
                                        <th>No.</th>
                                        <th hidden>ID</th>
                                        <th>No. Pindah Barang</th>
                                        <th>Tanggal</th>
                                        <th>Deskripsi</th>
                                        <th>Gudang Asal</th>
                                        <th>Gudang Tujuan</th>
                                        <th>Pengguna</th>
                                        {{-- <th>Cabang</th> --}}
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row">
                        <div class="col">
                            <a href="{{ route('pindahbarang/add/new') }}" class="btn btn-primary float-left veiwbutton"><i class="fas fa-plus mr-2"></i>Tambah</a>
                            <button class="btn btn-primary float-left veiwbutton ml-3" onclick="toggleFilter()"><i class="fas fa-filter mr-2"></i>Filter</button>
                            <button id="deleteSelected" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-trash mr-2"></i>Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#PindahBarangList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                paging: true,
                lengthChange: true, // pastikan ini ditambahkan
                ajax: {
                    url: "{{ route('get-pindahbarang-data') }}",
                    // data: function(d) {
                    //     d.nama_barang = $('input[name=nama_barang]').val(),
                    //     d.no_barang = $('input[name=no_barang]').val(),
                    //     d.kategori_barang = $('select[name=kategori_barang]').val(),
                    //     d.tipe_barang = $('select[name=tipe_barang]').val(),
                    //     d.tipe_persediaan = $('select[name=tipe_persediaan]').val(),
                    //     d.dihentikan = $('input[name=dihentikan]:checked').val();
                    // }
                },
                dom: "<'row'<'col-sm-12'B>>" +
                    "<'row'<'col-sm-12 mt-3'tr>>" + 
                    "<'row'<'col-sm-12 col-md-6 mt-2'l><'col-sm-12 col-md-6'p>>", 
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-copy"></i> <span class="btn_text_align font-weight-bold">Copy</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Pindah Barang',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i> <span class="btn_text_align font-weight-bold">Excel</span>',
                        className: 'btn btn-primary veiwbutton',
                        titleAttr: 'Export to Excel',
                        title: 'Daftar Pindah Barang',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i> <span class="btn_text_align font-weight-bold">PDF</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Pindah Barang',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> <span class="btn_text_align font-weight-bold">Print</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Pindah Barang',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                ],
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'no',
                        name: 'no',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id',
                        name: 'id',
                        visible: false
                    },
                    {
                        data: 'no_pindah',
                        name: 'no_pindah',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'tgl_pindah',
                        name: 'tgl_pindah',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'deskripsi_barang',
                        name: 'deskripsi_barang',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'dari_gudang',
                        name: 'dari_gudang',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'ke_gudang',
                        name: 'ke_gudang',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'pengguna_pindah',
                        name: 'pengguna_pindah',
                        orderable: false,
                        searchable: false
                    },
                    // {
                    //     data: 'cabang',
                    //     name: 'cabang',
                    //     orderable: false,
                    //     searchable: false
                    // },
                ]
            });

            $('form').on('submit', function(e) {
                e.preventDefault();
                table.draw();
            });

            $('#select_all').on('click', function() {
                $('.pindahbarang_checkbox').prop('checked', this.checked);
            });

            $('#PindahBarangList tbody').on('mouseenter', 'tr', function() {
                $(this).css('cursor', 'pointer');
            });

            $('#deleteSelected').on('click', function() {
                var selectedIds = $('.pindahbarang_checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length > 0) {
                    if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
                        $.ajax({
                            url: "{{ route('pindahbarang/delete') }}",
                            type: "POST",
                            data: {
                                ids: selectedIds,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                location.reload();
                            },
                        });
                    }
                } else {
                    alert('Pilih setidaknya satu data untuk dihapus!');
                }
            });

            $('#PindahBarangList tbody').on('click', 'tr', function(e) {
                // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
                if ($(e.target).is('input[type="checkbox"], label')) {
                    return; // Jika iya, hentikan eksekusi supaya tidak redirect
                }

                var data = table.row(this).data();
                    if (data) {
                        window.location.href = "/pindahbarang/edit/" + data.id + "/" + data.no_pindah;
                    }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const filterBox = document.getElementById("filterBox");
            const filterStatus = localStorage.getItem("filterStatus");
    
            if (filterStatus === "open") {
                filterBox.style.display = "block";
            } else {
                filterBox.style.display = "none";
            }
        });
    
        function toggleFilter() {
            const filterBox = document.getElementById("filterBox");
            const isVisible = filterBox.style.display === "block";
    
            if (isVisible) {
                filterBox.style.display = "none";
                localStorage.setItem("filterStatus", "closed");
            } else {
                filterBox.style.display = "block";
                localStorage.setItem("filterStatus", "open");
            }
        }
    </script>    
@endsection
@endsection
