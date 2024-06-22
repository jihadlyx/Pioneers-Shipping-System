<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\Branch;
use App\Models\Customers;
use App\Models\DeliveryMen;
use App\Models\PriceBranch;
use App\Models\Shipments;
use App\Models\StatusShipments;
use App\Models\Regions;
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
    public function index($id_page, $status_id)
    {
        $id_page = $this->page_id;
        $isDelete = $this->checkDeleteRole($this->page_id);
        $isCreate = $this->checkCreateRole($this->page_id);
        $isUpdate = $this->checkUpdateRole($this->page_id);
        $isShowTrash = $this->checkShowRole(10);
        $user = Auth()->user();
        $isEmployee = $user->id_type_users == 1 ? true : false;
        $id_branch = $user->findUserByType($user->id_type_users)->branch_id;
        if($user->id_type_users == 1) {
            $isEmployee = true;
            $shipments = Shipments::where('shipments.status_id', $status_id)
                ->join('customers', 'shipments.customer_id', '=', 'customers.customer_id')
                ->where('customers.branch_id', $id_branch)
                ->select('shipments.*', 'customers.address as customer_address')
                ->get();

            $delegates = DeliveryMen::where('branch_id', $id_branch)->get();
            $customers = Customers::where('branch_id', $id_branch)->get();
        } elseif ($user->id_type_users == 2) {
            $shipments = StatusShipments::where('status_id', $status_id)->get();
            $customers = [];
            $delegates = [];
        } else {
            $shipments = Shipments::where('shipments.status_id', $status_id)
                ->where('shipments.customer_id', $user->pid())
                ->join('customers', 'shipments.customer_id', '=', 'customers.customer_id')
                ->where('customers.branch_id', $id_branch)
                ->select('shipments.*', 'customers.address as customer_address')
                ->get();
            $customers = [Customers::where('customer_id', $user->pid())->first()];
            $delegates = [];
        }

        $prices_branches = PriceBranch::with('from_branch', $user->findUserByType($user->id_type_users)->branch_id);
        $sub_cites = Regions::all();


        $maxShipmentId = Shipments::withTrashed()->max('ship_id') ? Shipments::withTrashed()->max('ship_id') + 1 : 1;

        return view('site.shipments.shipmentsView', compact('shipments', 'isShowTrash', 'status_id', 'prices_branches', 'delegates', 'isEmployee', 'isCreate', 'isUpdate', 'isDelete', 'id_page', 'maxShipmentId', 'customers', 'sub_cites'));
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
                'ship_id' => ['required', 'numeric', 'unique:'.Shipments::class],
                'ship_name' => ['required', 'string', 'max:50', 'min:3'],
                'recipient_name' => ['required', 'string', 'max:40', 'min:3'],
                'customer_id' => ['required', 'numeric'],
                'region_id' => ['required', 'numeric'],
                'ship_value' => ['required', 'numeric', 'min:1'],
                'address' => ['required', 'string', 'max:30'],
                'notes' => ['nullable', 'string', 'max:50'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12'],
                'phone_number2' => ['nullable', 'numeric'] ,
            ]);
            Shipments::create([
                'ship_id' => $request->ship_id,
                'ship_name' => $request->ship_name,
                'customer_id' => $request->customer_id,
                'status_id' => 1,
                'region_id' => $request->region_id,
                'ship_value' => $request->ship_value,
                'phone_number' => $request->phone_number,
                'phone_number2' => $request->phone_number2,
                'address' => $request->address,
                'notes' => $request->notes,
                'recipient_name' => $request->recipient_name,
            ]);
            return redirect()->route("shipments.index", ['page_id' => $this->page_id, 'status_id' => 1])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نحجت العملية",
                        "text" => "تمت عملية الإضافة بنجاح"
                    ]
                ]);
        } catch (ValidationException $e) {
            return redirect()->route('shipments.index', ['page_id' => $this->page_id, 'status_id' => 1])
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
                'ship_id' => ['required', 'numeric', 'unique:'.Shipments::class],
                'ship_name' => ['required', 'string', 'max:50', 'min:3'],
                'recipient_name' => ['required', 'string', 'max:40', 'min:3'],
                'customer_id' => ['required', 'numeric'],
                'region_id' => ['required', 'numeric'],
                'ship_value' => ['required', 'numeric', 'min:1'],
                'address' => ['required', 'string', 'max:30'],
                'notes' => ['nullable', 'string', 'max:50'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12'],
                'phone_number2' => ['nullable', 'numeric'] ,
            ]);
        $shipment = Shipments::where("ship_id", $id)->first();

        if($shipment) {
            $shipment->update([
                'ship_name' => $request->ship_name,
                'customer_id' => $request->customer_id,
                'status_id' => 1,
                'region_id' => $request->region_id,
                'ship_value' => $request->ship_value,
                'phone_number' => $request->phone_number,
                'phone_number2' => $request->phone_number2,
                'address' => $request->address,
                'notes' => $request->notes,
                'recipient_name' => $request->recipient_name,
            ]);
            return redirect()->route("shipments.index", ['page_id' => $this->page_id, 'status_id' => 1])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نحجت العملية",
                        "text" => "تمت عملية التعديل على الشحنة"
                    ]
                ]);

        }
        return redirect()->route('shipments.index', ['page_id' => $this->page_id, 'status_id' => 1])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "هذه الشحنة غير موجودة"
                ]
            ]);
        } catch (ValidationException $e) {
            return redirect()->route('shipments.index', ['page_id' => $this->page_id, 'status_id' => 1])
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
        $shipment = Shipments::where("ship_id", $id)->first();

        if($shipment) {
            Shipments::destroy("ship_id", $id);

            return redirect()->route("shipments.index", ['page_id' => $this->page_id, 'status_id' => 1])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف الشحنة"
                    ]
                ]);
        }
        return redirect()->route('shipments.index', ['page_id' => $this->page_id, 'status_id' => 1])
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
        $shipment = Shipments::where('ship_id', $id)->first();
        $branches = Branch::where('status' , 1)->get();
        if (!$shipment) {
            abort(404); // يمكنك تعديل هذا بحسب احتياجاتك
        }
        return view('site.shipments.modal.print', compact('shipment', 'branches'));
    }

    public function getTrash() {
        $id_page = 10;
        $isUpdate = $this->checkUpdateRole(10);
        $shipments = Shipments::onlyTrashed()->get();
        return view('site.Shipments.trashView', compact('shipments', 'isUpdate', 'id_page'));
    }

    public function restore(Request $request, $page_id) {
        if ($request->has('shipments')) {
            $shipmentsData = $request->input('shipments');

            foreach ($shipmentsData as $shipmentData) {
                if (isset($shipmentData['check']) && $shipmentData['check'] === 'on') {
                    $shipment = Shipments::onlyTrashed()->find($shipmentData['id']);
                    if ($shipment) {
                        $shipment->restore();
                    }
                }
            }

            return redirect()->route("shipments.index", ['page_id' => $page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم استعادة الشحنات بنجاح"
                    ]
                ]);
        }

        return redirect()->route('shipments.getTrash', ['page_id' => $page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "الشحنات غير موجودة"
                ]
            ]);
    }
    public function delete(Request $request, $page_id) {
        if ($request->has('shipments')) {
            $shipmentsData = $request->input('shipments');

            foreach ($shipmentsData as $shipmentData) {
                if (isset($shipmentData['check']) && $shipmentData['check'] === 'on') {
                    $shipment = Shipments::onlyTrashed()->find($shipmentData['id']);
                    if ($shipment) {
                        $shipment->forceDelete();
                    }
                }
            }

            return redirect()->route("shipments.index", ['page_id' => $page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم حذف الشحنات نهائيًا بنجاح"
                    ]
                ]);
        }

        return redirect()->route('shipments.index', ['page_id' => $page_id])
            ->with([
                "message" => [
                    "type" => "error",
                    "title" => "فشلت العملية",
                    "text" => "الشحنات غير موجودة"
                ]
            ]);
    }

}
