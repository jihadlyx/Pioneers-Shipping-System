<?php

namespace Database\Seeders;

use App\Models\MaterialRole;
use App\Models\Page;
use App\Models\Role;
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
        Role::create([
            'id_role'=> 1,
            'title'=> "مدير",
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
            "id_page" => 9,
            "title" => 'انواع حالات الشحنة',
            "path" => "/dashboard"
        ]);

        $pages = Page::all();
        foreach ($pages as $page) {
            $maxMaterialRoleId = MaterialRole::max('id') ? MaterialRole::max('id') + 1 : 1;

            MaterialRole::create([
                'id' => $maxMaterialRoleId,
                'id_role' => 1,
                'id_page' => $page->id_page,
                'create' => false,
                'update' => false,
                'delete' => false,
                'show' => true,
            ]);
        }
    }
}
