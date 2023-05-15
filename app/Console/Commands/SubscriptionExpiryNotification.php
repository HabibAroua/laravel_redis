<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;
use Carbon\Carbon;
use App\Jobs\SendSubscriptionExpireMessageJob;

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

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $expired_customers = Customer::where('subscription_end_date','<',now())
                                ->get();
        foreach($expired_customers as $expired_customer)
        {
            info('I am here inside 46 in command class');
            $expire_date = Carbon::createFromFormat('Y-m-d',$expired_customer->subscription_end_date)
                                ->toDateString();
            dispatch(new SendSubscriptionExpireMessageJob($expired_customer, $expire_date))
                ->onQueue('Habib');
            //don't send email to each user or notification
        }
        
        //return Command::SUCCESS;
    }
}
