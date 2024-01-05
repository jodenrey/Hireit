<?php

use App\Experience;
use App\Leaderboard;
use App\User;
use App\UserSkill;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $major = [
            'Informatics Engineering',
            'Informaton System',
            'Computer Engineering',
            'Information Technology',
            'Information Technology Education'
        ];

        $university = [

        ];

        $expertise = [
            'Frontend Engineer',
            'Backend Engineer',
            'UI/UX Designer',
            'Data Expert'
        ];

        $student_identity_number = [

        ];

        $lecturer_identity_number = [
            '197298959619021001',
            '197209583657021001',
            '197247598397021001',
            '197126791997011001',
            '197209191997021001',
        ];

        $skills = [
            'verrel' => [
                'Leadership', 'User Experiences (UX)', 'User Interface Design',
                // 'Event Planning', 'Graphic Design', 'Event Management', 'Adobe Illustrator', 'Adobe XD', 'Adobe Photoshop', 'Adobe InDesign', 'Figma', 'Organization Skills'
            ],
        ];

        $experiences = [
            'verrel' => [
                'Figma', 'Adobe XD', 'Design Thinking', 'Design', 'Communication', 'Research'
            ],
        ];

        $users = [];

        $users[] = [
            'first_name' => 'Joseph ',
            'last_name' => 'Reyes',
            'email' => 'student@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'tagname' => 'josephreyes',
            'role' => 'Student',
            'expertise' => 'Frontend Engineer',
            'identity_number' => '175150200111042',
            'major' => 'Computer Science',
            'location' => 'Manila, Philippines',
            'biography' => $faker->text(),
            'github' => 'https://github.com/jodenrey',
            'linkedin' => 'https://linkedin.com/in/jodenrey',
            'is_open_hired' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $leaderboards[] = [
            'user_id' => 1,
            'expertise' => 'Frontend Engineer',
            'points' => 7777
        ];

        User::insert($users);

        $users = [];

        $users[] = [
            'first_name' => 'Stephen ',
            'last_name' => 'R. Covey, Ph.D.',
            'email' => 'lecturer@sjdelmonte.sti.edu.ph',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'tagname' => 'covey',
            'role' => 'Lecturer',
            'expertise' => 'UI/UX Designer Specialist',
            'identity_number' => '197408232000121002',
            'major' => 'Computer Science',
            'location' => 'Manila, Philippines',
            'biography' => $faker->text(),
            'is_open_hired' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        for($i = 3; $i < 8; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $fullName = $firstName . ' ' . $lastName;
            $tagname = explode(' ', strtolower($fullName));
            $tagname = implode('', $tagname);

            $users[] = [
                'first_name' => $firstName,
                'last_name' => $lastName . ', Ph.D.',
                'email' => $faker->freeEmail,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'role' => 'Lecturer',
                'tagname' => $tagname,
                'expertise' => $expertise[array_rand($expertise)] . ' Specialist',
                'identity_number' => $lecturer_identity_number[array_rand($lecturer_identity_number)],
                'major' => $major[array_rand($major)],
                'location' => 'Manila, Philippines',
                'biography' => $faker->text(),
                'is_open_hired' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $users[] = [
            'first_name' => 'Joanna',
            'last_name' => ' Uy',
            'email' => 'verrel@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'tagname' => 'joannauy',
            'role' => 'Student',
            'expertise' => 'UI/UX Designer',
            'identity_number' => '175150200111051',
            'major' => 'Computer Science',
            'location' => 'Manila, Philippines',
            'biography' => $faker->text(),
            'is_open_hired' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        for ($j = 0; $j < count($skills['verrel']); $j++) {
            $userSkills[] = [
                'user_id' => 8,
                'name' => $skills['verrel'][$j]
            ];
        }

        $userExperiences[] = [
            'user_id' => 8,
            'project_name' => 'Employee Monitoring Apps',
            'project_role' => 'UI/UX Designer',
            'start_date' => Carbon::createFromFormat('Y-m-d\TH:i:s+', '2019-05-31T17:00:00.000Z'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d\TH:i:s+', '2019-03-31T17:00:00.000Z'),
        ];

        $leaderboards[] = [
            'user_id' => 8,
            'expertise' => 'UI/UX Designer',
            'points' => 9999
        ];

        $users[] = [
            'first_name' => 'Cedrick',
            'last_name' => 'Cabansag',
            'email' => 'cedrick@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'tagname' => 'ajigumiwang',
            'role' => 'Student',
            'expertise' => 'Data Expert',
            'identity_number' => '175150200111091',
            'major' => 'Computer Science',
            'location' => 'Manila, Philippines',
            'biography' => $faker->text(),
            'is_open_hired' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $leaderboards[] = [
            'user_id' => 9,
            'expertise' => 'Data Expert',
            'points' => 8500
        ];

        User::insert($users);
        UserSkill::insert($userSkills);
        Experience::insert($userExperiences);
        Leaderboard::insert($leaderboards);
    }
}
