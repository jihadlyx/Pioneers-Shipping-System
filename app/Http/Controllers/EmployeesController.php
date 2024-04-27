<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Traits\AuthorizationTrait;


class EmployeesController extends Controller
{
    use AuthorizationTrait;

    protected $page_id = 2;

    public function __construct()
    {
        $this->middleware(CheckShowPermission::class . ":page_id= $this->page_id");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_page = $this->page_id;
        $isDelete = $this->checkDeleteRole($this->page_id);
        $isCreate = $this->checkCreateRole($this->page_id);
        $isUpdate = $this->checkUpdateRole($this->page_id);

        if($isCreate) {
            $employees = Employee::all();
        }
        else {
            $employees = Employee::where('id_emp', auth()->user()->id_pid)->get();
        }

        $roles = Role::all();
        $maxEmployeeId = Employee::max('id_emp') ? Employee::max('id_emp') + 1 : 1;

        return view('site.People.Employees.employeesView', compact('employees', 'isCreate', 'isUpdate', 'isDelete', 'id_page', 'roles', 'maxEmployeeId'));

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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $validatedData = $request->validate([
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
//            'password' => ['required', 'confirmed'],
//        ]);
//
//        if($validatedData) {
        $file = $request->file('photo');

        if ($file) {

            DB::transaction(function () use ($request) {

                $file = $request->file('photo');
                $fileName = time() . '.' . $file->getClientOriginalName();
                $file->move(public_path('imagesUsers'), $fileName);

                // إنشاء موظف
                Employee::create([
                    'id_emp' => $request->id_emp,
                    'name_emp' => $request->name,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'id_number' => 1,
                    'phone_number2' => $request->phone_number2,
                    'id_role' => 1,
                    'id_branch' => auth()->user()->findUserByType(auth()->user()->id_type_users)->id_branch,
                    'image' => 'imagesUsers/'.$fileName,
                ]);

                // إنشاء مستخدم
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'id_type_users' => 1,
                    'pid' => $request->id_emp,
                ]);
            });
            return redirect()->route("employees.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نحجت العملية",
                        "text" => "تمت عملية الإضافة بنجاح"
                    ]
                ]);

        }
        else {
            return redirect()->route("employees.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "فشلت العملية",
                        "text" => "لم تتم الاضافة بسبب الصورة"
                    ]
                ]);
        }


    //

    //        }
    //        return redirect()->route('employees.index', ['page_id' => $this->page_id])
    //            ->with([
    //                "message" => [
    //                    "type" => "error",
    //                    "title" => "فشلت العملية",
    //                    "text" => "يوجد خطأ في عملية ادخال البيانات يرجى التأكد البيانات"
    //                ]
    //            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $page_id, $id)
    {
        $file = $request->file('photo');

        if ($file) {

            $file = $request->file('photo');
            $fileName = time() . '.' . $file->getClientOriginalName();
            $file->move(public_path('imagesUsers'), $fileName);

            $employee = Employee::where("id_emp", $id)->first();

            if($employee) {
                $employee->update([
                    'id_emp' => $request->id_emp,
                    'name_emp' => $request->name,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'phone_number2' => $request->phone_number2,
                    'image' => 'imagesUsers/'.$fileName,
                ]);

                $user = User::where('id_type_users', 1)
                    ->where('pid', $id)->first();
                $user->update([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'id_type_users' => 1,
                    'pid' => $id,
                ]);

                return redirect()->route("employees.index", ['page_id' => $this->page_id])
                    ->with([
                        "message" => [
                            "type" => "success",
                            "title" => "نحجت العملية",
                            "text" => "تمت عملية التعديل على الموظف"
                        ]
                    ]);

            }
            return redirect()->route('employees.index', ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "فشلت العملية",
                        "text" => "هذا الموظف غير موجود"
                    ]
                ]);
        }
        else {
            return redirect()->route("employees.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "فشلت العملية",
                        "text" => "لم يتم التعديل بسبب الصورة"
                    ]
                ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($page_id, $id)
    {
        $employee = Employee::where("id_emp", $id)->first();

        if($employee) {
            Employee::destroy("id_emp", $id);

            $user = User::where('id_type_users', 1)
                ->where('pid', $id)->first();
            $user->destroy("pid", $id);

            return redirect()->route("employees.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "info",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف الموظف"
                    ]
                ]);
        }
        return redirect()->route('employees.index', ['page_id' => $this->page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذا الموظف غير موجود"
                ]
            ]);
    }
}
