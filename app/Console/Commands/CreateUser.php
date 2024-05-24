<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user= User::create([
            'name'=>'Adam',
            'email'=>'Adam@test.com',
            'phone'=>'96171246231',
            'password'=>bcrypt('adam2010'),
            'isAdmin'=>true,
        ]);
        dd($user);
    }
}
