@extends('layouts.app')

@section('title', 'Classes')

@section('content')
    <section>
        <div class="container mx-auto p-6 font-mono">
            <div class="mb-4 flex justify-between">
                <form class="flex gap-4" action="{{ route('classes.index') }}" method="GET">
                    <div class="flex flex-col gap-2">
                        <label>Nome</label>
                        <input type="text" name="name" value={{ request()->query('name', '') }}></input>
                    </div>
                    <button type="submit" class="bg-green-700 p-2 text-white h-auto mt-auto">Buscar</button>
                </form>
                @hasanyrole('director|coordinator|secretary')
                    <a href="{{ route('classes.create') }}" class="bg-green-700 p-2 text-white max-w-lg h-full my-auto">Criar
                        nova</a>
                @endhasanyrole
            </div>
            <div class="w-full mb-8 overflow-hidden rounded-lg">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr
                                class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">Nome</th>
                                <th class="px-4 py-3">Curso</th>
                                <th class="px-4 py-3">Polo</th>
                                <th class="px-4 py-3">Professor</th>
                                <th class="px-4 py-3">Estudantes</th>
                                <th class="px-4 py-3">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($classes as $class)
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
            {{ method_exists($classes, 'links') ? $classes->links() : '' }}
        </div>
    </section>
@endsection
