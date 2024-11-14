<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should create a question with more than 255 characters', function () {

    //Arrange
    $user = User::factory()->create();

    //Act
    actingAs($user);
    $request = post(route('questions.store'), [
        'question' => str_repeat('a', 256) . '?',
        'user_id'  => $user->id,
    ]);

    //Assert
    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('a', 256) . '?']);
});

it('could not create a question with less than 10 characters', function () {
    //Arrange
    $user = User::factory()->create();

    //Act
    actingAs($user);

    $request = post(route('questions.store'), [
        'question' => str_repeat('a', 8) . '?',
        'user_id'  => $user->id,
    ]);

    //Assert
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseCount('questions', 0);
});

it('should not create questions without a question mark at the end', function () {
    //Arrange
    $user = User::factory()->create();

    //Act
    actingAs($user);

    $request = post(route('questions.store'), [
        'question' => str_repeat('a', 256),
        'user_id'  => $user->id,
    ]);

    //Assert
    $request->assertSessionHasErrors(['question' => 'Are you sure this is a question? No question mark ? detected.']);
    assertDatabaseCount('questions', 0);
});
test('only authenticated users can create a question', function () {
    post(route('questions.store'), [
        'question' => str_repeat('a', 256) . '?',
    ])->assertRedirect(route('login'));
});
