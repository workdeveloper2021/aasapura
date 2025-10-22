<?php

namespace App\Exports;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrdersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return DB::table('booking')
            ->join('products', 'products.id', '=', 'booking.product_id')
            ->join('users as customers', 'customers.id', '=', 'booking.user_id')
            ->join('users as vendors', 'vendors.id', '=', 'booking.seller_id')
            ->select(
                'booking.id',
                'products.title as product_name',
                'customers.name as customer_name',
                'vendors.name as vendor_name',
                'booking.check_in',
                'booking.check_out',
                'booking.payment_verify',
                'booking.booking_status',
                'booking.created_at'
            )
            ->orderBy('booking.id', 'desc')
            ->get()
            ->map(function ($item) {
                // Format dates
                $item->check_in = Carbon::parse($item->check_in)->format('d-m-Y');
                $item->check_out = Carbon::parse($item->check_out)->format('d-m-Y');
                $item->created_at = Carbon::parse($item->created_at)->format('d-m-Y h:i A');
                return $item;
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Product',
            'Customer',
            'Vendor/Provider',
            'Check In',
            'Check Out',
            'Payment Status',
            'Order Status',
            'Order Time'
        ];
    }
}
