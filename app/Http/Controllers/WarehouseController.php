<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use App\DetailPurchase;
use Illuminate\Support\Facades\Input;//para buscar producto
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
class WarehouseController extends Controller
{
    public function __construct()
    {
        # code...
        $this->middleware('Supervisor');
        $this->middleware('auth'); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Warehouse::all();
        return view('warehouse.index', compact('products'));

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
        //dd($request->all());
        $products = Warehouse::all();
        $time = Carbon::now('America/Caracas');

        $product = new Warehouse();
        $product->nombre_producto = $request->nombre_producto;
        $product->presentacion    = $request->presentacion;
        $product->cantidad_entrada= $request->cantidad_entrada;
        $product->condicion = '1';
        $product->responsable     = $request->responsable;
        $product->cantidad_saliente = '0';
        $product->created_at = $time;
        $product->save();
        return redirect()->route('almacen.index', compact('products'))->with('info', 'Producto Almacenado con Exito.!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$product = Warehouse::findOrFail($id);
        $product = Warehouse::where('id', $id)->with('details')->first();
        $details = DetailPurchase::where('product_id', $id)->get();
        //dd($details);
        return view('warehouse.show', compact('product', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //$product = Warehouse::findOrFail($id);
        //$id = $request->id;
        $where = array('id' => $id);
        $product  = Warehouse::where($where)->first();

        return response()->json($product);
        //$product = Warehouse::where('id', $id)->get();
        //dd($product);
        //return response()->json($product);
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
        //$product = $request->all();
        $products = Warehouse::all();
        $product = Warehouse::find($request->id);
        $product->nombre_producto   = $request->nombre_producto;
        $product->presentacion      = $request->presentacion;
        $product->cantidad_entrada  = $request->cantidad_entrada;
        $product->cantidad_saliente = $request->cantidad_entrada;
        $product->condicion         = '1';
        $product->responsable       = $request->responsable;
        $product->save();
        return redirect()->route('almacen.index', compact('products'))->with('info', 'Producto actualizado con exito.!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Warehouse::all();
        $where = array('id' => $id);
        $product  = Warehouse::where($where)->first();
        $product->delete();
        return response()->json();
        //return view('almacen.index', compact('products'))->with('info', 'Producto eliminado con exito.!');
        //return redirect()->route('almacen.index', compact('products'))->with('info', 'Producto Eliminado con exito.!');
        //return Redirect::to('almacen', compact('products'))->with('info', 'Producto Eliminado con exito.!');
    }

}
