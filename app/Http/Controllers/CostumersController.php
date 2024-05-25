<?php

namespace App\Http\Controllers;


use App\Http\Middleware\CheckShowPermission;
use App\Models\Branch;
use App\Models\Customers;
use App\Models\Delegate;
use App\Traits\AuthorizationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class CostumersController extends Controller
{
    use AuthorizationTrait;

    protected $page_id = 4;

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
            $customers = Customers::all();
        }
        else {
            $customers = Customers::where('id_customer', $user->id_pid)->get();
        }
        if($this->checkCreateRole(1)){
            $branches = Branch::all();
        } else {
            $branches = [$user->findUserByType($user->id_type_users)->branch];
        }

        $maxCustomerId = Customers::withTrashed()->max('id_customer') ? Customers::withTrashed()->max('id_customer') + 1 : 1;

        return view('site.People.Customers.customersView', compact('customers','isShowTrash','branches', 'isCreate', 'isUpdate', 'isDelete', 'id_page', 'maxCustomerId'));
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
                'id_customer' => ['required', 'numeric', 'unique:'.Customers::class],
                'name' => ['required', 'string', 'max:255', 'min:3'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required'],
                'address' => ['required', 'string', 'max:30'],
                'id_branch' => ['required', 'numeric'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12', 'unique:'.Customers::class],
                'phone_number2' => ['nullable', 'numeric'] ,
                'photo' => ['nullable'],
            ]);

            DB::transaction(function () use ($request) {
                Customers::create([
                    'id_customer' => $request->id_customer,
                    'name_customer' => $request->name,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'id_number' => 1,
                    'phone_number2' => $request->phone_number2,
                    'id_role' => 3,
                    'id_branch' => $request->id_branch,
                ]);

                // إنشاء مستخدم
                User::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'id_type_users' => 3,
                    'pid' => $request->id_customer,
                    'id_emp' => Auth()->user()->pid,
                ]);

            });
            return redirect()->route("customers.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نحجت العملية",
                        "text" => "تمت عملية الإضافة بنجاح"
                    ]
                ]);

        } catch (ValidationException $e) {
            return redirect()->route('customers.index', ['page_id' => $this->page_id])
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
    public function update(Request $request,$page_id, $id)
    {
        try {
            $validatedData = $request->validate([
                'id_customer' => ['required', 'numeric'],
                'name' => ['required', 'string', 'max:255', 'min:3'],
                'email' => ['required', 'string', 'email'],
                'password' => ['nullable'],
                'address' => ['required', 'string', 'max:30'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12'],
                'phone_number2' => ['nullable', 'numeric'],
            ]);
            $customer = Customers::where("id_customer", $id)->first();

            if($customer) {
                $customer->update([
                    'id_customer' => $id,
                    'name_customer' => $request->name,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'phone_number2' => $request->phone_number2 == '0' ? null : $request->phone_number2,
                ]);

                $user = User::where('id_type_users', 3)
                    ->where('pid', $id)->first();
                $user->update([
                    'email' => $request->email,
                    'pid' => $id,
                ]);
                if($request->password){
                    if(Hash::make($request->password) != $user->password){
                        $user->password = Hash::make($request->password);
                        $user->save();
                    }
                }

                return redirect()->route("customers.index", ['page_id' => $this->page_id])
                    ->with([
                        "message" => [
                            "type" => "success",
                            "title" => "نحجت العملية",
                            "text" => "تمت عملية التعديل على الزبون"
                        ]
                    ]);

            }
            return redirect()->route('customers.index', ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "فشلت العملية",
                        "text" => "هذا الزبون غير موجود"
                    ]
                ]);
        } catch (ValidationException $e) {
            return redirect()->route('customers.index', ['page_id' => $this->page_id])
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
        $customer = Customers::where("id_customer", $id)->first();

        if($customer) {
            Customers::destroy("id_customer", $id);

            $user = User::where('id_type_users', 3)
                ->where('pid', $id)->first();
            User::destroy($user->id);

            return redirect()->route("customers.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف الزبون"
                    ]
                ]);
        }
        return redirect()->route('customers.index', ['page_id' => $this->page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذا الزبون غير موجود"
                ]
            ]);
    }

    public function getTrash() {
        $id_page = 10;
        $isUpdate = $this->checkUpdateRole(10);
        $customers = Customers::onlyTrashed()->get();
        return view('site.People.Customers.trashView', compact('customers', 'isUpdate', 'id_page'));
    }

    public function restore(Request $request, $page_id) {
        if ($request->has('customers')) {
            $customersData = $request->input('customers');

            foreach ($customersData as $customerData) {
                if (isset($customerData['check']) && $customerData['check'] === 'on') {
                    $customer = Customers::onlyTrashed()->find($customerData['id']);
                    if ($customer) {
                        $customer->restore();
                        $user = User::onlyTrashed()
                            ->where('pid', $customerData['id'])
                            ->where('id_type_users', 3)
                            ->first();
                        if ($user) {
                            $user->restore();
                        }
                    }
                }
            }

            return redirect()->route("customers.index", ['page_id' => $page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم استعادة الزبائن بنجاح"
                    ]
                ]);
        }

        return redirect()->route('customers.getTrash', ['page_id' => $page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "الزبائن غير موجودين"
                ]
            ]);
    }


    public function delete(Request $request, $page_id) {
        if ($request->has('customers')) {
            $customersData = $request->input('customers');

            foreach ($customersData as $customerData) {
                if (isset($customerData['check']) && $customerData['check'] === 'on') {
                    $customer = Customers::onlyTrashed()->find($customerData['id']);
                    if ($customer) {
                        $customer->forceDelete();
                        $user = User::onlyTrashed()
                            ->where('pid', $customerData['id'])
                            ->where('id_type_users', 3)
                            ->first();
                        if ($user) {
                            $user->forceDelete();
                        }
                    }
                }
            }

            return redirect()->route("customers.index", ['page_id' => $page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف الزبائن نهائيًا بنجاح"
                    ]
                ]);
        }

        return redirect()->route('customers.index', ['page_id' => $page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "الزبائن غير موجودين"
                ]
            ]);
    }

}
