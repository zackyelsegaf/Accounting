<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;


class PegawaiController extends Controller
{
    public function pegawaiList()
    {
        return view('pegawai.listpegawai');
    }

    public function pegawaiAddNew()
    {
        $data = DB::table('status_pemasok')->get();
        $provinsi = DB::table('provinsi')->orderBy('nama', 'asc')->get();
        $kota = DB::table('kota')->orderBy('nama', 'asc')->get();
        // $negara = DB::table('negara')->orderBy('nama', 'asc')->get();
        // $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        // $prefix = 'GMPSCR-';
        // $latest = Penjual::orderBy('pelanggan_id', 'desc')->first();
        // $nextID = $latest ? intval(substr($latest->pelanggan_id, strlen($prefix))) + 1 : 1;
        // $kodeBaru = $prefix . sprintf("%04d", $nextID);
        $status_pekerjaan = DB::table('status_pekerja')->orderBy('nama', 'asc')->get();
        $hubungan_pegawai = DB::table('status_keluarga')->orderBy('nama', 'asc')->get();
        $kartu_identitas = DB::table('kartu_identitas')->orderBy('nama', 'asc')->get();
        $golongan_darah = DB::table('golongan_darah')->orderBy('nama', 'asc')->get();
        $agama = DB::table('religion')->orderBy('nama', 'asc')->get();
        $gender = DB::table('gender')->orderBy('nama', 'asc')->get();
        return view('pegawai.pegawaiaddnew', compact('data', 'kota', 'gender', 'agama', 'golongan_darah', 'provinsi', 'kartu_identitas', 'hubungan_pegawai', 'status_pekerjaan'));
    }

