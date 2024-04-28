<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\SubCities;
use App\Models\TypeState;
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


        $maxTypeStateId = TypeState::max('id_state') ? TypeState::max('id_state') + 1 : 1;

        $status = TypeState::all();
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
     * @return \Illuminate\Http\Response
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

        TypeState::create([
            "id_state" => $request->id_state,
            "title" => $request->title,


        ]);

        return redirect()->route('status.index', ['page_id' => $this->page_id])
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$page_id, $id)
    {
        $state = TypeState::where("id_state", $id)->first();

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
     * @return \Illuminate\Http\Response
     */
    public function destroy($page_id,$id)
    {
        //
        $state = TypeState::where("id_state", $id)->first();

        if($state) {
            TypeState::destroy("id_state", $id);
            return redirect()->route("status.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "info",
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
