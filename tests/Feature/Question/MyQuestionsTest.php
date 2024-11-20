<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to list all questions created by me', function () {
    $rightUser      = User::factory()->create();
    $rightQuestions = Question::factory()->for($rightUser)->count(10)->create();

    $wrongUser      = User::factory()->create();
    $wrongQuestions = Question::factory()->for($wrongUser)->count(10)->create();

    actingAs($rightUser);

    $response = get(route('questions.index'));

    $response->assertStatus(200);

    foreach ($rightQuestions as $rightQuestion) {
        $response->assertSee($rightQuestion->question);
    }

    foreach ($wrongQuestions as $wrongQuestion) {
        $response->assertDontSee($wrongQuestion->question);
    }
});
