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

        $maxBranchId = Branch::withTrashed()->max('id_branch') ? Branch::withTrashed()->max('id_branch') + 1 : 1;

        if($isCreate) {
            $branches = Branch::all();
        } else {
            $branches = Branch::where("id_branch", auth()->user()->findUserByType(auth()->user()->id_type_users)->id_branch)->get();
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
                'id_branch' => ['required', 'numeric', 'unique:'.Branch::class],
                'title' => ['required', 'string', 'max:20', 'unique:'.Branch::class],
                'address' => ['required', 'string', 'max:30'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12', 'unique:'.Branch::class],
                'phone_number2' => ['nullable', 'numeric'] ,
            ]);
            $idBranch = $request->id_branch;
            Branch::create([
                "id_branch" => $idBranch,
                "title" => $request->title,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'state' => 0,
                'phone_number2' => $request->phone_number2,
            ]);
            $branches = Branch::all();
            foreach ($branches as $branch) {
                $maxId = PriceBranch::withTrashed()->max('id') ? PriceBranch::withTrashed()->max('id') + 1 : 1;
                PriceBranch::create([
                    'id' => $maxId,
                    'id_from_branch' => $idBranch,
                    'id_to_branch' => $branch->id_branch,
                    'price' => 0,
                ]);
                if($branch->id_branch != $idBranch) {
                    PriceBranch::create([
                        'id' => $maxId + 1,
                        'id_from_branch' => $branch->id_branch, // Assuming authenticated user has a branch
                        'id_to_branch' => $idBranch,
                        'price' => 0,
                    ]);
                }
            }

            return redirect()->route("branches.price.show", ['page_id' => $this->page_id, 'id_branch' => $request->id_branch]);
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
    public function update(Request $request,$page_id, $id)
    {
        try {
            $validatedData = $request->validate([
                'id_branch' => ['required', 'numeric'],
                'title' => ['required', 'string', 'max:20'],
                'address' => ['required', 'string', 'max:30'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12'],
                'phone_number2' => ['nullable', 'numeric'] ,
            ]);
            $branch = Branch::where("id_branch", $id)->first();

            if($branch) {
                $branch->update([
                    "id_branch" => $request->id_branch,
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
        $branch = Branch::where("id_branch", $id)->first();

        if($branch) {
            $branch->update([
                'state' => 0,
            ]);
            Branch::destroy("id_branch", $id);
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

    public function restore($id_page, $id) {
        $branch = Branch::onlyTrashed()->find($id);
        if ($branch) {
            $branch->update([
                'state' => 1,
            ]);
            $branch->restore();
            return redirect()->route("branches.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم استعادة الفرع بنجاح"
                    ]
                ]);
        }
        return redirect()->route('branches.trash.getTrash', ['page_id' => 10])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذا الفرع غير موجود"
                ]
            ]);
    }

    public function delete($page_id, $id)
    {
        $branch = Branch::onlyTrashed()->find($id);

        if($branch) {
            $branch->forceDelete();
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
    public function pricesView($id) {
        return view('site.Branches.DeliveryPrices.pricesView');
    }




}
