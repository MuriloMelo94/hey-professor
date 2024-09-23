<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, put};

it('should create a question with draft as true', function () {
    $user = User::factory()->create();

    $question = Question::factory()
                            ->for($user, 'user')
                            ->create();

    actingAs($user);

    assertDatabaseHas('questions', [
        'id'    => $question->id,
        'draft' => true,
    ]);
});

it('should publish a question with draft as false', function () {
    $user     = User::factory()->create();
    $question = Question::factory()
                            ->for($user, 'user')
                            ->create();

    actingAs($user);

    put(route('questions.publish', $question))
        ->assertRedirect();

    $question->refresh();

    expect($question->draft)->toBeFalse();
});

it('only the owner could publish a question', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();

    $question = Question::factory()
                             ->for($rightUser, 'user')
                             ->create();

    actingAs($wrongUser);

    put(route('questions.publish', $question))
        ->assertForbidden();

    actingAs($rightUser);

    put(route('questions.publish', $question))
        ->assertRedirect();
});
