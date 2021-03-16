<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
    public function news()
    {
        $news = DB::select('SELECT * FROM news');
         foreach($news as $new){
             echo $new->title.'</br>';
             echo '<img src='. $new->img. '>'.'</br>';
         }
    }
}
