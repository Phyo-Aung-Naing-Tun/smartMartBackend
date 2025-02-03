<?php

namespace App\Console\Commands;

use App\Events\OrderSuccess;
use App\Events\SuccessfullyRegister;
use App\Models\User;
use Illuminate\Console\Command;

class MailTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:mail-test';

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
        $user = User::find(3);
        SuccessfullyRegister::dispatch($user, "Successfully Register");
    }
}
