<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;

class DeleteOrdersTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command delete orders table monthly';

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
     * @return mixed
     */
    public function handle()
    {
        $orders = Order::all();
        foreach($orders as $order) {
            $order->whereIn('status', ['cancelado', 'finished'])->forceDelete();
        }
    }
}
