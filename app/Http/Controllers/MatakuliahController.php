<?php

namespace App\Http\Controllers;

use App\Models\matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('matakuliah.index', [
            'matakuliah' => matakuliah::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('matakuliah.create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    // Menggunakan query builder untuk memaksa data masuk tanpa pengaruh $fillable
    \Illuminate\Support\Facades\DB::table('table_matakuliah')->insert([
        'Jurusan_Id' => $request->input('Jurusan_Id'),
        'Kode_MK'    => $request->input('Kode_MK'),
        'Nama_MK'    => $request->input('Nama_MK'),
        'SKS'        => $request->input('SKS'),
        'Kode_Dosen' => $request->input('Kode_Dosen'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->action([MatakuliahController::class, 'index']);
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return matakuliah::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('matakuliah.edit', [
            'matakuliah' => matakuliah::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token', 'id', '_method');

        matakuliah::find($id)->update($data);

        return redirect()->action([MatakuliahController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
         matakuliah::find($id)->delete();

         return redirect()->action([MatakuliahController::class, 'index']);
    }
}