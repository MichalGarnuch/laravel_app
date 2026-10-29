<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void { Schema::table('properties',fn(Blueprint $table)=>$table->foreignId('user_id')->nullable()->constrained()->restrictOnDelete()); }
 public function down(): void { Schema::table('properties',fn(Blueprint $table)=>$table->dropConstrainedForeignId('user_id')); }
};
