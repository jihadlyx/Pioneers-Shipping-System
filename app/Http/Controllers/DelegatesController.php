<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\Branch;
use App\Models\Delegate;
use App\Traits\AuthorizationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class DelegatesController extends Controller
{
    use AuthorizationTrait;

    protected $page_id = 3;

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
            $delegates = Delegate::all();
        }
        else {
            $delegates = Delegate::where('id_delegate', $user->id_pid)->get();
        }
        if($this->checkCreateRole(1)){
            $branches = Branch::all();
        } else {
            $branches = [$user->findUserByType($user->id_type_users)->branch];
        }
        $maxDelegateId = Delegate::withTrashed()->max('id_delegate') ? Delegate::withTrashed()->max('id_delegate') + 1 : 1;

        return view('site.People.Delegates.delegatesView', compact('delegates', 'branches', 'isCreate', 'isUpdate', 'isDelete', 'id_page', 'maxDelegateId'));
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
                'id_delegate' => ['required', 'numeric', 'unique:'.Delegate::class],
                'name' => ['required', 'string', 'max:255', 'min:3'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required'],
                'address' => ['required', 'string', 'max:30'],
                'id_branch' => ['required', 'numeric'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12'],
                'phone_number2' => ['nullable', 'numeric'] ,
            ]);
            DB::transaction(function () use ($request) {

                Delegate::create([
                    'id_delegate' => $request->id_delegate,
                    'name_delegate' => $request->name,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'id_number' => 1,
                    'phone_number2' => $request->phone_number2,
                    'id_role' => 2,
                    'id_branch' => $request->id_branch,
                ]);

                // إنشاء مستخدم
                User::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'id_type_users' => 2,
                    'pid' => $request->id_delegate,
                ]);
            });
            return redirect()->route("delegates.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نحجت العملية",
                        "text" => "تمت عملية الإضافة بنجاح"
                    ]
                ]);

        } catch (ValidationException $e) {
            return redirect()->route('delegates.index', ['page_id' => $this->page_id])
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
                'id_delegate' => ['required', 'numeric'],
                'name' => ['required', 'string', 'max:255', 'min:3'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['nullable'],
                'address' => ['required', 'string', 'max:30'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12'],
                'phone_number2' => ['nullable', 'numeric'] ,
            ]);

            $delegate = Delegate::where("id_delegate", $id)->first();

            if ($delegate) {
                $delegate->update([
                    'id_delegate' => $request->id_delegate,
                    'name_delegate' => $request->name,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'phone_number2' => $request->phone_number2,
                ]);

                $user = User::where('id_type_users', 2)
                    ->where('pid', $id)->first();
                $user->update([
                    'email' => $request->email,
                    'pid' => $request->id_delegate,
                ]);
                if($request->password){
                    $user->password = Hash::make($request->password);
                    $user->save();
                }

                return redirect()->route("delegates.index", ['page_id' => $this->page_id])
                    ->with([
                        "message" => [
                            "type" => "success",
                            "title" => "نحجت العملية",
                            "text" => "تمت عملية التعديل على المندوب"
                        ]
                    ]);

            }
            return redirect()->route('delegates.index', ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "فشلت العملية",
                        "text" => "هذا المندوب غير موجود"
                    ]
                ]);

        } catch (ValidationException $e) {
            return redirect()->route('delegates.index', ['page_id' => $this->page_id])
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
        $delegate = Delegate::where("id_delegate", $id)->first();

        if($delegate) {
            Delegate::destroy("id_delegate", $id);

            $user = User::where('id_type_users', 2)
                ->where('pid', $id)->first();

            User::destroy($user->id);

            return redirect()->route("delegates.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "info",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف المندوب"
                    ]
                ]);
        }
        return redirect()->route('delegates.index', ['page_id' => $this->page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذا المندوب غير موجود"
                ]
            ]);
    }
}
