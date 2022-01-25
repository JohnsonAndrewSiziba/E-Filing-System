<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class StarFile extends Controller
{
    public function index(Request $request){
        $model = File::find($request->id);
        $model->starred = !$model->starred;
        $model->save();
        return true;
    }
}
