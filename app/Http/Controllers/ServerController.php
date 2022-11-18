<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;

use App\Http\Resources\ServerResource;
use App\Http\Resources\ServerCollection;


class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return new ServerCollection(Server::all());
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
        $ipv4 = $request->get('ipv4');
        $domain_name = $request->get('domainName');

        $server = new Server(['ipv4' => $ipv4, 'domain_name' => $domain_name]);

        $resource = new ServerResource($server);

        $server_exists = Server::where('ipv4', $ipv4)->first();

        if ($server_exists){
            return $resource->additional([
                'status' => '400',
                'message' => 'IPV4 address already exists, type another one'
            ]);
        }

        if ($server->save()){
            return $resource->additional([
                'status' => '200',
            ]);
        }

        return $resource->additional([
            'status' => '401',
            'message' => 'Error while saving server'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function show(Server $server)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Server $server)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function destroy(Server $server)
    {
        //
    }
}
