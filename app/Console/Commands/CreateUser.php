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
    protected $signature = 'app:create-user {fullname} {email} {password}';

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
        $name = $this->argument('fullname');
        $email = $this->argument('email');
        $pass = $this->argument('password');

        User::create([
            'full_name' => $name,
            'email' => $email,
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => bcrypt($pass),
            'role' => 'user'
        ]);

        echo "User successfully created.\n";
    }
}
