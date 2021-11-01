@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @role('student')
        <section>
            <div class="container mx-auto p-6 bg-white">
                <div class="mb-8">
                    <h1 class="text-3xl">Minhas turmas</h1>
                </div>
                <div class="flex">
                    @foreach (auth()->user()->classrooms as $classroom)
                        <div class="flex p-4 flex-col border">
                            <h2 class="text-2xl mb-2">{{ $classroom->name }}</h2>
                            <p class="text-lg">Nota:
                                @foreach ($classroom->students as $student)
                                    @if ($student->student_id == auth()->user()->id)
                                        {{ $student->score ? $student->score : 'Não lançado' }}
                                    @endif
                                @endforeach
                                </h2>
                            <p class="text-lg">Faltas:
                                @foreach ($classroom->students as $student)
                                    @if ($student->student_id == auth()->user()->id)
                                        {{ $student->absences }}
                                    @endif
                                @endforeach
                            </p>
                            <a class="text-blue-700 mt-2" href="{{ route('classes.show', $classroom->id) }}">Ver mais</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section>
            <div class="container mx-auto p-6 bg-white mt-8">
                <div class="mb-8">
                    <h1 class="text-3xl">Meus boletos</h1>
                </div>
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr
                                class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">Valor</th>
                                <th class="px-4 py-3">Mês de referência</th>
                                <th class="px-4 py-3">Pago</th>
                                <th class="px-4 py-3">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @if(count(auth()->user()->payments)>0)
                                @foreach (auth()->user()->payments as $payment)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 text-ms border">{{ $payment->value }}</td>
                                        <td class="px-4 py-3 text-ms border">{{ $payment->reference }}</td>
                                        <td class="px-4 py-3 text-ms border">
                                            @if ($payment->paid)
                                                <span class="p-2 rounded bg-green-700 w-max text-white">Pago</span>
                                            @else
                                                <span class="p-2 rounded bg-red-700 w-max text-white">Não pago</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-ms border">
                                            <a href="{{ route('payments.show', $payment->id) }}">Visualizar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="text-gray-700">
                                    <td colspan="4" class="px-4 py-3 text-ms border">Nenhum boleto cadastrado</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    @endrole

    @role('teacher')
        <section>
            <div class="container mx-auto p-6 bg-white mt-8">
                <div class="mb-8">
                    <h1 class="text-3xl">Minhas turmas</h1>
                </div>
                <div class="flex">
                    @foreach (auth()->user()->classrooms_teacher as $classroom)
                        <div class="flex p-4 flex-col border">
                            <h2 class="text-2xl mb-2">{{ $classroom->name }}</h2>
                            <a class="text-blue-700 mt-2" href="{{ route('classes.aulas', $classroom->id) }}">Gerenciar</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endrole
@endsection
