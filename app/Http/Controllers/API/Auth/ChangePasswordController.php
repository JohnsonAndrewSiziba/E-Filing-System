<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request): array
    {
        $user = auth()->user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            $user->tokens()->delete();
            return [
                "result" => true
            ];
        }
        else {
            return [
                "result" => false
            ];
        }
    }
}
