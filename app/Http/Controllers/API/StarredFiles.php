<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class StarredFiles extends Controller
{
    public function index(){
        $user = auth()->user();
        return File::where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->where('starred', true)->get();
    }

    public function count(){
        $user = auth()->user();

        return [
            'type' => 'starred',
            'data' => File::where('user_id', $user->id)->where('starred', true)->get()->count(),
        ];
    }
}
