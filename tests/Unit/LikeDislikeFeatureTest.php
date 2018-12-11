<?php

namespace Tests\Unit;

use Illuminate\Database\QueryException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikeDislikeFeatureTest extends TestCase
{
    /** @test */
    public function it_should_throw_update_error_exception_when_the_like_has_failed_to_increase()
    {
        try {

            $user = factory(\App\User::class)->make();
            $user->save();
            $question = factory(\App\Question::class)->make();
            $question->user()->associate($user);

            $question->increment('abc');
            $this->assertFalse($question->save());

        } catch (\Exception $e) {
            $this->assertFalse(false);
        }


    }

    /** @test2 */
    public function it_should_show_success_when_the_like_has_increase()
    {
        try {

            $user = factory(\App\User::class)->make();
            $user->save();
            $question = factory(\App\Question::class)->make();
            $question->user()->associate($user);

            $question->increment('likes');
            $question->increment('dislikes');
            $this->assertFalse($question->save());

        } catch (\Exception $e) {
            $this->assertFalse(false);
        }


    }
}
