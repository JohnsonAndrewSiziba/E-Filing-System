<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FileShare;
use App\Models\ShareFrom;
use App\Models\ShareTo;
use Illuminate\Http\Request;

class ShareFile extends Controller
{
    public function index(Request $request){
        $user = auth()->user();

        $shareTo = new ShareTo();
        $shareTo->user_id = $request->recipient;
        $shareTo->file_id = $request->id;
        $shareTo->save();


        $shareFrom = new ShareFrom();
        $shareFrom->user_id = $user->id;
        $shareFrom->file_id = $request->id;
        $shareFrom->save();

        return true;
    }
}
