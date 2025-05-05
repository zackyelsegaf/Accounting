@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Data Pegawai</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card rounded-default p-3 bg-dark text-white">
                    <form method="GET" action="{{ route('pegawai/list/page') }}">
                        <div class="form-group">
                            <label for="nama">Pencarian</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Pemasok" value="{{ request('nama') }}">
                        </div>
                        <button type="submit" class="btn btn-block btn-primary"  style="border-radius: 10px; padding: 10px 0 10px 0">Cari</button>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-table">
                    <div class="card-body booking_card">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-center mb-0" id="PegawaiList">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="20"><input type="checkbox" id="select_all"></th>
                                        <th>No</th>
                                        <th hidden>ID</th>
                                        {{-- <th>No. Pemasok</th> --}}
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Bergabung Pada</th>
                                        <th>Nomor rekening</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <a href="{{ route('pegawai/add/new') }}" class="btn btn-primary float-left veiwbutton"><i class="fas fa-plus mr-2"></i>Tambah</a>
                            <button id="deleteSelected" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-trash mr-2"></i>Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#PegawaiList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: true,
                ajax: {
                    url: "{{ route('get-pegawai-data') }}",
                },
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
                    // {
                    //     data: 'pemasok_id',
                    //     name: 'pemasok_id',
                    //     orderable: false,
                    //     searchable: false
                    // },
                    {
                        data: 'nik_pegawai',
                        name: 'nik_pegawai',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_pegawai',
                        name: 'nama_pegawai',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'email_pegawai',
                        name: 'email_pegawai',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'jenis_kelamin_pegawai',
                        name: 'jenis_kelamin_pegawai',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal_masuk_pegawai',
                        name: 'tanggal_masuk_pegawai',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nomor_rekening_pegawai',
                        name: 'nomor_rekening_pegawai',
                        orderable: false,
                        searchable: false
                    }
                    // {
                    //     data: 'dihentikan',
                    //     name: 'dihentikan',
                    //     orderable: false,
                    //     searchable: false,
                    //     render: function(data, type, row) {
                    //         return data == 1
                    //             ? '<h3 class="badge badge-pill text-white badge-secondary">Ya</h3>'
                    //             : '<h3 class="badge badge-pill text-white badge-success">Tidak</h3>';
                    //     }
                    // }
                ]
            });

            $('#select_all').on('click', function() {
                $('.pegawai_checkbox').prop('checked', this.checked);
            });

            $('#PegawaiList tbody').on('mouseenter', 'tr', function() {
                $(this).css('cursor', 'pointer');
            });

            $('#deleteSelected').on('click', function() {
                var selectedIds = $('.pegawai_checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length > 0) {
                    if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
                        $.ajax({
                            url: "{{ route('pegawai/delete') }}",
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

            $('#PegawaiList tbody').on('click', 'tr', function(e) {
                // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
                if ($(e.target).is('input[type="checkbox"], label')) {
                    return; // Jika iya, hentikan eksekusi supaya tidak redirect
                }

                var data = table.row(this).data();
                    if (data) {
                        window.location.href = "/pegawai/edit/" + data.id;
                    }
            });
        });
    </script>
@endsection
@endsection
