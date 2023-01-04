<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Router;
use RouterOS\Client;
use RouterOS\Query;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function users($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/ip/hotspot/user/print');
        $users = $client->query($query)->read();
        return response()->json($users, 200);
    }

    public function add_user(Request $request, $uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/ip/hotspot/user/add'))
            ->equal('server', $request->server)
            ->equal('name', $request->name)
            ->equal('password', $request->password)
            ->equal('profile', $request->voucher_profile)
            ->equal('limit-uptime', $request->limit_uptime)
            ->equal('limit-bytes-total', $request->limit_bytes_total)
            ->equal('disabled', 'no')
            ->equal('comment', $request->comment);
        $user = $client->query($query)->read();

        return response()->json($user, 200);
    }


    public function remove_user($uuid, $id)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/ip/hotspot/user/remove'))
            ->equal('.id', $id);
        $profile = $client->query($query)->read();
        return response()->json($profile, 200);
    }

    public function user_profile($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/ip/hotspot/user/profile/print');
        $profiles = $client->query($query)->read();
        return response()->json($profiles, 200);
    }
    public function add_user_profile(Request $request, $uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/ip/hotspot/user/profile/add'))
            ->equal('name', $request->profile_name)
            ->equal('shared-users', $request->shared_users)
            ->equal('keepalive-timeout', $request->keepalive_timeout)
            ->equal('status-autorefresh', $request->status_autorefresh)
            ->equal('add-mac-cookie', $request->add_mac_cookie ? 'no' : 'yes')
            ->equal('mac-cookie-timeout', $request->mac_cookie_timeout)
            ->equal('rate-limit', $request->rate_limit)
            ->equal('on-login', $request->on_login)
            ->equal('on-logout', $request->on_logout);

        $profile = $client->query($query)->read();
        return response()->json($profile, 200);
    }
    public function remove_user_profile($uuid, $id)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/ip/hotspot/user/profile/remove'))
            ->equal('.id', $id);
        $profile = $client->query($query)->read();
        return response()->json($profile, 200);
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
