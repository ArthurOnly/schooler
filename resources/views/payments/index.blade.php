@extends('layouts.app')

@section('title', 'Pagamentos')

@section('content')
    <section class="container mx-auto p-6 font-mono">
        <div class="mb-4 flex justify-between">
            <a href="{{ route('payments.create') }}" class="bg-green-700 p-2 text-white w-max mb-2 max-w-lg">Criar nova</a>
            <a href="{{ route('payments.csv') }}" download
                class="border-2 border-green-700 w-max p-2 text-green-700 mb-2 max-w-lg">Gerar relatório</a>
        </div>
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr
                            class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-3">Usuário</th>
                            <th class="px-4 py-3">Pagos/Existentes</th>
                            <th class="px-4 py-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($users as $user)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-ms border">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-ms border">
                                    @if ($user->qtd_paid >= $user->qtd_not_paid)
                                        <span class="p-2 rounded bg-green-700 w-max text-white">Em dia -
                                            {{ $user->qtd_paid }}/{{ $user->qtd_not_paid }}</span>
                                    @elseif ($user->qtd_not_paid - $user->qtd_paid == 1)
                                        <span class="p-2 rounded bg-yellow-700 w-max text-white">Aguardando -
                                            {{ $user->qtd_paid }}/{{ $user->qtd_not_paid }}</span>
                                    @else
                                        <span class="p-2 rounded bg-red-700 w-max text-white">Atrasado -
                                            {{ $user->qtd_paid }}/{{ $user->qtd_not_paid }}</span>
                                    @endif
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
