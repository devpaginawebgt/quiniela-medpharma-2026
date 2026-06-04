<?php

namespace App\Providers;

use App\Events\JourneyCompleted;
use App\Events\MatchCreated;
use App\Events\ResultCreated;
use App\Listeners\SendWelcomeEmail;
use App\Listeners\UpdateCurrentJourney;
use App\Listeners\UpdateGroupPoints;
use App\Listeners\UpdatePredictionPoints;
use App\Listeners\VerifyJourneyStatus;
use App\Listeners\VerifyJourneyStatusOnMatch;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            // SendEmailVerificationNotification::class,
            SendWelcomeEmail::class,
        ],
        MatchCreated::class => [
            VerifyJourneyStatusOnMatch::class,
        ],
        ResultCreated::class => [
            UpdatePredictionPoints::class,
            UpdateGroupPoints::class,
            VerifyJourneyStatus::class,
        ],
        JourneyCompleted::class => [
            UpdateCurrentJourney::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
