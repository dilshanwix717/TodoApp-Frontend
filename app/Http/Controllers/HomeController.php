<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;



class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/index');
    }
    // public function relationship()
    // {
    //     $response['products'] = Product::all();
    //     return view('pages.relationship.index')->with($response);
    // }
}
