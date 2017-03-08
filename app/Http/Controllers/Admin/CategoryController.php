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

        $user_id = Auth::user()->id;

        $categories = DB::table('categories')
            ->join('categories_users', 'categories_users.category_id', '=', 'categories.id')
            ->where('categories_users.user_id', $user_id)
            ->get();

        return view('/admin/showCategories', ['categories' => $categories]);

    }

    public function addCategories(){

        return view('/admin/addCategory');
    }

    public function saveCategories(Request $request){

        $user_id = Auth::user()->id;

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
                'user_id' => $user_id,
            ]
        );
        return redirect()->action('Admin\CategoryController@showCategories');
        //return view('/admin/showDepartments');
    }
}
