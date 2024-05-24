<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Address;
class CreateAddress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-address';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $address= Address::create([
            'country'=>'Germany',
            'city'=>'Berlin',
            'street'=>'Tariq bob fleifel',
            'building'=>'ezzedine',
            'floor'=>'4th floor',
            'user_id'=>1,
        ]);
        dd($address);
    }
}
