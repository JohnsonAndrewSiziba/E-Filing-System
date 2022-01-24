<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SharedFiles extends Controller
{
    public function index(){
        $user = auth()->user();

        return $user->files;
    }
}
