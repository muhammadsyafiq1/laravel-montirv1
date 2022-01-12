<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\TolakMontir;
use Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users  = User::where('role','!=','admin')
                                ->get();

        $calon_montir  = User::with('sertifikat','portfolio')->whereHas('sertifikat')->where('accept_by_admin','=', 0)
                                ->where('role','=' ,'montir')
                                ->get(); 

        return view('dashboard.user', compact('users','calon_montir'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $montir = User::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.set_montir', compact(['montir','categories']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'name' => 'required',
        ]);
        // dd($request->all());
        $montir = User::findOrFail($id);
        $montir->name = $request->name;
        $montir->no_hp = $request->no_hp;
        $montir->pekerjaan = $request->pekerjaan;
        $montir->nama_bengkel = $request->nama_bengkel;
        $montir->alamat = $request->alamat;
        $montir->tentang = $request->tentang;
        $montir->lingkup_wilayah = $request->lingkup_wilayah;
        if($request->hasFile('foto')){
            if($request->foto && file_exists(storage_path('app/public/'.$request->foto))){
                Storage::delete('public/'.$request->foto);
            }
            $file = $request->file('foto')->store('user','public');
            $montir->foto = $file;
        } 
        $montir->save();
        return redirect()->back()->with('status','Profil  Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 
    }

    public function trash ($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('status','Pengguna Berhasil Dinonaktifkan');
    }

    public function onlyTrashed ()
    {
        $users = User::onlyTrashed()->get();
        return view('dashboard.user_trashed', compact('users'));
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->where('id',$id);
        $user->restore();
        return redirect()->back()->with('status','Pengguna Berhasil Diaktifkan');
    }

    public function delete($id)
    {
        // hapus permanen data user
        $user = User::onlyTrashed()->where('id',$id);
        $user->forceDelete();
        return redirect()->back()->with('status','Pengguna Berhasil Dihapus');
    }

    public function accepted ($id)
    {
        $cm  = User::find($id);
        $cm->accept_by_admin = 1;
        $cm->save();
        return redirect()->back()->with('status','Montir berhasil diaktifkan');
    }

    public function tutupKetersediaan ($id)
    {
        $user = User::find($id);
        $user->ketersediaan = 'libur';
        $user->save();
        return redirect()->back()->with('status','Berhasil ubah status');
    }

    public function bukaKetersediaan ($id)
    {
        $user = User::find($id);
        $user->ketersediaan = 'tersedia';
        $user->save();
        return redirect()->back()->with('status','Berhasil ubah status');
    }

    public function detailCalonMontir ($id)
    {
        $user = User::with('sertifikat','portfolio')->where('id', $id)->first(); 
        return view('pages.detail-calon-montir', compact('user'));
    }

    public function tolakMontir ($id)
    {
        $user = User::find($id);
        $user->accept_by_admin = 3;
        $user->save();
        return redirect()->back()->with('status','Montir ditolak');
    }


    public function ajukanMontir ($id)
    {
       $user = User::find($id);
        $user->accept_by_admin = 0;
        $user->save();
        return redirect()->back()->with('status','Pengajuan montir kembali berhasil'); 
    }

    public function tolakDaftarMontir(Request $request)
    {
        // dd($request->all()); die;
        $dataBaru = new TolakMontir;
        $dataBaru->user_id = Auth::user()->id;
        $dataBaru->montir_id = $request->montir_id;
        $dataBaru->alasan_penolakan = $request->alasan_penolakan;
        $dataBaru->save();

        $user = User::find($request->montir_id); 
        $user->accept_by_admin = 3;
        $user->save();

        return redirect()->back()->with('status','Berhasil ditolak');
    }

    public function hapusInfo ($id)
    {
        $data = TolakMontir::find($id);
        $data->delete();
        return redirect()->back();
    }
}
