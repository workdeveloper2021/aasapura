<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('purchasedplans', function (Blueprint $table) {
            $table->date('start_date')->nullable()->after('package_id');
            $table->date('end_date')->nullable()->after('start_date');
            $table->integer('remaining_days')->default(0)->after('end_date');
            $table->decimal('remaining_value', 10, 2)->default(0.00)->after('remaining_days');
            $table->decimal('amount_paid', 10, 2)->default(0.00)->after('remaining_value');
            $table->enum('status', ['active', 'expired', 'renewed', 'upgraded'])->default('active')->after('amount_paid');
            $table->text('notes')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('purchasedplans', function (Blueprint $table) {
            $table->dropColumn([
                'start_date',
                'end_date',
                'remaining_days',
                'remaining_value',
                'amount_paid',
                'status',
                'notes',
            ]);
        });
    }
};
