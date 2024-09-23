<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $questions = Question::query()
                                ->withSum('votes', 'like')
                                ->withSum('votes', 'unlike')
                                ->get();

        return view('dashboard', [
            'questions' => $questions,
        ]);
    }
}
