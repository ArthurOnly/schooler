@extends('layouts.app')

@section('title', 'Polo')

@section('content')
<section class="container mx-auto p-6 font-mono">
  <div class="mb-4">
      <a href="{{route('polo.create')}}" class="bg-green-700 p-2 text-white w-full mb-2 max-w-lg">Criar novo</a>
  </div>
  <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
    <div class="w-full overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">Nome</th>
            <th class="px-4 py-3">Ações</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach($polos as $polo)
            <tr class="text-gray-700">
              <td class="px-4 py-3 text-ms border">{{$polo->name}}</td>
              <td class="px-4 py-3 text-ms border">
              <a href="{{route('polo.show', $polo->id)}}">Visualizar</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  {{ $polos->links() }}     
</section>
@endsection