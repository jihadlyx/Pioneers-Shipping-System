<?php

namespace App\Http\Controllers;

use App\Models\PriceBranch;
use App\Models\Shipments;
use App\Models\StatusShipments;
use App\Models\Regions;
use App\Models\TypeShipStatus;
use App\Traits\AuthorizationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StatusShipmentsController extends Controller
{
    protected $page_id = 11;
    use AuthorizationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $id_page = $this->page_id;
        $isUpdate = $this->checkUpdateRole($this->page_id);
        $user = Auth()->user();
        $id_branch = $user->findUserByType($user->id_type_users)->branch_id;

        if($user->id_type_users == 1) {
            $shipments = StatusShipments::where('shipment_on_service.status_id', 2)
                ->join('shipments', 'shipment_on_service.ship_id', '=', 'shipments.ship_id')
                ->join('customers', 'shipments.customer_id', '=', 'customers.customer_id')
                ->join('employees', 'employees.branch_id', '=', 'customers.branch_id')
                ->where('employees.branch_id', $id_branch)
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('shipment_on_service as ss2')
                        ->whereRaw('ss2.ship_id = shipments.ship_id')
                        ->whereRaw('ss2.status_id != 2');
                })
                ->distinct() // استخدام DISTINCT لتفادي التكرار
                ->get();

        }
        elseif($user->id_type_users == 2) {
            $shipments = StatusShipments::where('shipment_on_service.status_id', 2)
                ->join('shipments', 'shipment_on_service.ship_id', '=', 'shipments.ship_id')
                ->where('delivery_id', $user->pid())
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('shipment_on_service as ss2')
                        ->whereRaw('ss2.ship_id = shipments.ship_id')
                        ->whereRaw('ss2.status_id != 2');
                })
                ->get();
        }
        else {
            $shipments = StatusShipments::where('shipment_on_service.status_id', 2)
                ->join('shipments', 'shipment_on_service.ship_id', '=', 'shipments.ship_id')
                ->join('customers', 'shipments.customer_id', '=', 'customers.customer_id')
                ->where('customers.customer_id', $user->pid())
                ->where('customers.branch_id', $id_branch)
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('shipment_on_service as ss2')
                        ->whereRaw('ss2.ship_id = shipments.ship_id')
                        ->whereRaw('ss2.status_id != 2');
                })
                ->get();
        }
        $prices_branches = PriceBranch::with('id_from_branch', $user->findUserByType($user->id_type_users)->branch_id);
        $sub_cites = Regions::all();
        return view('site.Status Shipments.statusShipmentsView', compact('shipments', 'sub_cites', 'prices_branches', 'id_page', 'isUpdate'));
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
    public function store(Request $request, $id_page)
    {
        try {
            $validatedData = $request->validate([
                'ship_id' => ['required', 'numeric'],
                'delivery_id' => ['required', 'numeric'],
            ]);
            $ship = StatusShipments::Where('ship_id', $request->ship_id)
                ->where('status_id', 2)->first();
            if($ship) {
                return redirect()->route('shipments.index', ['page_id' => $id_page])
                    ->with([
                        "message" => [
                            "type" => "error",
                            "title" => "هذه الشحنة تم تسليمها لمندوب من قبل",
                            "text" => ""
                        ]
                    ]);
            }
            $maxStatusId = StatusShipments::withTrashed()->max('id') ? StatusShipments::withTrashed()->max('id') + 1 : 1;
            StatusShipments::create([
                'id' => $maxStatusId,
                'ship_id' => $request->ship_id,
                'delivery_id' => $request->delivery_id,
                'status_id' => 2,
                'id_user' => Auth()->user()->id,
                'date_update' => date("Y-m-d"),
            ]);
            $ship = Shipments::where('ship_id', $request->ship_id)->first();
            $ship->update([
                'status_id' => 2,
            ]);
            return redirect()->route('statuses.index', ['page_id' => $this->page_id])
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "تم تسليم الشحنة للمندوب",
                        "text" => ""
                    ]
                ]);

        }
        catch (ValidationException $e) {
            return redirect()->route('shipments.index', ['page_id' => $id_page])
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "فشلت العملية",
                        "text" => "يوجد خطأ في عملية ادخال البيانات يرجى اختيار مندوب"
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
    public function update(Request $request, $id_page, $id)
    {
//        return $request;
        $ship = StatusShipments::where('id', $id)->first();
        $maxStatusId = StatusShipments::withTrashed()->max('id') ? StatusShipments::withTrashed()->max('id') + 1 : 1;
        StatusShipments::create([
            'id' => $maxStatusId,
            'ship_id' => $ship->ship_id,
            'delivery_id' => $ship->delivery_id,
            'status_id' => $request->state,
            'id_user' => Auth()->user()->id,
            'date_update' => date("Y-m-d"),
        ]);
        $ship = Shipments::where('ship_id', $ship->ship_id)->first();
        $ship->update([
            'status_id' => $request->state,
        ]);
        return redirect()->route('statuses.index', ['page_id' => $this->page_id])
            ->with([
                "message" => [
                    "type" => "success",
                    "title" => "تم التعديل على الشحنة",
                    "text" => ""
                ]
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
