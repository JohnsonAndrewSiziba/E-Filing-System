<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class SharedFiles extends Controller
{
    public function index(){
        $user = auth()->user();

        return File::whereRelation('shares', 'share_type', '=', 'to')->whereRelation('shares', 'user_id', '=', $user->id)->with('user')->get();
    }

    public function count(){
        $user = auth()->user();

        return [
            'type' => 'shared',
            'data' =>  File::whereRelation('shares', 'share_type', '=', 'to')->whereRelation('shares', 'user_id', '=', $user->id)->get()->count()
        ];
    }
}
