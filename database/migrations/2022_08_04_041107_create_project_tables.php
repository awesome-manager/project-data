<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    private $tables = [
        'projects',
        'statuses',
        'groups',
        'customers',
        'group_customer',
        'project_employee'
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table)) {
                continue;
            }

            if (method_exists($this, $method = Str::camel("up_{$table}"))) {
                $this->{$method}();
            }
        }
    }

    private function upProjects()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 255);
            $table->string('code', 100)->unique();
            $table->uuid('group_customer_id');
            $table->enum('type', ['TM', 'FIX']);
            $table->uuid('status_id');
            $table->date('started_at')->nullable();
            $table->date('ended_at')->nullable();
            $table->bigInteger('budget')->nullable();
            $table->smallInteger('expected_profitability')->default(40);
            $table->smallInteger('average_rate')->default(2000);
            $table->text('comment')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    private function upStatuses()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 255);
            $table->string('code', 100)->unique();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    private function upGroups()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 255);
            $table->string('code', 100)->unique();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    private function upCustomers()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100);
            $table->string('surname', 100);
            $table->date('birthday')->nullable();
            $table->string('phone', 11)->nullable();
            $table->string('email', 100)->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    private function upGroupCustomer()
    {
        Schema::create('group_customer', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('group_id');
            $table->uuid('customer_id');

            $table->unique(['group_id', 'customer_id']);
        });
    }

    private function upProjectEmployee()
    {
        Schema::create('project_employee', function (Blueprint $table) {
            $table->uuid('project_id');
            $table->uuid('employee_id');
            $table->uuid('position_id');

            $table->unique(['project_id', 'employee_id', 'position_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $table) {
            Schema::dropIfExists($table);
        }
    }
};
