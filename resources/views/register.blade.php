<x-layout pageTitle="Projeto Pedro - Criar Tarefa">

    <x-slot name="btn">
        <a href="{{route('login')}}" class="btn btn-primary">
            Voltar
        </a>
    </x-slot>

    <section id="task_section">
        <h1>Registrar-se</h1>
        <form method="POST" action="{{route('user.register_action')}}">
            @csrf
            <x-form.text_input name="name" label="Nome" placeholder="Seu nome" required="required"/>

            <x-form.text_input type="email" name="email" label="Email" placeholder="Seu email" required="required"/>

            <x-form.text_input type="password" name="password" label="Senha" placeholder="Sua senha" required="required"/>

            <x-form.text_input type="password" name="password_confirmation" label="Confirme a senha" placeholder="Confirme a sua senha" required="required"/>

            <x-form.form_button resetTxt="Limpar" submitTxt="Registrar-se"/>
        </form>
    </section>
</x-layout>