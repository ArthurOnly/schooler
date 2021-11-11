@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
    <section class="container mx-auto p-6 font-mono">
        @if(session()->has('success'))
            <h2 class="bg-green-700 p-4 mb-4">{{session('success')['message']}}</h2>
        @endif
        <div class="mb-4 flex justify-between">
            <form class="flex gap-4" action="{{route('users.index')}}" method="GET">
                <div class="flex flex-col gap-2">
                    <label>Nome</label>
                    <input type="text" name="name" value={{request()->query('name', '')}}></input>
                </div>
                <div class="flex flex-col gap-2">
                    <label>Tipo</label>
                    <select name='type' class="p-2">
                        <option selected value>Todos</option>
                        <option @if(request()->query('type') == 'student') selected @endif value="student">Aluno</option>
                        <option @if(request()->query('type') == 'teacher') selected @endif value="teacher">Professor</option>
                        <option @if(request()->query('type') == 'secretary') selected @endif value="secretary">Secretário</option>
                        <option @if(request()->query('type') == 'coordinator') selected @endif value="coordinator">Coordenador</option>
                        <option @if(request()->query('type') == 'financial') selected @endif value="financial">Financeiro</option>
                        <option @if(request()->query('type') == 'director') selected @endif value="director">Diretor</option>
                    </select>
                </div>
                <button type="submit" class="bg-green-700 p-2 text-white h-auto mt-auto">Buscar</button>
            </form>
            @can('create users')
            <a href="{{ route('users.create') }}" class="bg-green-700 p-2 text-white mb-2 max-w-lg h-full my-auto">Criar
                novo usuário</a>
            @endcan
        </div>
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr
                            class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-3">Nome</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Tipo</th>
                            <th class="px-4 py-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($users as $user)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-ms border">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-ms border">{{ $user->email }}</td>
                                <td class="px-4 py-3 text-ms border">
                                    @foreach ($user->getRoleNames() as $role)
                                        <span
                                            class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none bg-green-700 text-white rounded">{{ $role }}</span>
                                    @endforeach
                                </td>
                                <td class="px-4 py-3 text-ms border">
                                    <a href="{{ route('users.show', $user->id) }}">Visualizar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $users->links() }}
    </section>
@endsection