    public function saveRecordPegawai(Request $request){
        
        $request->validate([
            'nik_pegawai' => 'nullable|string|max:255',
            'nama_pegawai' => 'nullable|string|max:255',
            'tempat_lahir_pegawai' => 'nullable|string|max:255',
            'tanggal_lahir_pegawai' => 'nullable|string|max:255',
            'jenis_kelamin_pegawai' => 'nullable|string|max:255',
            'agama_pegawai' => 'nullable|string|max:255',
            'status_pernikahan_pegawai' => 'nullable|string|max:255',
            'golongan_darah_pegawai' => 'nullable|string|max:255',
            'email_pegawai' => 'nullable|string|max:255',
            'no_telp_pegawai' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kelurahan' => 'nullable|string|max:255',
            'rt_pegawai' => 'nullable|string|max:255',
            'rw_pegawai' => 'nullable|string|max:255',
            'alamat_pegawai' => 'nullable|string|max:255',
            'nama_bank_pegawai' => 'nullable|string|max:255',
            'nomor_rekening_pegawai' => 'nullable|string|max:255',
            'atas_nama_pegawai' => 'nullable|string|max:255',
            'jenis_identitas_pegawai' => 'nullable|string|max:255',
            'nomor_identitas_pegawai' => 'nullable|string|max:255',
            'nama_ayah_pegawai' => 'nullable|string|max:255',
            'nama_ibu_pegawai' => 'nullable|string|max:255',
            'nama_kontak_darurat_pegawai' => 'nullable|string|max:255',
            'no_telp_darurat_pegawai' => 'nullable|string|max:255',
            'hubungan_pegawai' => 'nullable|string|max:255',
            'status_pekerjaan_pegawai' => 'nullable|string|max:255',
            'foto_pegawai' => 'nullable|file',
            'tanggal_masuk_pegawai' => 'nullable|string|max:255',
            'tanggal_keluar_pegawai' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
        ]);

        //debug
        // DB::enableQueryLog();
        // MataUang::create($request->all());
        // dd(DB::getQueryLog());

        DB::beginTransaction();
        try {

            $photo= $request->foto_pegawai;
            $file_name = rand() . '.' .$photo->getClientOriginalName();
            $photo->move(public_path('/assets/upload/'), $file_name);
           
            $pegawai                              = new Pegawai;
            $pegawai->nik_pegawai                 = $request->nik_pegawai;
            $pegawai->nama_pegawai                = $request->nama_pegawai;
            $pegawai->tempat_lahir_pegawai        = $request->tempat_lahir_pegawai;
            $pegawai->tanggal_lahir_pegawai       = $request->tanggal_lahir_pegawai;
            $pegawai->jenis_kelamin_pegawai       = $request->jenis_kelamin_pegawai;
            $pegawai->agama_pegawai               = $request->agama_pegawai;
            $pegawai->status_pernikahan_pegawai   = $request->status_pernikahan_pegawai;
            $pegawai->golongan_darah_pegawai      = $request->golongan_darah_pegawai;
            $pegawai->email_pegawai               = $request->email_pegawai;
            $pegawai->no_telp_pegawai             = $request->no_telp_pegawai;
            $pegawai->provinsi                    = $request->provinsi;
            $pegawai->kota                        = $request->kota;
            $pegawai->kecamatan                   = $request->kecamatan;
            $pegawai->kelurahan                   = $request->kelurahan;
            $pegawai->rt_pegawai                  = $request->rt_pegawai;
            $pegawai->rw_pegawai                  = $request->rw_pegawai;
            $pegawai->alamat_pegawai              = $request->alamat_pegawai;
            $pegawai->nama_bank_pegawai           = $request->nama_bank_pegawai;
            $pegawai->nomor_rekening_pegawai      = $request->nomor_rekening_pegawai;
            $pegawai->atas_nama_pegawai           = $request->atas_nama_pegawai;
            $pegawai->jenis_identitas_pegawai     = $request->jenis_identitas_pegawai;
            $pegawai->nomor_identitas_pegawai     = $request->nomor_identitas_pegawai;
            $pegawai->nama_ayah_pegawai           = $request->nama_ayah_pegawai;
            $pegawai->nama_ibu_pegawai            = $request->nama_ibu_pegawai;
            $pegawai->nama_kontak_darurat_pegawai = $request->nama_kontak_darurat_pegawai;
            $pegawai->no_telp_darurat_pegawai     = $request->no_telp_darurat_pegawai;
            $pegawai->hubungan_pegawai            = $request->hubungan_pegawai;
            $pegawai->status_pekerjaan_pegawai    = $request->status_pekerjaan_pegawai;
            $pegawai->foto_pegawai                = $file_name;
            $pegawai->tanggal_masuk_pegawai       = $request->tanggal_masuk_pegawai;
            $pegawai->tanggal_keluar_pegawai      = $request->tanggal_keluar_pegawai;
            $pegawai->twitter                     = $request->twitter;
            $pegawai->instagram                   = $request->instagram;
            $pegawai->youtube                     = $request->youtube;
            $pegawai->facebook                    = $request->email;
            $pegawai->linkedin                    = $request->linkedin;
            $pegawai->save();

            DB::commit();
            sweetalert()->success('Create new Penjual successfully :)');
            return redirect()->route('pegawai/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $data = DB::table('status_pemasok')->get();
        $provinsi = DB::table('provinsi')->orderBy('nama', 'asc')->get();
        $kota = DB::table('kota')->orderBy('nama', 'asc')->get();
        // $negara = DB::table('negara')->orderBy('nama', 'asc')->get();
        // $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        // $prefix = 'GMPSCR-';
        // $latest = Penjual::orderBy('pelanggan_id', 'desc')->first();
        // $nextID = $latest ? intval(substr($latest->pelanggan_id, strlen($prefix))) + 1 : 1;
        // $kodeBaru = $prefix . sprintf("%04d", $nextID);
        $status_pekerjaan = DB::table('status_pekerja')->orderBy('nama', 'asc')->get();
        $hubungan_pegawai = DB::table('status_keluarga')->orderBy('nama', 'asc')->get();
        $kartu_identitas = DB::table('kartu_identitas')->orderBy('nama', 'asc')->get();
        $golongan_darah = DB::table('golongan_darah')->orderBy('nama', 'asc')->get();
        $agama = DB::table('religion')->orderBy('nama', 'asc')->get();
        $gender = DB::table('gender')->orderBy('nama', 'asc')->get();

        $Pegawai = Pegawai::findOrFail($id);
        if (!$Pegawai) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('pegawai.pegawaiedit', compact('Pegawai', 'data', 'kota', 'gender', 'agama', 'golongan_darah', 'provinsi', 'kartu_identitas', 'hubungan_pegawai', 'status_pekerjaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik_pegawai' => 'nullable|string|max:255',
            'nama_pegawai' => 'nullable|string|max:255',
            'tempat_lahir_pegawai' => 'nullable|string|max:255',
            'tanggal_lahir_pegawai' => 'nullable|string|max:255',
            'jenis_kelamin_pegawai' => 'nullable|string|max:255',
            'agama_pegawai' => 'nullable|string|max:255',
            'status_pernikahan_pegawai' => 'nullable|string|max:255',
            'golongan_darah_pegawai' => 'nullable|string|max:255',
            'email_pegawai' => 'nullable|string|max:255',
            'no_telp_pegawai' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kelurahan' => 'nullable|string|max:255',
            'rt_pegawai' => 'nullable|string|max:255',
            'rw_pegawai' => 'nullable|string|max:255',
            'alamat_pegawai' => 'nullable|string|max:255',
            'nama_bank_pegawai' => 'nullable|string|max:255',
            'nomor_rekening_pegawai' => 'nullable|string|max:255',
            'atas_nama_pegawai' => 'nullable|string|max:255',
            'jenis_identitas_pegawai' => 'nullable|string|max:255',
            'nomor_identitas_pegawai' => 'nullable|string|max:255',
            'nama_ayah_pegawai' => 'nullable|string|max:255',
            'nama_ibu_pegawai' => 'nullable|string|max:255',
            'nama_kontak_darurat_pegawai' => 'nullable|string|max:255',
            'no_telp_darurat_pegawai' => 'nullable|string|max:255',
            'hubungan_pegawai' => 'nullable|string|max:255',
            'status_pekerjaan_pegawai' => 'nullable|string|max:255',
            'foto_pegawai' => 'nullable|file',
            'tanggal_masuk_pegawai' => 'nullable|string|max:255',
            'tanggal_keluar_pegawai' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            // $photo= $request->foto_pegawai;
            // $file_name = rand() . '.' .$photo->getClientOriginalName();
            // $photo->move(public_path('/assets/upload/'), $file_name);

            $pegawai = Pegawai::findOrFail($id);
            $pegawai->nik_pegawai                 = $request->nik_pegawai;
            $pegawai->nama_pegawai                = $request->nama_pegawai;
            $pegawai->tempat_lahir_pegawai        = $request->tempat_lahir_pegawai;
            $pegawai->tanggal_lahir_pegawai       = $request->tanggal_lahir_pegawai;
            $pegawai->jenis_kelamin_pegawai       = $request->jenis_kelamin_pegawai;
            $pegawai->agama_pegawai               = $request->agama_pegawai;
            $pegawai->status_pernikahan_pegawai   = $request->status_pernikahan_pegawai;
            $pegawai->golongan_darah_pegawai      = $request->golongan_darah_pegawai;
            $pegawai->email_pegawai               = $request->email_pegawai;
            $pegawai->no_telp_pegawai             = $request->no_telp_pegawai;
            $pegawai->provinsi                    = $request->provinsi;
            $pegawai->kota                        = $request->kota;
            $pegawai->kecamatan                   = $request->kecamatan;
            $pegawai->kelurahan                   = $request->kelurahan;
            $pegawai->rt_pegawai                  = $request->rt_pegawai;
            $pegawai->rw_pegawai                  = $request->rw_pegawai;
            $pegawai->alamat_pegawai              = $request->alamat_pegawai;
            $pegawai->nama_bank_pegawai           = $request->nama_bank_pegawai;
            $pegawai->nomor_rekening_pegawai      = $request->nomor_rekening_pegawai;
            $pegawai->atas_nama_pegawai           = $request->atas_nama_pegawai;
            $pegawai->jenis_identitas_pegawai     = $request->jenis_identitas_pegawai;
            $pegawai->nomor_identitas_pegawai     = $request->nomor_identitas_pegawai;
            $pegawai->nama_ayah_pegawai           = $request->nama_ayah_pegawai;
            $pegawai->nama_ibu_pegawai            = $request->nama_ibu_pegawai;
            $pegawai->nama_kontak_darurat_pegawai = $request->nama_kontak_darurat_pegawai;
            $pegawai->no_telp_darurat_pegawai     = $request->no_telp_darurat_pegawai;
            $pegawai->hubungan_pegawai            = $request->hubungan_pegawai;
            $pegawai->status_pekerjaan_pegawai    = $request->status_pekerjaan_pegawai;
            // $pegawai->foto_pegawai                = $file_name;
            $pegawai->tanggal_masuk_pegawai       = $request->tanggal_masuk_pegawai;
            $pegawai->tanggal_keluar_pegawai      = $request->tanggal_keluar_pegawai;
            $pegawai->twitter                     = $request->twitter;
            $pegawai->instagram                   = $request->instagram;
            $pegawai->youtube                     = $request->youtube;
            $pegawai->facebook                    = $request->email;
            $pegawai->linkedin                    = $request->linkedin;
            $pegawai->save();
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('pegawai/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            Pegawai::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('pegawai/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getPegawai(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $search_arr      = $request->get('search');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue     = $search_arr['value']; // Search value

        $pegawai =  DB::table('pegawai');
        $totalRecords = $pegawai->count();

        $totalRecordsWithFilter = $pegawai->where(function ($query) use ($searchValue) {
            $query->where('nama_depan_penjual', 'like', '%' . $searchValue . '%');
            $query->orWhere('nik_pegawai', 'like', '%' . $searchValue . '%');
        })->count();

        if ($columnName == 'nama_pegawai') {
            $columnName = 'nama_pegawai';
        }
        $records = $pegawai->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
                $query->where('nama_pegawai', 'like', '%' . $searchValue . '%');
                $query->orWhere('nik_pegawai', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="pegawai_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"               => $checkbox,
                "no"                     => $start + $key + 1,
                "id"                     => $record->id,
                // "pelanggan_id"   => $record->pelanggan_id,
                "nik_pegawai"            => $record->nik_pegawai,
                'nama_pegawai'           => $record->nama_pegawai,
                "email_pegawai"          => $record->email_pegawai,
                'jenis_kelamin_pegawai'  => $record->jenis_kelamin_pegawai,
                'tanggal_masuk_pegawai'  => $record->tanggal_masuk_pegawai,
                'nomor_rekening_pegawai' => $record->nomor_rekening_pegawai,
            ];
        }
        
        return response()->json([
            "draw"                 => intval($draw),
            "recordsTotal"         => $totalRecords,
            "recordsFiltered"      => $totalRecordsWithFilter,
            "data"                 => $data_arr
        ])->header('Content-Type', 'application/json');        
    }
}
