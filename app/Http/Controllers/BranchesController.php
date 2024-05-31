<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\Branch;
use App\Models\PriceBranch;
use App\Traits\AuthorizationTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BranchesController extends Controller
{
    use AuthorizationTrait;

    protected $page_id = 1;
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

        $maxBranchId = Branch::withTrashed()->max('branch_id') ? Branch::withTrashed()->max('branch_id') + 1 : 1;

        if($isCreate) {
            $branches = Branch::all();
        } else {
            $branches = Branch::where("branch_id", auth()->user()->findUserByType(auth()->user()->id_type_users)->branch_id)->get();
        }
        return view('site.Branches.branchesView', compact('branches', 'maxBranchId', 'isCreate', 'isUpdate', 'isDelete', 'isShowTrash', 'id_page'));
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
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $validatedData = $request->validate([
                'branch_id' => ['required', 'numeric', 'unique:'.Branch::class],
                'title' => ['required', 'string', 'max:20', 'unique:'.Branch::class],
                'address' => ['required', 'string', 'max:30'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12', 'unique:'.Branch::class],
                'phone_number2' => ['nullable', 'numeric'] ,
            ]);
            $idBranch = $request->branch_id;
            Branch::create([
                "branch_id" => $idBranch,
                "title" => $request->title,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'status' => 0,
                'phone_number2' => $request->phone_number2,
            ]);
            $branches = Branch::all();
            foreach ($branches as $branch) {
                $maxId = PriceBranch::withTrashed()->max('id') ? PriceBranch::withTrashed()->max('id') + 1 : 1;
                PriceBranch::create([
                    'id' => $maxId,
                    'from_branch' => $idBranch,
                    'to_branch' => $branch->branch_id,
                    'price' => 0,
                ]);
                if($branch->branch_id != $idBranch) {
                    PriceBranch::create([
                        'id' => $maxId + 1,
                        'from_branch' => $branch->branch_id, // Assuming authenticated user has a branch
                        'to_branch' => $idBranch,
                        'price' => 0,
                    ]);
                }
            }

            return redirect()->route("branches.price.show", ['page_id' => $this->page_id, 'branch_id' => $request->branch_id]);
        } catch (ValidationException $e) {
            return redirect()->route('branches.index', ['page_id' => $this->page_id])
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
    public function translate(Request $request, $id_page, $id) {
        try {
            $validatedData = $request->validate([
                'branch_id' => ['required', 'numeric'],
                'status' => ['required', 'numeric'],
            ]);
            $branch = Branch::where("branch_id", $id)->first();

            if($branch) {
                $branch->update([
                    "status" => $request->status,
                ]);
                return redirect()->route("branches.index", ['page_id' => $this->page_id])
                    ->with([
                        "message" => [
                            "type" => "success",
                            "title" => "نحجت العملية",
                            "text" => "تمت عملية التعديل على الفرع"
                        ]
                    ]);

            }
            return redirect()->route('branches.index', ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "فشلت العملية",
                        "text" => "هذا الفرع غير موجود"
                    ]
                ]);
        } catch (ValidationException $e) {
            return redirect()->route('branches.index', ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "فشلت العملية",
                        "text" => "يوجد خطأ في عملية ادخال البيانات يرجى التأكد البيانات"
                    ]
                ]);
        }
    }
    public function update(Request $request,$page_id, $id)
    {
        try {
            $validatedData = $request->validate([
                'branch_id' => ['required', 'numeric'],
                'title' => ['required', 'string', 'max:20'],
                'address' => ['required', 'string', 'max:30'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12'],
                'phone_number2' => ['nullable', 'numeric'] ,
            ]);
            $branch = Branch::where("branch_id", $id)->first();

            if($branch) {
                $branch->update([
                    "branch_id" => $request->branch_id,
                    "title" => $request->title,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'phone_number2' => $request->phone_number2,
                ]);
                return redirect()->route("branches.index", ['page_id' => $this->page_id])
                    ->with([
                        "message" => [
                            "type" => "success",
                            "title" => "نحجت العملية",
                            "text" => "تمت عملية التعديل على الفرع"
                        ]
                    ]);

            }
            return redirect()->route('branches.index', ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "فشلت العملية",
                        "text" => "هذا الفرع غير موجود"
                    ]
                ]);
        } catch (ValidationException $e) {
            return redirect()->route('branches.index', ['page_id' => $this->page_id])
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
        $branch = Branch::where("branch_id", $id)->first();

        if($branch) {
            $branch->update([
                'status' => 0,
            ]);
            Branch::destroy("branch_id", $id);
            $branches = PriceBranch::where('from_branch', $id)
                ->orWhere('to_branch', $id)->get();
            foreach ($branches as $item) {
                if($item)
                    PriceBranch::destroy("id", $item->id);
            }
            return redirect()->route("branches.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف الفرع"
                    ]
                ]);
        }

        return redirect()->route('branches.index', ['page_id' => $this->page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذا الفرع غير موجود"
                ]
            ]);
    }

    public function getTrash() {
        $id_page = 10;
        $isUpdate = $this->checkUpdateRole(10);
        $branches = Branch::onlyTrashed()->get();
        return view('site.branches.trashView', compact('branches', 'isUpdate', 'id_page'));
    }

    public function restore(Request $request, $id_page) {
        if ($request->has('branches')) {
            $branchesData = $request->input('branches');

            // تكرار عبر كل فرع واستعادته
            foreach ($branchesData as $branchData) {
                $branch = Branch::onlyTrashed()->find($branchData['id']);
                if ($branch) {
                    if(isset($branchData['check']) && $branchData['check'] === 'on') {
                        $branch->update([
                            'status' => 1,
                        ]);
                        $branch->restore();
                        $branches = PriceBranch::onlyTrashed()->where('from_branch', $branch->branch_id)
                            ->orWhere('to_branch', $branch->branch_id)->get();
                        foreach ($branches as $item) {
                            if($item)
                                $item->restore();
                        }
                    }
                }
            }

            // إعادة التوجيه مع رسالة نجاح
            return redirect()->route("branches.index", ['page_id' => $id_page])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم استعادة الفروع بنجاح"
                    ]
                ]);
        }

        return redirect()->route('branches.trash.getTrash', ['page_id' => 10])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "الفروع غير موجودة"
                ]
            ]);
    }

    public function delete(Request $request, $id_page)
    {
        if ($request->has('branches')) {
            $branchesData = $request->input('branches');

            // تكرار عبر كل فرع وحذفه نهائيًا فقط إذا كان الحقل "check" موجودًا وقيمته "on"
            foreach ($branchesData as $branchData) {
                if (isset($branchData['check']) && $branchData['check'] === 'on') {
                    $branch = Branch::onlyTrashed()->find($branchData['id']);
                    if ($branch) {
                        $branch->forceDelete();
                        $branches = PriceBranch::onlyTrashed()->where('from_branch', $branch->branch_id)
                            ->orWhere('to_branch', $branch->branch_id)->get();
                        foreach ($branches as $item) {
                            if($item)
                                $item->forceDelete();
                        }
                    }
                }
            }

            // إعادة التوجيه مع رسالة نجاح
            return redirect()->route("branches.index", ['page_id' => $id_page])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف الفروع نهائيًا بنجاح"
                    ]
                ]);
        }

        // إعادة التوجيه مع رسالة خطأ في حالة عدم وجود الفروع
        return redirect()->route('branches.index', ['page_id' => $id_page])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "الفروع غير موجودة"
                ]
            ]);
    }
    public function pricesView($id) {
        return view('site.Branches.DeliveryPrices.pricesView');
    }




}
