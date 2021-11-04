@extends('layouts.app')

@section('title', 'Pagamentos')

@section('content')
    <section class="container mx-auto p-6 bg-white">
        @can('edit payments')
            <div class="flex justify-between">
                <span></span>
                <div class="flex gap-4">
                    <a href="{{ route('payments.edit', $payment->id) }}" class="flex"><i data-feather="edit"></i><span
                            class="ml-2">Editar</span> </a>
                    <form method="POST" action={{ route('payments.delete', $payment->id) }}
                        onsubmit="return confirm('Você tem certeza que quer deletar o boleto?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex text-red-700"><i data-feather="user-minus"></i><span
                                class="ml-2">Deletar</span> </a>
                    </form>
                </div>
            </div>
        @endcan
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
                <div class="flex flex-col">
                    <label class="mb-2">Value</label>
                    <input required disabled type="text" name="value" value="{{ old('value', $payment->value) }}" />
                </div>
                <div class="flex flex-col">
                    <label class="mb-2" for="students">Aluno</label>
                    <input required disabled type="text" name="value" value="{{ old('value', $payment->user->name) }}" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
                <div class="flex flex-col">
                    <label class="mb-2">Mês de referência</label>
                    <input required disabled type="month" name='reference'
                        value="{{ old('reference', $payment->reference) }}" />
                </div>
                <div class="flex flex-col">
                    <label class="mb-2">Pago</label>
                    @if ($payment->paid)
                        <span class="p-2 rounded bg-green-700 w-max text-white">Pago</span>
                    @else
                        <span class="p-2 rounded bg-red-700 w-max text-white">Não pago</span>
                    @endif
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
                <div class="flex flex-col">
                    <label class="mb-2">Boleto</label>
                    <a type="download" href="{{ asset('storage/' . $payment->file) }}" target="_blank">Download do boleto</a>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('plugin-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"
        integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#students').select2();
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
