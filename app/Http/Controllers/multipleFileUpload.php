<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class multipleFileUpload extends Controller
{
    public function index(){
        return view('multipleFile.file');
    }

    public function upload(Request $request){
        $image_code = '';
        $images = $request->file('file');
        foreach ($images as $image){
            $newName = rand(). '.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $newName);

            $image_code .= '<div class="col-md-2" style="margin-bottom: 24px;">
            <img src="/images/'.$newName.'" style="height: 150px; width: 120px;" class="img-thumbnail"/></div>';
        }


        $output = array(
            'success' => 'Images Uploaded Successfully',
            'image'   => $image_code
        );

        return response()->json($output);
    }
}
