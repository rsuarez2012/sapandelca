<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\DetailOrder;
use DB;
use Carbon\Carbon;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get(); 
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $orders = Order::orderBy('id', 'desc')->first(); 
        return view('orders.create', compact('products', 'orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orders = Order::all();
        //$products = Product::where('stock', '>', '1')->with('productproduction')->get();
        $products = Product::orderBy('id', 'asc')->get();
        //dd($request->all());
        try{
 
            DB::beginTransaction();
            $time = Carbon::now('America/Caracas');
            $order = new Order();
            $order->num_order = $request->num_fac;
            $order->client_id = $request->client_id;
            $order->user_id = auth()->user()->id;
            $order->date_order = $time;
            $order->date_delivery = $request->date_delivery;
            $order->format_buy = $request->format_buy;
            $order->num_buy = '0';
            $order->status = '0';
            $order->save();

            $product_id = $request->product_id;
            $quantity_product = $request->quantity_product;
            $total = $request->buy;

         
             //Recorro todos los elementos
            $cont=0;

            while($cont < count($product_id)){
                $detail = new DetailOrder();
                /*enviamos valores a las propiedades del objeto detalle*/
                /*al idcompra del objeto detalle le envio el id del objeto venta, que es el objeto que se ingresó en la tabla ventas de la bd*/
                /*el id es del registro de la venta*/
                $detail->order_id = $order->id;
                $detail->product_id = $product_id[$cont];
                $detail->quantity_product = $quantity_product[$cont];
                $detail->price = $total[$cont];
                $detail->save();
                $cont=$cont+1;
            }
            DB::commit();
 
        } catch(Exception $e){
                 
            DB::rollBack();
        }

        return redirect()->route('pedidos.index')->with('info', 'Pedido registrado con exito.!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $detailorders = DetailOrder::where('order_id', $id)->get();
        //dd($detailorder);
        return view('orders.show', compact('order', 'detailorders'));
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
        //dd($request->all());
        $orders = Order::all();
        $order = Order::find($request->id);
        $order->num_buy = $request->num_buy;
        $order->status = '1';
        $order->save();
        return redirect()->route('pedidos.index', compact('orders'))->with('info', 'Pedido Procesado con exito.!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->status = '2';
        $order->save();
        return response()->json();
    }

    public function sends()
    {
       $orders = Order::where('status', '1')->orderBy('id', 'desc')->get(); 
        return view('orders.sends', compact('orders')); 
    }
}
