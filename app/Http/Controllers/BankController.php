<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    private $title = 'Bank';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Bank::all();
        return view('bank.index', compact('data'))->with(['title' => $this->title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bank.add')->with(['title' => $this->title]);
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
            'name' => 'required|unique:banks,name'
        ]);
        $bank = Bank::create([
            'name'  => $request->name,
        ]);
        if ($bank) {
            return redirect(route('bank.index'))->with(['success' => 'Data berhasil ditambahkan!']);
        } else {
            return redirect(route('bank.index'))->with(['error' => 'Data berhasil ditambahkan!']);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        if (!$bank) {
            abort(404);
        }
        $data = $bank;
        return view('bank.edit', compact('data'))->with(['title' => $this->title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        if (!$bank) {
            abort(404);
        }
        $this->validate($request, [
            'name' => 'required|unique:banks,name,' . $bank->id
        ]);
        $bank = $bank->update([
            'name'  => $request->name,
        ]);
        if ($bank) {
            return redirect(route('bank.index'))->with(['success' => 'Data berhasil diubah!']);
        } else {
            return redirect(route('bank.index'))->with(['error' => 'Data berhasil diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        if (!$bank) {
            abort(404);
        }
        $bank = $bank->delete();
        if ($bank) {
            return redirect(route('bank.index'))->with(['success' => 'Data berhasil dihapus!']);
        } else {
            return redirect(route('bank.index'))->with(['error' => 'Data berhasil dihapus!']);
        }
    }
}
