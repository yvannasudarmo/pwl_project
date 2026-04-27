<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dosen.index', [
            'dosen' => dosen::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        dosen::create($data);

        return redirect()->action([DosenController::class, 'index']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return dosen::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('dosen.edit', [
            'dosen' => dosen::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token', 'id', '_method');

        dosen::find($id)->update($data);

        return redirect()->action([DosenController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
         dosen::find($id)->delete();

         return redirect()->action([DosenController::class, 'index']);
    }
}
