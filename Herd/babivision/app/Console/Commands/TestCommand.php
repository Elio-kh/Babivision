<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use  App\Models\User;
class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

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
      $newUser = new User();
$newUser->name     = 'Test User';
$newUser->email    = 'elio@test.com';
$newUser->password = bcrypt('password'); // Always hash passwords
$newUser->save();
    }
}
