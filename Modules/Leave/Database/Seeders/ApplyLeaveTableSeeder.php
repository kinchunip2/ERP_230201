<?php

namespace Modules\Leave\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Leave\Entities\ApplyLeave;

class ApplyLeaveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        ApplyLeave::truncate();

        $data = [
            'user_id' =>3,
            'leave_type_id' =>1,
            'reason' =>'Sick',
            'apply_date' =>Carbon::now()->subDays(1),
            'start_date' =>Carbon::now(),
            'day' =>1,
        ];

        ApplyLeave::insert($data);
    }
}
