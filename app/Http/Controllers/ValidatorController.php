<?php

namespace App\Http\Controllers;

use App\Models\Validator;
use Illuminate\Http\Request;

class ValidatorController extends Controller
{

    private $title = 'Validator';

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
        $data = Validator::all();
        return view('validator.index', compact('data'))->with(['title' => $this->title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('validator.add')->with(['title' => $this->title]);
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
            'prepared'  => 'required|max:150',
            'checked'   => 'required|max:150',
            'approved'  => 'required|max:150',
        ], [
            'prepared.required'     => 'Prepared Wajib diisi',
            'checked.required'      => 'Checked Wajib diisi',
            'approved.required'     => 'Approved Wajib diisi',
        ]);
        $validator = Validator::create([
            'prepared_by'  => $request->prepared,
            'checked_by'   => $request->checked,
            'approved_by'  => $request->approved,
        ]);
        if ($validator) {
            return redirect(route('validator.index'))->with(['success' => 'Data berhasil ditambahkan!']);
        } else {
            return redirect(route('validator.index'))->with(['error' => 'Data berhasil ditambahkan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Validator  $validator
     * @return \Illuminate\Http\Response
     */
    public function show(Validator $validator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Validator  $validator
     * @return \Illuminate\Http\Response
     */
    public function edit(Validator $validator)
    {
        $data = $validator;
        return view('validator.edit', compact('data'))->with(['title' => $this->title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Validator  $validator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Validator $validator)
    {
        $this->validate($request, [
            'prepared'  => 'required|max:150',
            'checked'   => 'required|max:150',
            'approved'  => 'required|max:150',
        ], [
            'prepared.required'     => 'Prepared Wajib diisi',
            'checked.required'      => 'Checked Wajib diisi',
            'approved.required'     => 'Approved Wajib diisi',
        ]);
        $validator = $validator->update([
            'prepared_by'  => $request->prepared,
            'checked_by'   => $request->checked,
            'approved_by'  => $request->approved,
        ]);
        if ($validator) {
            return redirect(route('validator.index'))->with(['success' => 'Data berhasil diubah!']);
        } else {
            return redirect(route('validator.index'))->with(['error' => 'Data berhasil diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Validator  $validator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Validator $validator)
    {
        $validator->delete();
        if ($validator) {
            return redirect(route('validator.index'))->with(['success' => 'Data berhasil dihapus!']);
        } else {
            return redirect(route('validator.index'))->with(['error' => 'Data berhasil dihapus!']);
        }
    }
}
