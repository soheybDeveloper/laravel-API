<?php

namespace Tests\Unit;


//use App\services\OrderService;
use Tests\TestCase;
use App\Models\User;


use Illuminate\Foundation\Testing\RefreshDatabase;
class orderTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();

    }
    /** @test */
    public function check_null_user()
    {

            $user = User::find(99);

        $this->assertNull($user);

    }


     /* A basic unit test example.
     */

//    public function test_example(): void
//    {
//        $this->assertTrue(true);
//    }
}
