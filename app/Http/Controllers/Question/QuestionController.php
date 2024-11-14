<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Http\{RedirectResponse, Request};
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

        user()->questions()->create($attributes);

        return back();
    }
}
