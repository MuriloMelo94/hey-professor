<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, post};

it('should be able to give a like in a question', function () {
    $user = User::factory()->create();

    $question = Question::factory()->create();

    actingAs($user);

    post(route('questions.like', $question))
        ->assertRedirect();

    assertDatabaseHas('votes', [
        'user_id'     => $user->id,
        'question_id' => $question->id,
        'like'        => 1,
        'unlike'      => 0,
    ]);
});

it('should not be able to like more than 1 time', function () {
    $user = User::factory()->create();

    $question = Question::factory()->create();

    actingAs($user);

    post(route('questions.like', $question));
    post(route('questions.like', $question));
    post(route('questions.like', $question));

    expect($user->votes()->where('question_id', '=', $question->id)->get())
        ->toHaveCount(1);

});

it('should be able to give an unlike in a question', function () {
    $user = User::factory()->create();

    $question = Question::factory()->create();

    actingAs($user);

    post(route('questions.unlike', $question))
        ->assertRedirect();

    assertDatabaseHas('votes', [
        'user_id'     => $user->id,
        'question_id' => $question->id,
        'like'        => 0,
        'unlike'      => 1,
    ]);
});

it('should not be able to unlike more than 1 time', function () {
    $user = User::factory()->create();

    $question = Question::factory()->create();

    actingAs($user);

    post(route('questions.unlike', $question));
    post(route('questions.unlike', $question));
    post(route('questions.unlike', $question));

    expect($user->votes()->where('question_id', '=', $question->id)->get())
        ->toHaveCount(1);

});
