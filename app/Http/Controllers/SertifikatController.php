<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sertifikat;

class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filterKeyword = $request->keyword; 
        if($filterKeyword){
            $sf = Sertifikat::where('user_id', \Auth::user()->id)
                ->where('keterangan','LIKE',"%$filterKeyword%")
                ->paginate(12);
        } else {
            $sf = Sertifikat::where('user_id', \Auth::user()->id)->paginate(12);
        }
        return view('dashboard.sertifikat', compact('sf'));
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
        $request->validate([
            // 'user_id' => 'required',
            'foto' => 'required|image',
            'keterangan' => 'required|max:150',

        ]);
        $data = $request->all();
        $data['user_id'] = \Auth::user()->id;
        $data['foto'] = $request->file('foto')->store('sertifikat','public');
        Sertifikat::create($data);
        return redirect()->back()->with('status','sertifikat Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sf = Sertifikat::findOrFail($id);
        return view('dashboard.edit_sertifikat', compact('sf'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'image|nullable',
        ]);
        $category = Sertifikat::findOrFail($id);
        $category->keterangan = $request->keterangan;
        $category->user_id = \Auth::user()->id;
        if($request->hasFile('foto')){
            if($request->foto && file_exists(storage_path('app/public/'.$request->foto))){
                Storage::delete('public/'.$request->foto);
            }
            $file = $request->file('foto')->store('sertifikat','public');
            $category->foto = $file;
        } 
        $category->save();
        return redirect()->back()->with('status','Sertifikat  Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sf = Sertifikat::findOrFail($id);
        $sf->delete();
        return redirect()->back()->with('status','sertifikat Berhasil Dihapus');
    }
}
