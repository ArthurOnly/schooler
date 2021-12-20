@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
<section class="container mx-auto p-6 bg-white">
  <div class="flex justify-between">
    <h1 class="text-2xl mb-8">{{$user->name}}</h1>
    <div class="flex gap-4">
        <a href="{{route('users.edit', $user->id)}}" class="flex"><i data-feather="edit"></i><span class="ml-2">Editar</span> </a>
        <a href="#" class="flex text-red-700"><i data-feather="user-minus"></i><span class="ml-2">Deletar</span> </a>
    </div>
  </div>
  <form method="POST" action="{{route('users.update', $user->id)}}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Nome</label>
                <input type="text" name="name" value="{{$user->name}}"/>
            </div>
            <div class="flex flex-col">
                <label class="mb-2">Email</label>
                <input type="email" name="email" value="{{$user->email}}"/>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Cpf</label>
                <input required type="text" name="cpf" value="{{$user->cpf}}"/>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Função</label>
                <select name="roles[]" multiple>
                    @foreach ($roles as $role)
                        <option 
                         @if ($user->hasRole($role))
                         selected
                         @endif
                         value={{$role}}
                         >
                         {{$role}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col">
                <label class="mb-2">Polo</label>
                <select required name="polo_id">
                    @foreach ($polos as $polo)
                        <option 
                         value={{$polo->id}}
                         @if($polo->id == $user->polo_id) 
                         selected
                         @endif
                         >
                         {{$polo->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        @hasrole('director')
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Senha</label>
                <input type="password" name="password"/>
            </div>
        </div>
        @endhasrole
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <button type="submit" class="bg-green-700 p-2 text-white w-full mb-2 max-w-lg">Atualizar</button>
        </div>
    </form>
</section>
@endsection