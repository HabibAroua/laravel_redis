<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;
use Illuminate\Support\Facades\Redis;

class FillRedis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fillCustomer:redis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill redis DB from mysql DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $customers = Customer::select('id', 'national_id')->get();
        
        //if((isset($customers)) AND (!empty($customers))
        {
            foreach($customers as $customer)
            {
                Redis::set('national_'.$customer->national_id, $customer->id);
            }
        }
    }
}
