<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\Branch;
use App\Models\PriceBranch;
use App\Models\SubCities;
use App\Traits\AuthorizationTrait;
use Illuminate\Http\Request;

class SubCitiesController extends Controller
{
    use AuthorizationTrait;

    protected $page_id = 6;

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
        $maxcityId = SubCities::withTrashed()->max('id_city') ? SubCities::withTrashed()->max('id_city') + 1 : 1;

        $cities = SubCities::all();
        if($this->checkCreateRole(1)){
            $branches = Branch::all();
        } else {
            $branches = [Auth()->user()->findUserByType(Auth()->user()->id_type_users)->branch];
        }
        return view('site.SubCities.subCitiesView', compact('cities','isShowTrash', 'branches', 'maxcityId', 'isCreate', 'isUpdate', 'isDelete', 'id_page'));
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
//            'id_city' => ['required', 'numeric', 'unique:'.SubCities::class],
//            'title' => ['required', 'string', 'max:30'],
//            'price' => ['required', 'numeric', 'max:30'],
//
//        ]);
//
//        if($validatedData) {
            SubCities::create([
                "id_city" => $request->id_city,
                "title" => $request->title,
                'id_branch' => $request->id_branch,
                'price' => $request->price

            ]);

//      }

            return redirect()->route('subCities.index', ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "نحجت العملية",
                        "text" => "تمت عملية إضافة المدينة بنجاح"
                    ]]);
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

        $city = SubCities::where("id_city", $id)->first();

        if($city) {
            $city->update([
                "title" => $request->title,
                'price' => $request->price
            ]);


            return redirect()->route("subCities.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نحجت العملية",
                        "text" => "تمت عملية التعديل على المندوب"
                    ]
                ]);

        }
        return redirect()->route('subCities.index', ['page_id' => $this->page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذا المندوب غير موجود"
                ]]);


        }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($page_id,$id)
    {
        $city = SubCities::where("id_city", $id)->first();

        if($city) {
            SubCities::destroy("id_city", $id);
            return redirect()->route("subCities.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف "
                     ]
                ]);
        } return redirect()->route('subCities.index', ['page_id' => $this->page_id])
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
        $cities = SubCities::onlyTrashed()->get();
        return view('site.SubCities.trashView', compact('cities', 'isUpdate', 'id_page'));
    }

    public function restore($id_page, $id) {
        $city = SubCities::onlyTrashed()->find($id);
        if ($city) {
            $city->restore();
            return redirect()->route("subCities.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم استعادة المنطقة بنجاح"
                    ]
                ]);
        }
        return redirect()->route('subCities.getTrash', ['page_id' => 10])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذه المنطقة غير موجود"
                ]
            ]);
    }

    public function delete($page_id, $id)
    {
        $city = SubCities::onlyTrashed()->find($id);

        if($city) {
            $city->forceDelete();
            return redirect()->route("subCities.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف المنطقة"
                    ]
                ]);
        }

        return redirect()->route('subCities.index', ['page_id' => $this->page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذه المنطقة غير موجود"
                ]
            ]);
    }

}
