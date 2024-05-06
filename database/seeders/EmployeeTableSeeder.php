<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create([
            "id_branch" => 1,
            "title" => "zliten",
            'address' => 'x=zlire',
            'phone_number' => 4343343,
            'state' => 1,
            'phone_number2' => 34353543,
        ]);

        $emp = Employee::create([
            'id_emp' => 1,
            'name_emp' => "jihad",
            'address' => 'x=zlire',
            'phone_number' => 4343343,
            'id_number' => 1,
            'phone_number2' => 34353543,
            'id_role' => 1,
            'id_branch' => 1,
            'image' => null
        ]);

        // إنشاء مستخدم
        $user = User::create([
            'email' => "jihad@gmail.com",
            'password' => Hash::make("1234"),
            'id_type_users' => 1,
            'pid' => 1,
        ]);
    }
}
