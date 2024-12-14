<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use App\Notifications\SubscriptionExpiryNotification;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-notification';

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
        $today = Carbon::now();

        // تاريخ انتهاء الاشتراك بعد أسبوع
        $expiryDate = $today->copy()->addWeek();

        // البحث عن المستخدمين الذين سينتهي اشتراكهم في اليوم بعد أسبوع
        $usersToNotify = User::whereDate('subscription_end_data', $expiryDate->toDateString())->get();

        foreach ($usersToNotify as $user) {

            $user->notify(new (SubscriptionExpiryNotification::class));
        }
    }
}
