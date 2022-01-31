@extends('layouts.app')

@section('title', 'Classes')

@section('content')
<section class="container mx-auto p-6 bg-white">
  <div class="flex justify-between">
    <h1 class="text-2xl mb-8">{{$class->name}}</h1>
    <div class="flex gap-4">
        @hasanyrole('director|coordinator')
        <form method="POST" action={{route('classes.store', $class->id)}}>
            @csrf
            @method('POST')
            <input type='hidden' name='name' value='{{$class->name}}-{{uniqid()}}'>
            <input type='hidden' name='teacher_id' value='{{$class->teacher_id}}'>
            <input type='hidden' name='course' value='{{$class->course}}'>
            <input type='hidden' name='polo_id' value='{{$class->polo_id}}'>
            <select hidden id='students' name="students[]" multiple class="py-4">
                @foreach ($class->students as $student)
                    <option 
                        value="{{$student->student_id}}"
                        selected
                        >
                        test
                    </option>
                @endforeach
            </select>
            <button type="submit" class="flex"><i data-feather="copy"></i><span class="ml-2">Duplicar</span></button>
        </form>
        <a href="{{route('classes.edit', $class->id)}}" class="flex"><i data-feather="edit"></i><span class="ml-2">Editar</span> </a>
        <form method="POST" action={{route('classes.delete', $class->id)}} onsubmit="return confirm('Você tem certeza que quer deletar a classe?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="flex text-red-700"><i data-feather="user-minus"></i><span class="ml-2">Deletar</span> </a>
        </form>
        @endhasanyrole
    </div>
  </div>
  <form>
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Nome</label>
                <p>{{$class->name}}</p>
            </div>
            <div class="flex flex-col">
                <label class="mb-2">Curso</label>
                <p>{{$class->course}}</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Professor</label>
                <a href="{{route('users.show', $class->teacher->id)}}">
                        <span class="flex gap-2 mb-2"> <i data-feather="eye"></i>{{$class->teacher->name}} <span>
                </a>
            </div>
            <div class="flex flex-col">
                <label class="mb-2">Alunos</label>
                @foreach ($class->students as $student)
                    <a href="{{route('users.show', $student->user->id)}}">
                        <span class="flex gap-2 mb-2"> <i data-feather="eye"></i>{{$student->user->name}} <span>
                    </a>
                @endforeach
            </div>
            <div class="flex flex-col">
                <label class="mb-2">Polo</label>
                <p>{{$class->polo->name}}</p>
            </div>
            <div class="flex flex-col">
                <label class="mb-2">Criado em</label>
                <p>{{$class->created_at}}</p>
            </div>
        </div>
    </form>
</section>
@endsection