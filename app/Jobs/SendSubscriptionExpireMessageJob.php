<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Customer;

class SendSubscriptionExpireMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $customer;
    private $expireDate;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($customer, $expireDate)
    {
        $this->customer = $customer;
        $this->expireDate = $expireDate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        info('I am now inside job class');
        //send Notifciation email , SMS, Notification with FireBase etc ..
        //Todo Sen Email for each Expired user
        //sendMail('emails.subscription_experation', $this->customer->email, 'Your Subscription has been expired');
    }
}
