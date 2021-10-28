<?php

namespace App\Http\Controllers;

use App\Models\MonthlyPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = MonthlyPayment::paginate();
        return view('payments.index', ['payments' => $payments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = User::role('student')->get();
        return view('payments.create', ['students' => $students]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filename = uniqid().'.'.$request->file('boleto')->extension();
        $imageUrl = $request->file('boleto')->storeAs('boletos', $filename ,'public');
        $request->merge(['file' => $imageUrl]);
        if ($request->paid == 'on'){
            $request->merge(['paid' => True]);
        } else{
            $request->merge(['paid' => False]);
        }
        MonthlyPayment::create($request->all());
        return redirect()->route('payments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = MonthlyPayment::find($id);
        return view('payments.show', ['payment' => $payment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = MonthlyPayment::find($id);
        $students = User::role('student')->get();
        return view('payments.edit', ['payment' => $payment, 'students' => $students]);
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
        $payment = MonthlyPayment::find($id);
        if ($request->file('boleto')){
            Storage::delete($payment->file);
            $filename = uniqid().'.'.$request->file('boleto')->extension();
            $imageUrl = $request->file('boleto')->storeAs('boletos', $filename ,'public');
            $request->merge(['file' => $imageUrl]);
        } 
        if ($request->paid == 'on'){
            $request->merge(['paid' => True]);
        } else{
            $request->merge(['paid' => False]);
        }
        $payment->fill($request->all());
        $payment->save();
        return redirect()->route('payments.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = MonthlyPayment::find($id);
        Storage::delete($payment->file);
        MonthlyPayment::destroy($id);
        return redirect()->route('payments.index');
    }
}
