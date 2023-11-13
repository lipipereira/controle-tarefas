<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        .page-break {
            page-break-after: always;
        }

        .titulo {
            border: 1px;
            background-color: #c2c2c2;
            text-align: center;
            width: 100%;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .tabela {
            width: 100%;
        }

        table th {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="titulo">Lista de tarefas</div>

    <table class="tabela">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tarefa</th>
                <th>Data limite conclusão</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->task }}</td>
                    <td>{{ date('d/m/Y', strtotime($task->date_limit_completion)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="page-break"></div>
    <h1>Page 2</h1>
</body>

</html>
