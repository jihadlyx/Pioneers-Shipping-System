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
        $isShowTrash = $this->checkShowRole(10);
        $user = Auth()->user();
        if($isCreate) {
            $employees = Employee::whereNotIn('emp_id', [$user->pid()])->whereNotIn('role_id', [0])
                ->whereNotIn('emp_id', [$user->getUserId()])->get();
        }
        else {
            $employees = Employee::where('emp_id', $user->pid())
                ->whereNotIn('emp_id', [$user->getUserId()])->get();
        }
        if($this->checkCreateRole(1)){
            $branches = Branch::all();
        } else {
            $branches = [$user->findUserByType($user->id_type_users)->branch];
        }

//        $roles = Role::where('role_id', [$user->findUserByType($user->id_type_users)->role_id])
//                    ->orwhere('emp_id', [$user->pid()])->get();
        $roles = Role::all();
        $maxEmployeeId = Employee::withTrashed()->max('emp_id') ? Employee::withTrashed()->max('emp_id') + 1 : 1;

        return view('site.People.Employees.employeesView', compact('employees','isShowTrash', 'isCreate', 'isUpdate', 'isDelete', 'id_page', 'roles', 'branches', 'maxEmployeeId'));

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
                'emp_id' => ['required', 'numeric', 'unique:'.Employee::class],
                'name' => ['required', 'string', 'max:255', 'min:3'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required'],
                'address' => ['required', 'string', 'max:30'],
                'role_id' => ['required', 'numeric'],
                'branch_id' => ['required', 'numeric'],
                'number_id' => ['required', 'numeric'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12', 'unique:'.Employee::class],
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
                    'emp_id' => $request->emp_id,
                    'emp_name' => $request->name,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'number_id' => $request->number_id,
                    'phone_number2' => $request->phone_number2,
                    'role_id' => $request->role_id,
                    'branch_id' => $request->branch_id,
                    'image' => 'imagesUsers/'.$fileName,
                ]);

                // إنشاء مستخدم
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'id_type_users' => 1,
                    'pid' =>  1 . $request->emp_id,
                    'user_id' => Auth()->user()->pid,
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
                'emp_id' => ['required', 'numeric'],
                'name' => ['required', 'string', 'max:255', 'min:3'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['nullable'],
                'address' => ['required', 'string', 'max:30'],
                'role_id' => ['required', 'numeric'],
                'number_id' => ['required', 'numeric'],
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

                    $employee = Employee::where("emp_id", $id)->first();

                    if($employee) {
                        $employee->update([
                            'emp_id' => $request->emp_id,
                            'emp_name' => $request->name,
                            'address' => $request->address,
                            'number_id' => $request->number_id,
                            'phone_number' => $request->phone_number,
                            'role_id' => $request->role_id,
                            'phone_number2' => $request->phone_number2,
                            'image' => $fileName != null ? 'imagesUsers/' . $fileName : null,
                        ]);
                    }
                    $user = User::where('id_type_users', 1)
                        ->where('pid', 1 . $id)->first();
                    $user->update([
                        'email' => $request->email,
                        'pid' =>  1 . $request->emp_id,
                    ]);
                    $users = User::where("user_id", 1 . $id)->get();
                    foreach ($users as $n) {
                        $n->update([
                            'user_id' => 1 . $request->emp_id,
                        ]);
                    }
                    if($request->password){
                        if(Hash::make($request->password) != $user->password){
                            $user->password = Hash::make($request->password);
                            $user->save();
                        }
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
        $employee = Employee::where("emp_id", $id)->first();

        if($employee) {
            Employee::destroy("emp_id", $id);

            $user = User::where('id_type_users', 1)
                ->where('pid', 1 . $id)->first();

            User::destroy($user->pid);


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

    public function getTrash() {
        $id_page = 10;
        $isUpdate = $this->checkUpdateRole(10);
        $employees = Employee::onlyTrashed()->get();
        return view('site.People.employees.trashView', compact('employees', 'isUpdate', 'id_page'));
    }

    public function restore(Request $request, $page_id) {
        // تأكيد وجود البيانات المرسلة في الطلب
        if ($request->has('employees')) {
            $employeesData = $request->input('employees');
            // تكرار عبر كل موظف واستعادته فقط إذا كان الحقل "check" موجودًا وقيمته "on"
            foreach ($employeesData as $employeeData) {
                if (isset($employeeData['check']) && $employeeData['check'] === 'on') {
                    $employee = Employee::onlyTrashed()->find($employeeData['id']);
                    if ($employee) {
                        $employee->restore();
                        $user = User::onlyTrashed()
                            ->where('pid', 1 . $employeeData['id'])
                            ->where('id_type_users', 1)
                            ->first();
                        if ($user) {
                            $user->restore();
                        }
                    }
                }
            }

            // إعادة التوجيه مع رسالة نجاح
            return redirect()->route("employees.index", ['page_id' => $page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم استعادة الموظفين بنجاح"
                    ]
                ]);
        }

        // إعادة التوجيه مع رسالة خطأ في حالة عدم وجود الموظفين
        return redirect()->route('employees.getTrash', ['page_id' => $page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "الموظفون غير موجودون"
                ]
            ]);
    }


    public function delete(Request $request, $page_id) {
        // تأكيد وجود البيانات المرسلة في الطلب
        if ($request->has('employees')) {
            $employeesData = $request->input('employees');

            // تكرار عبر كل موظف وحذفه نهائيًا فقط إذا كان الحقل "check" موجودًا وقيمته "on"
            foreach ($employeesData as $employeeData) {
                if (isset($employeeData['check']) && $employeeData['check'] === 'on') {
                    $employee = Employee::onlyTrashed()->find($employeeData['id']);
                    if ($employee) {
                        $employee->forceDelete();
                        $user = User::onlyTrashed()
                            ->where('pid', 1 . $employeeData['id'])
                            ->where('id_type_users', 1)
                            ->first();
                        if ($user) {
                            $user->forceDelete();
                        }
                    }
                }
            }

            // إعادة التوجيه مع رسالة نجاح
            return redirect()->route("employees.index", ['page_id' => $page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف الموظفين نهائيًا بنجاح"
                    ]
                ]);
        }

        // إعادة التوجيه مع رسالة خطأ في حالة عدم وجود الموظفين
        return redirect()->route('employees.getTrash', ['page_id' => $page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "الموظفون غير موجودون"
                ]
            ]);
    }

}
