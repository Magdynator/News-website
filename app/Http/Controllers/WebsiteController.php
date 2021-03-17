<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\news;

class WebsiteController extends Controller
{
    public function index(){
        $news = news::orderBy('id', 'ASC')->paginate(5);
        $names = news::orderBy('id', 'ASC')->paginate(5);

        return view('website.index', compact('news', 'names'));
    }

    public function news($id)
    {
        $news = news::where('id', $id)->first();
        if ($news) {
            return view('website.news', compact('news'));
        } else {
            return \Response::view('website.errors.404', array(), 404);
        }
    }
}
