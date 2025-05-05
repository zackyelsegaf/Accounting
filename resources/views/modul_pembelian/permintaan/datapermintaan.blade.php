@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Data Barang</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="filterBox" class="col-md-4" style="{{ request('filter') == '1' ? '' : 'display: none;' }}">
                <div class="card rounded-default p-3 bg-dark text-white">
                    <form method="GET" action="{{ route('barang/list/page') }}">
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
                            <table class="table table-striped table-bordered table-hover table-center mb-0" id="BarangList">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="20"><input type="checkbox" id="select_all"></th>
                                        <th>No</th>
                                        <th hidden>ID</th>
                                        <th>No. Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Deskripsi 1</th>
                                        <th>Deskripsi 2</th>
                                        {{-- <th>Jumlah</th> --}}
                                        <th>Satuan</th>
                                        <th>Harga Satuan</th>
                                        <th>Tipe</th>
                                        <th>Kategori</th>
                                        <th>Tipe Persediaan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row">
                        <div class="col">
                            <a href="{{ route('barang/add/new') }}" class="btn btn-primary float-left veiwbutton"><i class="fas fa-plus mr-2"></i>Tambah</a>
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
            var table = $('#BarangList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-barang-data') }}",
                    data: function(d) {
                        d.nama_barang = $('input[name=nama_barang]').val(),
                        d.no_barang = $('input[name=no_barang]').val(),
                        d.kategori_barang = $('select[name=kategori_barang]').val(),
                        d.tipe_barang = $('select[name=tipe_barang]').val(),
                        d.tipe_persediaan = $('select[name=tipe_persediaan]').val(),
                        d.dihentikan = $('input[name=dihentikan]:checked').val();
                    }
                },
                dom: "<'row'<'col-sm-12'B>>" +
                    "<'row'<'col-sm-12 mt-3'tr>>" + 
                    "<'row'<'col-sm-12 col-md-6 mt-2'l><'col-sm-12 col-md-6'p>>", 
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-copy"></i> <span class="btn_text_align font-weight-bold">Copy</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Barang',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i> <span class="btn_text_align font-weight-bold">Excel</span>',
                        className: 'btn btn-primary veiwbutton',
                        titleAttr: 'Export to Excel',
                        title: 'Daftar Barang',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i> <span class="btn_text_align font-weight-bold">PDF</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Barang',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> <span class="btn_text_align font-weight-bold">Print</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Barang',
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
                        data: 'no_barang',
                        name: 'no_barang',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'deskripsi_1',
                        name: 'deskripsi_1',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'deskripsi_2',
                        name: 'deskripsi_2',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'satuan',
                        name: 'satuan',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'rasio',
                        name: 'rasio',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tipe_barang',
                        name: 'tipe_barang',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kategori_barang',
                        name: 'kategori_barang',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tipe_persediaan',
                        name: 'tipe_persediaan',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('form').on('submit', function(e) {
                e.preventDefault();
                table.draw();
            });

            $('#select_all').on('click', function() {
                $('.barang_checkbox').prop('checked', this.checked);
            });

            $('#BarangList tbody').on('mouseenter', 'tr', function() {
                $(this).css('cursor', 'pointer');
            });

            $('#deleteSelected').on('click', function() {
                var selectedIds = $('.barang_checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length > 0) {
                    if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
                        $.ajax({
                            url: "{{ route('barang/delete') }}",
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

            $('#BarangList tbody').on('click', 'tr', function(e) {
                // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
                if ($(e.target).is('input[type="checkbox"], label')) {
                    return; // Jika iya, hentikan eksekusi supaya tidak redirect
                }

                var data = table.row(this).data();
                    if (data) {
                        window.location.href = "/barang/edit/" + data.id;
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
