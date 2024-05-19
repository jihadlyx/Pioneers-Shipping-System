<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\PriceBranch;
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
            "title" => "فرع زليتن",
            'address' => 'وسط المدينة',
            'phone_number' => 911089052,
            'state' => 1,
            'phone_number2' => null,
        ]);
        PriceBranch::create([
            'id' => 1,
            'id_from_branch' => 1,
            'id_to_branch' => 1,
            'price' => 0,
        ]);

        $emp = Employee::create([
            'id_emp' => 1,
            'name_emp' => "جهاد شرع الله",
            'address' => 'السبعة',
            'phone_number' => 911089052,
            'id_number' => 1,
            'phone_number2' => null,
            'id_role' => 1,
            'id_branch' => 1,
            'image' => null
        ]);

        // إنشاء مستخدم
        $user = User::create([
            'email' => "jihad@gmail.com",
            'password' => Hash::make("123456"),
            'id_type_users' => 1,
            'pid' => 1,
            'id_emp' => 1
        ]);
    }
}
