<?php

namespace App\Http\Controllers;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.products.index');
    }
    
    public function show($id)
    {
        return view('pages.products.show', compact('id'));
    }
}