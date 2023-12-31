@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Tarefas
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <a href="{{ route('task.create') }}" class="mr-3">Novo</a>
                                    <a href="{{ route('task.export', ['extension' => 'xlsx']) }}" class="mr-3">XLSX</a>
                                    <a href="{{ route('task.export', ['extension' => 'csv']) }}" class="mr-3">CSV</a>
                                    <a href="{{ route('task.export', ['extension' => 'pdf']) }}" class="mr-3">PDF</a>
                                    <a href="{{ route('task.exportPdf') }}" target="_blank">PDF V2</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tarefa</th>
                                    <th scope="col">Data limite conclusão</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <th scope="row">{{ $task->id }}</th>
                                        <td>{{ $task->task }}</td>
                                        <td>{{ date('d/m/Y', strtotime($task->date_limit_completion)) }}</td>
                                        <td><a href="{{ route('task.edit', [$task->id]) }}">Editar</a></td>
                                        <td>
                                            <form id="form_{{ $task->id }}" method="POST"
                                                action="{{ route('task.destroy', ['task' => $task->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <a href="#"
                                                    onclick="document.getElementById('form_{{ $task->id }}').submit()">Excluir</a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link"
                                        href="{{ $tasks->previousPageUrl() }}">Voltar</a>
                                </li>
                                @for ($i = 1; $i <= $tasks->lastPage(); $i++)
                                    <li class="page-item {{ $tasks->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $tasks->url($i) }}">{{ $i }} </a>
                                    </li>
                                @endfor
                                <li class="page-item"><a class="page-link" href="{{ $tasks->nextPageUrl() }}">Avança</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
