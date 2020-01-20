<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
class ClientController extends Controller
{
    public function __construct()
    {
        # code...
        $this->middleware('Administrador');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::where('status', 1)->get();
        return view('clients.index', compact('clients'));
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
        $clients = Client::where('status', 1)->get();
        //$client->save();
        //$client = Client::create($request->all());
        $client = Client::new();
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->dni = $request->dni;
        $client->client_type = $request->client_type;
        $client->address = $request->address;
        $client->status = 1;
        $client->telephone = $request->telephone;
        $client->save();
        return redirect()->route('clientes.index', compact('clients'))->with('info', 'Cliente registrado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        return view('clients.show', compact('client'));
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
        $client  = Client::where($where)->first();

        return response()->json($client);
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
        $clients = Client::where('status', 1)->get();
        $client = Client::find($request->id);
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->dni = $request->dni;
        $client->client_type = $request->client_type;
        $client->address = $request->address;
        $client->telephone = $request->telephone;
        $client->status = 1;
        $client->save();
        return redirect()->route('clientes.index', compact('clients'))->with('info', 'Cliente actualizado con exit.!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {

        $client = Client::find($id);
        $client->status = 0;
        $client->save();
    }
}
