<?php

namespace App\Http\Controllers;

use App\Models\PriceBranch;
use App\Models\Shipments;
use App\Models\StatusShipments;
use App\Models\SubCities;
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
        $id_branch = $user->findUserByType($user->id_type_users)->id_branch;

        if($user->id_type_users == 1) {
            $shipments = StatusShipments::where('status_shipments.id_status', 2)
                ->join('shipments', 'status_shipments.id_ship', '=', 'shipments.id_ship')
                ->join('customers', 'shipments.id_customer', '=', 'customers.id_customer')
                ->join('employees', 'employees.id_branch', '=', 'customers.id_branch')
                ->where('employees.id_branch', $id_branch)
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('status_shipments as ss2')
                        ->whereRaw('ss2.id_ship = shipments.id_ship')
                        ->whereRaw('ss2.id_status != 2');
                })
                ->distinct() // استخدام DISTINCT لتفادي التكرار
                ->get();

        }
        elseif($user->id_type_users == 2) {
            $shipments = StatusShipments::where('status_shipments.id_status', 2)
                ->join('shipments', 'status_shipments.id_ship', '=', 'shipments.id_ship')
                ->where('id_delegate', $user->pid)
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('status_shipments as ss2')
                        ->whereRaw('ss2.id_ship = shipments.id_ship')
                        ->whereRaw('ss2.id_status != 2');
                })
                ->get();
        }
        else {
            $shipments = StatusShipments::where('status_shipments.id_status', 2)
                ->join('shipments', 'status_shipments.id_ship', '=', 'shipments.id_ship')
                ->join('customers', 'shipments.id_customer', '=', 'customers.id_customer')
                ->where('customers.id_customer', $user->pid)
                ->where('customers.id_branch', $id_branch)
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('status_shipments as ss2')
                        ->whereRaw('ss2.id_ship = shipments.id_ship')
                        ->whereRaw('ss2.id_status != 2');
                })
                ->get();
        }
        $prices_branches = PriceBranch::with('id_from_branch', $user->findUserByType($user->id_type_users)->id_branch);
        $sub_cites = SubCities::all();
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
                'id_ship' => ['required', 'numeric'],
                'id_delegate' => ['required', 'numeric'],
            ]);
            $ship = StatusShipments::Where('id_ship', $request->id_ship)
                ->where('id_status', 2)->first();
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
                'id_ship' => $request->id_ship,
                'id_delegate' => $request->id_delegate,
                'id_status' => 2,
                'id_user' => Auth()->user()->id,
                'date_update' => date("Y-m-d"),
            ]);
            $ship = Shipments::where('id_ship', $request->id_ship)->first();
            $ship->update([
                'id_status' => 2,
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
            'id_ship' => $ship->id_ship,
            'id_delegate' => $ship->id_delegate,
            'id_status' => $request->state,
            'id_user' => Auth()->user()->id,
            'date_update' => date("Y-m-d"),
        ]);
        $ship = Shipments::where('id_ship', $ship->id_ship)->first();
        $ship->update([
            'id_status' => $request->state,
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
