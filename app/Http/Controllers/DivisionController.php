<?php

namespace App\Http\Controllers;

use App\Models\DivisionModel;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    private $title = 'Division';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DivisionModel::all();
        return view('division.index', compact('data'))->with(['title' => $this->title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('division.add')->with(['title' => $this->title]);
    }

    public function show()
    {
       abort(404);
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
            'name' => 'required|max:50|unique:division,name',
            'slug' => 'required|max:20'
        ]);
        $division = DivisionModel::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);
        if ($division) {
            return redirect()->route('division.index')->with(['success' => 'Data berhasil ditambah!']);
        } else {
            return redirect()->route('division.index')->with(['error' => 'Data gagal ditambah!']);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DivisionModel $division)
    {
        if (!$division) {
            abort(404);
        }
        $data = $division;
        return view('division.edit', compact('data'))->with(['title' => $this->title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DivisionModel $division)
    {
        if (!$division) {
            abort(404);
        }
        $this->validate($request, [
            'name' => 'required|max:50|unique:division,name,' . $division->id,
            'slug' => 'required|max:20'
        ]);
        $division = $division->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        if ($division) {
            return redirect()->route('division.index')->with(['success' => 'Data berhasil diubah!']);
        } else {
            return redirect()->route('division.index')->with(['error' => 'Data gagal diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DivisionModel $division)
    {
        if (!$division) {
            abort(404);
        }
        $division = $division->delete();
        if ($division) {
            return redirect()->route('division.index')->with(['success' => 'Data berhasil dihapus!']);
        } else {
            return redirect()->route('division.index')->with(['error' => 'Data gagal dihapus!']);
        }
    }
}
