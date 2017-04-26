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

        if(Auth::user()->hasRole(1)) {
            $user_id = Auth::user()->id;

            $clients = DB::table('clients')
                ->join('clients_users', 'clients.id', '=', 'clients_users.client_id')
                ->join('statuses', 'clients.status', '=', 'statuses.id')
                ->where('clients_users.user_id', $user_id)
                ->get();

            return view('/admin/showClients', ['clients' => $clients]);
        }
        return view('404');
    }

    public function addClient(){
        if(Auth::user()->hasRole(1)) {

            $status = DB::table('statuses')->get();

            return view('/admin/addClient',['status' => $status]);
        }
        return view('404');
    }
    /*Переделать на транзакции*/
    public function saveClient(Request $request){

        if(Auth::user()->hasRole(1)) {

            if(!empty($request->clientName && $request->clientCode)){
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
                        'user_id' => Auth::user()->id,
                        'company_id' => Auth::user()->company_id,
                    ]

                );
                return redirect()->action('Admin\CustomerController@showClients');
            }
        }
        return view('404');
    }
}
