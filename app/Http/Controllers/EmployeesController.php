<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Traits\AuthorizationTrait;
use Illuminate\Validation\ValidationException;


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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $id_page = $this->page_id;
        $isDelete = $this->checkDeleteRole($this->page_id);
        $isCreate = $this->checkCreateRole($this->page_id);
        $isUpdate = $this->checkUpdateRole($this->page_id);
        $user = Auth()->user();
        if($isCreate) {
            $employees = Employee::whereNotIn('id_emp', [$user->pid])->get();
        }
        else {
            $employees = Employee::where('id_emp', $user->id_pid)->get();
        }
        if($this->checkCreateRole(1)){
            $branches = Branch::all();
        } else {
            $branches = [$user->findUserByType($user->id_type_users)->branch];
        }

        $roles = Role::all();
        $maxEmployeeId = Employee::withTrashed()->max('id_emp') ? Employee::withTrashed()->max('id_emp') + 1 : 1;

        return view('site.People.Employees.employeesView', compact('employees', 'isCreate', 'isUpdate', 'isDelete', 'id_page', 'roles', 'branches', 'maxEmployeeId'));

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
        try {
            $validatedData = $request->validate([
                'id_emp' => ['required', 'numeric', 'unique:'.Employee::class],
                'name' => ['required', 'string', 'max:255', 'min:3'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required'],
                'address' => ['required', 'string', 'max:30'],
                'id_role' => ['required', 'numeric'],
                'id_branch' => ['required', 'numeric'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12'],
                'phone_number2' => ['nullable', 'numeric'] ,
                'photo' => ['nullable'],
            ]);

            DB::transaction(function () use ($request) {
                if($request->file('photo')) {
                    $file = $request->file('photo');
                    $fileName = time() . '.' . $file->getClientOriginalName();
                    $file->move(public_path('imagesUsers'), $fileName);
                } else {
                    $fileName = 'Avatar.png';
                }

                // إنشاء موظف
                Employee::create([
                    'id_emp' => $request->id_emp,
                    'name_emp' => $request->name,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'id_number' => 1,
                    'phone_number2' => $request->phone_number2,
                    'id_role' => $request->id_role,
                    'id_branch' => $request->id_branch,
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

        } catch (ValidationException $e) {
            return redirect()->route('employees.index', ['page_id' => $this->page_id])
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
        try {
            $validatedData = $request->validate([
                'id_emp' => ['required', 'numeric'],
                'name' => ['required', 'string', 'max:255', 'min:3'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['nullable'],
                'address' => ['required', 'string', 'max:30'],
                'id_role' => ['required', 'numeric'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12'],
                'phone_number2' => ['nullable', 'numeric'] ,
                'photo' => ['nullable'],
            ]);
                if(isset($request->photo)){
                    $file = $request->file('photo');
                    if ($file) {
                        $file = $request->file('photo');
                        $fileName = time() . '.' . $file->getClientOriginalName();
                        $file->move(public_path('imagesUsers'), $fileName);
                    }
                }
                else {
                    $fileName = null;
                }

                    $employee = Employee::where("id_emp", $id)->first();

                    if($employee) {
                        $employee->update([
                            'id_emp' => $request->id_emp,
                            'name_emp' => $request->name,
                            'address' => $request->address,
                            'phone_number' => $request->phone_number,
                            'phone_number2' => $request->phone_number2,
                            'image' => $fileName != null ? 'imagesUsers/' . $fileName : null,
                        ]);
                    }
                    $user = User::where('id_type_users', 1)
                        ->where('pid', $id)->first();
                    $user->update([
                        'email' => $request->email,
                        'pid' => $id,
                    ]);
                    if($request->password != $user->password){
                        $user->password = Hash::make($request->password);
                        $user->save();
                    }

                    return redirect()->route("employees.index", ['page_id' => $this->page_id])
                        ->with([
                            "message" => [
                                "type" => "success",
                                "title" => "نحجت العملية",
                                "text" => "تمت عملية التعديل على الموظف"
                            ]
                        ]);
        } catch (ValidationException $e) {
            return redirect()->route('employees.index', ['page_id' => $this->page_id])
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

            User::destroy($user->id);


            return redirect()->route("employees.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
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
