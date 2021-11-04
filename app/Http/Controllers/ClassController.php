<?php

namespace App\Http\Controllers;

use App\Http\Requests\Classrooom\EditClassroomDataRequest;
use App\Models\Classroom;
use App\Models\ClassStudent;
use App\Models\Grade;
use App\Models\Polo;
use App\Models\Presence;
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
        $polos = Polo::all();
        return view('classes.create', ['teachers' => $teachers, 'students' => $students, 'polos' => $polos]);
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
        $polos = Polo::all();
        return view('classes.edit', ['class' => $class, 'teachers' => $teachers, 'students' => $students, 'polos' => $polos]);
    }

    public function aulas(EditClassroomDataRequest $request, Classroom $classroom){
        return view('classes.aulas', ['class' => $classroom]);
    }

    public function storeScore(EditClassroomDataRequest $request, Classroom $classroom){
        try{
            foreach ($request->students as $id => $newData){
                ClassStudent::find($id)->fill($newData)->save();
            }
            notify()->success('Alteardo com sucesso!');
        } catch (Exception $ex){
            notify()->error('Erro: '.$ex->__toString());
        }
        return redirect()->route('classes.aulas', $classroom->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        DB::beginTransaction();
        try{
            $classroom->fill($request->all());
            $classroom->save();
            
            $actualClassIds = ClassStudent::where('classroom_id', $classroom->id)->pluck('student_id');
            $newIds = collect($request->students);

            foreach($newIds as $id){
                if (!$actualClassIds->contains($id)){
                    ClassStudent::create(['student_id' => $id, 'classroom_id' => $classroom->id]);
                }
            }

            foreach($actualClassIds as $id){
                if (!$newIds->contains($id)){
                    ClassStudent::where(['student_id' => $id, 'classroom_id' => $classroom->id])->delete();
                }
            }
           
            DB::commit();
            notify()->success('Editado com sucesso!');
            return redirect()->route('classes.show', $classroom->id);
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
