<x-layout pageTitle="ToDo - Login">

    <x-slot name="btn">
        <a href="{{route('register')}}" class="btn btn-primary">
            Registre-se
        </a>
    </x-slot>

    <section id="task_section">
        <h1>Faça o login</h1>

        @if($errors->any())
            <ul class="alert alert-error">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{route('user.login_action')}}">
            @csrf
            <x-form.text_input type="email" name="email" label="Email" placeholder="Seu email" required="required"/>

            <x-form.text_input type="password" name="password" label="Senha" placeholder="Sua senha" required="required"/>

            <x-form.form_button resetTxt="Limpar" submitTxt="Login"/>
        </form>
    </section>
</x-layout>