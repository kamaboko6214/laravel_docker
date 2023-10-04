<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use App\Models\Overview;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreRequest;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travels = Travel::all();
        return view('pages.test', ['travels' => $travels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pages.createPlan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $travel = new Travel();
            $travel->title = $request->title;
            $travel->subtitle = $request->subtitle;
            $travel->save();

            //リクエストの内容を取得
            $all_requests = $request->all();

            //概要の内容を取得
            $overview_titles = $all_requests['overview_title'];
            $overview_contents = $all_requests['overview_content'];
            
            //概要をインサート
            foreach (array_map(null,$overview_titles,$overview_contents) as [$title,$content]) {
                    $o_data = [
                        'travel_id' => $travel->id,
                        'title' => $title,
                        'content' => $content,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                Overview::insert($o_data);
            }

            //プランの内容を取得
            $plan_titles = $all_requests['plan_title'];
            $plan_contents = $all_requests['plan_content'];
            $plan_dates = $all_requests['date'];
            $plan_times = $all_requests['time'];

            //プランをインサート
            foreach (array_map(null,$plan_titles,$plan_contents,$plan_dates,$plan_times) as [$title,$content,$date,$time]) {
                $p_data = [
                    'travel_id' => $travel->id,
                    'title' => $title,
                    'date' => $date,
                    'time' => $time,
                    'location' => 'test',
                    'content' => $content,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            Plan::insert($p_data);
        }

        } catch(\Exception $e) {
            var_dump('失敗');
            DB::rollback();
            return back()->withInput();
        }
        DB::commit();
        return view('pages.completePlan',['travel' => $travel]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function show(Travel $travel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dump($id);
        exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Travel $travel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Travel $travel)
    {
        //
    }
}
