<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\MaterialRole;
use App\Models\Page;
use App\Models\Role;
use App\Traits\AuthorizationTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    use AuthorizationTrait;

    protected $page_id = 7;

    public function __construct()
    {
        $this->middleware(CheckShowPermission::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $maxRoleId = Role::max('id_role')? Role::max('id_role') + 1 : 1;
        $roles = Role::all();
        $isDelete = $this->checkDeleteRole($this->page_id);
        $isCreate = $this->checkCreateRole($this->page_id);
        $isUpdate = $this->checkUpdateRole($this->page_id);

        return view('site.Settings.Roles.rolesView', compact('roles', 'maxRoleId', 'isDelete', 'isUpdate', 'isCreate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $role = Role::create([
                'id_role'=> $request->id_role,
                'title'=> $request->title,
            ]);

            if($role) {

                $pages = Page::all();
                foreach ($pages as $page) {
                    $maxMaterialRoleId = MaterialRole::max('id') ? MaterialRole::max('id') + 1 : 1;

                    MaterialRole::create([
                        'id' => $maxMaterialRoleId,
                        'id_role' => $request->id_role,
                        'id_page' => $page->id_page,
                        'create' => false,
                        'update' => false,
                        'delete' => false,
                        'show' => false,
                    ]);
                }
            }

        });
        return redirect()->route('roles.index', ['page_id' => 7])
            ->with([
                "message" => [
                    "type" => "success",
                    "title" => "نجحت العملية",
                    "text" => "تم إضافة صلاحية ال" . $request->title
                ]
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id, $id_role)
    {
        $role = Role::findOrFail($id_role);
        if($role) {
            $role->update([
                "id_role" => $request->id_role,
                "title" => $request->title,
            ]);
            return redirect()->route('roles.index', ['page_id' => 7])
                ->with([
                    "message" => [
                        "type" => "info",
                        "title" => "نجحت العملية",
                        "text" => "تم تعديل صلاحية ال" . $request->title
                    ]
                ]);
        }

        return redirect()->route('roles.index', ['page_id' => 7])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "لم يتم العثور على الصلاحية المطلوبة"
                ]
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, $id_role)
    {
        $role = Role::findOrFail($id_role);
        if($role) {
            if($role->employees()->count() <= 0) {
                $role->delete();
                return redirect()->route('roles.index', ['page_id' => 7])
                    ->with([
                        "message" => [
                            "type" => "info",
                            "title" => "نجحت العملية",
                            "text" => "تمت عملية حذف الصلاحية"
                        ]
                    ]);
            } else {
                return redirect()->route('roles.index', ['page_id' => 7])
                    ->with([
                        "message" => [
                            "type" => "error",
                            "title" => "فشلت العملية",
                            "text" => "هذه الصلاحية مستخدمة من قبل موظف"
                        ]
                    ]);
            }

        }

        return redirect()->route('roles.index', ['page_id' => 7])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "لم يتم العثور على الصلاحية"
                ]
            ]);

    }



}
