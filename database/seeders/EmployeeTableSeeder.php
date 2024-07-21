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
            "branch_id" => 1,
            "title" => "فرع زليتن",
            'address' => 'وسط المدينة',
            'phone_number' => 911089052,
            'status' => 1,
            'phone_number2' => null,
        ]);
        PriceBranch::create([
            'id' => 1,
            'from_branch' => 1,
            'to_branch' => 1,
            'price' => 0,
        ]);

        $emp = Employee::create([
            'emp_id' => 1,
            'emp_name' => "جهاد شرع الله",
            'address' => 'السبعة',
            'phone_number' => 911089052,
            'number_id' => 1,
            'phone_number2' => null,
            'role_id' => 0,
            'branch_id' => 1,
            'image' => null
        ]);

        // إنشاء مستخدم
        $user = User::create([
            'pid' => 11,
            'email' => "jihad@gmail.com",
            'password' => Hash::make("123456"),
            'id_type_users' => 1,
            'user_id' => 11
        ]);
    }
}
