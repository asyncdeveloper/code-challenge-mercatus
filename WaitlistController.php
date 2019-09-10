<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Mail\SubscriberJoined;
use App\Http\Requests\WaitlistRequest;

use Illuminate\Support\Facades\Mail;

class WaitlistController extends Controller
{
    public function index()
    {
        return view('waitlist');
    }

    public function subscribe(WaitlistRequest $request)
    {
        $subscriber = Subscriber::create([
            'email' => $request->email,
        ]);

        Mail::to(config('mail.from.address'))->send(
            new SubscriberJoined($subscriber)
        );

        return redirect()->route('subscribed');
    }

    public function subscribed()
    {
        return view('subscribed');
    }
}
