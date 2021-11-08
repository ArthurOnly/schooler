@extends('layouts.app')

@section('title', 'Polo')

@section('content')
    <section class="container mx-auto p-6 bg-white">
        @can('edit polo')
            <div class="flex justify-between">
                <h1 class="text-2xl mb-8">{{ $polo->name }}</h1>
                <div class="flex gap-4">
                    <a href="{{ route('polo.edit', $polo->id) }}" class="flex"><i data-feather="edit"></i><span
                            class="ml-2">Editar</span> </a>
                    <form method="POST" action={{ route('polo.destroy', $polo->id) }}
                        onsubmit="return confirm('Você tem certeza que quer deletar o usuário?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex text-red-700"><i data-feather="user-minus"></i><span
                                class="ml-2">Deletar</span> </a>
                    </form>
                </div>
            </div>
        @endcan
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
                <div class="flex flex-col">
                    <label class="mb-2">Nome</label>
                    <input disabled type="text" name="name" value="{{ $polo->name }}" />
                </div>
            </div>
        </form>
    </section>
    <section class="container mx-auto p-6 bg-white mt-4">
        <h2 class="mb-2">Turmas</h2>
        <div class="w-full mb-8 overflow-hidden rounded-lg">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr
                            class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-3">Nome</th>
                            <th class="px-4 py-3">Curso</th>
                            <th class="px-4 py-3">Professor</th>
                            <th class="px-4 py-3">Estudantes</th>
                            <th class="px-4 py-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($polo->classrooms as $class)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-ms border">{{ $class->name }}</td>
                                <td class="px-4 py-3 text-ms border">{{ $class->course }}</td>
                                <td class="px-4 py-3 text-ms border">{{ $class->polo->name }}</td>
                                <td class="px-4 py-3 text-ms border">{{ $class->teacher->name }}</td>
                                <td class="px-4 py-3 text-ms border">{{ sizeOf($class->students) }}</td>
                                <td class="px-4 py-3 text-ms border">
                                    <a href="{{ route('classes.show', $class->id) }}">Visualizar</a>
                                    @hasanyrole('director|coordinator|secretary|teacher')
                                        <p class="inline"> | </p>
                                        <a href="{{ route('classes.aulas', $class->id) }}">Gerenciar</a>
                                    @endhasanyrole
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
