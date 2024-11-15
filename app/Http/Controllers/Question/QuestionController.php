<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class QuestionController extends Controller
{
    public function index(): View
    {
        return view('question.index', [
            'questions' => user()->questions,
        ]);
    }
    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'question' => [
                'required',
                'string',
                'min:10',
                new EndWithQuestionMarkRule(),
            ],
        ]);

        $attributes['draft'] = true;

        user()->questions()->create($attributes);

        return back();
    }

    public function destroy(Question $question): RedirectResponse
    {
        Gate::authorize('destroy', $question);

        $question->delete();

        return back();
    }
}
