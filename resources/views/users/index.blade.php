@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
<section class="container mx-auto p-6 font-mono">
  <div class="mb-4">
      <a href="{{route('users.create')}}" class="bg-green-700 p-2 text-white w-full mb-2 max-w-lg">Criar nova</a>
  </div>
  <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
    <div class="w-full overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">Nome</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Tipo</th>
            <th class="px-4 py-3">Ações</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach($users as $user)
            <tr class="text-gray-700">
              <td class="px-4 py-3 text-ms border">{{$user->name}}</td>
              <td class="px-4 py-3 text-ms border">{{$user->email}}</td>
              <td class="px-4 py-3 text-ms border">
                @foreach($user->getRoleNames() as $role)
                  <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none bg-green-700 text-white rounded">{{$role}}</span>
                @endforeach
              </td>
              <td class="px-4 py-3 text-ms border">
              <a href="{{route('users.show', $user->id)}}">Visualizar</a>
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