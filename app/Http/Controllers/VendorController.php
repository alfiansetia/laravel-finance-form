<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{
    private $title = 'Vendor';
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
        $data = Vendor::all();
        return view('vendor.index', compact('data'))->with(['title' => $this->title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.add')->with(['title' => $this->title]);
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
            'name_beneficary'   => 'required|max:50',
            'detail'    => 'nullable|max:100',
            'bank'      => [
                'required', 'max:150',
                Rule::unique('vendors')->where(function ($query) use ($request) {
                    return $query->where('beneficary', $request->name_beneficary);
                })
            ],
        ]);
        $vendor = Vendor::create([
            'beneficary'    => $request->name_beneficary,
            'bank'          => $request->bank,
            'detail'        => $request->detail,
        ]);
        if ($vendor) {
            return redirect()->route('vendor.index')->with(['success' => 'Data berhasil diubah!']);
        } else {
            return redirect()->route('vendor.index')->with(['success' => 'Data gagal diubah!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        if (!$vendor) {
            abort(404);
        }
        $data = $vendor;
        return view('vendor.edit', compact('data'))->with(['title' => $this->title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        if (!$vendor) {
            abort(404);
        }
        $this->validate($request, [
            'name_beneficary'   => 'required|max:50',
            'detail'    => 'nullable|max:100',
            'bank'      => [
                'required', 'max:150',
                Rule::unique('vendors')->where(function ($query) use ($request, $vendor) {
                    return $query->where('beneficary', $request->name_beneficary)->where('id', '!=', $vendor->id);
                })
            ],
        ]);

        $vendor = $vendor->update([
            'beneficary'    => $request->name_beneficary,
            'bank'          => $request->bank,
            'detail'        => $request->detail,
        ]);

        if ($vendor) {
            return redirect()->route('vendor.index')->with(['success' => 'Data berhasil diubah!']);
        } else {
            return redirect()->route('vendor.index')->with(['success' => 'Data gagal diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        if (!$vendor) {
            abort(404);
        }
        $vendor = $vendor->delete();
        if ($vendor) {
            return redirect()->route('vendor.index')->with(['success' => 'Data berhasil dihapus!']);
        } else {
            return redirect()->route('vendor.index')->with(['success' => 'Data gagal dihapus!']);
        }
    }
}
