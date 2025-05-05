<?php

namespace App\Http\Controllers;

use App\Models\MataUang;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Http\Request;

class MataUangController extends Controller
{
    public function index(Request $request){
        $mataUang = MataUang::filterByName($request->nama)->get();
        return view('matauang.listmatauang', compact('mataUang'));
    }

    public function matauangList()
    {
        return view('matauang.listmatauang');
    }

    public function getMataUangData()
    {
        $matauang = MataUang::select(['id', 'nama', 'nilai_tukar']);

        return DataTables::of($matauang)
            ->addColumn('checkbox', function ($item) {
                return '<input type="checkbox" class="matauang_checkbox" value="' . $item->id . '">';
            })
            ->rawColumns(['checkbox']) // Agar HTML checkbox tidak di-escape
            ->make(true);
    }

    /** Add Neew Mata Uang */
    public function MataUangAddNew()
    {
        return view('matauang.matauangaddnew');
    }

    public function MataUangView($id)
    {
        $MataUangData = MataUang::where('id',$id)->first();
        return view('matauang.matauangedit',compact('matauangData'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nilai_tukar' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $mataUang = MataUang::findOrFail($id);
            $mataUang->nama        = $request->nama;
            $mataUang->nilai_tukar = $request->nilai_tukar;
            $mataUang->save();
            
            DB::commit();
            sweetalert()->success('Ubah Data Berhasil');
            return redirect()->route('matauang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Ubah Data Gagal');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $mataUang = MataUang::findOrFail($id);
        if (!$mataUang) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('matauang.matauangedit', compact('mataUang'));
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids; // Ambil ID dari checkbox
            MataUang::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil Dihapus');
            return redirect()->route('matauang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Hapus Data Gagal');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
        // $ids = $request->ids; // Ambil ID dari checkbox
        // if ($ids) {
        //     MataUang::whereIn('id', $ids)->delete();
        //     flash()->success('Updated record successfully :)');
        //     return response()->json(['success' => true]);
        // } else {
        //     return response()->json(['error' => 'Tidak ada data yang dipilih!'], 400);
        // }
    }
    /** Save Record */
    public function saveRecordMataUang(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'nilai_tukar'   => 'required|numeric',
        ]);

        //debug
        // DB::enableQueryLog();
        // MataUang::create($request->all());
        // dd(DB::getQueryLog());

        DB::beginTransaction();
        try {
            $matauang = new MataUang;
            $matauang->nama         = $request->nama;
            $matauang->nilai_tukar  = $request->nilai_tukar;
            $matauang->save();
            
            DB::commit();
            sweetalert()->success('Tambah Data Berhasil');
            return redirect()->route('matauang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal');
            return redirect()->back();
        }
    }

    /** Get Mata Uang Data */
    public function getMataUang(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama'); // dari input form pencarian

        $columnIndex     = $columnIndex_arr[0]['column'];
        $columnName      = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];

        $query = DB::table('mata_uang');
        $totalRecords = $query->count();

        if ($namaFilter) {
            $query->where(function ($q) use ($namaFilter) {
                $q->where('nama', 'like', '%' . $namaFilter . '%')
                ->orWhere('nilai_tukar', 'like', '%' . $namaFilter . '%');
            });
        }

        $totalRecordsWithFilter = $query->count();

        $records = $query
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();

        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="matauang_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"     => $checkbox,
                "no"           => $start + $key + 1,
                "id"           => $record->id,
                "nama"         => $record->nama,
                "nilai_tukar"  => 'Rp ' . number_format($record->nilai_tukar, 0, ',', '.'),
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
