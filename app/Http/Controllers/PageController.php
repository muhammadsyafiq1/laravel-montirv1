<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rating;
use App\Models\Review;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $topMontir = User::orderBy('pekerjaan_diselesaikan','desc')
            ->where('pekerjaan_diselesaikan', '>' , 0)
            ->where('role','!=','admin')
            ->where('accept_by_admin', 1)
            ->limit(6)
            ->get(); 
        $filterKeyword = $request->keyword;


        if($filterKeyword){
            $montirs = User::with('category')
                ->where('role','=','montir')
                ->where('foto', '!=', NULL)
                ->where('accept_by_admin', 1)
                ->where('alamat', 'LIKE', "%$filterKeyword%")
                ->orderBy('id','desc')->paginate(24); 
        } else {
            $montirs = User::with('category')
                ->where('role','=','montir')
                ->where('foto', '!=', NULL)
                ->where('accept_by_admin', 1)
                ->orderBy('id','desc')->paginate(24); 
        }
    	
    	return view('pages.halaman_utama.index', compact('montirs','topMontir'));
    }

    public function detail($id)
    {
        $montir = User::with(['portfolio','sertifikat'])->where('id', $id)->first(); 
        $reviews = Review::with('user','rating')->where('montir_id', $id)->get();  
        $ratings = Rating::where('montir_id', $montir->id)->get(); 
        $rating_sum = Rating::where('montir_id', $montir->id)->sum('stars_rated'); 
        if($ratings->count() > 0){
            $rating_value = $rating_sum / $ratings->count();
        }else{
            $rating_value = 0;
        }
        
        return view('pages.halaman_detail.index', compact('reviews','montir','rating_value','ratings')); 
    }

    public function kategori (Request $request)
    {
        $categories = Category::all();
        $filterKeyword = $request->keyword;

        if($filterKeyword){
            $montirs = User::with('category')
                ->where('role','=','montir')
                ->where('foto', '!=', NULL)
                ->where('accept_by_admin', 1)
                ->where('alamat', 'LIKE', "%$filterKeyword%")
                ->orderBy('id','desc')->paginate(16); 
        } else {
            $montirs = User::with('category')
                ->where('role','=','montir')
                ->where('foto', '!=', NULL)
                ->where('accept_by_admin', 1)
                ->orderBy('id','desc')->paginate(16); 
        }
        return view('pages.halaman_kategori.index', compact(
            'categories','montirs'
        ));
    }

    public function montirByCategory(Request $request, $id)
    {
        $categories = Category::all();

        $montirs = User::where('category_id', $id)
            ->where('foto', '!=', NULL)
            ->where('accept_by_admin', 1)
            ->paginate(16);
        
        return view('pages.halaman_kategori.index', compact(
            'categories','montirs'
        ));
    }

}
