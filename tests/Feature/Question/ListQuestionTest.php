<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('has to show all published question in dashboard', function () {
    //Arrange
    $user                 = User::factory()->create();
    $questionsUnpublished = Question::factory()->for($user)->create();
    $questionsPublished   = Question::factory()->for($user)->create();

    //Act
    actingAs($user);

    $questionsPublished->update(['draft' => false]);

    $response = get(route('dashboard'));

    //Assert

    $response->assertSee($questionsPublished->question);
    $response->assertDontSee($questionsUnpublished->question);
});
