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
        $menus = Order::where('order_date',$now->format('Y-m-d'))->groupBy('menu_id')->get();
        $data = new Collection;
        $i = 1;
        $text = "Notification Catering Today \n".$now->format('d, M Y')."\n \n";
        foreach ($menus as $order) {
            $menu = Menu::findOrFail($order->menu_id);
            $data->push((object)[
                'Menu' => $menu->name,
                'total_order' => $orders->where('menu_id',$menu->id)->count()
            ]);
            $text .= $i.". ".$menu->name." => ".$orders->where('menu_id',$menu->id)->count()."\n";
            $i++;
        }
        $text .= "\n ============================\n \n Total order = ".$orders->count(). " \n Total fee = ".number_format($orders->sum('fee'));
        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID',''),
            'parse_mode' => 'HTML',
            'text' => $text
        ]);
        $this->info('Notification send successfully.');
    }
}
