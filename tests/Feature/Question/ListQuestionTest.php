<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('has to show all question in dashboard', function () {
    //Arrange

    $user = User::factory()->create();

    $questions = Question::factory()->count(5)->create();

    //Act

    actingAs($user);

    $response = get(route('dashboard'));

    //Assert

    /** @var Question $q */

    foreach($questions as $q) {
        $response->assertSee($q->question);
    }
});
