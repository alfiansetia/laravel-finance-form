<?php

namespace App\Http\Controllers;

use App\Models\Filepr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileprController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'payment'   => 'required|integer|exists:payment_request,id',
            'file'      => 'required|mimes:pdf|max:10240',
        ]);
        $image_path = public_path('files/pdf/');
        $files = $request->file('file');
        $file_name = pathinfo($files->getClientOriginalName(), PATHINFO_FILENAME);
        $image = 'file_' . $file_name . '_' . date('dmyHis') . '.' . $files->getClientOriginalExtension();
        $files->move($image_path, $image);
        $filepr = Filepr::create([
            'payment_id'    => $request->payment,
            'name'          => $image,
        ]);
        if ($filepr) {
            return redirect()->back()->with(['success' => 'File berhasil ditambah!']);
        } else {
            return redirect()->back()->with(['error' => 'File gagal ditambah!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Filepr  $filepr
     * @return \Illuminate\Http\Response
     */
    public function show(Filepr $filepr)
    {
        $image_path = public_path('files/pdf/');
        $image = $image_path . $filepr->name;
        if (file_exists($image)) {
            return response()->download($image);
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Filepr  $filepr
     * @return \Illuminate\Http\Response
     */
    public function edit(Filepr $filepr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Filepr  $filepr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filepr $filepr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Filepr  $filepr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Filepr $filepr)
    {
        $image_path = public_path('files/pdf/');
        $image = $filepr->name;
        if (!empty($image) && file_exists($image_path . $image)) {
            File::delete($image_path . $image);
        }
        $filepr = $filepr->delete();
        if ($filepr) {
            return redirect()->back()->with(['success' => 'Remove File Success!']);
        } else {
            return redirect()->back()->with(['error' => 'Remove File Failed!']);
        }
    }
}
