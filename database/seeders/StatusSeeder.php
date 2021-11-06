<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //pending
        $status = new Status();
        $status->name = 'Pending';
        $status->setTranslation('name', 'ar', 'قيد الانتظار')
        ->save();

        //active
        $status = new Status();
        $status->name = 'Active';
        $status->setTranslation('name', 'ar', 'مفعل')
        ->save();

        //inactive
        $status = new Status();
        $status->name = 'Inactive';
        $status->setTranslation('name', 'ar', 'متوقف')
        ->save();
    }
}
