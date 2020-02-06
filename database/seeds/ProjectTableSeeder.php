<?php

use Illuminate\Database\Seeder;
use App\Project;
class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
          'project1',
          'project2',
          'project3',
          'project4',
          'project5',
        ];
        foreach ($projects as $key => $project) {
          Project::updateOrCreate(['name' => $project]);
        }
    }
}
