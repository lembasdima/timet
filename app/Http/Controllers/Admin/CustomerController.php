<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function showClients(){
        $user_id = Auth::user()->id;

        $clients = DB::table('clients')
            ->join('clients_users', 'clients.id', '=', 'clients_users.client_id' )
            ->where('clients_users.user_id', $user_id)
            ->get();

        return view('admin\showClients',['clients' => $clients]);
    }

    public function addClient(){


        return view('admin\addClient');
    }
    /*Переделать на транзакции*/
    public function saveClient(Request $request){
        $user_id = Auth::user()->id;

        $new_client_id = DB::table('clients')->insertGetId(
            [
                'name' => $request->clientName,
                'code' => $request->clientCode,
                'status' => $request->clientStatus,
            ]
        );

        DB::table('clients_users')->insert(
            [
                'client_id' => $new_client_id,
                'user_id' => $user_id,
            ]

        );
        return redirect()->action('Admin\CustomerController@showClients');
    }
}
