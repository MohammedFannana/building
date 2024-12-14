<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-status';

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
        $usersToDeactivate = User::where('is_subscribed', 'false')
            ->orWhere(function ($query) {
                $query->where('is_subscribed', 'true')
                    ->where('subscription_end_data', '<', now());
            })
            ->get();


        // قم بتحديث حالة وحالة الاشتراك للمستخدمين المحددين
        foreach ($usersToDeactivate as $user) {
            $user->update([
                'status' => 'غير نشط', // تحديث الحالة إلى "غير نشط"
                'is_subscribed' => 'false' // تحديث حالة الاشتراك إلى "غير مشترك"
            ]);
        };
    }
}
