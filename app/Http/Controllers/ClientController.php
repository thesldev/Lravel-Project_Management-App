<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    
    public function index(){
        // fetch client data from model
        $clients = Client::all();
        return view('clients.index', ['clients' => $clients]);

    }

    // Fetch all clients and return as JSON
    public function fetchClients()
    {
        $clients = Client::all();
        return response()->json($clients); // Return as JSON
    }


    public function create(){
        return view('clients.create');
    }

    // function to store new client
    public function storeData(Request $request){
        // validate user data
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:client,email',
            'phone' => 'nullable|digits_between:10,15',
            'project_description' => 'nullable|string|max:1000',
        ]);

        $newClient = Client::create($data);
        return redirect(route('client.index'));
    }

    // function for edit client data
    public function editData(Client $client){
        return view('clients.edit', ['client' => $client]);
    }

    // function for update client data
    public function updateData(Client $client, Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:client,email,' . $client->id,
            'phone' => 'nullable|digits_between:10,15',
            'project_description' => 'nullable|string|max:1000',
        ]);
    
        $client->update($data);
    
        return redirect(route('client.index'))->with('success', 'Client updated successfully.');
    }
    
    //function for delete client data
    public function deleteData(Client $client){
        $client->delete();
        return redirect(route('client.index'))->with('success', 'Client Deleted successfully.');
    }

    // function for get client by Id
    public function viewClient(Client $client){
        return view('clients.view', compact('client'));
    }

    // function for get all clients as JSON format
    public function getClients(){
        $clients = Client::select('id','name')->get();

        // return data in jason format
        return response()->json($clients);
    }
}
