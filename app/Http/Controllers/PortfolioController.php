<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
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
            $portfolios = Portfolio::where('user_id', \Auth::user()->id)->where('keterangan','LIKE',"%$filterKeyword%")->paginate(12);
        } else {
            $portfolios = Portfolio::where('user_id', \Auth::user()->id)->paginate(12);
        }
        return view('dashboard.portfolio', compact('portfolios'));
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
            'keterangan'=>'required|max:150',
        ]);
        $data = $request->all(); 
        $data['user_id'] = \Auth::user()->id;
        $data['foto'] = $request->file('foto')->store('portfolio','public');
        Portfolio::create($data);
        return redirect()->back()->with('status','Portfolio Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('dashboard.edit_portfolio', compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'image|nullable',
            'keterangan' => 'required|max:150',
        ]);
        $category = Portfolio::findOrFail($id);
        $category->keterangan = $request->keterangan;
        if($request->hasFile('foto')){
            if($request->foto && file_exists(storage_path('app/public/'.$request->foto))){
                Storage::delete('public/'.$request->foto);
            }
            $file = $request->file('foto')->store('kategori','public');
            $category->foto = $file;
        } 
        $category->save();
        return redirect()->back()->with('status','Portfolio  Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Portfolio::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('status','Portfolio Berhasil Dihapus');
    }
}
