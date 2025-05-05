<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PelangganController extends Controller
{

    public function pelangganList(Request $request)
    {
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $tipe_pelanggan = DB::table('tipe_pelanggan')->orderBy('nama', 'asc')->get();
        return view('pelanggan.listpelanggan', compact('mata_uang', 'tipe_pelanggan'));
    }

    public function pelangganAddNew()
    {
        $data = DB::table('status_pemasok')->get();
        $provinsi = DB::table('provinsi')->orderBy('nama', 'asc')->get();
        $kota = DB::table('kota')->orderBy('nama', 'asc')->get();
        $negara = DB::table('negara')->orderBy('nama', 'asc')->get();
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $prefix = 'GMPSCR-';
        $latest = Pelanggan::orderBy('pelanggan_id', 'desc')->first();
        $nextID = $latest ? intval(substr($latest->pelanggan_id, strlen($prefix))) + 1 : 1;
        $kodeBaru = $prefix . sprintf("%04d", $nextID);
        $pajak = DB::table('pajak')->orderBy('nama', 'asc')->get();
        $syarat = DB::table('syarat')->orderBy('nama', 'asc')->get();
        $tipe_pelanggan = DB::table('tipe_pelanggan')->orderBy('nama', 'asc')->get();
        $level_harga = DB::table('level_harga')->orderBy('nama', 'asc')->get();
        $agama = DB::table('religion')->orderBy('nama', 'asc')->get();
        $gender = DB::table('gender')->orderBy('nama', 'asc')->get();
        return view('pelanggan.pelangganaddnew', compact('data', 'provinsi', 'kota', 'negara', 'mata_uang', 'kodeBaru', 'pajak', 'syarat', 'tipe_pelanggan', 'level_harga','agama','gender'));
    }


    public function saveRecordPelanggan(Request $request)
    {
        $rules = [
            'nama_pelanggan'             => 'nullable|string|max:255',
            'nik_pelanggan'              => 'nullable|string|max:255',
            'tanggal_lahir'              => 'nullable|string|max:255',
            'tempat_lahir'               => 'nullable|string|max:255',
            'agama'                      => 'nullable|string|max:255',
            'jenis_kelamin'              => 'nullable|string|max:255',
            'nama_ayah'                  => 'nullable|string|max:255',
            'nama_ibu'                   => 'nullable|string|max:255',
            'npwp_pelanggan'             => 'nullable|string|max:255',
            'nppkp_pelanggan'            => 'nullable|string|max:255',
            'pajak_1_pelanggan'          => 'nullable|string|max:255',
            'pajak_2_pelanggan'          => 'nullable|string|max:255',
            'penjual'                    => 'nullable|string|max:255',
            'tipe_pelanggan'             => 'nullable|string|max:255',
            'level_harga_pelanggan'      => 'nullable|string|max:255',
            'diskon_penjualan_pelanggan' => 'nullable|string|max:255',
            'syarat_pelanggan'           => 'nullable|string|max:255',
            'batas_maks_hutang'          => 'nullable|string|max:255',
            'batas_umur_hutang'          => 'nullable|string|max:255',
            'mata_uang_pelanggan'        => 'nullable|string|max:255',
            'saldo_awal_pelanggan'       => 'nullable|string|max:255',
            'tanggal_pelanggan'          => 'nullable|string|max:255',
            'deskripsi'                  => 'nullable|string|max:255',
            'status'                     => 'nullable|string|max:255',
            'dihentikan'                 => 'nullable|boolean',
            'alamat_1'                   => 'nullable|string|max:255',
            'alamat_2'                   => 'nullable|string|max:255',
            'alamatpajak_1'              => 'nullable|string|max:255',
            'alamatpajak_2'              => 'nullable|string|max:255',
            'negara'                     => 'nullable|string|max:255',
            'kota'                       => 'nullable|string|max:255',
            'provinsi'                   => 'nullable|string|max:255',
            'kode_pos'                   => 'nullable|string|max:255',
            'kontak'                     => 'nullable|string|max:255',
            'no_telp'                    => 'nullable|string|max:255',
            'no_fax'                     => 'nullable|string|max:255',
            'email'                      => 'nullable|string|max:255',
            'website'                    => 'nullable|string|max:255',
            'memo'                       => 'nullable|string|max:255',
        ];

        for ($i = 1; $i <= 7; $i++) {
            $rules["fileupload_{$i}"] = 'nullable|string|max:255';
        }

        $validated = $request->validate($rules);

        $validated['saldo_awal_pelanggan'] = str_replace(['Rp', '.', ' '], '', $validated['saldo_awal_pelanggan']);

        DB::beginTransaction();
        try {
            $pelanggan = new Pelanggan($validated);
            $pelanggan->save();

            DB::commit();
            sweetalert()->success('Create new Pelanggan successfully :)');
            return redirect()->route('pelanggan/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }


    public function edit($id, $pelanggan_id)
    {
        $data = DB::table('status_pemasok')->get();
        $provinsi = DB::table('provinsi')->orderBy('nama', 'asc')->get();
        $kota = DB::table('kota')->orderBy('nama', 'asc')->get();
        $negara = DB::table('negara')->orderBy('nama', 'asc')->get();
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $pelangganEdit = DB::table('pelanggan')->where('pelanggan_id',$pelanggan_id)->first();
        $pajak = DB::table('pajak')->orderBy('nama', 'asc')->get();
        $syarat = DB::table('syarat')->orderBy('nama', 'asc')->get();
        $tipe_pelanggan = DB::table('tipe_pelanggan')->orderBy('nama', 'asc')->get();
        $level_harga = DB::table('level_harga')->orderBy('nama', 'asc')->get();
        $agama = DB::table('religion')->orderBy('nama', 'asc')->get();
        $gender = DB::table('gender')->orderBy('nama', 'asc')->get();
        $Pelanggan = Pelanggan::findOrFail($id);
        if (!$Pelanggan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('pelanggan.pelangganedit', compact('Pelanggan','pelangganEdit','data','provinsi','kota','negara','mata_uang','pajak','syarat','tipe_pelanggan','level_harga','agama','gender'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nama_pelanggan'             => 'nullable|string|max:255',
            'nik_pelanggan'              => 'nullable|string|max:255',
            'tanggal_lahir'              => 'nullable|string|max:255',
            'tempat_lahir'               => 'nullable|string|max:255',
            'agama'                      => 'nullable|string|max:255',
            'jenis_kelamin'              => 'nullable|string|max:255',
            'nama_ayah'                  => 'nullable|string|max:255',
            'nama_ibu'                   => 'nullable|string|max:255',
            'npwp_pelanggan'             => 'nullable|string|max:255',
            'nppkp_pelanggan'            => 'nullable|string|max:255',
            'pajak_1_pelanggan'          => 'nullable|string|max:255',
            'pajak_2_pelanggan'          => 'nullable|string|max:255',
            'penjual'                    => 'nullable|string|max:255',
            'tipe_pelanggan'             => 'nullable|string|max:255',
            'level_harga_pelanggan'      => 'nullable|string|max:255',
            'diskon_penjualan_pelanggan' => 'nullable|string|max:255',
            'syarat_pelanggan'           => 'nullable|string|max:255',
            'batas_maks_hutang'          => 'nullable|string|max:255',
            'batas_umur_hutang'          => 'nullable|string|max:255',
            'mata_uang_pelanggan'        => 'nullable|string|max:255',
            'saldo_awal_pelanggan'       => 'nullable|string|max:255',
            'tanggal_pelanggan'          => 'nullable|string|max:255',
            'deskripsi'                  => 'nullable|string|max:255',
            'status'                     => 'nullable|string|max:255',
            'dihentikan'                 => 'nullable|boolean',
            'alamat_1'                   => 'nullable|string|max:255',
            'alamat_2'                   => 'nullable|string|max:255',
            'alamatpajak_1'              => 'nullable|string|max:255',
            'alamatpajak_2'              => 'nullable|string|max:255',
            'negara'                     => 'nullable|string|max:255',
            'kota'                       => 'nullable|string|max:255',
            'provinsi'                   => 'nullable|string|max:255',
            'kode_pos'                   => 'nullable|string|max:255',
            'kontak'                     => 'nullable|string|max:255',
            'no_telp'                    => 'nullable|string|max:255',
            'no_fax'                     => 'nullable|string|max:255',
            'email'                      => 'nullable|string|max:255',
            'website'                    => 'nullable|string|max:255',
            'memo'                       => 'nullable|string|max:255',
        ];

        for ($i = 1; $i <= 7; $i++) {
            $rules["fileupload_{$i}"] = 'nullable|string|max:255';
        }

        $validate = $request->validate($rules);

        DB::beginTransaction();
        try {
            $pelanggan                 = Pelanggan::findOrFail($id);
            $pelanggan->update($validate);
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('pelanggan/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            Pelanggan::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('pelanggan/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getPelanggan(Request $request)
    {
        $draw               = $request->get('draw');
        $start              = $request->get("start");
        $rowPerPage         = $request->get("length");
        $columnIndex_arr    = $request->get('order');
        $columnName_arr     = $request->get('columns');
        $order_arr          = $request->get('order');
        $namaFilter         = $request->get('nama_pelanggan');
        $pelangganIdFilter  = $request->get('pelanggan_id');
        $pelangganMataUangFilter  = $request->get('mata_uang_pelanggan');
        $pelangganTipePelangganFilter  = $request->get('tipe_pelanggan');
        $pelangganDihentikanFilter  = $request->get('dihentikan');

        $columnIndex     = $columnIndex_arr[0]['column'];
        $columnName      = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];

        $query = DB::table('pelanggan');
        $totalRecords = $query->count();

        if ($namaFilter) {
            $query->where('nama_pelanggan', 'like', '%' . $namaFilter . '%');
        }

        if ($pelangganIdFilter) {
            $query->where('pelanggan_id', 'like', '%' . $pelangganIdFilter . '%');
        }

        if ($pelangganMataUangFilter) {
            $query->where('mata_uang_pelanggan', $pelangganMataUangFilter);
        }

        if ($pelangganTipePelangganFilter) {
            $query->where('tipe_pelanggan', $pelangganTipePelangganFilter);
        }

        if ($pelangganDihentikanFilter  !== null && $pelangganDihentikanFilter !== '') {
            $query->where('dihentikan', $pelangganDihentikanFilter);
        }

        $totalRecordsWithFilter = $query->count();

        $records = $query
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="pelanggan_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"       => $checkbox,
                "no"             => $start + $key + 1,
                "id"             => $record->id,
                "pelanggan_id"   => $record->pelanggan_id,
                "nama_pelanggan" => $record->nama_pelanggan,
                'alamat_1'       => $record->alamat_1,
                'alamat_2'       => $record->alamat_2,
                'kontak'         => $record->kontak,
                'no_telp'        => $record->no_telp,
                'mata_uang_pelanggan' => $record->mata_uang_pelanggan,
                'tipe_pelanggan' => $record->tipe_pelanggan,
                'dihentikan'     => $record->dihentikan,
            ];
        }

        return response()->json([
            "draw"            => intval($draw),
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecordsWithFilter,
            "data"            => $data_arr
        ])->header('Content-Type', 'application/json');
    }
}
