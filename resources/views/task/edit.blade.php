@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Atualiza tarefa</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('task.update', ['task' => $task->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label lass="form-label">Tarefa</label>
                                <input type="text" class="form-control" name="task" value="{{ $task->task }}">
                                {{ $errors->has('task') ? $errors->first('task') : '' }}
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Data limite conclusão</label>
                                <input type="date" class="form-control" name="date_limit_completion"
                                    value="{{ $task->date_limit_completion }}">
                                {{ $errors->has('date_limit_completion') ? $errors->first('date_limit_completion') : '' }}
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
