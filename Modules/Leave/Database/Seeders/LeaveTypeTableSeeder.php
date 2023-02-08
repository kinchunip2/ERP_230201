<?php

namespace Modules\Leave\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Leave\Entities\LeaveType;

class LeaveTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        LeaveType::truncate();

        LeaveType::insert([

            [
                'name' => 'Sick Leave',
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'name' => 'Annual Leave',
                'created_by' => 1,
                'updated_by' => 1
            ],
        ]);
    }
}
