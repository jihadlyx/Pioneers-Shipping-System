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
            'id_status' => 1,
            'title' => 'قيد الموافقه'
        ]);
        TypeShipStatus::create([
            'id_status' => 2,
            'title' => 'قيد التوصيل'
        ]);
        TypeShipStatus::create([
            'id_status' => 3,
            'title' => 'تم التسليم'
        ]);
        TypeShipStatus::create([
            'id_status' => 4,
            'title' => 'تعذر التوصيل'
        ]);
        Role::create([
            'id_role'=> 0,
            'title'=> "مبرمج",
            'id_emp' => 1
        ]);
        Role::create([
            'id_role'=> 1,
            'title'=> "مدير",
            'id_emp' => 1
        ]);
        Role::create([
            'id_role'=> 2,
            'title'=> "مندوب",
            'id_emp' => 1
        ]);
        Role::create([
            'id_role'=> 3,
            'title'=> "زبون",
            'id_emp' => 1
        ]);
        Page::create([
            "id_page" => 9,
            "title" => 'الرئيسية',
            "path" => "/dashboard"
        ]);
        Page::create([
            "id_page" => 1,
            "title" => 'الفروع',
            "path" => "/branches"
        ]);

        Page::create([
            "id_page" => 2,
            "title" => 'الموظفين',
            "path" => "/employees"
        ]);

        Page::create([
            "id_page" => 3,
            "title" => 'المندوبين',
            "path" => "/delegates"
        ]);
        Page::create([
            "id_page" => 4,
            "title" => 'الزبائن',
            "path" => "/costumers"
        ]);
        Page::create([
            "id_page" => 5,
            "title" => 'الشحنات',
            "path" => "/shipments"
        ]);
        Page::create([
            "id_page" => 6,
            "title" => 'المدن و المناطق',
            "path" => "/subCities"
        ]);
        Page::create([
            "id_page" => 7,
            "title" => 'الصلاحيات',
            "path" => "/roles"
        ]);
        Page::create([
            "id_page" => 8,
            "title" => 'انواع حالات الشحنة',
            "path" => "/status"
        ]);

        Page::create([
            "id_page" => 10,
            "title" => 'سلة المحذوفات',
            "path" => "/trash"
        ]);
        Page::create([
            "id_page" => 11,
            "title" => 'حالات الشحنة',
            "path" => "/statusShipments"
        ]);

        $pages = Page::all();
        $roles = Role::all();
        foreach ($roles as $role) {
            foreach ($pages as $page) {
                $maxMaterialRoleId = MaterialRole::max('id') ? MaterialRole::max('id') + 1 : 1;
                if($role->id_role == 2) {
                    MaterialRole::create([
                        'id' => $maxMaterialRoleId,
                        'id_role' => $role->id_role,
                        'id_page' => $page->id_page,
                        'create' => $page->id_page == 5 || $page->id_page == 9? true : false,
                        'update' => $page->id_page == 5 || $page->id_page == 9? true : false,
                        'delete' => $page->id_page == 5 || $page->id_page == 9? true : false,
                        'show' => $page->id_page == 5 || $page->id_page == 9? true : false,
                    ]);
                } elseif ($role->id_role == 3) {
                    MaterialRole::create([
                        'id' => $maxMaterialRoleId,
                        'id_role' => $role->id_role,
                        'id_page' => $page->id_page,
                        'create' => $page->id_page == 5 || $page->id_page == 9? true : false,
                        'update' => $page->id_page == 5 || $page->id_page == 9 ? true : false,
                        'delete' => $page->id_page == 5 || $page->id_page == 9 ? true : false,
                        'show' => $page->id_page == 5 || $page->id_page == 9 ? true : false,
                    ]);
                } else {
                    MaterialRole::create([
                        'id' => $maxMaterialRoleId,
                        'id_role' => $role->id_role,
                        'id_page' => $page->id_page,
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
