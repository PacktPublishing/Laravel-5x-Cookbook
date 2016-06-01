<?php

use App\Plans;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\File;

class SubscribeRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * @test
     */
    public function should_create_level_2_subscription()
    {
        $this->markTestIncomplete("It needs to mock Stripe right now it is hitting Stripe and the fixture
        has an already used token");

        $fixture = json_decode(File::get(base_path('tests/fixtures/postlevel2.json')), true);

        $user = \App\User::with('subscriptions')->where("email", $fixture['stripeEmail'])->first();

        if($user) {
            if($user->subscriptions)
            {
                foreach($user->subscriptions as $sub) {
                    $sub->delete();
                }
            }
        }

        $repo = new \App\Repositories\SubscribeRepository();

        $user = $repo->registerUser($fixture, Plans::$LEVEL2);

        $this->assertNotNull($user->stripe_id);


    }
}
