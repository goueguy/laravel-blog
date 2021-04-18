<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "WELCOME TO MY BBLOG";
        return view("pages.index",compact("title"));
    }
    public function about(){
        $title = "WELCOME TO ABOUT";
        return view("pages.about",compact('title'));
    }
    public function services(){
        $data = array(
            "title"=>"Services",
            "services"=>["Web Design", "Programming","SEO"]
        );
        $title = "WELCOME TO SERVICES";
        return view("pages.services")->with($data);
    }
}
