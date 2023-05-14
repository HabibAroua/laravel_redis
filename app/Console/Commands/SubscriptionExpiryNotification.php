<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;
use Carbon\Carbon;

class SubscriptionExpiryNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:SubscriptionExpiryNotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check whcih subscribed users has been expired';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expired_customers = Customer::where('subscription_end_date','<',now())
                                ->where('subscription_end_date')
                                ->get();
        foreach($expired_customers as $expired_customer)
        {
            $expire_date = Carbon::createFormFormat('Y-m-d H:i:s',$expired_customer->subscription_end_date)
                                ->toDateString();
            //don't send email to each user or notification
        }
        //dispatch();
        //return Command::SUCCESS;
    }
}
