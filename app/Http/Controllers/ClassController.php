<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ClassStudent;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classroom::paginate();
        return view('classes.index', ['classes' => $classes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = User::role('teacher')->get();
        $students = User::role('student')->get();
        return view('classes.create', ['teachers' => $teachers, 'students' => $students]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $class = Classroom::create($request->all());
            foreach($request->students as $student){
                ClassStudent::create(['classroom_id' => $class->id, 'student_id' => $student]);
            }
            DB::commit();
            notify()->success('Criado com sucesso!');
            return redirect()->route('classes.index');
        } catch (Exception $ex){
            DB::rollBack();
            notify()->error('Erro: '.$ex->__toString());
            return back()->withInput();
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
        $class = Classroom::find($id);
        return view('classes.show', ['class' => $class]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teachers = User::role('teacher')->get();
        $students = User::role('student')->get();
        $class = Classroom::find($id);
        return view('classes.edit', ['class' => $class, 'teachers' => $teachers, 'students' => $students]);
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
        $class = Classroom::find($id);
        DB::beginTransaction();
        try{
            $class->fill($request->all());
            foreach ($class->students as $student){
                ClassStudent::where('classroom_id', $class->id)->delete();
            }
            foreach($request->students as $student){
                ClassStudent::create(['classroom_id' => $class->id, 'student_id' => $student]);
            }
            $class->save();
            DB::commit();
            notify()->success('Editado com sucesso!');
            return redirect()->route('classes.show', $class->id);
        } catch (Exception $ex){
            DB::rollBack();
            notify()->error('Erro: '.$ex->__toString());
            return back()->withInput();
        }
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
