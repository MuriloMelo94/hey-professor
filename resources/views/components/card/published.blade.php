@props([
    'question'
])

<div class="dark:text-gray-400 rounded dark:bg-gray-800 shadow shadow-blue-500/50 p-3 flex justify-between ">

    <p>{{ $question->question }}</p>

    <x-form.generic :action="route('questions.unpublish', $question)" method="PUT">
        <button type="submit">
            Despublicar
        </button>
    </x-form.generic>

</div>
