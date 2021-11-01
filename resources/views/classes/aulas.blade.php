@extends('layouts.app')

@section('title', 'Classes')

@section('content')
    <section>
        <form class="container mx-auto p-6 font-mono" action="{{ route('classes.aulas.update', $class->id) }}" method="POST">
        @csrf
        @method('PUT')
            <div class="w-full mb-8 overflow-hidden rounded-lg">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr
                                class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">Nome do aluno</th>
                                <th class="px-4 py-3">Faltas</th>
                                <th class="px-4 py-3">Nota</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($class->students as $student)
                                <tr class="text-gray-700">
                                    <td class="px-4 py-3 text-ms border">{{ $student->user->name }}</td>
                                    <td class="px-4 py-3 text-ms border"><input type="number" class="border"
                                            name="students[{{ $student->id }}][absences]" value="{{ $student->absences }}"></input></td>
                                    <td class="px-4 py-3 text-ms border"><input type="number" class="border"
                                            name="students[{{ $student->id }}][score]" value="{{ $student->score }}"></input></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mb-4">
                <button type='submit'
                    class="bg-green-700 p-2 text-white w-full mb-2 max-w-lg">Atualizar</button>
            </div>
        </form>
    </section>
@endsection
