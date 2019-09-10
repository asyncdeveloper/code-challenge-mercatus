<?php

namespace Tests\Unit;

use App\Models\Subscriber;
use Illuminate\Database\QueryException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class SubscriberTest
 * @package Tests\Unit
 */
class SubscriberTest extends TestCase {

    use RefreshDatabase;

    /**
     * @test
     */
    public function subscriber_email_must_be_unique() {
        $this->expectException(QueryException::class);

        $data = [ 'email' => 'new@example.com' ];

        Subscriber::create($data);
        Subscriber::create($data);
    }

}