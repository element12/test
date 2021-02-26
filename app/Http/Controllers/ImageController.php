<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function handle(Request $request)
    {

       $pathToFile =  $request->file('image')->store('img','public');

       return $pathToFile;
    
    }
}
