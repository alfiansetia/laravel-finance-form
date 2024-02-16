<?php

namespace App\Http\Controllers;

use App\Models\Vat;
use Illuminate\Http\Request;

class VatController extends Controller
{
    private $title = 'VAT';

    public function __construct()
    {
        $this->middleware('role');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Vat::all();
        return view('vat.index', compact('data'))->with(['title' => $this->title]);
    }

    public function show()
    {
        abort(404);
    }

    public function create()
    {
        return view('vat.add')->with(['title' => $this->title]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required',
            'value' => "required|numeric|gt:0|regex:/^\d+(\.\d{2})?$/",
        ], [
            'name.required'     => 'Name Wajib diisi',
            'value.required'    => 'Value Wajib diisi!',
            'value.numeric'     => 'Value harus berupa numeric!',
            'value.gt'          => 'Value harus lebih dari 0!',
            'value.regex'       => 'Format tidak valid, dibelakang koma harus 2 angka!',
        ]);
        $vat = Vat::create([
            'name'  => $request->name,
            'value' => $request->value,
        ]);
        if ($vat) {
            return redirect(route('vat.index'))->with(['success' => 'Data berhasil ditambahkan!']);
        } else {
            return redirect(route('vat.index'))->with(['error' => 'Data berhasil ditambahkan!']);
        }
    }

    public function edit(Vat $vat)
    {
        $data = $vat;
        return view('vat.edit', compact('data'))->with(['title' => $this->title]);
    }

    public function update(Request $request, Vat $vat)
    {
        $this->validate($request, [
            'name'  => 'required',
            'value' => "required|numeric|gt:0|regex:/^\d+(\.\d{2})?$/",
        ], [
            'name.required'     => 'Name Wajib diisi',
            'value.required'    => 'Value Wajib diisi!',
            'value.numeric'     => 'Value harus berupa numeric!',
            'value.gt'          => 'Value harus lebih dari 0!',
            'value.regex'       => 'Format tidak valid, dibelakang koma harus 2 angka!',
        ]);
        $vat = $vat->update([
            'name'  => $request->name,
            'value' => $request->value,
        ]);
        if ($vat) {
            return redirect(route('vat.index'))->with(['success' => 'Data berhasil diubah!']);
        } else {
            return redirect(route('vat.index'))->with(['error' => 'Data berhasil diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vat $vat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vat $vat)
    {
        $vat = $vat->delete();
        if ($vat) {
            return redirect(route('vat.index'))->with(['success' => 'Data berhasil dihapus!']);
        } else {
            return redirect(route('vat.index'))->with(['error' => 'Data berhasil dihapus!']);
        }
    }
}
