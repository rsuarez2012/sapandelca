<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Client;
use App\Product;
use App\ProductProduction;
use App\Employe;
use App\Sale;
use App\Credit;
use App\DetailCredit;
use App\DetailSale;
use Carbon\Carbon;
use DB;
class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sales = Sale::orderBy('id', 'Desc')->get();
        return view('sales.index', compact('sales'));
    }
    public function autocomplete(Request $request)
    {
        $client = $request->client;
        /*$client = Input::get('client');
        $results = array();        
        $queries = Client::where('dni', 'LIKE', '%'.$client.'%')->orWhere('first_name', 'LIKE', '%'.$client.'%')->take(5)->get();
        foreach ($queries as $query)
        {
            /*$results[] = [ 
                'id' => $query->id, 
                'dni' => $query->dni,
                'first_name' => $query->first_name
            ];*/
        /*    $results[] = array("id"=>$query->id,"dni"=>$query->dni, "first_name"=>$query->first_name);
        }
        return response()->json($results);*/
        if($client == ''){
            $clients = Client::orderBy('first_name', 'asc')->select('id', 'first_name')->limit(5)->get();
        }else{
            //$clients = Client::orderby('first_name','asc')->select('id','first_name')->where('dni', 'like', '%' .$client . '%')->limit(5)->get();
            $clients = Client::where('status', 1)->where('dni', 'LIKE', '%'.$client.'%')->orWhere('first_name', 'LIKE', '%'.$client.'%')->take(5)->get();
        }

        $response = array();
          foreach($clients as $client){
             $response[] = array("value"=>$client->id,"label"=>$client->first_name.' '.$client->last_name, "dni" => $client->dni);
          }

          echo json_encode($response);
          exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $sales = Sale::orderBy('id', 'desc')->first();
        
        $products = Product::where('stock', '>', '1')->with('productproduction')->get();

        $employes = Employe::all();

        return view('sales.sales', ['products'=>$products, 'sales'=>$sales, 'employes'=>$employes]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $sales = Sale::all();
        $products = Product::where('stock', '>', '1')->with('productproduction')->get();
        //$sales = Sale::orderBy('id', 'asc')->get();
        //
        $rules = [
            'client_id'     => 'required',
            'format_buy'    => 'required',
        ];
        $messages = [
            'client_id.required' => 'Debe ingresar el cliente.!',
            'format_buy.required' => 'Debe ingresar el metodo de pago.!',
        ];

        $this->validate($request, $rules, $messages);

        try{
 
            DB::beginTransaction();
            $time = Carbon::now('America/Caracas');
            $sale = new Sale();
            $sale->num_fac = $request->num_fac;
            $sale->client_id = $request->client_id;
            $sale->user_id = auth()->user()->id;
            $sale->date_created = $time;
            $sale->format_buy = $request->format_buy;
            $sale->reference_number = $request->reference;
            $sale->observation = $request->observation;
            $sale->iva = '16';
            $sale->status = '1';
            $sale->point = $request->point;
            $sale->employe_id = $request->employe_id;
            $sale->save();

            

            $product_id = $request->product_id;
            $quantity_product = $request->quantity_product;
            $total = $request->buy;

         
             //Recorro todos los elementos
            $cont=0;

            while($cont < count($product_id)){
                $detail = new DetailSale();
                /*enviamos valores a las propiedades del objeto detalle*/
                /*al idcompra del objeto detalle le envio el id del objeto venta, que es el objeto que se ingresó en la tabla ventas de la bd*/
                /*el id es del registro de la venta*/
                $detail->sale_id = $sale->id;
                $detail->product_id = $product_id[$cont];
                $detail->quantity_product = $quantity_product[$cont];
                $detail->total = $total[$cont];
                $detail->save();
                $cont=$cont+1;
            }
            if($request->format_buy == 8){
                $credit = new Credit();
                $credit->sale_id = $sale->id;
                $credit->num_fac = $sale->num_fac;
                $credit->status = 1;
                $credit->total = $request->total_credito;
                $credit->save();

                $detail = new DetailCredit();
                /*enviamos valores a las propiedades del objeto detalle*/
                /*al idcompra del objeto detalle le envio el id del objeto venta, que es el objeto que se ingresó en la tabla ventas de la bd*/
                /*el id es del registro de la venta*/
                $detail->credit_id = $credit->id;
                $detail->total = $credit->total;
                $detail->subtraction = $credit->total;
                $detail->save();
            }
            DB::commit();
 
        } catch(Exception $e){
                 
            DB::rollBack();
        }

        //return back()->with('info', 'Venta registrada con exito.!');
        //return view('sales.index')->with('info', 'Venta registrada con exito.!');
        return redirect()->route('ventas.index')->with('info', 'Venta registrada con exito.!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$sale = DetailSale::where('sale_id', $id)->get();//with('detailsale')->
        $sale = Sale::where('id', $id)->with('detailsale')->get();
        $detailsales = DetailSale::where('sale_id', $id)->get();
        return view('sales.show', compact('sale', 'detailsales'));   
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
        $sale = Sale::find($id);
        $sale->status = '0';
        $sale->save();
        return response()->json();
        //return redirect()->route('ventas.index')->with('info', 'Venta Anulada con exito.!'); 

             /*$venta = Venta::findOrFail($request->id_venta);
             $venta->estado = 'Anulado';
             $venta->save();*/
    }

    public function fact($id)
    {
        # code...
        $sale = Sale::where('id', $id)->with('detailsale')->get();
        $detailsales = DetailSale::where('sale_id', $id)->get();
        return view('sales.factura', compact('sale', 'detailsales'));
    }

    public function note($id)
    {
        //dd($id);
        $detailsales = DetailSale::where('sale_id', $id)->get();

        $sale = Sale::with('detailsale')->where('id', $id)->get();
        //dd($sale->detailsale);
        
        return view('sales.nota', compact('sale'));
    }
}
