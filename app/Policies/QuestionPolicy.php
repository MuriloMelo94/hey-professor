<?php

namespace App\Policies;

use App\Models\{Question, User};

class QuestionPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function publish(User $user, Question $question): bool
    {
        return $user->is($question->user);
    }

    public function unpublish(User $user, Question $question): bool
    {
        return $user->is($question->user);
    }

    public function destroy(User $user, Question $question): bool
    {
        return $user->is($question->user);
    }
}
