<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicine;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        Medicine::create([
            'med_name'      => 'Paracetamol',
            'med_use'       => 'Pain relief, fever reduction',
            'side_eff'      => 'Nausea, rash (rare)',
            'med_warning'   => 'Avoid overdose; liver risk',
            'preg_warning'  => 'Generally considered safe; consult physician',
            'alter_med'     => 'Acetaminophen',
            'pres_required' => false,
        ]);
    }
}
