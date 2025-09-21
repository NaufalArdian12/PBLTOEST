<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\EducationalStaffModels;
use app\Models\StudyProgramModels;

class ProgramStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudyProgramModels::create([
            'study_program_name' => 'D-IV Teknologi Rekayasa Otomotif',
            'campus_id' => 3,
        ]);

         StudyProgramModels::create([
            'study_program_name' => 'D-III Teknologi Sipil',
            'campus_id' => 3,
        ]);

         StudyProgramModels::create([
            'study_program_name' => 'D-III Akuntansi',
            'campus_id' => 3,
        ]);

                 StudyProgramModels::create([
            'study_program_name' => 'D-III Teknologi Informasi',
            'campus_id' => 3,
        ]);
    }
}
