<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vote') }}
        </h2>
    </x-slot>

    <x-container>
        <hr class="border-gray-700 border-dashed my-4"/>

        <div class="dark:text-gray-400 uppercase font-bold my-5 text-4xl text-center">
            List of Questions
        </div>

        <div class="space-y-4">
            @foreach($questions->where('draft', false) as $item)
                <x-card.question :question="$item" />
            @endforeach
        </div>
    </x-container>

</x-app-layout>
