<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Router;
use RouterOS\Client;
use RouterOS\Query;

class HotspotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hotspot($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/ip/hotspot/print');
        $hotspot = $client->query($query)->read();
        return response()->json($hotspot, 200);
    }
    public function profile($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/ip/hotspot/profile/print');
        $profile = $client->query($query)->read();
        return response()->json($profile, 200);
    }

    public function add_hotspot(Request $request, $uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/ip/hotspot/add'))
            ->equal('name', $request->name)
            ->equal('interface', $request->_interface)
            ->equal('address-pool', $request->_address_pool)
            ->equal('profile', $request->profile)
            ->equal('addresses-per-mac', (int) $request->addresses_per_mac);
        $hotspot = $client->query($query)->read();
        return response()->json($hotspot, 200);
    }

    public function add_profile(Request $request, $uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/ip/hotspot/profile/add'))
            ->equal('name', $request->name)
            ->equal('hotspot-address', $request->hotspot_address)
            ->equal('dns-name', $request->dns_name)
            ->equal('html-directory', $request->html_directory)
            ->equal('login-by', $request->login_by)
            ->equal('http-cookie-lifetime', $request->http_cookie_lifetime);
        $profile = $client->query($query)->read();
        return response()->json($profile, 200);
    }


    public function remove_profile($uuid, $id)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/ip/hotspot/profile/remove'))
            ->equal('.id', $id);
        $profile = $client->query($query)->read();
        return response()->json($profile, 200);
    }

    public function remove_hotspot($uuid, $id)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/ip/hotspot/remove'))
            ->equal('.id', $id);
        $hotspot = $client->query($query)->read();
        return response()->json($hotspot, 200);
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
