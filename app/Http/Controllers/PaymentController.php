<?php

namespace App\Http\Controllers;

use App\Models\MonthlyPayment;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->query('name', '');
        $students = User::role('student')->where('name', 'like', "%$name%")->paginate();
        foreach ($students as $student) {
            $student->in_day = TRUE;
            foreach ($student->payments as $payment) {
                $date = new DateTime($payment->reference);
                $date->modify('+1 month');
                $now = new DateTime('now');
                if ($now > $date && !$payment->paid) $student->in_day = FALSE;            
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

        $initial_date = Carbon::createFromFormat('Y-m-d', $request->reference.'-01');
        for($i = 0; $i < $request->quantity; $i++){
            $request['reference'] = $initial_date->format('Y-m');
            MonthlyPayment::create($request->all());
            $initial_date = $initial_date->addMonth();
        }
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

        $columns = array('ID', 'Nome', 'Polo', 'Boletos criados', 'Situação');

        $callback = function () use ($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                $user->in_day = TRUE;
                foreach ($user->payments as $payment) {
                    $date = new DateTime($payment->reference);
                    $date->modify('+1 month');
                    $now = new DateTime('now');
                    if ($now > $date && !$payment->paid) $user->in_day = FALSE;            
                }

                if ($user->in_day){
                    $row['Situação'] = 'Em dia';
                } else{
                    $row['Situação'] = 'Em atraso';
                }

                $row['ID']  = $user->id;
                $row['Nome'] = $user->name;
                $row['Polo'] = $user->polo->name;
                $row['Boletos criados'] = count($user->payments);

                fputcsv($file, array($row['ID'], $row['Nome'], $row['Polo'], $row['Boletos criados'], $row['Situação']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
