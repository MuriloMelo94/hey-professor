<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Http\{RedirectResponse, Request};

class QuestionController extends Controller
{
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

        return to_route('dashboard');
    }
}
