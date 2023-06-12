<?php

namespace App\Http\Controllers;

use App\Models\Vat;
use Illuminate\Http\Request;

class VatController extends Controller
{
    private $title = 'VAT';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Vat::first();
        return view('vat.index', compact('data'))->with(['title' => $this->title]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vat  $vat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vat $vat)
    {
        if (!$vat) {
            abort(404);
        }
        $this->validate($request, [
            'value' => 'required|integer|gt:0',
        ]);
        $vat = $vat->update([
            'value' => $request->value,
        ]);
        if ($vat) {
            return redirect()->route('vat.index')->with(['success' => 'Data berhasil diubah!']);
        } else {
            return redirect()->route('vat.index')->with(['error' => 'Data gagal diubah!']);
        }
    }
}
