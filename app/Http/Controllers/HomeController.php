<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\TolakMontir;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lastTransaction = Booking::with('montir','user')->get();
        $montirAktif = User::where('role','=','montir')->where('accept_by_admin', 1)->count(); 
        $montirNonaktif = User::where('role','=','montir')->where('accept_by_admin', 0)->count();
        $pekerjaanSelesai = User::sum('pekerjaan_diselesaikan'); 
        $totalPengguna = User::where('role','!=','admin')->count(); 
        $tolakMontir = TolakMontir::where('montir_id', \Auth::user()->id)->first(); 
        return view('dashboard.index', compact([
            'montirAktif','montirNonaktif','pekerjaanSelesai','totalPengguna','lastTransaction','tolakMontir'
        ])); 
    }
}
