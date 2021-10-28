@extends('layouts.app')

@section('content')
<section class="container mx-auto p-6 bg-white">
  <form method="POST" action="{{route('classes.update', $class->id)}}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Nome</label>
                <input type="text" name="name" value="{{old('name', $class->name)}}"/>
            </div>
            <div class="flex flex-col">
                <label class="mb-2">Professor</label>
                </select>
                <select class="p-2" name="teacher_id" value="{{old('teacher_id', $class->teacher->id)}}">
                    @foreach ($teachers as $teacher)
                        <option 
                         value={{$teacher->id}}
                         @if ($teacher->id == $class->teacher->id)
                            selected
                         @endif
                         >
                         {{$teacher->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Alunos</label>
                <select name="students[]" multiple>
                    @foreach ($students as $student)
                        <option 
                            @foreach ($class->students as $classStudents)
                                @if ($student->id == $classStudents->id)
                                    selected
                                @endif
                            @endforeach
                         value="{{$student->id}}"
                         >
                         {{$student->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <button type="submit" class="bg-green-700 p-2 text-white w-full mb-2 max-w-lg">Atualizar</button>
        </div>
    </form>
</section>
@endsection