<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\news;
use App\Models\journalist;

class WebsiteController extends Controller
{
    public function index(){
        $news = news::orderBy('id', 'DESC')->paginate(5);
        $names = DB::table('journalist')->paginate(5);

        return view('website.index', compact('news', 'names'));
    }

    public function news($id)
    {
        $news = news::where('id', $id)->first();
        
        $journalist = DB::table('journalist')->where('id', $news->journalist_id)->pluck('name');
        $names = $journalist[0];
        if ($news) {
            return view('website.news', compact('news','names'));
        } else {
            return \Response::view('website.errors.404', array(), 404);
        }
    }
    public function journalist($id)
    {
        $news = news::orderBy('id', 'DESC')->where('journalist_id', $id)->paginate(5);
        $names = DB::table('journalist')->where('id', $id)->get();
        if ($news) {
            return view('website.index', compact('news','names'));
        } else {
            return \Response::view('website.errors.404', array(), 404);
        }
    }
}
