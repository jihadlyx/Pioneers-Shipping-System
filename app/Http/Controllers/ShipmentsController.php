<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\Customers;
use App\Models\Shipments;
use App\Models\sub_cities;
use Illuminate\Http\Request;
use App\Traits\AuthorizationTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ShipmentsController extends Controller
{
    use AuthorizationTrait;

    protected $page_id = 5;

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

        $shipments = Shipments::all();
        $customers = Customers::all();
        $sub_cites = sub_cities::all();

        $maxShipmentId = Shipments::max('id_ship') ? Shipments::max('id_ship') + 1 : 1;

        return view('site.shipments.shipmentsView', compact('shipments', 'isCreate', 'isUpdate', 'isDelete', 'id_page', 'maxShipmentId', 'customers', 'sub_cites'));
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
        Shipments::create([
            'id_ship' => $request->id_ship,
            'name_ship' => $request->name_ship,
            'id_customer' => $request->id_customer,
            'id_status' => 1,
            'id_city' => $request->id_city,
            'ship_value' => $request->ship_value,
            'phone_number' => $request->phone_number,
            'phone_number2' => $request->phone_number2,
            'address' => $request->address,
            'notes' => $request->notes,
            'recipient_name' => $request->recipient_name,
        ]);
        return redirect()->route("shipments.index", ['page_id' => $this->page_id])
            ->with([
                "message" => [
                    "type" => "success",
                    "title" => "نحجت العملية",
                    "text" => "تمت عملية الإضافة بنجاح"
                ]
            ]);
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
        $shipment = Shipments::where("id_ship", $id)->first();

        if($shipment) {
            $shipment->update([
                'name_ship' => $request->name_ship,
                'id_customer' => $request->id_customer,
                'id_status' => 1,
                'id_city' => $request->id_city,
                'ship_value' => $request->ship_value,
                'phone_number' => $request->phone_number,
                'phone_number2' => $request->phone_number2,
                'address' => $request->address,
                'notes' => $request->notes,
                'recipient_name' => $request->recipient_name,
            ]);
            return redirect()->route("shipments.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نحجت العملية",
                        "text" => "تمت عملية التعديل على الشحنة"
                    ]
                ]);

        }
        return redirect()->route('shipments.index', ['page_id' => $this->page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذه الشحنة غير موجودة"
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
        $shipment = Shipments::where("id_ship", $id)->first();

        if($shipment) {
            Shipments::destroy("id_ship", $id);

            return redirect()->route("shipments.index", ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "info",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف الشحنة"
                    ]
                ]);
        }
        return redirect()->route('shipments.index', ['page_id' => $this->page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذه الشحنة غير موجودة"
                ]
            ]);
    }
}
