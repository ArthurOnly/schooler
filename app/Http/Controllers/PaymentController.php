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
        $students = User::role('student')->paginate();
        foreach ($students as $student) {
            $student->qtd_not_paid = 0;
            $student->qtd_paid = 0;
            foreach ($student->payments as $payment) {
                if ($payment->paid) {
                    $student->qtd_not_paid += 1;
                } else {
                    $student->qtd_paid += 1;
                }
            }
        }
        return view('payments.index', ['users' => $students]);
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
        $filename = uniqid() . '.' . $request->file('boleto')->extension();
        $imageUrl = $request->file('boleto')->storeAs('boletos', $filename, 'public');
        $request->merge(['file' => $imageUrl]);
        if ($request->paid == 'on') {
            $request->merge(['paid' => True]);
        } else {
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
        if ($request->file('boleto')) {
            Storage::delete($payment->file);
            $filename = uniqid() . '.' . $request->file('boleto')->extension();
            $imageUrl = $request->file('boleto')->storeAs('boletos', $filename, 'public');
            $request->merge(['file' => $imageUrl]);
        }
        if ($request->paid == 'on') {
            $request->merge(['paid' => True]);
        } else {
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

    public function exportCsv()
    {
        $fileName = 'tasks.csv';
        $users = User::role('student')->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('ID', 'Nome', 'Polo', 'Boletos criados', 'Boletos pagos', 'Situação');

        $callback = function () use ($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                $user->qtd_not_paid = 0;
                $user->qtd_paid = 0;
                foreach ($user->payments as $payment) 
                    $payment->paid ? $user->qtd_not_paid += 1 : $user->qtd_paid += 1;

                if ($user->qtd_not_paid == 0){
                    $row['Situação'] = 'Em dia';
                } elseif ($user->qtd_not_paid == 1){
                    $row['Situação'] = 'Aguardando';
                } else{
                    $row['Situação'] = 'Em atraso';
                }

                $row['ID']  = $user->id;
                $row['Nome'] = $user->name;
                $row['Polo'] = $user->polo->name;
                $row['Boletos criados'] = $user->qtd_paid + $user->qtd_not_paid;
                $row['Boletos pagos'] = $user->qtd_paid;

                fputcsv($file, array($row['ID'], $row['Nome'], $row['Polo'], $row['Boletos criados'], $row['Boletos pagos'], $row['Situação']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
