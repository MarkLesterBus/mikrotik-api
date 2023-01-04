<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Router;
use RouterOS\Client;
use RouterOS\Query;

class QueuesController extends Controller
{
    public function simple_queues($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/queue/simple/print');
        $simple = $client->query($query)->read();
        return response()->json($simple, 200);
    }
    public function queue_tree($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/queue/tree/print');
        $tree = $client->query($query)->read();
        return response()->json($tree, 200);
    }
    
    // public function add_pool(Request $request, $uuid)
    // {
    //     $device = Router::where('uuid', $uuid)->first();
    //     $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
    //     $query = (new Query('/ip/pool/add'))
    //         ->equal('name', $request->name)
    //         ->equal('ranges', $request->ranges);
    //     $pool = $client->query($query)->read();
    //     return response()->json($pool, 200);
    // }
    // public function remove_pool($uuid, $id)
    // {
    //     $device = Router::where('uuid', $uuid)->first();
    //     $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
    //     $query = (new Query('/ip/pool/remove'))
    //         ->equal('.id', $id);
    //     $pool = $client->query($query)->read();
    //     return response()->json($pool, 200);
    // }

}
