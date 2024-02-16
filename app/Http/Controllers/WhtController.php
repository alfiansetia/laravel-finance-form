<?php

namespace App\Http\Controllers;

use App\Models\Wht;
use Illuminate\Http\Request;

class WhtController extends Controller
{
    private $title = 'WHT';

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
        $title = $this->title;
        $data = Wht::get();
        return view('wht.index', compact('data'))->with(['title' => $this->title]);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('wht.add')->with(['title' => $this->title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $wht = Wht::create([
            'name'  => $request->name,
            'value' => $request->value,
        ]);
        if ($wht) {
            return redirect(route('wht.index'))->with(['success' => 'Data berhasil ditambahkan!']);
        } else {
            return redirect(route('wht.index'))->with(['error' => 'Data berhasil ditambahkan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wht  $wht
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wht  $wht
     * @return \Illuminate\Http\Response
     */
    public function edit(Wht $wht)
    {
        if (!$wht) {
            abort(404);
        }
        $data = $wht;
        return view('wht.edit', compact('data'))->with(['title' => $this->title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wht  $wht
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wht $wht)
    {
        if (!$wht) {
            abort(404);
        }
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
        $wht = $wht->update([
            'name'  => $request->name,
            'value' => $request->value,
        ]);
        if ($wht) {
            return redirect(route('wht.index'))->with(['success' => 'Data berhasil diubah!']);
        } else {
            return redirect(route('wht.index'))->with(['error' => 'Data berhasil diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wht  $wht
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wht $wht)
    {
        if (!$wht) {
            abort(404);
        }
        $wht = $wht->delete();
        if ($wht) {
            return redirect(route('wht.index'))->with(['success' => 'Data berhasil dihapus!']);
        } else {
            return redirect(route('wht.index'))->with(['error' => 'Data berhasil dihapus!']);
        }
    }
}
