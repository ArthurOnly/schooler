@extends('layouts.app')

@section('content')
<section class="container mx-auto p-6 bg-white">
  <div class="flex justify-between">
    <h1 class="text-2xl mb-8">{{$class->name}}</h1>
    <div class="flex gap-4">
        <a href="{{route('classes.edit', $class->id)}}" class="flex"><i data-feather="edit"></i><span class="ml-2">Editar</span> </a>
        <form method="POST" action={{route('classes.delete', $class->id)}} onsubmit="return confirm('Você tem certeza que quer deletar a classe?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="flex text-red-700"><i data-feather="user-minus"></i><span class="ml-2">Deletar</span> </a>
        </form>
    </div>
  </div>
  <form>
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Nome</label>
                <input disabled type="text" name="name" value="{{$class->name}}"/>
            </div>
            <div class="flex flex-col">
                <label class="mb-2">Professor</label>
                <input disabled type="email" name="teacher" value="{{$class->teacher->name}}"/>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Função</label>
                <select disabled name="role" multiple>
                    @foreach ($class->students as $student)
                        <option 
                         selected
                         >
                         {{$student->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
</section>
@endsection