<?php

namespace App\Http\Controllers\API\Resources;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FileResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return File::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
//        return $request->all();
//        $imageName = $request->file->getClientOriginalName();
//        $request->file->move(public_path('images'), $imageName);
//
//        return response()->json(['success'=>'You have successfully upload file.']);
//        return $request->files;

        $user = auth()->user();


        foreach ($request->file('files') as $file){
            $fileName = $file->getClientOriginalName();
//            $size = $this->formatBytes($file->getSize());
            $size = $file->getSize();
            $extension = $file->getClientOriginalExtension();
            $file->move(public_path('files_storage/' . $user->email), $fileName);
            $fileModel = new File();
            $fileModel->name = $fileName;
            $fileModel->user_id = $user->id;
            $fileModel->file_size = $size;
            $fileModel->file_type = $extension;
            $fileModel->file_path = $user->email . '/' . $fileName;
            $fileModel->save();
        }
        return response()->json(['success'=>'Upload successful']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $file= File::find($id);
        $email = $file->user->email;
        $fileName = $file->name;
        return asset('/files_storage/' . $email . '/' .$fileName);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('', 'K', 'M', 'G', 'T');

        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }
}
