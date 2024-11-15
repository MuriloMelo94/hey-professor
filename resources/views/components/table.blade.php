'@props([
    'questions'
])

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    @if(count($questions) > 0)
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Question
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Actions</span>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($questions as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->question }}
                    </th>

                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('questions.publish', $item) }}" method="post">
                            @csrf
                            @method('PUT')

                            <x-btn.primary>
                                Publish
                            </x-btn.primary>
                        </form>

                        <form action="{{ route('questions.destroy', $item) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <x-btn.delete>
                                Delete
                            </x-btn.delete>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
