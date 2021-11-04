@extends('layouts.app')

@section('title', 'Classes')

@section('content')
<section>
  <div class="container mx-auto p-6 font-mono">
    @hasanyrole('director|coordinator|secretary')
    <div class="mb-4">
      <a href="{{route('classes.create')}}" class="bg-green-700 p-2 text-white w-full mb-2 max-w-lg">Criar nova</a>
    </div>
    @endhasanyrole
    <div class="w-full mb-8 overflow-hidden rounded-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3">Nome</th>
              <th class="px-4 py-3">Polo</th>
              <th class="px-4 py-3">Professor</th>
              <th class="px-4 py-3">Estudantes</th>
              <th class="px-4 py-3">Ações</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($classes as $class)
              <tr class="text-gray-700">
                <td class="px-4 py-3 text-ms border">{{$class->name}}</td>
                <td class="px-4 py-3 text-ms border">{{$class->polo->name}}</td>
                <td class="px-4 py-3 text-ms border">{{$class->teacher->name}}</td>
                <td class="px-4 py-3 text-ms border">{{sizeOf($class->students)}}</td>
                <td class="px-4 py-3 text-ms border">
                <a href="{{route('classes.show', $class->id)}}">Visualizar</a>
                @hasanyrole('director|coordinator|secretary|teacher')
                <p class="inline"> | </p>
                <a href="{{route('classes.aulas', $class->id)}}">Gerenciar</a>
                @endhasanyrole
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    {{ method_exists($classes,'links') ?  $classes->links() : ''}}     
  </div>
</section>
@endsection