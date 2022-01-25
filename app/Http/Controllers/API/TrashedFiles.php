<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class TrashedFiles extends Controller
{
    public function index(){
        $user = auth()->user();

        return File::onlyTrashed()->where('user_id', $user->id)
            ->orderBy('deleted_at', 'desc')
            ->get();
    }


    public function count(){
        $user = auth()->user();
        $files = File::onlyTrashed()->where('user_id', $user->id)->get()->count();

        return [
            'type' => 'trashed',
            'data' => $files,
        ];
    }
}
