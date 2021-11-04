@extends('layouts.app')

@section('title', 'Classes')

@section('content')
<section class="container mx-auto p-6 bg-white">
  <form method="POST" action="{{route('classes.store')}}">
        @csrf
        @method('POST')
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Nome</label>
                <input type="text" name="name" value="{{old('name')}}"/>
            </div>
            <div class="flex flex-col">
                <label class="mb-2">Professor</label>
                </select>
                <select class="p-2" name="teacher_id" value="{{old('teacher_id')}}" id='teacher'>
                    @foreach ($teachers as $teacher)
                        <option 
                         value={{$teacher->id}}
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
                <select id='students' name="students[]" multiple class="py-4">
                    @foreach ($students as $student)
                        <option 
                         value="{{$student->id}}""
                         >
                         {{$student->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col">
                <label class="mb-2">Polo</label>
                <select name="polo_id" class="py-2">
                    @foreach ($polos as $polo)
                        <option 
                         value="{{$polo->id}}"
                        >
                         {{$polo->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <button type="submit" class="bg-green-700 p-2 text-white w-full mb-2 max-w-lg">Criar</button>
        </div>
    </form>
</section>
@endsection

@section('plugin-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#students').select2();
        });
        $(document).ready(function() {
            $('#teacher').select2();
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection