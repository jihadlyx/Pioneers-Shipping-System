<?php

namespace App\Http\Controllers;

use App\Models\DeliveryMen;
use App\Models\Shipments;
use App\Models\StatusShipments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    protected $page_id = 12;

    public function index() {
        $status = 3;
        $user = Auth()->user();
        $branch = $user->findUserByType($user->id_type_users)->branch;
        if($user->id_type_users == 1){
            $reports = $this->getShipmentsFromEmployees($status, $user->findUserByType(1)->branch_id);
            $prices = $this->getPriceEmployee($reports);
        }
        elseif($user->id_type_users == 2){
            $reports = $this->getShipmentsFromDelivery($status, $user->pid());
            $prices = $this->getPriceDelivery($reports);
        } else {
            $reports = $this->getShipmentsFromCustomers($status, $user->pid());
            $prices = $this->getPriceCustomer($reports);
        }
        return view('site.reports.reports', compact('reports', 'branch', 'user', 'prices'));
    }

    function getShipmentsFromCustomers($status, $customerId) {
        return StatusShipments::where('shipment_on_service.status_id', $status)
            ->join('shipments', 'shipment_on_service.ship_id', '=', 'shipments.ship_id')
            ->where('shipments.customer_id', $customerId)
            ->get();
    }

    function getShipmentsFromDelivery($status, $deliveryId) {
        return StatusShipments::where('status_id', $status)
            ->where('delivery_id', $deliveryId)
            ->get();
    }

    function getShipmentsFromEmployees($status, $branchId) {
        return StatusShipments::where('shipment_on_service.status_id', $status)
            ->join('shipments', 'shipment_on_service.ship_id', '=', 'shipments.ship_id')
            ->join('customers', 'shipments.customer_id', '=', 'customers.customer_id')
            ->where('customers.branch_id', $branchId)
            ->get();
    }

    function getPriceEmployee($shipments) {
        $sum_price = 0;
        foreach ($shipments as $shipment) {
           $sum_price += ($shipment->shipment->getPrice() );
        }

        return $sum_price;
    }
    function getPriceDelivery($shipments) {
        $sum_price = $shipments->count() * $shipments[0]->delegate->piece_delivery_price;

        return $sum_price;
    }
    function getPriceCustomer($shipments) {
        $sum_price = 0;
        foreach ($shipments as $shipment) {
            $sum_price += $shipment->shipment->ship_value ;
        }

        return $sum_price;
    }

    public function show($page_id, $id) {
        $status = 3;
        $user = Auth()->user();
        $branch = $user->findUserByType($user->id_type_users)->branch;
        $reports = $this->getShipmentsFromDelivery($status, $id);
        $prices = $this->getPriceDelivery($reports);
        $sendTo = DeliveryMen::where('delivery_id', $id)->first();
        return view('site.reports.reports', compact('reports', 'branch', 'sendTo', 'user', 'prices'));
    }
}
