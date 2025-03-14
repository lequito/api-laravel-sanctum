<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller{

    /**
     * Display a listing of the resource.
     */
    public function index(){
        //return all clients in the database
        return response()->json(Client::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        //validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients',
            'phone' => 'required'
        ]);

        //add the client to the database
        $client = Client::create($request->all());

        //return a response
        return response()->json([
            'message' => 'Cliente criado com sucesso',
            'data' => $client
        ], 201);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){
        //show client detail
        $client = Client::find($id);
        //return a response
        if ($client) {
            return response()->json($client, 200);
        } else {
            return response()->json([
                'message' => 'Cliente não encontrado'
            ], 404);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
         //validate the request
         $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients,email,'.$id,
            'phone' => 'required'
        ]);

        //update the client data in the database
        $client = Client::find($id);
        if ($client) {
            $client->update($request->all());
            return response()->json([
                'message' => 'Cliente atualizado com sucesso',
                'data' => $client
            ], 200);
        } else {
            return response()->json([
                'message' => 'Cliente não encontrado'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        //delete the client from the database
        $client = Client::find($id);
        if ($client) {
            $client->delete();
            return response()->json([
                'message' => 'Cliente deletado com sucesso',
            ], 204);
        } else {
            return response()->json([
                'message' => 'Cliente não encontrado'
            ], 404);
        }
    }
}
