<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class DeleteFile extends Controller
{
    public function index(Request $request){
        $file = File::find($request->id);
        $file->delete();
        return true;
    }
}
