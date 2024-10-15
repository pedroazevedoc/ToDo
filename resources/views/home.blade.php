<x-layout pageTitle="ToDo - Inicio">

    <x-slot name="btn">
        <a href="{{route('task.create')}}" class="btn btn-primary">
            Criar Tarefa
        </a>

        <a href="{{route('logout')}}" class="btn btn-primary">
            Sair
        </a>
    </x-slot>

    <section class="graph">
        <div class="graph_header">
            <h2>Progresso do Dia</h2>
            <div class="graph_header-line"></div>
            <div class="graph_header-date">

                <a href="{{ route('home', ['date' => $date_prev_button]) }}">
                    <img src="/assets/images/icon-prev.png">
                </a>
                    {{ $date_as_string }}
                <a href="{{ route('home', ['date' => $date_next_button]) }}">
                    <img src="/assets/images/icon-next.png">
                </a>
            
            </div>
        </div>
        <div class="graph_header-subtitle">Tarefas: <b>{{ $task_count - $undone_tasks_count }} / {{$task_count}}</b></div>
        <div class="graph-placeholder"></div>
        <div class="tasks_left_footer">
            <img src="/assets/images/icon-info.png">
            @if($undone_tasks_count === 0)
                Todas as tarefas foram realizadas!
            @elseif($undone_tasks_count === 1)
                Resta {{ $undone_tasks_count }} tarefa para ser realizada!
            @else
                Restam {{ $undone_tasks_count }} tarefas para serem realizadas!
            @endif
        </div>
    </section>
    <section class="list">
        <div class="list_header">
            <select class="list_header-select" onChange="changeTaskStatusFilter(this)">
                <option value="all_task">Todas as tarefas</option>
                <option value="task_pending">Tarefas Pendentes</option>
                <option value="task_done">Tarefas Realizadas</option>
            </select>
        </div>
        <div class="task_list">
            @foreach($tasks as $task)
                <x-task :data=$task/>
            @endforeach
        </div>
    </section>

    <script>
        function changeTaskStatusFilter(element) {
            showAllTasks();

            if(element.value == 'task_pending') {
                document.querySelectorAll('.task_done').forEach(function(element) {
                    element.style.display = 'none';
                });
            } else if(element.value == 'task_done') {
                document.querySelectorAll('.task_pending').forEach(function(element) {
                    element.style.display = 'none';
                });
            }
        }

        function showAllTasks() {
            document.querySelectorAll('.task').forEach(function(element) {
                    element.style.display = 'flex';
                });
        }
    </script>

    <script>
        async function taskUpdate(element) {
            let status = element.checked;
            let taskId = element.dataset.id;
            let url = '{{route('task.update')}}';

            //requisição dos checks das tasks do front-end
            let rawResult = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json',
                    'accept': 'application/json'
                },
                body: JSON.stringify({status, taskId, _token: '{{ csrf_token() }}'})
            });
            result = await rawResult.json();
            // se o resultado for sucesso irá exibir na tela
            if (result.success) {
                alert('Task Atualizada com Sucesso!');
            } else { // se não, irá voltar os dados para o anterior
                element.checked = !status;
            }
        }
    </script>
</x-layout>