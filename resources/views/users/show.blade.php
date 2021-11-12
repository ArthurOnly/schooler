@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
    <section class="container mx-auto p-6 bg-white">
        <div class="flex justify-between">
            <h1 class="text-2xl mb-8">{{ $user->name }}</h1>
            @can('edit users')
                <div class="flex gap-4">
                    <a href="{{ route('users.edit', $user->id) }}" class="flex"><i data-feather="edit"></i><span
                            class="ml-2">Editar</span> </a>
                    <form method="POST" action={{ route('users.delete', $user->id) }}
                        onsubmit="return confirm('Você tem certeza que quer deletar o usuário?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex text-red-700"><i data-feather="user-minus"></i><span
                                class="ml-2">Deletar</span> </a>
                    </form>
                </div>
            @endcan
        </div>
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
                <div class="flex flex-col">
                    <label class="mb-2">Nome</label>
                    <input disabled type="text" name="name" value="{{ $user->name }}" />
                </div>
                <div class="flex flex-col">
                    <label class="mb-2">Email</label>
                    <input disabled type="email" name="email" value="{{ $user->email }}" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
                <div class="flex flex-col">
                    <label class="mb-2">Função</label>
                    <select disabled name="role" multiple>
                        @foreach ($roles as $role)
                            <option @if ($user->hasRole($role))
                                selected
                        @endif
                        >
                        {{ $role }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col">
                <label class="mb-2">Polo</label>
                <input type="text" value="{{$user->polo->name}}" disabled/>
            </div>
            </div>
            @if ($user->hasRole('student'))
                <div class="grid grid-cols-1 md:grid-cols-1 mt-4 gap-4">
                    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                        <label class="mb-2">Boletos</label>
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
                                    @foreach ($user->payments as $payment)
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </form>
    </section>
@endsection
