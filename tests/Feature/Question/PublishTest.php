<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, put};

it('should create a question with draft as true', function () {
    $user = User::factory()->create();

    $question = Question::factory()->create();

    actingAs($user);

    assertDatabaseHas('questions', [
        'id'    => $question->id,
        'draft' => true,
    ]);
});

it('should publish a question with draft as false', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    actingAs($user);

    put(route('questions.publish', $question))
        ->assertRedirect();

    $question->refresh();

    expect($question->draft)->toBeFalse();
});
