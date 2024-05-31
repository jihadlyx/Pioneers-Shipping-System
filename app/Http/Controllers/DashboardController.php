<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\Customers;
use App\Models\DeliveryMen;
use App\Models\PriceBranch;
use App\Models\Shipments;
use App\Models\StatusShipments;
use App\Models\Regions;
use App\Traits\AuthorizationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    use AuthorizationTrait;
    protected $id_page = 9;
    public function __construct()
    {
        $this->middleware(CheckShowPermission::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth()->user();
        $branchId = $user->findUserByType(auth()->user()->id_type_users)->branch_id;
        if($user->id_type_users == 1){

            $ship1 = Shipments::whereHas('customer', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            })
                ->where('status_id', 1)->get();

            $ship2 = Shipments::whereHas('customer', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            })
                ->where('status_id', 2)->get();

            $ship3 = Shipments::whereHas('customer', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            })
                ->where('status_id', 3)->get();

            $ship4 = Shipments::whereHas('customer', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            })
                ->where('status_id', 4)->get();
        }
        elseif($user->id_type_users == 2){
            $ship1 = StatusShipments::where('status_id', 1)
                ->where('delivery_id', $user->pid)
                ->get();
            $ship2 = StatusShipments::where('shipment_on_service.status_id', 2)
                ->join('shipments', 'shipment_on_service.ship_id', '=', 'shipments.ship_id')
                ->where('delivery_id', $user->pid)
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('shipment_on_service as ss2')
                        ->whereRaw('ss2.ship_id = shipments.ship_id')
                        ->whereRaw('ss2.status_id != 2');
                })
                ->get();
            $ship3 = StatusShipments::where('status_id', 3)
                ->where('delivery_id', $user->pid)
                ->get();
            $ship4 = StatusShipments::where('status_id', 4)
                ->where('delivery_id', $user->pid)
                ->get();
        }
        else {
            $ship1 = $this->getShipmentsByStatus(1, $user->pid, $branchId);
            $ship2 = $this->getShipmentsByStatus(2, $user->pid, $branchId);
            $ship3 = $this->getShipmentsByStatus(3, $user->pid, $branchId);
            $ship4 = $this->getShipmentsByStatus(4, $user->pid, $branchId);

        }

        return view('site.dashboard.dashboardView', compact('ship1', 'ship2', 'ship3', 'ship4'));
    }

    function getShipmentsByStatus($status, $customerId, $branchId) {
        return Shipments::where('shipments.status_id', $status)
            ->where('shipments.customer_id', $customerId)
            ->join('customers', 'shipments.customer_id', '=', 'customers.customer_id')
            ->where('customers.branch_id', $branchId)
            ->select('shipments.*', 'customers.address as customer_address')
            ->get();
    }
    function getShipmentsByStatusID($status, $branchId) {
        return Shipments::where('shipments.status_id', $status)
            ->join('customers', 'shipments.customer_id', '=', 'customers.customer_id')
            ->where('customers.branch_id', $branchId)
            ->select('shipments.*', 'customers.address as customer_address')
            ->get();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id_page, $id)
    {
        $user = Auth()->user();
        $id_page = $this->id_page;
        $prices_branches = PriceBranch::with('from_branch', $user->findUserByType($user->id_type_users)->branch_id);
        $sub_cites = Regions::all();
        $isDelete = $this->checkDeleteRole($this->id_page);
        $isUpdate = $this->checkUpdateRole($this->id_page);
        $isEmployee = false;

        $branch_id = $user->findUserByType($user->id_type_users)->branch_id;
        if($user->id_type_users == 1) {
            $isEmployee = true;
            $shipments = Shipments::where('status_id', $id)
                ->join('customers', 'shipments.customer_id', '=', 'customers.customer_id')
                ->where('customers.branch_id', $branch_id)
                ->select('shipments.*', 'customers.address as customer_address')
                ->get();

            $delegates = DeliveryMen::where('branch_id', $branch_id)->get();
            $customers = Customers::where('branch_id', $branch_id)->get();
        } elseif ($user->id_type_users == 2) {
            $shipments = StatusShipments::where('status_id', $id)
                    ->where('delivery_id', $user->pid)
                    ->get();
            $customers = [];
            $delegates = [];
        } else {
            $shipments = Shipments::where('shipments.status_id', $id)
                ->where('shipments.customer_id', $user->pid)
                ->join('customers', 'shipments.customer_id', '=', 'customers.customer_id')
                ->where('customers.branch_id', $branch_id)
                ->select('shipments.*', 'customers.address as customer_address')
                ->get();
            $customers = [Customers::where('customer_id', $user->pid)->first()];
            $delegates = [];
        }

        if($id == 1) {
            $text = 'استعلام عن الشحنات التي قيد الانتظار';
        } elseif ($id == 2) {
            $text = 'استعلام عن الشحنات التي قيد التوصيل';
        }
        elseif ($id == 3) {
            $text = 'استعلام عن الشحنات التي تم تسليمها';
        }
        else {
            $text = 'استعلام عن الشحنات التي تعذر توصيلها';
        }
        return view('site.Dashboard.Type Status Ship.typeShipmentView', compact('shipments', 'delegates', 'isEmployee', 'isUpdate', 'isDelete', "id_page", 'sub_cites', 'text', 'id', 'prices_branches', 'customers'));

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
    public function update(Request $request, $id)
    {
        //
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
