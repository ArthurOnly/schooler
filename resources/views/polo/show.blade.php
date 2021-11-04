@extends('layouts.app')

@section('title', 'Polo')

@section('content')
    <section class="container mx-auto p-6 bg-white">
        @can ('edit polo')
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
@endsection
