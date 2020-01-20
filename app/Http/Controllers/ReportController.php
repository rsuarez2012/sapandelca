<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Order;
use Carbon\Carbon;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$sell_today = '2019-08-02';//$request->today;
        
        $sell = Sale::whereDate('date_created', $sell_today)->with('detailsale')->get();
        dd($sell);*/
        return view('reports.index');
    }
    public function sellToday(Request $request)
    {
        //dd($request->all());
        $tp = $request->tp;
        //$sell_today = '2019-07-30';
        $sell_today = $request->to_day;
        //$sell_today = Carbon::now()->format('Y-m-d');
        if(is_null($tp)){
        $sales = Sale::whereDate('date_created', $sell_today)->with('detailsale')->get();

        }else{
            
            $sales = Sale::whereDate('date_created', $sell_today)->where('format_buy', $tp)->with('detailsale')->get();
        }
        //dd($sales);
        //$sales = Sale::with('detailsaleThisDay')->get();
        /*$sales = Sale::with(['detailsale' => function($query) use ($sell_today) {
                    $query->whereDay('created_at', $sell_today);
        }])->get();*/
        return view('reports.sales_for_day', compact('sales', 'sell_today', 'tp'));
    }
    public function saleForDates(Request $request)
    //public function saleForDates($start, $end)
    {
        $tp = $request->tp;
        $start = $request->start;
        $end = $request->end;
        //dd($start.' '.$end);
        //$sales = Sale::whereBetween('date_created', [$start, $end])->with('detailsale')->get();
        if(is_null($tp)){
            $sales = Sale::with('detailsale')->whereBetween('date_created', [$start, $end])->get();    
        }else{

            $sales = Sale::with('detailsale')->whereBetween('date_created', [$start, $end])->where('format_buy', $tp)->get();
        }
        //dd($sales->count());
            //return $sales;
            /*if($sales->detailsale->count() > 0)
                return $sales->detailsale[0];

         foreach ($sales as $sale) {
             return $sale->detailsale;
         }*/
         return view('reports.sales_for_dates', compact('sales', 'start', 'end'));
    }
    public function ordersDay(Request $request)
    {
        //$tp = $request->tp;
        //$today = '2019-08-04';
        $today = $request->to_day;
        $orders = Order::whereDate('date_order', $today)->with('detailorder')->get();
        return view('reports.orders_for_day', compact('orders', 'today'));
    }
    public function ordersForDates(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $orders = Order::with('detailorder')->whereBetween('date_order', [$start, $end])->get();
         return view('reports.orders_for_dates', compact('orders', 'start', 'end'));   
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
