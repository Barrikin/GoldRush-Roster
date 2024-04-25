<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class Setpassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setpassword';

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
        $users = User::all();

        foreach ($users as $user) {
            if ($user->id == 25 && $user->id == 40) { return; }

            $user->password = $user->phone_number;
            $user->change_password = true;
            $user->save();
            print $user->name . " password is " . $user->phone_number.PHP_EOL;
        }
    }
}
