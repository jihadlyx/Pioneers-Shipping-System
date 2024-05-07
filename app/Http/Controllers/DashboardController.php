<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\Customers;
use App\Models\Delegate;
use App\Models\PriceBranch;
use App\Models\Shipments;
use App\Models\StatusShipments;
use App\Models\SubCities;
use App\Traits\AuthorizationTrait;
use Illuminate\Http\Request;

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
        $branchId = $user->findUserByType(auth()->user()->id_type_users)->id_branch;
        if($user->id_type_users == 1){

            $ship1 = Shipments::whereHas('customer', function ($query) use ($branchId) {
                $query->where('id_branch', $branchId);
            })
                ->where('id_status', 1)->get();

            $ship2 = Shipments::whereHas('customer', function ($query) use ($branchId) {
                $query->where('id_branch', $branchId);
            })
                ->where('id_status', 2)->get();

            $ship3 = Shipments::whereHas('customer', function ($query) use ($branchId) {
                $query->where('id_branch', $branchId);
            })
                ->where('id_status', 3)->get();

            $ship4 = Shipments::whereHas('customer', function ($query) use ($branchId) {
                $query->where('id_branch', $branchId);
            })
                ->where('id_status', 4)->get();
        }
        elseif($user->id_type_users == 2){
            $ship1 = StatusShipments::where('id_status', 1)
                ->where('id_delegate', $user->pid)
                ->get();
            $ship2 = StatusShipments::where('id_status', 2)
                ->where('id_delegate', $user->pid)
                ->get();
            $ship3 = StatusShipments::where('id_status', 3)
                ->where('id_delegate', $user->pid)
                ->get();
            $ship4 = StatusShipments::where('id_status', 4)
                ->where('id_delegate', $user->pid)
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
        return Shipments::where('shipments.id_status', $status)
            ->where('shipments.id_customer', $customerId)
            ->join('customers', 'shipments.id_customer', '=', 'customers.id_customer')
            ->where('customers.id_branch', $branchId)
            ->get();
    }
    function getShipmentsByStatusID($status, $branchId) {
        return Shipments::where('shipments.id_status', $status)
            ->join('customers', 'shipments.id_customer', '=', 'customers.id_customer')
            ->where('customers.id_branch', $branchId)
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
        $prices_branches = PriceBranch::with('id_from_branch', $user->findUserByType($user->id_type_users)->id_branch);
        $sub_cites = SubCities::all();
        $isDelete = $this->checkDeleteRole($this->id_page);
        $isUpdate = $this->checkUpdateRole($this->id_page);
        $isEmployee = false;

        $id_branch = $user->findUserByType($user->id_type_users)->id_branch;
        if($user->id_type_users == 1) {
            $isEmployee = true;
            $shipments = Shipments::where('id_status', $id)
                ->join('customers', 'shipments.id_customer', '=', 'customers.id_customer')
                ->where('customers.id_branch', $id_branch)
                ->get();

            $delegates = Delegate::where('id_branch', $id_branch)->get();
            $customers = Customers::where('id_branch', $id_branch)->get();
        } elseif ($user->id_type_users == 2) {
            $shipments = StatusShipments::where('id_status', $id)
                    ->where('id_delegate', $user->pid)
                    ->get();
            $customers = [];
            $delegates = [];
        } else {
            $shipments = Shipments::where('shipments.id_status', $id)
                ->where('shipments.id_customer', $user->pid)
                ->join('customers', 'shipments.id_customer', '=', 'customers.id_customer')
                ->where('customers.id_branch', $id_branch)
                ->get();
            $customers = [Customers::where('id_customer', $user->pid)->first()];
            $delegates = [];
        }

        if($id == 1) {
            $text = 'الشحنات التي قيد الموافقه';
        } elseif ($id == 2) {
            $text = 'الشحنات التي قيد التوصيل';
        }
        elseif ($id == 3) {
            $text = 'الشحنات التي تم تسليمها';
        }
        else {
            $text = 'الشحنات التي تعذر توصيلها';
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
