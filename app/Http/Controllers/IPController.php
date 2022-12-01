<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Router;
use RouterOS\Client;
use RouterOS\Query;

class IPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function address_list($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/ip/address/print');
        $addresses = $client->query($query)->read();

        return response()->json($addresses, 200);
    }
    public function pool($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/ip/pool/print');
        $pool = $client->query($query)->read();

        return response()->json($pool, 200);
    }
    public function dns($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/ip/dns/print');
        $dns = $client->query($query)->read();

        return response()->json($dns, 200);
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
