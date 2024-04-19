<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ['name' => 'Communication', 'icon' => 'fas fa-comments', 'description' => 'Communication Description', 'level' => 90],
            ['name' => 'Leadership', 'icon' => 'fas fa-user-tie', 'description' => 'Leadership Description', 'level' => 85],
            ['name' => 'Problem Solving', 'icon' => 'fas fa-lightbulb', 'description' => 'Problem Solving Description', 'level' => 80],
            ['name' => 'Time Management', 'icon' => 'fas fa-clock', 'description' => 'Time Management Description', 'level' => 75],
            ['name' => 'Creativity', 'icon' => 'fas fa-palette', 'description' => 'Creativity Description', 'level' => 70],
            ['name' => 'Adaptability', 'icon' => 'fas fa-sync-alt', 'description' => 'Adaptability Description', 'level' => 85],
            ['name' => 'Collaboration', 'icon' => 'fas fa-users', 'description' => 'Collaboration Description', 'level' => 90],
            ['name' => 'Persuasion', 'icon' => 'fas fa-handshake', 'description' => 'Persuasion Description', 'level' => 80],
            ['name' => 'Work Ethic', 'icon' => 'fas fa-briefcase', 'description' => 'Work Ethic Description', 'level' => 85],
            ['name' => 'Interpersonal Skills', 'icon' => 'fas fa-smile', 'description' => 'Interpersonal Skills Description', 'level' => 90],
            ['name' => 'Attention to Detail', 'icon' => 'fas fa-search-plus', 'description' => 'Attention to Detail Description', 'level' => 80],
            ['name' => 'Self Motivation', 'icon' => 'fas fa-rocket', 'description' => 'Self Motivation Description', 'level' => 85],
            ['name' => 'Decision Making', 'icon' => 'fas fa-balance-scale', 'description' => 'Decision Making Description', 'level' => 75],
            ['name' => 'Analytical Thinking', 'icon' => 'fas fa-brain', 'description' => 'Analytical Thinking Description', 'level' => 80],
            ['name' => 'Critical Thinking', 'icon' => 'fas fa-lightbulb', 'description' => 'Critical Thinking Description', 'level' => 85],
            ['name' => 'Flexibility', 'icon' => 'fas fa-yoga', 'description' => 'Flexibility Description', 'level' => 80],
            ['name' => 'Negotiation', 'icon' => 'fas fa-handshake', 'description' => 'Negotiation Description', 'level' => 85],
            ['name' => 'Emotional Intelligence', 'icon' => 'fas fa-brain', 'description' => 'Emotional Intelligence Description', 'level' => 90],
            ['name' => 'Resilience', 'icon' => 'fas fa-heartbeat', 'description' => 'Resilience Description', 'level' => 85],
            ['name' => 'Networking', 'icon' => 'fas fa-network-wired', 'description' => 'Networking Description', 'level' => 90],
            ['name' => 'Programming', 'icon' => 'fas fa-code', 'description' => 'Programming Description', 'level' => 80],
            ['name' => 'Web Development', 'icon' => 'fas fa-globe', 'description' => 'Web Development Description', 'level' => 85],
            ['name' => 'Mobile Development', 'icon' => 'fas fa-mobile-alt', 'description' => 'Mobile Development Description', 'level' => 80],
            ['name' => 'Machine Learning', 'icon' => 'fas fa-robot', 'description' => 'Machine Learning Description', 'level' => 85],
            ['name' => 'Data Science', 'icon' => 'fas fa-chart-line', 'description' => 'Data Science Description', 'level' => 90],
            ['name' => 'Artificial Intelligence', 'icon' => 'fas fa-robot', 'description' => 'Artificial Intelligence Description', 'level' => 85],
            ['name' => 'Cybersecurity', 'icon' => 'fas fa-shield-alt', 'description' => 'Cybersecurity Description', 'level' => 90],
            ['name' => 'Cloud Computing', 'icon' => 'fas fa-cloud', 'description' => 'Cloud Computing Description', 'level' => 85],
            ['name' => 'DevOps', 'icon' => 'fas fa-cogs', 'description' => 'DevOps Description', 'level' => 90],
            ['name' => 'Blockchain', 'icon' => 'fas fa-cube', 'description' => 'Blockchain Description', 'level' => 85],
            ['name' => 'PHP', 'icon' => 'fab fa-php', 'description' => 'PHP Description', 'level' => 80],
            ['name' => 'JavaScript', 'icon' => 'fab fa-js', 'description' => 'JavaScript Description', 'level' => 90],
            ['name' => 'Python', 'icon' => 'fab fa-python', 'description' => 'Python Description', 'level' => 85],
            ['name' => 'Java', 'icon' => 'fab fa-java', 'description' => 'Java Description', 'level' => 75],
            ['name' => 'C++', 'icon' => 'fab fa-cuttlefish', 'description' => 'C++ Description', 'level' => 70],
            ['name' => 'C#', 'icon' => 'fab fa-cuttlefish', 'description' => 'C# Description', 'level' => 70],
            ['name' => 'Ruby', 'icon' => 'fas fa-gem', 'description' => 'Ruby Description', 'level' => 80],
            ['name' => 'Swift', 'icon' => 'fab fa-swift', 'description' => 'Swift Description', 'level' => 85],
            ['name' => 'Kotlin', 'icon' => 'fab fa-kickstarter-k', 'description' => 'Kotlin Description', 'level' => 75],
            ['name' => 'Go', 'icon' => 'fab fa-google', 'description' => 'Go Description', 'level' => 80],
            ['name' => 'Rust', 'icon' => 'fas fa-rust', 'description' => 'Rust Description', 'level' => 90],
            ['name' => 'TypeScript', 'icon' => 'fab fa-js', 'description' => 'TypeScript Description', 'level' => 85],
            ['name' => 'HTML', 'icon' => 'fab fa-html5', 'description' => 'HTML Description', 'level' => 90],
            ['name' => 'CSS', 'icon' => 'fab fa-css3-alt', 'description' => 'CSS Description', 'level' => 90],
            ['name' => 'SQL', 'icon' => 'fas fa-database', 'description' => 'SQL Description', 'level' => 85],
            ['name' => 'Bash/Shell', 'icon' => 'fas fa-terminal', 'description' => 'Bash/Shell Description', 'level' => 80],
            ['name' => 'R', 'icon' => 'fas fa-registered', 'description' => 'R Description', 'level' => 70],
            ['name' => 'Scala', 'icon' => 'fas fa-scale', 'description' => 'Scala Description', 'level' => 75],
            ['name' => 'Perl', 'icon' => 'fas fa-code', 'description' => 'Perl Description', 'level' => 70],
            ['name' => 'Objective-C', 'icon' => 'fab fa-app-store-ios', 'description' => 'Objective-C Description', 'level' => 70],
        ];

        foreach ($skills as $skill) {
            //Skill::create($skill);
        }
    }
}
