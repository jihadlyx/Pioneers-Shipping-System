<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\SubCities;
use App\Models\TypeShipStatus;
use App\Traits\AuthorizationTrait;
use Illuminate\Http\Request;

class TypeStatusController extends Controller
{
    use AuthorizationTrait;

    protected $page_id = 8;

    public function __construct()
    {
        $this->middleware(CheckShowPermission::class . ":page_id= $this->page_id");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_page = $this->page_id;
        $isDelete = $this->checkDeleteRole($this->page_id);
        $isCreate = $this->checkCreateRole($this->page_id);
        $isUpdate = $this->checkUpdateRole($this->page_id);


        $maxTypeStateId = TypeShipStatus::max('id_status') ? TypeShipStatus::max('id_status') + 1 : 1;

        $status = TypeShipStatus::all();
        return view('site.Settings.TypeStatus.typeStatusView', compact('status', 'maxTypeStateId', 'isCreate', 'isUpdate', 'isDelete', 'id_page'));

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
//            'price' => ['required', 'string', 'max:30'],
//
//        ]);

//        if($validatedData) {
        TypeShipStatus::create([
            "id_status" => $request->id_status,
            "title" => $request->title,
        ]);

        return redirect()->route('status.index', ['page_id' => $this->page_id])
            ->with([
                "message" => [
                    "type" => "success",
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
        $state = TypeShipStatus::where("id_status", $id)->first();

        if($state) {
            $state->update([
                "title" => $request->title,
            ]);
            return redirect()->route("status.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نحجت العملية",
                        "text" => "تمت عملية التعديل على المندوب"
                    ]
                ]);

        }
        return redirect()->route('status.index', ['page_id' => $this->page_id])
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
        //
        $state = TypeShipStatus::where("id_status", $id)->first();

        if($state) {
            TypeShipStatus::destroy("id_status", $id);
            return redirect()->route("status.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف "
                    ]
                ]);
        } return redirect()->route('status.index', ['page_id' => $this->page_id])
        ->with([
            "message" => [
                "type" => "error",
                "title" => "فشلت العملية",
                "text" => "هذا الفرع غير موجود"
            ]
        ]);




    }
}
