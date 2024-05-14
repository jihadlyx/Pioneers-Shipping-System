<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\Customers;
use App\Models\Delegate;
use App\Models\PriceBranch;
use App\Models\Shipments;
use App\Models\StatusShipments;
use App\Models\SubCities;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Traits\AuthorizationTrait;
use Illuminate\Validation\ValidationException;


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
    public function index($id_page, $id_status)
    {
        $id_page = $this->page_id;
        $isDelete = $this->checkDeleteRole($this->page_id);
        $isCreate = $this->checkCreateRole($this->page_id);
        $isUpdate = $this->checkUpdateRole($this->page_id);
        $isShowTrash = $this->checkShowRole(10);
        $user = Auth()->user();
        $isEmployee = $user->id_type_users == 1 ? true : false;
        $id_branch = $user->findUserByType($user->id_type_users)->id_branch;
        if($user->id_type_users == 1) {
            $isEmployee = true;
            $shipments = Shipments::where('id_status', $id_status)
                ->join('customers', 'shipments.id_customer', '=', 'customers.id_customer')
                ->where('customers.id_branch', $id_branch)
                ->get();

            $delegates = Delegate::where('id_branch', $id_branch)->get();
            $customers = Customers::where('id_branch', $id_branch)->get();
        } elseif ($user->id_type_users == 2) {
            $shipments = StatusShipments::where('id_status', $id_status)->get();
            $customers = [];
            $delegates = [];
        } else {
            $shipments = Shipments::where('shipments.id_status', $id_status)
                ->where('shipments.id_customer', $user->pid)
                ->join('customers', 'shipments.id_customer', '=', 'customers.id_customer')
                ->where('customers.id_branch', $id_branch)
                ->get();
            $customers = [Customers::where('id_customer', $user->pid)->first()];
            $delegates = [];
        }

        $prices_branches = PriceBranch::with('id_from_branch', $user->findUserByType($user->id_type_users)->id_branch);
        $sub_cites = SubCities::all();


        $maxShipmentId = Shipments::withTrashed()->max('id_ship') ? Shipments::withTrashed()->max('id_ship') + 1 : 1;

        return view('site.shipments.shipmentsView', compact('shipments', 'isShowTrash', 'prices_branches', 'delegates', 'isEmployee', 'isCreate', 'isUpdate', 'isDelete', 'id_page', 'maxShipmentId', 'customers', 'sub_cites'));
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
                'id_ship' => ['required', 'numeric', 'unique:'.Shipments::class],
                'name_ship' => ['required', 'string', 'max:50', 'min:3'],
                'recipient_name' => ['required', 'string', 'max:40', 'min:3'],
                'id_customer' => ['required', 'numeric'],
                'id_city' => ['required', 'numeric'],
                'ship_value' => ['required', 'numeric', 'min:1'],
                'address' => ['required', 'string', 'max:30'],
                'notes' => ['nullable', 'string', 'max:50'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12'],
                'phone_number2' => ['nullable', 'numeric'] ,
            ]);
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
            return redirect()->route("shipments.index", ['page_id' => $this->page_id, 'id_status' => 1])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نحجت العملية",
                        "text" => "تمت عملية الإضافة بنجاح"
                    ]
                ]);
        } catch (ValidationException $e) {
            return redirect()->route('shipments.index', ['page_id' => $this->page_id, 'id_status' => 1])
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
                'id_ship' => ['required', 'numeric', 'unique:'.Shipments::class],
                'name_ship' => ['required', 'string', 'max:50', 'min:3'],
                'recipient_name' => ['required', 'string', 'max:40', 'min:3'],
                'id_customer' => ['required', 'numeric'],
                'id_city' => ['required', 'numeric'],
                'ship_value' => ['required', 'numeric', 'min:1'],
                'address' => ['required', 'string', 'max:30'],
                'notes' => ['nullable', 'string', 'max:50'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12'],
                'phone_number2' => ['nullable', 'numeric'] ,
            ]);
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
            return redirect()->route("shipments.index", ['page_id' => $this->page_id, 'id_status' => 1])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نحجت العملية",
                        "text" => "تمت عملية التعديل على الشحنة"
                    ]
                ]);

        }
        return redirect()->route('shipments.index', ['page_id' => $this->page_id, 'id_status' => 1])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذه الشحنة غير موجودة"
                ]
            ]);
        } catch (ValidationException $e) {
            return redirect()->route('shipments.index', ['page_id' => $this->page_id, 'id_status' => 1])
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
        $shipment = Shipments::where("id_ship", $id)->first();

        if($shipment) {
            Shipments::destroy("id_ship", $id);

            return redirect()->route("shipments.index", ['page_id' => $this->page_id, 'id_status' => 1])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف الشحنة"
                    ]
                ]);
        }
        return redirect()->route('shipments.index', ['page_id' => $this->page_id, 'id_status' => 1])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذه الشحنة غير موجودة"
                ]
            ]);
    }

    public function downloadShipmentData($id_page,$id)
    {
        // العثور على الشحنة باستخدام المعرف
        $shipment = Shipments::where('id_ship', $id)->first();

        if (!$shipment) {
            abort(404); // يمكنك تعديل هذا بحسب احتياجاتك
        }
        return view('site.shipments.modal.print', compact('shipment'));
    }

    public function getTrash() {
        $id_page = 10;
        $isUpdate = $this->checkUpdateRole(10);
        $shipments = Shipments::onlyTrashed()->get();
        return view('site.Shipments.trashView', compact('shipments', 'isUpdate', 'id_page'));
    }

    public function restore($id_page, $id) {
        $shipment = Shipments::onlyTrashed()->find($id);
        if ($shipment) {
            $shipment->restore();
            return redirect()->route("shipments.index", ['page_id' => $this->page_id, 'id_status' => $shipment->id_status])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم استعادة الشحنة بنجاح"
                    ]
                ]);
        }
        return redirect()->route('shipments.getTrash', ['page_id' => 10])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذا الشحنة غير موجود"
                ]
            ]);
    }

    public function delete($page_id, $id)
    {
        $shipment = Shipments::onlyTrashed()->find($id);

        if($shipment) {
            $shipment->forceDelete();
            return redirect()->route("shipments.index", ['page_id' => $this->page_id, 'id_status' => $shipment->id_status])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف الشحنة"
                    ]
                ]);
        }

        return redirect()->route('shipments.index', ['page_id' => $this->page_id, 'id_status' => $shipment->id_status])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذه الشحنة غير موجود"
                ]
            ]);
    }
}
