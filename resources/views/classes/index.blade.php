@extends('layouts.app')

@section('content')
<section>
  <div class="container mx-auto p-6 font-mono">
    <div class="mb-4">
      <a href="{{route('classes.create')}}" class="bg-primary p-2 text-white w-full mb-2 max-w-lg">Criar nova</a>
    </div>
    <div class="w-full mb-8 overflow-hidden rounded-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3">Nome</th>
              <th class="px-4 py-3">Professor</th>
              <th class="px-4 py-3">Estudantes</th>
              <th class="px-4 py-3">Ações</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($classes as $class)
              <tr class="text-gray-700">
                <td class="px-4 py-3 text-ms border">{{$class->name}}</td>
                <td class="px-4 py-3 text-ms border">{{$class->teacher->name}}</td>
                <td class="px-4 py-3 text-ms border">{{sizeOf($class->students)}}</td>
                <td class="px-4 py-3 text-ms border">
                <a href="{{route('classes.show', $class->id)}}">Visualizar</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    {{ $classes->links() }}     
  </div>
</section>
@endsection