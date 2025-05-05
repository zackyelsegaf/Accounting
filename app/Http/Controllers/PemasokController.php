<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasok;
use App\Http\Controllers\DependentDropdownController;
use Illuminate\Support\Facades\DB;

class PemasokController extends Controller
{
    public function pemasokList()
    {
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        return view('pemasok.listpemasok', compact('mata_uang'));
    }

    public function pemasokAddNew()
    {
        $data = DB::table('status_pemasok')->get();
        $provinsi = DB::table('provinsi')->orderBy('nama', 'asc')->get();
        $kota = DB::table('kota')->orderBy('nama', 'asc')->get();
        $negara = DB::table('negara')->orderBy('nama', 'asc')->get();
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $latest = Pemasok::orderBy('pemasok_id', 'desc')->first();
        $nextID = $latest ? intval(substr($latest->pemasok_id, 3)) + 1 : 1;
        $kodeBaru = 'TB-' . sprintf("%04d", $nextID);
        $pajak = DB::table('pajak')->orderBy('nama', 'asc')->get();
        $syarat = DB::table('syarat')->orderBy('nama', 'asc')->get();
        return view('pemasok.pemasokaddnew', compact('data','provinsi','kota','negara','mata_uang','kodeBaru','pajak','syarat'));
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            Pemasok::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('pemasok/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function saveRecordPemasok(Request $request){
        
        $validated = $request->validate([
            'nama'          => 'nullable|string|max:255',
            'status'        => 'nullable|string|max:255',
            'kode_pos'      => 'nullable|string|max:255',
            'provinsi'      => 'nullable|string|max:255',
            'kota'          => 'nullable|string|max:255',
            'negara'        => 'nullable|string|max:255',
            'alamat_1'      => 'nullable|string|max:255',
            'alamat_2'      => 'nullable|string|max:255',
            'alamatpajak_1' => 'nullable|string|max:255',
            'alamatpajak_2' => 'nullable|string|max:255',
            'kontak'        => 'nullable|string|max:255',
            'no_telp'       => 'nullable|string|max:255',
            'no_fax'        => 'nullable|string|max:255',
            'email'         => 'nullable|string|max:255',
            'website'       => 'nullable|string|max:255',
            'memo'          => 'nullable|string|max:255',
            'fileupload_1'  => 'nullable|string|max:255',
            'dihentikan'    => 'nullable|boolean',
            'npwp'          => 'nullable|string|max:255',
            'pajak_1'       => 'nullable|string|max:255',
            'pajak_2'       => 'nullable|string|max:255',
            'syarat'        => 'nullable|string|max:255',
            'mata_uang'     => 'nullable|string|max:255',
            'saldo_awal'    => 'nullable|string|max:255',
            'tanggal'       => 'nullable|string|max:255',
            'deskripsi'     => 'nullable|string|max:255',
            'no_pkp'        => 'nullable|string|max:255',
            // 'fileupload_2'  => 'file',
            // 'fileupload_3'  => 'file',
            // 'fileupload_4'  => 'file',
            // 'fileupload_5'  => 'file',
            // 'fileupload_6'  => 'file',
            // 'fileupload_7'  => 'file',
        ]);

        //debug
        // DB::enableQueryLog();
        // MataUang::create($request->all());
        // dd(DB::getQueryLog());

        $validated['saldo_awal'] = str_replace(['Rp', '.', ' '], '', $validated['saldo_awal']);

        DB::beginTransaction();
        try {

            // $photo= $request->fileupload_1;
            // $file_name = rand() . '.' .$photo->getClientOriginalName();
            // $photo->move(public_path('/assets/img/'), $file_name);

            $pemasok = new Pemasok($validated);
            $pemasok->save();

            DB::commit();
            sweetalert()->success('Create new Pemasok successfully :)');
            return redirect()->route('pemasok/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id, $pemasok_id)
    {
        $data = DB::table('status_pemasok')->get();
        $provinsi = DB::table('provinsi')->orderBy('nama', 'asc')->get();
        $kota = DB::table('kota')->orderBy('nama', 'asc')->get();
        $negara = DB::table('negara')->orderBy('nama', 'asc')->get();
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $pemasokEdit = DB::table('pemasok')->where('pemasok_id',$pemasok_id)->first();
        $pajak = DB::table('pajak')->orderBy('nama', 'asc')->get();
        $syarat = DB::table('syarat')->orderBy('nama', 'asc')->get();
        $Pemasok = Pemasok::findOrFail($id);
        if (!$Pemasok) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('pemasok.pemasokedit', compact('Pemasok','pemasokEdit','data','provinsi','kota','negara','mata_uang','pajak','syarat'));
    }

    // public function update(Request $request, $pemasok_id)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $update = [
    //         'pemasok_id'    => $request->pemasok_id,
    //         'nama'          => $request->nama,
    //         'status'        => $request->status,
    //         'kode_pos'      => $request->kode_pos,
    //         'provinsi'      => $request->provinsi,
    //         'kota'          => $request->kota,
    //         'negara'        => $request->negara,
    //         'alamat_1'      => $request->alamat_1,
    //         'alamat_2'      => $request->alamat_2,
    //         'alamatpajak_1' => $request->alamatpajak_1,
    //         'alamatpajak_2' => $request->alamatpajak_2,
    //         'kontak'        => $request->kontak,
    //         'no_telp'       => $request->no_telp,
    //         'no_fax'        => $request->no_fax,
    //         'email'         => $request->email,
    //         'website'       => $request->website,
    //         'memo'          => $request->memo,
    //         'fileupload_1'  => $request->fileupload_1,
    //         ];
            
    //         Pemasok::where('pemasok_id',$request->pemasok_id)->update($update);

    //         DB::commit();
    //         sweetalert()->success('Updated record successfully :)');
    //         return redirect()->route('pemasok/list/page');    
            
    //     } catch(\Exception $e) {
    //         DB::rollback();
    //         sweetalert()->error('Update record fail :)');
    //         \Log::error($e->getMessage());
    //         return redirect()->back();
    //     }
    // }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama'          => 'nullable|string|max:255',
            'status'        => 'nullable|string|max:255',
            'kode_pos'      => 'nullable|string|max:255',
            'provinsi'      => 'nullable|string|max:255',
            'kota'          => 'nullable|string|max:255',
            'negara'        => 'nullable|string|max:255',
            'alamat_1'      => 'nullable|string|max:255',
            'alamat_2'      => 'nullable|string|max:255',
            'alamatpajak_1' => 'nullable|string|max:255',
            'alamatpajak_2' => 'nullable|string|max:255',
            'kontak'        => 'nullable|string|max:255',
            'no_telp'       => 'nullable|string|max:255',
            'no_fax'        => 'nullable|string|max:255',
            'email'         => 'nullable|string|max:255',
            'website'       => 'nullable|string|max:255',
            'memo'          => 'nullable|string|max:255',
            'fileupload_1'  => 'nullable|string|max:255',
            'dihentikan'    => 'nullable|boolean',
            'npwp'          => 'nullable|string|max:255',
            'pajak_1'       => 'nullable|string|max:255',
            'pajak_2'       => 'nullable|string|max:255',
            'syarat'        => 'nullable|string|max:255',
            'mata_uang'     => 'nullable|string|max:255',
            'saldo_awal'    => 'nullable|string|max:255',
            'tanggal'       => 'nullable|string|max:255',
            'deskripsi'     => 'nullable|string|max:255',
            'no_pkp'        => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $pemasok                 = Pemasok::findOrFail($id);
            $pemasok->update($validate);
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('pemasok/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getPemasok(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter         = $request->get('nama');
        $pelangganIdFilter  = $request->get('pemasok_id');
        $pelangganMataUangFilter  = $request->get('mata_uang');
        $pelangganDihentikanFilter  = $request->get('dihentikan');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $pemasok =  DB::table('pemasok');
        $totalRecords = $pemasok->count();

        if ($namaFilter) {
            $pemasok->where('nama', 'like', '%' . $namaFilter . '%');
        }

        if ($pelangganIdFilter) {
            $pemasok->where('pemasok_id', 'like', '%' . $pelangganIdFilter . '%');
        }

        if ($pelangganMataUangFilter) {
            $pemasok->where('mata_uang', $pelangganMataUangFilter);
        }

        if ($pelangganDihentikanFilter  !== null && $pelangganDihentikanFilter !== '') {
            $pemasok->where('dihentikan', $pelangganDihentikanFilter);
        }

        $totalRecordsWithFilter = $pemasok->count();

        $records = $pemasok
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();

        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="pemasok_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"     => $checkbox,
                "no"           => $start + $key + 1,
                "id"           => $record->id,
                "pemasok_id"   => $record->pemasok_id,
                "nama"         => $record->nama,
                'alamat_1'     => $record->alamat_1,
                'alamat_2'     => $record->alamat_2,
                'kontak'       => $record->kontak,
                'no_telp'      => $record->no_telp,
                'mata_uang'    => $record->mata_uang,
                'dihentikan'   => $record->dihentikan,
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
