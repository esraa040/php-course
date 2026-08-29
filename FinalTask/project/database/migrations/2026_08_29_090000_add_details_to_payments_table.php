<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId("order_id")->after("id")->constrained()->onDelete("cascade")->cascadeOnUpdate();
            $table->decimal("amount", 10, 2)->after("order_id")->default(0);
            $table->enum("method", ["cash", "card", "wallet"])->after("amount")->default("cash");
            $table->enum("status", ["pending", "paid", "refunded"])->after("method")->default("pending");
            $table->timestamp("paid_at")->nullable()->after("status");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropColumn(["order_id", "amount", "method", "status", "paid_at"]);
        });
    }
};
