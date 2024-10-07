<x-layout pageTitle="Projeto Pedro - Login">

    <x-slot name="btn">
        <a href="{{route('register')}}" class="btn btn-primary">
            Registre-se
        </a>
    </x-slot>

    Tela de Login
    <a href="{{route('home')}}" class="btn btn-primary">
        Ir para Home
    </a>
</x-layout>