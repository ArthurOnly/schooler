@extends('layouts.guest')

@section('content')
    <div class="mx-auto my-auto bg-white px-4 py-4 w-full max-w-lg">
        <h1 class="text-4xl font-bold mb-8">Schooler</h1>
        <form>
            <div class="flex flex-col">
                <label class="mb-2">Email</label>
                <input type="email"/>
            </div>
            <div class="flex flex-col mt-4">
                <label class="mb-2">Senha</label>
                <input type="password"/>
            </div>
            <div class="mt-4">
                <button class="bg-primary p-2 text-white w-full mb-2">Login</button>
                <a href="#">Esqueci minha senha</a>
            </div>
        </form>
    </div>
@endsection
