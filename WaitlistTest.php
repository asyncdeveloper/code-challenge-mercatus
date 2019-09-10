<?php

namespace Tests\Feature;

use App\Mail\SubscriberJoined;
use App\Models\Subscriber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class WaitlistTest extends TestCase {

    use RefreshDatabase;

    protected function setUp(): void {
        parent::setUp();
        Mail::fake();
    }

    /**
     * @test
     */
    public function user_can_subscribe_via_email() {
        $email = 'me@example.com';

        $this->post(route('waitlist'), [ 'email' => $email ])
            ->assertRedirect(route('subscribed'));

        Mail::assertQueued(SubscriberJoined::class, function(SubscriberJoined $mail) use ($email) {
            return $mail->subscriber->email === $email ;
        });

        $this->assertDatabaseHas('subscribers', [ 'email' => $email ]);
    }

    /**
     * @test
     */
    public function user_can_not_subscribe_via_with_existing_email() {
        $data = [ 'email' => 'me@example.com' ];

        Subscriber::create($data);

         $this->post(route('waitlist'), $data)
            ->assertSessionHasErrors('email');

        Mail::assertNotQueued(SubscriberJoined::class);

        $this->assertCount(1, Subscriber::all());
    }

    /**
     * @test
     */
    public function user_can_not_subscribe_with_an_invalid_email() {
        $wrongEmailAddresses = [ '', '    ' , 'me', '@meme', 'me@@@@mecom' ];

        foreach($wrongEmailAddresses as $wrongEmailAddress) {
             $this->post(route('waitlist'), [ 'email' => $wrongEmailAddress ])
                ->assertSessionHasErrors('email');

            $this->assertDatabaseMissing('subscribers', [ 'email' => $wrongEmailAddress ]);

            Mail::assertNotQueued(SubscriberJoined::class);
        }
    }

}