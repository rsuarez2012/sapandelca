<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\HistoryProduction;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::where('condition', 1)->get();
        return view('products.index', compact('products'));
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
        $rules = [
            'cod'     => 'required',
            'product'    => 'required',
        ];
        $messages = [
            'cod.required' => 'Debe ingresar el codigo del producto.!',
            'product.required' => 'Debe ingresar el nombre del producto.!',
        ];

        $this->validate($request, $rules, $messages);

        $product = new Product();
        $product->cod = $request->cod;
        $product->presentation = $request->presentation;
        $product->package = $request->package;
        $product->buy = $request->buy;
        $product->exent_iva = $request->exent_iva;
        $product->stock = '0';
        $product->condition = '1';
        if($request->exent_iva != '1'){
            $product->product = $request->product.' '.'(G)';
            $product->iva = $request->iv;
        }
        else{
            $product->product = $request->product.' '.'(E)';
            $product->iva = '0';
        }
        $product->save();
        return back()->with('info', 'Producto registrado con exito.!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id',$id)->first();
        $products = HistoryProduction::where('product_id', $id)->orderBy('production_date', 'Desc')->paginate(10);
        //dd($products);
        return view('products.show', compact('product', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$where = array('id' => $id);
        $product  = Product::where('id', $id)->first();

        //return response()->json($product);
        return view('products.edit', compact('product'));
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
        $rules = [
            'cod'       => 'required',
            'product'   => 'required',
            'exent_iva' => 'required',
            'buy'       => 'required'
        ];
        $messages = [
            'cod.required' => 'Debe ingresar el codigo del producto.!',
            'product.required' => 'Debe ingresar el nombre del producto.!',
            'exent_iva.required' => 'Debe ingresar si es exento de iva o no.!',
            'buy.required' => 'Debe actualizar el precio.!',
        ];

        $this->validate($request, $rules, $messages);

        $product = Product::find($request->id);
        $product->cod = $request->cod;
        $product->presentation = $request->presentation;
        $product->package = $request->package;
        $product->buy = $request->buy;
        $product->exent_iva = $request->exent_iva;
        $product->stock = '0';
        $product->condition = '1';
        if($request->exent_iva != '1'){
            $product->product = $request->product;
            $product->iva = $request->iv;
        }
        else{
            $product->product = $request->product;
            $product->iva = '0';
        }
        $product->stock = $request->stock;
        $product->save();
        return back()->with('info', 'Producto editado con exito.!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
        $product = Product::findOrFail($id);
        $product->delete();
        return view('products.index')->with('info', 'El producto '.$product->product.' Eliminado correctamente.!');
    }
    public function eliminar($id)
    {
        //dd($id);
        $products = Product::where('condition', 1)->get();
        $product = Product::findOrFail($id);
        if($product->stock>1)
            return redirect()->back()->with('info', 'El producto no puede ser Eliminado ya que tiene stock.!');
        else
            $product->delete();
        //return view('products.index', compact('products'))->with('info', 'El producto Eliminado correctamente.!');
            return redirect()->back()->with('info', 'Producto Eliminado con exito.!');
    }
}
