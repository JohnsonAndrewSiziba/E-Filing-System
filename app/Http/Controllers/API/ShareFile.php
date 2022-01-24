<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FileShare;
use Illuminate\Http\Request;

class ShareFile extends Controller
{
    public function index(Request $request){
        $user = auth()->user();

        $shareModel = new FileShare();
        $shareModel->share_type = "to";
        $shareModel->user_id = $request->recipient;
        $shareModel->file_id = $request->id;
        $shareModel->save();

        $shareModel2 = new FileShare();
        $shareModel2->share_type = "from";
        $shareModel2->user_id = $user->id;
        $shareModel2->file_id = $request->id;
        $shareModel2->save();

        return true;
    }
}
