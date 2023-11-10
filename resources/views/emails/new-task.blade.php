<x-mail::message>
# {{ $task }}

Data limite de conclusão: {{ $date_limit_completion }}

<x-mail::button :url="$url">
Clique aqui para ver a tarefa
</x-mail::button>

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
