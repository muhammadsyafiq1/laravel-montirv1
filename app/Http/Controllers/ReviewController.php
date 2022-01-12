<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Rating;
use App\Models\User;
use App\Models\Booking;
use App\Models\Complain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rating = Rating::with('user','montir')->where('user_id', Auth::user()->id)->get(); 
        $complain = Complain::with('user','montir')->where('user_id', Auth::user()->id)->get(); 
        $review = Review::with('user','montir','rating')->where('user_id', Auth::user()->id)->get(); 
        return view('dashboard.review', compact('review','rating','complain'));
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
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function review (Request $request)
    {
        // dd($request->all()); die;
        $revEdit = Rating::find($request->rating_id);
        $revEdit->stars_rated = $request->stars_rated;
        $revEdit->save();

        $revEdit = Review::find($request->id);
        $revEdit->review = $request->review;
        $revEdit->save();
        return redirect()->back()->with('status','Review berhasil diberikan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
