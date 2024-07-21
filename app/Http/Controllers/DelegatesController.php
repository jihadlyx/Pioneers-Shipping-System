<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\Branch;
use App\Models\DeliveryMen;
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
        $isShowTrash = $this->checkShowRole(10);
        $user = Auth()->user();
        if($isCreate) {
            $delegates = DeliveryMen::all();
        }
        else {
            $delegates = DeliveryMen::where('delivery_id', $user->pid()())->get();
        }
        if($this->checkCreateRole(1)){
            $branches = Branch::all();
        } else {
            $branches = [$user->findUserByType($user->id_type_users)->branch];
        }
        $maxDelegateId = DeliveryMen::withTrashed()->max('delivery_id') ? DeliveryMen::withTrashed()->max('delivery_id') + 1 : 1;

        return view('site.People.Delegates.delegatesView', compact('delegates', 'branches', 'isShowTrash', 'isCreate', 'isUpdate', 'isDelete', 'id_page', 'maxDelegateId'));
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
//        return $request;
        try {
            $validatedData = $request->validate([
                'delivery_id' => ['required', 'numeric', 'unique:'.DeliveryMen::class],
                'name' => ['required', 'string', 'max:255', 'min:3'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required'],
                'address' => ['required', 'string', 'max:30'],
                'branch_id' => ['required', 'numeric'],
                'number_id' => ['required', 'numeric', 'unique:'.DeliveryMen::class],
                'piece_delivery_price' => ['required', 'numeric', 'digits_between:1,8'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12', 'unique:'.DeliveryMen::class],
                'phone_number2' => ['nullable', 'numeric'] ,
            ]);
            DB::transaction(function () use ($request) {

                DeliveryMen::create([
                    'delivery_id' => $request->delivery_id,
                    'delivery_name' => $request->name,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'number_id' => $request->number_id,
                    'phone_number2' => $request->phone_number2,
                    'role_id' => 2,
                    'piece_delivery_price' => $request->piece_delivery_price,
                    'branch_id' => $request->branch_id,
                ]);

                // إنشاء مستخدم
                User::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'id_type_users' => 2,
                    'pid' => 2 . $request->delivery_id,
                    'user_id' => Auth()->user()->pid,
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
                'delivery_id' => ['required', 'numeric'],
                'name' => ['required', 'string', 'max:255', 'min:3'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['nullable'],
                'address' => ['required', 'string', 'max:30'],
                'number_id' => ['required', 'numeric'],
                'piece_delivery_price' => ['required', 'numeric', 'min:1', 'max:4'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12'],
                'phone_number2' => ['nullable', 'numeric'] ,
            ]);

            $delegate = DeliveryMen::where("delivery_id", $id)->first();

            if ($delegate) {
                $delegate->update([
                    'delivery_id' => $request->delivery_id,
                    'delivery_name' => $request->name,
                    'address' => $request->address,
                    'number_id' => $request->number_id,
                    'phone_number' => $request->phone_number,
                    'phone_number2' => $request->phone_number2,
                    'piece_delivery_price' => $request->piece_delivery_price,
                ]);

                $user = User::where('id_type_users', 2)
                    ->where('pid', 2 . $id)->first();
                $user->update([
                    'email' => $request->email,
                    'pid' => 2 . $request->delivery_id,
                ]);
                if($request->password){
                    if(Hash::make($request->password) != $user->password){
                        $user->password = Hash::make($request->password);
                        $user->save();
                    }
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
        $delegate = DeliveryMen::where("delivery_id", $id)->first();

        if($delegate) {
            DeliveryMen::destroy("delivery_id", $id);

            $user = User::where('id_type_users', 2)
                ->where('pid', 2 . $id)->first();

            User::destroy($user->pid);

            return redirect()->route("delegates.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
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

    public function getTrash() {
        $id_page = 10;
        $isUpdate = $this->checkUpdateRole(10);
        $delegates = DeliveryMen::onlyTrashed()->get();
        return view('site.People.Delegates.trashView', compact('delegates', 'isUpdate', 'id_page'));
    }

    public function restore(Request $request, $page_id) {
        if ($request->has('delegates')) {
            $delegatesData = $request->input('delegates');

            foreach ($delegatesData as $delegateData) {
                if (isset($delegateData['check']) && $delegateData['check'] === 'on') {
                    $delegate = DeliveryMen::onlyTrashed()->find($delegateData['id']);
                    if ($delegate) {
                        $delegate->restore();
                        $user = User::onlyTrashed()
                            ->where('pid', 2 . $delegateData['id'])
                            ->where('id_type_users', 2)
                            ->first();
                        if ($user) {
                            $user->restore();
                        }
                    }
                }
            }

            return redirect()->route("delegates.index", ['page_id' => $page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم استعادة المندوبين بنجاح"
                    ]
                ]);
        }

        return redirect()->route('delegates.getTrash', ['page_id' => $page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "المندوبون غير موجودون"
                ]
            ]);
    }

    public function delete(Request $request, $page_id) {
        if ($request->has('delegates')) {
            $delegatesData = $request->input('delegates');

            foreach ($delegatesData as $delegateData) {
                if (isset($delegateData['check']) && $delegateData['check'] === 'on') {
                    $delegate = DeliveryMen::onlyTrashed()->find($delegateData['id']);
                    if ($delegate) {
                        $delegate->forceDelete();
                        $user = User::onlyTrashed()
                            ->where('pid', 2 . $delegateData['id'])
                            ->where('id_type_users', 2)
                            ->first();
                        if ($user) {
                            $user->forceDelete();
                        }
                    }
                }
            }

            return redirect()->route("delegates.index", ['page_id' => $page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف المندوبين نهائيًا بنجاح"
                    ]
                ]);
        }

        return redirect()->route('delegates.index', ['page_id' => $page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "المندوبون غير موجودون"
                ]
            ]);
    }

}
