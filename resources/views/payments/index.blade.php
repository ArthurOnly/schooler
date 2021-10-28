@extends('layouts.app')

@section('content')
<section class="container mx-auto p-6 font-mono">
  <div class="mb-4">
    <a href="{{route('payments.create')}}" class="bg-green-700 p-2 text-white w-full mb-2 max-w-lg">Criar nova</a>
  </div>
  <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
    <div class="w-full overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">Usuário</th>
            <th class="px-4 py-3">Mês de referência</th>
            <th class="px-4 py-3">Pago</th>
            <th class="px-4 py-3">Ações</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach($payments as $payment)
            <tr class="text-gray-700">
              <td class="px-4 py-3 text-ms border">{{$payment->user->name}}</td>
              <td class="px-4 py-3 text-ms border">{{$payment->reference}}</td>
              <td class="px-4 py-3 text-ms border">
                @if ($payment->paid) 
                    <span class="p-2 rounded bg-green-700 w-max text-white">Pago</span>
                @else
                    <span class="p-2 rounded bg-red-700 w-max text-white">Não pago</span>
                @endif</td>
              <td class="px-4 py-3 text-ms border">
              <a href="{{route('payments.show', $payment->id)}}">Visualizar</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  {{ $payments->links() }}     
</section>
@endsection