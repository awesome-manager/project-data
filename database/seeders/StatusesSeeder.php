<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    private array $data = [
        [
            'title' => 'Не начат',
            'code' => 'not_started',
            'is_active' => true
        ],
        [
            'title' => 'Продажа',
            'code' => 'sale',
            'is_active' => true
        ],
        [
            'title' => 'Сбор требований',
            'code' => 'requirements',
            'is_active' => true
        ],
        [
            'title' => 'В работе',
            'code' => 'in_progress',
            'is_active' => true
        ],
        [
            'title' => 'Завершен',
            'code' => 'ended',
            'is_active' => true
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $el) {
            Status::query()->create($el);
        }
    }
}
