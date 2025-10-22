<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UpdateServiceDaysForExistingProducts extends Migration
{
    public function up()
    {
        // Get all products
        $products = DB::table('products')->get();
        
        foreach ($products as $product) {
            // Get all completed bookings for this product
            $completeOrders = DB::table('booking')
                ->where('product_id', $product->id)
                ->where('booking_status', 'complete')
                ->get(['check_in', 'check_out']);
                
            $runningOrders = DB::table('booking')
                ->where('product_id', $product->id)
                ->where('booking_status', 'running')
                ->get(['check_in', 'check_out']);
            
            $totalDays = 0;
            
            // Calculate days from completed orders
            foreach ($completeOrders as $order) {
                $start = Carbon::createFromFormat('Y-m-d', $order->check_in);
                $end = Carbon::createFromFormat('Y-m-d', $order->check_out);
                $totalDays += $start->diffInDays($end);
            }
            
            // Calculate days from running orders
            foreach ($runningOrders as $order) {
                $start = Carbon::createFromFormat('Y-m-d', $order->check_in);
                $end = Carbon::createFromFormat('Y-m-d', $order->check_out);
                $totalDays += $start->diffInDays($end);
            }
            
            // Update the product with the calculated service days
            DB::table('products')
                ->where('id', $product->id)
                ->update(['service_days_count' => $totalDays]);
        }
    }

    public function down()
    {
        // This is a data migration, no rollback needed
    }
}
