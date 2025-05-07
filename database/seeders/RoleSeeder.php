<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'VAD',
            'Vertriebssteuerung',
            'KAM',
            'KAM-ass',
            'IT',
            'Marketing',
            'Einkauf',
            'Montagesteuerung',
            'TBL',
            'Entwicklung',
            'Werksführer',
            'Allrounder',
            'Pino',
            'Raumplus',
            'n_Objekt',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}
