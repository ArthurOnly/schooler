@extends('layouts.app')

@section('content')
<section class="container mx-auto p-6 font-mono">
  <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
    <div class="w-full overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">Nome</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Ações</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr class="text-gray-700">
            <td class="px-4 py-3 text-ms font-semibold border">22</td>
            <td class="px-4 py-3 text-ms font-semibold border">22</td>
            <td class="px-4 py-3 text-ms font-semibold border">Visualizar</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>
@endsection