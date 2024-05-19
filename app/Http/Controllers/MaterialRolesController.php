<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\MaterialRole;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MaterialRolesController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckShowPermission::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        return view('site.settings.Roles.MaterialRoles.materialRolesView');
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($page_id, $id)
    {
        $materialRoles = MaterialRole::where('id_role', $id)
            ->where('id_page', '!=', 8)
            ->get();
        $title = Role::where('id_role', $id)->first()->title;

        return view('site.settings.Roles.MaterialRoles.materialRolesView', compact('materialRoles', 'title', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id)
    {
        return $this->update($request, $id);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
//        return $request;

        $data = $request->input('column');

        foreach ($data as $item) {
            $id = $item['id'];

            $materialRole = MaterialRole::findOrFail($id);

            $materialRole->update([
                'create' => isset($item['create']),
                'update' => isset($item['update']),
                'delete' => isset($item['delete']),
                'show' => isset($item['show']),
            ]);
        }
        $role = MaterialRole::findOrFail($id)->role->title;

        return redirect()->route('roles.index', ['page_id' => 7])
            ->with([
                "message" => [
                    "type" => "success",
                    "title" => "نجحت العملية",
                    "text" => "تم تعديل الأذونات الخاصة بال" . $role
                ]
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
