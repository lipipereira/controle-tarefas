<x-mail::message>
# Introdução

Corpo do e-mail

<x-mail::button :url="'/'">
    Botão
</x-mail::button>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
