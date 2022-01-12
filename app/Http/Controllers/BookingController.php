<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Review;
use App\Models\Rating;
use App\Models\Complain;
use App\Models\TolakMontir;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Booking::with('user')->where('montir_id', \Auth::user()->id)->get(); 
        return view('dashboard.list_booking', compact('data'));
    }

    public function diterima ($id)
    {
        $data = Booking::find($id); 
        $montir = User::find($data->montir_id);
        $montir->ketersediaan = 'bekerja';
        $data->status = 'diterima';
        $montir->save();
        $data->save();
        return redirect()->back()->with('status','Pesanan diterima');
    }

    public function ditolak (Request $request)
    {
        $dataBaru = new TolakMontir;
        $dataBaru->user_id = $request->customer_id;
        $dataBaru->montir_id = \Auth::user()->id;
        $dataBaru->alasan_penolakan = $request->alasan_penolakan;
        $dataBaru->save();
        // dd($request->all());
        $data = Booking::find($request->booking_id); 
        $data->status = 'ditolak';
        $data->save();
        return redirect()->back()->with('status','Pesanan berhasil ditolak');
    }

     public function menunggu ($id)
    {
        $data = Booking::find($id);
        $data->status = 'menunggu';
        $data->save();
        return redirect()->back()->with('status','Pesanan menunggu');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pesananSaya ()
    {
        // $data = Booking::with('montir.complainMontir','montir.ratingMontir')->where('user_id', 4)->get();
        $tolakCustomer = TolakMontir::with('montir','user')->where('user_id', \Auth::user()->id)->get(); 
        $data = Booking::with('user')->whereHas('user', function($user){
            $user->where('user_id', \Auth::user()->id);
        })->get(); 
        
        return view('dashboard.pesanan', compact('data','tolakCustomer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $montir_id = $request->montir_id; 
        $data = $request->all();
        $data['status'] = 'menunggu';
        $data['user_id'] = \Auth::user()->id;
        Booking::create($data);

        return redirect()->route('success',$montir_id);
    }

    public function bookingSukses ($montir_id)
    {
        $user  = User::find($montir_id); 
        return view('pages.halaman_sukses.success', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function bookingSelesai ($idMontir, $idBooking)
    {
        $booking = Booking::find($idBooking);
        $booking->status = 'selesai';
        $booking->save();

        $user = User::find($idMontir);
        $user->pekerjaan_diselesaikan = + 1;
        $user->ketersediaan = 'tersedia';
        $user->save();

        $rating =  Rating::create([
            'user_id' => \Auth::user()->id,
            'montir_id' => $idMontir,
            'stars_rated' => '',
        ]);

        Review::create([
            'user_id' => \Auth::user()->id,
            'montir_id' => $idMontir,
            'review' => '',
            'rating_id' => $rating->id
        ]);


        Complain::create([
            'user_id' => \Auth::user()->id,
            'montir_id' => $idMontir,
            'complain' => '',
        ]);

        return redirect()->route('user.review')->with('status','Pekerjaan telah diselesaikan, silahkan berikan penilaian');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Booking::find($id); 
        $data->delete();
        return redirect()->back()->with('status','Pesanan berhasil dihapus');

    }
}
