<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Router;
use RouterOS\Client;
use RouterOS\Query;

class SystemController extends Controller
{
    public function resources($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);

        $query = new Query('/system/resource/print');
        $resource = $client->query($query)->read();

        $query = new Query('/system/clock/print');
        $clock = $client->query($query)->read();

        $resources = [
            'resource' => $resource[0],
            'clock' => $clock[0],
        ];

        // $query = new Query('/user/print');
        // $users = $client->query($query)->read();
        return response()->json($resources, 200);
    }
    public function system($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);

        $query = new Query('/system/identity/print');
        $identity = $client->query($query)->read();

        $query = new Query('/system/history/print');
        $history = $client->query($query)->read();

        $query = new Query('/system/scheduler/print');
        $scheduler = $client->query($query)->read();

        $system = [
            'identity' => $identity[0],
            'history' => $history,
            'scheduler' => $scheduler,
        ];

        // $query = new Query('/user/print');
        // $users = $client->query($query)->read();
        return response()->json($system, 200);
    }
    public function monitor($uuid, $interface)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);

        $query =
            (new Query('/interface/monitor-traffic'))
            ->equal('interface', $interface)
            ->equal('once');
        $monitor = $client->query($query)->read();

        // $query = new Query('/user/print');
        // $users = $client->query($query)->read();
        return response()->json($monitor[0], 200);
    }
    public function logs($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/log/print');

        $logs = $client->query($query)->read();

        return response()->json($logs, 200);
    }




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
        $query = new Query('/interface/vlan/print');
        $vlan = $client->query($query)->read();
        return response()->json($vlan, 200);
    }

    public function add_vlan(Request $request, $uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/interface/vlan/add'))
            ->equal('interface', $request->interface)
            ->equal('name', $request->name)
            ->equal('vlan-id', (int)$request->vlan_id);
        $vlan = $client->query($query)->read();
        return response()->json($vlan, 200);
    }
    public function remove_vlan($uuid, $id)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/interface/vlan/remove'))
            ->equal('.id', $id);
        $vlan = $client->query($query)->read();
        return response()->json($vlan, 200);
    }
}
