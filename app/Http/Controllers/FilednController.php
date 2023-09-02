<?php

namespace App\Http\Controllers;

use App\Models\Filedn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FilednController extends Controller
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
            'debit'     => 'required|integer|exists:debit_note,id',
            'file'      => 'required|mimes:pdf|max:10240',
        ]);
        $image_path = public_path('files/pdf/');
        $files = $request->file('file');
        $file_name = pathinfo($files->getClientOriginalName(), PATHINFO_FILENAME);
        $image = 'file_' . $file_name . '_' . date('dmyHis') . '.' . $files->getClientOriginalExtension();
        $files->move($image_path, $image);
        $filedn = Filedn::create([
            'debit_id'      => $request->debit,
            'name'          => $image,
        ]);
        if ($filedn) {
            return redirect()->back()->with(['success' => 'Success Add File!']);
        } else {
            return redirect()->back()->with(['error' => 'Failed Add File!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Filedn  $filedn
     * @return \Illuminate\Http\Response
     */
    public function show(Filedn $filedn)
    {
        $image_path = public_path('files/pdf/');
        $image = $image_path . $filedn->name;
        if (file_exists($image)) {
            return response()->download($image);
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Filedn  $filedn
     * @return \Illuminate\Http\Response
     */
    public function edit(Filedn $filedn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Filedn  $filedn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filedn $filedn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Filedn  $filedn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Filedn $filedn)
    {
        $image_path = public_path('files/pdf/');
        $image = $filedn->name;
        if (!empty($image) && file_exists($image_path . $image)) {
            File::delete($image_path . $image);
        }
        $filedn = $filedn->delete();
        if ($filedn) {
            return redirect()->back()->with(['success' => 'Remove File Success!']);
        } else {
            return redirect()->back()->with(['error' => 'Remove File Failed!']);
        }
    }
}
