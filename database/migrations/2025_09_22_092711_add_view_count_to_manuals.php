<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('manuals', function (Blueprint $table) {
            // nullable om eerst te kunnen backfillen
            $table->unsignedBigInteger('type_id')->nullable()->after('brand_id');
            $table->index('type_id');

            // Als je FK’s wilt afdwingen en je table heet 'types' met pk 'id':
            // $table->foreign('type_id')->references('id')->on('types')->nullOnDelete();
        });
    }

    public function down(): void {
        Schema::table('manuals', function (Blueprint $table) {
            // Als je hierboven een foreign key toevoegt, drop die dan eerst:
            // $table->dropForeign(['type_id']);
            $table->dropIndex(['type_id']);
            $table->dropColumn('type_id');
        });
    }
};

