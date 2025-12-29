<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\Department;
use App\Models\Skill;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@hrm.com',
            'password' => bcrypt('password'),
        ]);

        // Create departments
        $departments = ['IT', 'HR', 'Marketing', 'Sales', 'Finance'];
        foreach ($departments as $dept) {
            Department::create(['name' => $dept]);
        }

        // Create skills
        $skills = ['PHP', 'Laravel', 'JavaScript', 'Vue.js', 'React', 'MySQL', 'Git', 'AWS', 'Docker', 'API'];
        foreach ($skills as $skill) {
            Skill::create(['name' => $skill]);
        }

        // Create employees with skills
        Employee::factory(10)->create()->each(function($employee) {
            $employee->skills()->attach(
                Skill::inRandomOrder()->limit(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
