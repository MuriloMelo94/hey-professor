<div class="py-12">
    <div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('questions.store') }}" method="post">
            @csrf

            <div>
                <label for="question" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Question</label>
                <textarea id="message" name="question" rows="4" class="block p-2.5 mb-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."> {{ old('question') }}</textarea>

                @error('question')
                    <span class="dark:text-red-400 text-red-600">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div>
                <x-btn.primary>
                    Save
                </x-btn.primary>

                <x-btn.secondary>
                    Cancel
                </x-btn.secondary>
            </div>
        </form>
    </div>
</div>
