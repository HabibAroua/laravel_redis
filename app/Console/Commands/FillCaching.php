<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;
use Illuminate\Support\Facades\Cache;

class FillCaching extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fillCustomer:caching';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill caching DB from mysql DB';

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
                Cache::put('national_id_'.$customer->national_id, $customer->id);
            }
        }
        $x = Cache::get('national_id_158899');
        info("the result of the cache is ".$x);
    }
}
