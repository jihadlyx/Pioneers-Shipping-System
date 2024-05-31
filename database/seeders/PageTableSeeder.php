<?php

namespace Database\Seeders;

use App\Models\MaterialRole;
use App\Models\Page;
use App\Models\Role;
use App\Models\TypeShipStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeShipStatus::create([
            'status_id' => 1,
            'title' => 'قيد الموافقه'
        ]);
        TypeShipStatus::create([
            'status_id' => 2,
            'title' => 'قيد التوصيل'
        ]);
        TypeShipStatus::create([
            'status_id' => 3,
            'title' => 'تم التسليم'
        ]);
        TypeShipStatus::create([
            'status_id' => 4,
            'title' => 'تعذر التوصيل'
        ]);
        Role::create([
            'role_id'=> 0,
            'title'=> "مبرمج",
            'emp_id' => 1
        ]);
        Role::create([
            'role_id'=> 1,
            'title'=> "مدير",
            'emp_id' => 1
        ]);
        Role::create([
            'role_id'=> 2,
            'title'=> "مندوب",
            'emp_id' => 1
        ]);
        Role::create([
            'role_id'=> 3,
            'title'=> "زبون",
            'emp_id' => 1
        ]);
        Page::create([
            "page_id" => 9,
            "title" => 'الرئيسية',
            "path" => "/dashboard"
        ]);
        Page::create([
            "page_id" => 1,
            "title" => 'الفروع',
            "path" => "/branches"
        ]);

        Page::create([
            "page_id" => 2,
            "title" => 'الموظفين',
            "path" => "/employees"
        ]);

        Page::create([
            "page_id" => 3,
            "title" => 'المندوبين',
            "path" => "/delegates"
        ]);
        Page::create([
            "page_id" => 4,
            "title" => 'الزبائن',
            "path" => "/costumers"
        ]);
        Page::create([
            "page_id" => 5,
            "title" => 'الشحنات',
            "path" => "/shipments"
        ]);
        Page::create([
            "page_id" => 6,
            "title" => 'المدن و المناطق',
            "path" => "/subCities"
        ]);
        Page::create([
            "page_id" => 7,
            "title" => 'الصلاحيات',
            "path" => "/roles"
        ]);
        Page::create([
            "page_id" => 8,
            "title" => 'انواع حالات الشحنة',
            "path" => "/status"
        ]);

        Page::create([
            "page_id" => 10,
            "title" => 'سلة المحذوفات',
            "path" => "/trash"
        ]);
        Page::create([
            "page_id" => 11,
            "title" => 'حالات الشحنة',
            "path" => "/statusShipments"
        ]);

        $pages = Page::all();
        $roles = Role::all();
        foreach ($roles as $role) {
            foreach ($pages as $page) {
                $maxMaterialRoleId = MaterialRole::max('id') ? MaterialRole::max('id') + 1 : 1;
                if($role->role_id == 2) {
                    MaterialRole::create([
                        'id' => $maxMaterialRoleId,
                        'role_id' => $role->role_id,
                        'page_id' => $page->page_id,
                        'create' => $page->page_id == 5 || $page->page_id == 9? true : false,
                        'update' => $page->page_id == 5 || $page->page_id == 9? true : false,
                        'delete' => $page->page_id == 5 || $page->page_id == 9? true : false,
                        'show' => $page->page_id == 5 || $page->page_id == 9? true : false,
                    ]);
                } elseif ($role->role_id == 3) {
                    MaterialRole::create([
                        'id' => $maxMaterialRoleId,
                        'role_id' => $role->role_id,
                        'page_id' => $page->page_id,
                        'create' => $page->page_id == 5 || $page->page_id == 9? true : false,
                        'update' => $page->page_id == 5 || $page->page_id == 9 ? true : false,
                        'delete' => $page->page_id == 5 || $page->page_id == 9 ? true : false,
                        'show' => $page->page_id == 5 || $page->page_id == 9 ? true : false,
                    ]);
                } else {
                    MaterialRole::create([
                        'id' => $maxMaterialRoleId,
                        'role_id' => $role->role_id,
                        'page_id' => $page->page_id,
                        'create' => true,
                        'update' => true,
                        'delete' => true,
                        'show' => true,
                    ]);
                }
            }
        }

    }
}
