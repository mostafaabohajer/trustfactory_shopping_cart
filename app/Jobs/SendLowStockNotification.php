<?php

namespace App\Jobs;

use App\Mail\LowStockNotification;
use App\Models\Product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendLowStockNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();

        if (! $admin) {
            Log::warning('Low stock notification skipped because the admin user was not found.');

            return;
        }

        $threshold = (int) config('inventory.low_stock_threshold', 5);

        $products = Product::query()
            ->where('stock_quantity', '<=', $threshold)
            ->orderBy('stock_quantity')
            ->get(['id', 'name', 'stock_quantity']);

        if ($products->isEmpty()) {
            Log::info('Low stock notification skipped because no products are below the threshold.');

            return;
        }

        Mail::to($admin->email)->send(new LowStockNotification(
            products: $products,
            threshold: $threshold,
        ));
    }
}
