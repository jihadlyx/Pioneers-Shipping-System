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
use Illuminate\Validation\ValidationException;

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
        $page_id = $this->page_id;
        $maxRoleId = Role::withTrashed()->max('id_role')? Role::withTrashed()->max('id_role') + 1 : 1;
        $user = Auth()->user()->findUserByType(Auth()->user()->id_type_users);
        if($user->id_role == 0)
            $roles = Role::all();
        else
            $roles = Role::where('id_emp', $user->id_emp)
                ->whereNot('id_role', $user->id_role)
                ->get();

        $isDelete = $this->checkDeleteRole($this->page_id);
        $isCreate = $this->checkCreateRole($this->page_id);
        $isUpdate = $this->checkUpdateRole($this->page_id);
        $isShowTrash = $this->checkShowRole(10);

        return view('site.Settings.Roles.rolesView', compact('roles','isShowTrash', 'maxRoleId', 'isDelete', 'isUpdate', 'isCreate', 'page_id'));
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
        try {
            $validatedData = $request->validate([
                'id_role' => ['required', 'numeric', 'unique:'.Role::class],
                'title' => ['required', 'string', 'max:50', 'min:3', 'unique:'.Role::class],
            ]);
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
            return redirect()->route('materialRoles.show', ['page_id' => $this->page_id, 'id_role' => $request->id_role])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم إضافة صلاحية ال" . $request->title
                    ]
                ]);

        } catch (ValidationException $e) {
            return redirect()->route('roles.index', ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "فشلت العملية",
                        "text" => "يوجد خطأ في عملية ادخال البيانات يرجى التأكد البيانات"
                    ]
                ]);
        }
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
                            "type" => "error",
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

    public function getTrash() {
        $id_page = 10;
        $isUpdate = $this->checkUpdateRole(10);
        $roles = Role::onlyTrashed()->get();
        return view('site.Settings.Roles.trashView', compact('roles', 'isUpdate', 'id_page'));
    }

    public function restore($id_page, $id) {
        $city = Role::onlyTrashed()->find($id);
        if ($city) {
            $city->restore();
            return redirect()->route("roles.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم استعادة المنطقة بنجاح"
                    ]
                ]);
        }
        return redirect()->route('roles.getTrash', ['page_id' => 10])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذه المنطقة غير موجود"
                ]
            ]);
    }

    public function delete($page_id, $id)
    {
        $city = Role::onlyTrashed()->find($id);

        if($city) {
            $city->forceDelete();
            return redirect()->route("roles.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف المنطقة"
                    ]
                ]);
        }

        return redirect()->route('roles.index', ['page_id' => $this->page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذه المنطقة غير موجود"
                ]
            ]);
    }

}
