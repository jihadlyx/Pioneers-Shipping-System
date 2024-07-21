<?php

namespace App\Http\Controllers;

use App\Models\DeliveryMen;
use App\Models\Shipments;
use App\Models\StatusShipments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    protected $page_id = 12;

    public function index() {
        $status = 3;
        $user = Auth()->user();

        if($user->id_type_users == 1){
            return $this->getReportFromEmployees();
        }
        elseif($user->id_type_users == 2){
            return $this->getReportFromDelivery($user->pid());
        } else {
            return $this->getReportFromCustomers($user->pid());
        }

    }

    function getReportFromEmployees(){
        $user = Auth()->user();
        $branch = $user->findUserByType($user->id_type_users)->branch;
        $reports = StatusShipments::where('shipment_on_service.status_id', 3)
            ->join('shipments', 'shipment_on_service.ship_id', '=', 'shipments.ship_id')
            ->join('customers', 'shipments.customer_id', '=', 'customers.customer_id')
            ->where('customers.branch_id', $branch->branch_id)
            ->get();
        $prices = 0;
        $price_delivery = 0;
        foreach ($reports as $shipment) {
            $prices += ($shipment->shipment->getPrice() );
            $price_delivery += $shipment->delegate->piece_delivery_price;
        }
        $send_report = User::Where("pid", $user->user_id)->first();
        $sendTo = [
            "name" => $send_report->findUserByType($send_report->id_type_users)->emp_name,
            "phone_number" => $send_report->findUserByType($send_report->id_type_users)->phone_number,
            "address" => $send_report->findUserByType($send_report->id_type_users)->address,
        ];

        return view('site.reports.reports', compact('reports', 'branch', 'price_delivery', 'user', 'prices', 'sendTo'));
    }
    function getReportFromCustomers($customerId){
        $user = Auth()->user();
        $branch = $user->findUserByType($user->id_type_users)->branch;
        $reports = StatusShipments::where('shipment_on_service.status_id', 3)
            ->join('shipments', 'shipment_on_service.ship_id', '=', 'shipments.ship_id')
            ->join('customers', 'shipments.customer_id', '=', 'customers.customer_id')
            ->where("customers.customer_id", $customerId)
            ->get();


        $prices = 0;
        foreach ($reports as $ship){
            $prices += $ship->shipment->ship_value;
        }

        $send_report = User::Where("pid", $user->user_id)->first();
        $name = $send_report->findUserByType($send_report->id_type_users)->emp_name != null ? $send_report->findUserByType($send_report->id_type_users)->emp_name : $send_report->findUserByType($send_report->id_type_users)->customer_name;
        $sendTo = [
            "name" => $name,
            "phone_number" => $send_report->findUserByType($send_report->id_type_users)->phone_number,
            "address" => $send_report->findUserByType($send_report->id_type_users)->address,
        ];

        return view('site.reports.reports', compact('reports', 'user','branch', 'prices', 'sendTo'));

    }
    function getReportFromDelivery($deliveryId){
        $user = Auth()->user();
        $branch = $user->findUserByType($user->id_type_users)->branch;
        $reports = StatusShipments::where('status_id', 3)
            ->where('delivery_id', $deliveryId)
            ->get();
        $prices = $reports->count() * $user->findUserByType($user->id_type_users)->piece_delivery_price;

        $send_report = User::Where("pid", $user->user_id)->first();
        $sendTo = [
            "name" => $send_report->findUserByType($send_report->id_type_users)->delivery_name,
            "phone_number" => $send_report->findUserByType($send_report->id_type_users)->phone_number,
            "address" => $send_report->findUserByType($send_report->id_type_users)->address,
        ];

        return view('site.reports.reports', compact('reports', 'user','branch', 'prices', 'sendTo'));


    }


    public function show($page_id, $deliveryId) {
        $user = Auth()->user();
        $branch = $user->findUserByType($user->id_type_users)->branch;
        $reports = StatusShipments::where('status_id', 3)
            ->where('delivery_id', $deliveryId)
            ->get();
        $delivery = DeliveryMen::Where('delivery_id', $deliveryId)->first();
        $prices = $reports->count() * $delivery->piece_delivery_price;

        $send_report = User::Where("pid", $user->user_id)->first();
        $sendTo = [
            "name" => $delivery->delivery_name,
            "phone_number" => $delivery->phone_number,
            "address" => $delivery->address,
        ];

        return view('site.reports.reports', compact('reports', 'user','branch', 'prices', 'sendTo'));

    }
}
