<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\Branch;
use App\Models\PriceBranch;
use App\Models\Regions;
use App\Traits\AuthorizationTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        $maxcityId = Regions::withTrashed()->max('region_id') ? Regions::withTrashed()->max('region_id') + 1 : 1;

        $cities = Regions::all();
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
        try {
            $validatedData = $request->validate([
                'region_id' => ['required', 'numeric', 'unique:'.Regions::class],
                'title' => ['required', 'string', 'max:30'],
                'price' => ['required', 'numeric', 'max:9999'],

            ]);

            Regions::create([
                "region_id" => $request->region_id,
                "title" => $request->title,
                'branch_id' => $request->branch_id,
                'price' => $request->price

            ]);

            return redirect()->route('subCities.index', ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نحجت العملية",
                        "text" => "تمت عملية إضافة المدينة بنجاح"
                    ]]);
        } catch (ValidationException $e) {
                return redirect()->route('subCities.index', ['page_id' => $this->page_id])
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
                'region_id' => ['required', 'numeric'],
                'title' => ['required', 'string', 'max:30'],
                'price' => ['required', 'numeric', 'max:9999'],

            ]);
            $city = Regions::where("region_id", $id)->first();

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

        } catch (ValidationException $e) {
            return redirect()->route('subCities.index', ['page_id' => $this->page_id])
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
    public function destroy($page_id,$id)
    {
        $city = Regions::where("region_id", $id)->first();

        if($city) {
            Regions::destroy("region_id", $id);
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
        $cities = Regions::onlyTrashed()->get();
        return view('site.SubCities.trashView', compact('cities', 'isUpdate', 'id_page'));
    }
    public function restore(Request $request, $id_page) {
        if ($request->has('cities')) {
            $subCitiesData = $request->input('cities');

            // تكرار عبر كل منطقة فرعية واستعادتها
            foreach ($subCitiesData as $subCityData) {
                $subCity = Regions::onlyTrashed()->find($subCityData['id']);
                if ($subCity) {
                    if(isset($subCityData['check']) && $subCityData['check'] === 'on') {
                        $subCity->restore();
                    }
                }
            }

            // إعادة التوجيه مع رسالة نجاح
            return redirect()->route("subCities.index", ['page_id' => $id_page])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم استعادة المناطق الفرعية بنجاح"
                    ]
                ]);
        }

        return redirect()->route('subCities.trash.getTrash', ['page_id' => 10])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "المناطق الفرعية غير موجودة"
                ]
            ]);
    }
    public function delete(Request $request, $id_page)
    {
        if ($request->has('cities')) {
            $subCitiesData = $request->input('cities');

            foreach ($subCitiesData as $subCityData) {
                if (isset($subCityData['check']) && $subCityData['check'] === 'on') {
                    $subCity = Regions::onlyTrashed()->find($subCityData['id']);
                    if ($subCity) {
                        $subCity->forceDelete();
                    }
                }
            }

            // إعادة التوجيه مع رسالة نجاح
            return redirect()->route("subCities.index", ['page_id' => $id_page])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف المناطق الفرعية نهائيًا بنجاح"
                    ]
                ]);
        }
        // إعادة التوجيه مع رسالة خطأ في حالة عدم وجود الفروع
        return redirect()->route('subCities.trash.getTrash', ['page_id' => 10])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "المناطق الفرعية غير موجودة"
                ]
            ]);
    }
}
