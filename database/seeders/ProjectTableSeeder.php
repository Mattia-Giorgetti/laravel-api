<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Project;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = config('projects_seeder.projects');
        foreach ($projects as $project) {
            $newProject = new Project();
            $newProject->title = $project['title'];
            $newProject->slug = Str::slug($newProject->title, '-');
            $newProject->proj_description = $project['proj_description'];
            $newProject->code_lang = $project['code_lang'];
            $newProject->github_link = $project['github_link'];
            $newProject->save();
        }
    }
}
