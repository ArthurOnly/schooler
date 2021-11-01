<?php

namespace App\Http\Controllers;

use App\Models\Polo;
use Exception;
use Illuminate\Http\Request;

class PoloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polos = Polo::paginate();
        return view('polo.index', ['polos' => $polos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('polo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            Polo::create($request->all());
            return redirect()->route('polo.index');
        } catch(Exception $ex){
            return back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Polo $polo)
    {
        return view('polo.show', ['polo' => $polo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Polo $polo)
    {
        return view('polo.edit', ['polo' => $polo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Polo $polo)
    {
        try{
            $polo->fill($request->all());
            $polo->save();
            return redirect()->route('polo.show', $polo);
        } catch(Exception $ex){
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
