@props([
    'question'
])

<div class="dark:text-gray-400 rounded dark:bg-gray-800 shadow shadow-blue-500/50 p-3 flex justify-between ">

    <p>{{ $question->question }}</p>

        <div class="flex flex-col justify-between space-y-2">

            <x-form.vote-form :action="route('questions.like', $question)">
                <button type="submit">
                    <x-icon.thumbs-up class="w-5 h-5 text-gray-300/30 hover:text-green-400 hover:cursor-pointer"/>
                </button>


                <p>{{ $question->votes_sum_like ?? 0 }}</p>

            </x-form.vote-form>

            <x-form.vote-form :action="route('questions.unlike', $question)">
                <button type="submit">
                    <x-icon.thumbs-down class="w-5 h-5 text-gray-300/30 hover:text-red-400 hover:cursor-pointer"/>
                </button>

                <p>{{ $question->votes_sum_unlike ?? 0 }}</p>
            </x-form.vote-form>
        </div>
</div>
