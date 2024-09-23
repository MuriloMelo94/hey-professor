@props([
    'action'
])

<form action="{{ $action }}" method="post" class="flex space-x-1.5 items-center">
    @csrf
    {{ $slot }}
</form>
