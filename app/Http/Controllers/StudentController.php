<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Student::latest()->get();
            return DataTables::of($data)->addcolumn('action', function ($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'"
                class="btn btn-primary btn-sm  edit">Edit</button>';
                $button .= ' ';
                $button .= '<button type="button" name="delete" id="'.$data->id.'" class="
                delete btn btn-danger btn-sm">Delete</button>';
                return $button;
            })->rawColumns(['action'])->make(true);
        }
        return view('student');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addStudent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'title' => 'required',
        ]);
        if($validData){
            Student::create($request->all());
            return ['success' =>true, 'message'=>'Successful add student'];
        }else{
            return response()->json(['error'=>$validData->errors()->all()]);
        }

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
    public function edit(Student $student,$id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $id = $request->id;
        $validData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'title' => 'required',
        ]);
        if($validData){
            Student::whereId($id)->update($validData);
            return ['success' =>true, 'message'=>'Successful Update student'];
        }else{
            return response()->json(['error'=>$validData->errors()->all()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {

        $student = Student::find($student->id);
        if($student->delete()){
            return ['success' =>true, 'message'=>'Successful Delete student'];
        }else{
            return response()->json(['error' => 'Delete Unsuccess']);
        }
    }
}
