<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departament;
use App\DetailPurchase;
use App\Warehouse;
use App\Product;
use App\ProductProduction;
use App\HistoryProduction;
use DB;
use Carbon\Carbon;
class DepartamentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'Supervisor']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departaments = Departament::all();
        return view('departaments.index', compact('departaments'));
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
        $departaments = Departament::all();
        $departament = new Departament();
        $departament->departament = $request->departament;
        $departament->save();
        return redirect()->route('departamentos.index', compact('departaments'))->with('info', 'Departamento registrado con exito.!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product_productions = Product::where('condition', 1)->get();

        $products = Warehouse::all();
        $departament = Departament::findOrFail($id);
        //$detail = Departament::with('detail_purchase')->where('id', $id)->get();
        $details = DetailPurchase::where('departament_id', $id)->get();
        $productions = ProductProduction::where('departament_id', $id)->get();
        //return $detail[0]->departament->departament;
        //return $details;
        return view('departaments.show', compact('details', 'departament', 'products', 'productions','product_productions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $departament  = Departament::where($where)->first();

        return response()->json($departament);
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
        $departaments = Departament::all();
        $departament = Departament::find($request->id);
        $departament->departament = $request->departament;
        $departament->save();
        return redirect()->route('departamentos.index', compact('departaments'))->with('info', 'Departamento actualizado con exito.!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departaments = Departament::all();
        $where = array('id' => $id);
        $departament  = Departament::where($where)->first();
        $departament->delete();
        return response()->json();
    }

    public function assigment(Request $request)
    {
        //dd($request->rest);
        $departaments = Departament::all();
        $warehouse = Warehouse::find($request->product_id); //por si actualizo pero voy a crear registro de cada salida
        //
        $product = ($request->all());

        //dd($request->all());
        try{
            DB::beginTransaction();
                $time = Carbon::now('America/Caracas');
                $product = Warehouse::find($request->product_id);
                $product->nombre_producto = $warehouse->nombre_producto;
                $product->presentacion = $warehouse->presentacion;
                //$product->cantidad_entrada = $request->quantity;
                $product->cantidad_saliente = $request->rest;
                $product->responsable = auth()->user()->user;
                $product->condicion = '1';
                $product->updated_at = $time->toDateString();
                $product->save();

                $detailPurschase = new DetailPurchase();
                $detailPurschase->product_id     = $request->product_id;
                $detailPurschase->departament_id = $request->departament_id;
                $detailPurschase->product_production_id = $request->product_production;
                $detailPurschase->user_id        = auth()->user()->id;
                $detailPurschase->quantity       = $request->quantity;
                $detailPurschase->save();
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
        }
        return back()->with('info', 'Material asignado con exito.!');
    }
    public function production($id)
    {
        # code...
        $production = Departament::find($id);
        $products = Product::where('condition', 1)->get();
        
        return view('departaments.production', compact('production', 'products'));
    }

    public function storeProduction(Request $request)
    {
        $production = new ProductProduction();
        $production->product_id = $request->product_id;
        
        $production->departament_id = $request->departament_id;
        $production->user_id = auth()->user()->id;
        $production->quantity_in = $request->quantity_in;
        $production->lost = $request->lost;
        $production->observation = $request->observation;
        $production->production_date = $request->production_date;
        $production->status = '1';
        $production->save();

        $history = new HistoryProduction();
        $history->product_id = $request->product_id;
        $history->quantity_in = $request->quantity_in;
        $history->production_date = $request->production_date;
        
        $history->save();

        return back()->with('info', 'Producto Agregado al Stock con exito.!');
    }

    public function changeStatus(Request $request)
    {
        //dd($request->all());
        $production = ProductProduction::find($request->production_id);
        //dd($production);
        $production->status = '0';
        $production->observation = $request->observation;
        $production->save();
        return back()->with('info', 'Producción anulada con exito.!');
    }
    public function lost()
    {
        $losts = ProductProduction::where('lost','>=', '1')->orderBy('production_date', 'Desc')->get();
        //dd($losts);
        return view('departaments.losts', compact('losts')); 
    }
    public function productionLost($id)
    {
        $product = ProductProduction::find($id);
        //dd($product);
        return view('departaments.production_lost', compact('product'));
    }
    public function storePerdida(Request $request)
    {
        $lost = ProductProduction::where('product_id', $request->product_id)->first();
        //dd($lost);
        $lost->lost         = $request->lost;
        $lost->observation  = $request->observation;
        $lost->save();
        
        $product = Product::find($request->product_id);

        $stock = $product->stock;
        $perdida = ($stock - $request->lost); 
        $product->stock = $perdida;
        //dd($perdida);
        $product->save();

        return back()->with('info', 'Perdida Agregada con exito.!');
        
    }
}
