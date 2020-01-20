<?php

namespace App\Http\Controllers;

use App\Credit;
use App\Sale;
use App\DetailCredit;
use Illuminate\Http\Request;
use DB;
class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credits = Credit::orderBy('id', 'Desc')->get();
        //dd($credits);
        $sales = Sale::orderBy('id', 'Desc')->get();
        return view('credits.index', compact('credits', 'sales'));
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
        try{
 
            DB::beginTransaction();
            $credit = new Credit();
            $credit->sale_id = $request->sale_id;
            $credit->num_fac = $request->num_fac;
            $credit->total = $request->total;
            $credit->status = '1';
            $credit->save();

            $total = $request->total;

         
             //Recorro todos los elementos
            

            
            $detail = new DetailCredit();
            /*enviamos valores a las propiedades del objeto detalle*/
            /*al idcompra del objeto detalle le envio el id del objeto venta, que es el objeto que se ingresó en la tabla ventas de la bd*/
            /*el id es del registro de la venta*/
            $detail->credit_id = $credit->id;
            $detail->total = $total;
            $detail->subtraction = $total;
            $detail->save();
            
            DB::commit();
 
        } catch(Exception $e){
                 
            DB::rollBack();
        }
        return redirect()->route('creditos.index')->with('info', 'Credito registrado con exito.!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function show(Credit $credit, $id)
    {
        $sales = Sale::orderBy('id', 'Desc')->get();
        $credit = Credit::with('detailcredit')->where('id', $id)->get();
        $las = $credit[0]->detailcredit->last();
        //dd($credit->detailcredit->last());
        

        return view('credits.show', compact('credit', 'sales', 'las'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function edit(Credit $credit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Credit $credit)
    {
        dd($request->all());
        $credit = Credit::find($request->id);
        $credit->status = '0';
        $credit->save();
        return redirect()->route('creditos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $credit = Credit::find($id);

        //$credit = Credit::with('detailcredit')->where('id', $id)->get();

        $las = $credit->detailcredit->last();
        //$las = $credit[0]->detailcredit->last();

        //dd($las->subtraction);
        if ($las->subtraction != '0')
            //dd($las);
            return response()->json(['success'=>'error'], 500);
        
        if($las->subtraction == '0')
            //$credit = Credit::find($id);
            $credit->status = '0';
            $credit->save();
            return response()->json(['success'=>'success'], 200);

        
    }

    public function payment(Request $request)
    {
        //dd($request->all());
        $detail = new DetailCredit();
        $detail->credit_id = $request->id;
        $detail->total = $request->total;
        $detail->payment_type = $request->payment_type;
        $detail->bank = $request->bank;
        $detail->reference = $request->reference;
        $detail->rode = $request->rode;
        $detail->subtraction = $request->s;
        $detail->save();

        return back()->with('info', 'Pago registrado con exito');
    }
}
