<x-layout pageTitle="ToDo - Criar Tarefa">

    <x-slot name="btn">
        <a href="{{route('home')}}" class="btn btn-primary">
            Voltar
        </a>
    </x-slot>

    <section id="task_section">
        <h1>Criar Tarefa</h1>
        <form method="POST" action="{{route('task.create_action')}}">
            @csrf
            <x-form.text_input name="title" label="Título" placeholder="Digite o título da tarefa" required="required"/>

            <x-form.text_input type="datetime-local" name="due_date" label="Data de Realização" required="required"/>
        
            <x-form.select_input name="category_id" label="Categoria" required="required">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </x-form.select_input>

            <x-form.textarea_input name="description" label="Descrição" placeholder="Digite uma descrição para sua tarefa" required="required"/>

            <x-form.form_button resetTxt="Resetar" submitTxt="Criar"/>
        </form>
    </section>
</x-layout>