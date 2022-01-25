<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecentFiles extends Controller
{
    public function index(){
        $user = auth()->user();

        return File::where('user_id', $user->id)->where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function count(){
        $user = auth()->user();

        return [
            'type' => 'recent',
            'data' => $user->files->count(),
        ];
    }
}
