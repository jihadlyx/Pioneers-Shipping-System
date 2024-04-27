<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\Delegate;
use App\Traits\AuthorizationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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

        $delegates = Delegate::all();

        $maxDelegateId = Delegate::max('id_delegate') ? Delegate::max('id_delegate') + 1 : 1;

        return view('site.People.Delegates.delegatesView', compact('delegates', 'isCreate', 'isUpdate', 'isDelete', 'id_page', 'maxDelegateId'));
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
//        $validatedData = $request->validate([
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
//            'password' => ['required', 'confirmed'],
//        ]);
//
//        if($validatedData) {

            DB::transaction(function () use ($request) {

                Delegate::create([
                    'id_delegate' => $request->id_delegate,
                    'name_delegate' => $request->name,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'id_number' => 1,
                    'phone_number2' => $request->phone_number2,
                    'id_role' => 1,
                    'id_branch' => auth()->user()->findUserByType(auth()->user()->id_type_users)->id_branch,
                ]);

                // إنشاء مستخدم
                User::create([
                    'name' => $request->name,
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
//        }
//        return redirect()->route('delegates.index', ['page_id' => $this->page_id])
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
        $delegate = Delegate::where("id_delegate", $id)->first();

        if($delegate) {
            $delegate->update([
                'id_delegate' => $id,
                'name_delegate' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'phone_number2' => $request->phone_number2,
            ]);

            $user = User::where('id_type_users', 2)
                ->where('pid', $id)->first();
            $user->update([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_type_users' => 2,
                'pid' => $id,
            ]);

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
            $user->destroy("pid", $id);

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
