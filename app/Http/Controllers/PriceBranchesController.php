<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\PriceBranch;
use Illuminate\Http\Request;

class PriceBranchesController extends Controller
{
    protected $id_page;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($page_id, $id)
    {
        $this->id_page = $page_id;
        $branches = PriceBranch::where("id_from_branch", $id)->get();
        if (!$branches) {

        }
        $new_branch = Branch::where("id_branch", $id)->first();

        return view('site.Branches.DeliveryPrices.pricesView', compact('branches', 'new_branch', 'page_id'));
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
    public function store(Request $request, $id_page, $id)
    {
        // Validate the request data
//        $request->validate([
//            'prices' => 'required|array',
//            'prices.*.id_to_branch' => 'required|exists:branches,id',
//            'prices.*.price' => 'required|numeric',
//        ]);

        // Loop through the prices array and create PriceBranch records
        foreach ($request->prices as $price) {
            $branch = PriceBranch::where('id_from_branch', $id)
                ->where('id_to_branch', $price['id_to_branch'])
                ->first();
            if($branch) {
                $branch->update([
                    'price' => $price['price']
                ]);
                $msg_title = "تمت عملية التعديل على الفرع بنجاح";
            } else {
                $maxBranchId = PriceBranch::max('id') ? PriceBranch::max('id') + 1 : 1;
                PriceBranch::create([
                    'id' => $maxBranchId,
                    'id_from_branch' => $id, // Assuming authenticated user has a branch
                    'id_to_branch' => $price['id_to_branch'],
                    'price' => $price['price'],
                ]);
                if($price['id_to_branch'] != $id) {
                    PriceBranch::create([
                        'id' => $maxBranchId + 1,
                        'id_from_branch' => $price['id_to_branch'], // Assuming authenticated user has a branch
                        'id_to_branch' => $id,
                        'price' => $price['price'],
                    ]);
                }
                $msg_title = "تمت عملية اضافة الفرع بنجاح";
            }

        }
        $branch = Branch::where("id_branch", $id)->update([
            'state' => 1,
        ]);

        return redirect()->route('branches.index', ['page_id' => $id_page])
            ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => $msg_title
                    ]
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($page_id, $id)
    {
        $this->id_page = $page_id;
        $branches = Branch::all();
        $new_branch = Branch::where("id_branch", $id)->first();

        return view('site.Branches.DeliveryPrices.addFormPrices', compact('branches', 'new_branch', 'page_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($page_id, $id)
    {
        $this->id_page = $page_id;
        $branches = PriceBranch::where("id_from_branch", $id)->get();
        $new_branch = Branch::where("id_branch", $id)->first();

        return view('site.Branches.DeliveryPrices.addFormPrices', compact('branches', 'new_branch', 'page_id'));
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
