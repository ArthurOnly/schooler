@extends('layouts.app')

@section('title', 'Pagamentos')

@section('content')
<section class="container mx-auto p-6 bg-white">
  <form method="POST" action="{{route('payments.store')}}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Value</label>
                <input required type="text" name="value" value="{{old('value')}}"/>
            </div>
            <div class="flex flex-col">
                <label class="mb-2" for="students">Aluno</label>
                <select required id="students" class="p-2" name="user_id" value="{{old('user_id')}}">
                    @foreach ($students as $student)
                        <option 
                         value={{$student->id}}
                        >
                         {{$student->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Mês de referência</label>
                <input required type="month" name='reference'/>
            </div>
            <div class="flex flex-col">
                <label class="mb-2">Pago</label>
                <input type="checkbox" name='paid'/>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div class="flex flex-col">
                <label class="mb-2">Boleto</label>
                <input required type="file" name='boleto'/>
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
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection