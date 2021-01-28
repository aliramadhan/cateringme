<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;
use \App\Models\Menu;
use \App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class CateringNotif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:cateringToday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily notification Catering today..';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();
        $orders = Order::where('order_date',$now->format('Y-m-d'))->get();
        $shifts = $orders->sortBy('shift')->groupBy('shift');
        $servings = $orders->sortBy('menu_id')->groupBy(['menu_id','serving']);
        $text = "Notification Catering Today \n".$now->format('d, M Y l')."\n \n";
        //shift
        foreach ($shifts as $shift) {
            $i = 1;
            $text .= "Shift ".$shift->first()->shift." ========================\n \n";
            foreach ($shift as $data) {
                //cek sambal
                $sambal = "";
                if ($data->is_sauce == 1) {
                    $sambal = " ( tambah sambal )";
                }
                $text .= $i.". ".$data->employee->name." - ".$data->menu->name." porsi ".$data->serving.$sambal."\n";
                $i++;
            }
            $text .= "\n";
        }
        $text .= "================================\n \n";
        //summary
        $i = 1;
        foreach ($servings as $serving) {
            foreach ($serving as $item) {
                $menu = $item->first()->menu;
                $text .= $i. " ".$menu->name. " - porsi ".$item->first()->serving. " => ".$item->count()."\n";
                $i++;
            }
        }
        $text .= "\n ============================\n \n Total order = ".$orders->count(). " Menu\n Total fee = Rp. ".number_format($orders->sum('fee'));
        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID',''),
            'parse_mode' => 'HTML',
            'text' => $text
        ]);
        $this->info('Notification send successfully.');
    }
}
