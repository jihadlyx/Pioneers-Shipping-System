<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckShowPermission;
use App\Models\Shipments;
use App\Models\StatusShipments;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
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
