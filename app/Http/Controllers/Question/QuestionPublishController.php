<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class QuestionPublishController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Question $question): RedirectResponse
    {
        Gate::authorize('publish', $question);

        $question->update(['draft' => false]);

        return back()->with('success', 'Question published successfully');
    }
}
