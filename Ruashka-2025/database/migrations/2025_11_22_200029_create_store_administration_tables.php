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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('manager_name')->nullable(); 
            $table->json('settings')->nullable();   
            $table->timestamps();
        });

        Schema::create('store_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('name'); 
            $table->json('permissions')->nullable();
            $table->timestamps();
        });

        Schema::create('store_personnel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); 
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('hire_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('store_personnel_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_personnel_id')->constrained('store_personnel')->cascadeOnDelete();
            $table->foreignId('store_role_id')->constrained('store_roles')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('store_shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('name'); 
            $table->time('start_time');
            $table->time('end_time');
            $table->json('days_of_week')->nullable(); 
            $table->timestamps();
        });

        Schema::create('store_attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->foreignId('store_personnel_id')->constrained('store_personnel')->cascadeOnDelete();
            $table->date('date');
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->string('status')->default('present'); 
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('store_machines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('serial_number')->nullable();
            $table->string('status')->default('operational'); 
            $table->date('last_maintenance')->nullable();
            $table->date('next_maintenance')->nullable();
            $table->timestamps();
        });

        Schema::create('store_maintenance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->foreignId('store_machine_id')->constrained('store_machines')->cascadeOnDelete();
            $table->date('scheduled_date');
            $table->string('type'); 
            $table->string('description')->nullable();
            $table->string('status')->default('pending'); 
            $table->foreignId('performed_by')->nullable()->constrained('store_personnel')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('store_machine_faults', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->foreignId('store_machine_id')->constrained('store_machines')->cascadeOnDelete();
            $table->dateTime('reported_at');
            $table->foreignId('reported_by')->nullable()->constrained('store_personnel')->nullOnDelete();
            $table->text('description');
            $table->string('priority')->default('medium'); // low, medium, high, critical
            $table->string('status')->default('open'); // open, investigating, resolved
            $table->dateTime('resolved_at')->nullable();
            $table->timestamps();
        });

        Schema::create('store_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('category')->nullable(); // protocol, regulation, manual
            $table->string('file_path');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('store_incidents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->dateTime('occurred_at');
            $table->string('severity')->default('low');
            $table->foreignId('reported_by')->nullable()->constrained('store_personnel')->nullOnDelete();
            $table->string('status')->default('open');
            $table->timestamps();
        });

        Schema::create('store_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->foreignId('requester_id')->constrained('store_personnel')->cascadeOnDelete();
            $table->string('type'); // permission, resupply, other
            $table->text('details');
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->text('admin_response')->nullable();
            $table->timestamps();
        });

        Schema::create('store_access_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // System user
            $table->string('action');
            $table->string('ip_address')->nullable();
            $table->text('details')->nullable();
            $table->timestamps();
        });

        Schema::create('store_notices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('content');
            $table->string('priority')->default('normal');
            $table->dateTime('expires_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('store_personnel')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('store_internal_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sender_id')->constrained('store_personnel')->cascadeOnDelete();
            $table->foreignId('recipient_id')->nullable()->constrained('store_personnel')->cascadeOnDelete(); // Null for broadcast
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_administration_tables');
    }
};
