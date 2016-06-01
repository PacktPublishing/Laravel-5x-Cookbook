<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SwapPlansTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function should_swap_plan()
    {

        $repo = new \App\Repositories\SubscribeRepository();

        $results = $user = $repo->getNewPlanFromCurrent(\App\Plans::$LEVEL1);

        $this->assertEquals(\App\Plans::$LEVEL2, $results);


    }
}
