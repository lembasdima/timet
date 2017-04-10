<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function showCategories(){

        if(Auth::user()->hasRole(1) || Auth::user()->hasRole(2)) {
            $user_id = Auth::user()->id;

            $user_parent = DB::table('users')
                ->where('users.id', $user_id)
                ->first();

            if(!$user_parent->user_parent){
                $parent = $user_id;
            }
            else{
                $parent = $user_parent->user_parent;
            }

            $categories = DB::table('categories')
                ->join('categories_users', 'categories_users.category_id', '=', 'categories.id')
                ->where('categories_users.user_id', $parent)
                ->get();

            return view('/admin/showCategories', ['categories' => $categories]);
        }

        return view('404');
    }

    public function addCategories(){

        if(Auth::user()->hasRole(1)) {
            return view('/admin/addCategory');
        }
        return view('404');
    }

    public function saveCategories(Request $request){

        if(Auth::user()->hasRole(1)) {

            if(!empty($request->categoryCode && $request->categoryName)){
                $new_category_id = DB::table('categories')->insertGetId(
                    [
                        'code' => $request->categoryCode,
                        'name' => $request->categoryName,
                        'description' => $request->categoryDescr,
                    ]
                );

                DB::table('categories_users')->insert(
                    [
                        'category_id' => $new_category_id,
                        'user_id' => Auth::user()->id,
                        'company_id' => Auth::user()->company_id,
                    ]
                );
                return redirect()->action('Admin\CategoryController@showCategories');
                //return view('/admin/showDepartments');
            }
        }
        return view('404');
    }
}
