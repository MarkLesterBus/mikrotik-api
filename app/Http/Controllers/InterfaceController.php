<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Router;
use RouterOS\Client;
use RouterOS\Query;

class InterfaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function interfaces($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/interface/print');
        $interface = $client->query($query)->read();

        return response()->json($interface, 200);
    }


    public function bridges($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/interface/bridge/print');
        $interface = $client->query($query)->read();
        return response()->json($interface, 200);
    }
    public function add_bridge(Request $request, $uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/interface/bridge/add'))
            ->equal('name', $request->name);
        $bridge = $client->query($query)->read();
        return response()->json($bridge, 200);
    }
    public function remove_bridge($uuid, $id)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/interface/bridge/remove'))
            ->equal('.id', $id);
        $bridge = $client->query($query)->read();
        return response()->json($bridge, 200);
    }




    public function ports($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client([
            'host' => $device->host,
            'user' => $device->user,
            'pass' => $device->pass,
            'port' => (int)$device->port
        ]);
        $query = new Query('/interface/bridge/port/print');
        $ports = $client->query($query)->read();
        return response()->json($ports, 200);
    }

    public function add_port(Request $request, $uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/interface/bridge/port/add'))
            ->equal('interface', $request->interface)
            ->equal('bridge', $request->bridge);
        $port = $client->query($query)->read();
        return response()->json($port, 200);
    }
    public function remove_port($uuid, $id)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/interface/bridge/port/remove'))
            ->equal('.id', $id);
        $port = $client->query($query)->read();
        return response()->json($port, 200);
    }



    public function vlans($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/interface/bridge/vlan/print');
        $vlan = $client->query($query)->read();
        return response()->json($vlan, 200);
    }

    public function add_vlan(Request $request, $uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/interface/bridge/vlan/add'))
            ->equal('bridge', $request->bridge)
            ->equal('vlan-ids', $request->vlan_ids)
            ->equal('tagged', $request->tagged)
            ->equal('untagged', $request->untagged);
        $vlan = $client->query($query)->read();
        return response()->json($vlan, 200);
    }
    public function remove_vlan($uuid, $id)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/interface/bridge/vlan/remove'))
            ->equal('.id', $id);
        $vlan = $client->query($query)->read();
        return response()->json($vlan, 200);
    }
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
