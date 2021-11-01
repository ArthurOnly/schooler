@extends('layouts.app')

@section('title', 'Polo')

@section('content')
<section class="container mx-auto p-6 bg-white">
  <div class="flex justify-between">
    <h1 class="text-2xl mb-8">{{$polo->name}}</h1>
    <div class="flex gap-4">
        <a href="{{route('polo.edit', $polo->id)}}" class="flex"><i data-feather="edit"></i><span class="ml-2">Editar</span> </a>
        <a href="#" class="flex text-red-700"><i data-feather="user-minus"></i><span class="ml-2">Deletar</span> </a>
    </div>
  </div>
  <form method="POST" action="{{route('polo.update', $polo->id)}}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Nome</label>
                <input type="text" name="name" value="{{$polo->name}}"/>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <button type="submit" class="bg-green-700 p-2 text-white w-full mb-2 max-w-lg">Atualizar</button>
        </div>
    </form>
</section>
@endsection