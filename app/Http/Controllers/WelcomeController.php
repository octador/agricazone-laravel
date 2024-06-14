<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
   public function index()
   {
    $category = Category::all();
       return view('welcome',[
           'categories' => $category
       ]);
   }
   public function show()
   {
    $category = Category::all();
       return view('show',[
           'categories' => $category
       ]);
   }
   public function search(){
    $category= Category::all();
     return view('search',[
         'categories' => $category
     ]
 );
 }
}
