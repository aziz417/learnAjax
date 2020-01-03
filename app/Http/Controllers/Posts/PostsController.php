<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Post;
use App\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){
            $data = Post::latest()->get();

            return DataTables::of($data)->addcolumn('action', function ($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'"
                class="btn btn-primary btn-sm edit">Edit</button>';
                $button .= ' ';
                $button .= '<button type="button" name="delete" id="'.$data->id.'" class="
                delete btn btn-danger btn-sm">Delete</button>';
                return $button;
            })->rawColumns(['action'])->make(true);
        }
        return view('post.post');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $image   = $request->file('img');
        $newName = rand(). '.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'), $newName);
        $request['image'] = $newName;
        $request['tcheck'] = implode(",",$request->hobby);
        $post = new Post($request->all());
        $post->save();
        return response($newName);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        if($request->ajax()) {
            $data = Post::findOrFail($id)->get();
            return response()->json(['data' => $data]);
        }
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
}
