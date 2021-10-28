@extends('layouts.app')

@section('content')
<section class="container mx-auto p-6 bg-white">
  <form method="POST" action="{{route('users.store')}}">
        @csrf
        @method('POST')
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Nome</label>
                <input required type="text" name="name" value="{{old('name')}}"/>
            </div>
            <div class="flex flex-col">
                <label class="mb-2">Email</label>
                <input required type="email" name="email" value="{{old('email')}}"/>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Função</label>
                <select required name="roles[]" multiple>
                    @foreach ($roles as $role)
                        <option 
                         value={{$role}}
                         >
                         {{$role}}
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