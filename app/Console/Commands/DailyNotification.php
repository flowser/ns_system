<?php

namespace App\Console\Commands;

use stdClass;
use App\Models\Channel\Message;
use Illuminate\Console\Command;
use App\Events\SendMidnightNotification;

class DailyNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to send notifications to admins at midnight';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $notificationsSentToday = Message::whereDate('created_at', today())->count();

        if ($notificationsSentToday > 0) {
            // Send midnight SMS notifications to admins
            $data = new stdClass;
            $data->message = 'You have new notifications!';
            event(new SendMidnightNotification($data));
        }
    }
}
