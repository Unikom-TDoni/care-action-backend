<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Auth;
use Validator;
use App\Models\Customer;
use App\Models\Category;
use App\Models\News;

class APIController extends Controller
{
    function getDataCategory()
    {
        $category = Category::orderBy('category_name')->get();

        $data = [];
        foreach($category as $row)
        {
            $row->icon = URL::asset('images/category').'/'.$row->icon;
            
            $data[] = $row;
        }

        $ret['status']  = "success";
        $ret['data']    = $data;

        return response()->json($ret);
    }

    function getDataNews(Request $request)
    {
        $news = News::with("category", "user")->select('news.*', 'category_name')->leftJoin('category', 'news.id_category', '=', 'category.id_category');
        $news = ($request->exists('id_category') && $request->id_category!="")?$news->where('news.id_category', $request->id_category):$news;
        $news = ($request->exists('keyword') && $request->keyword)?$news->where('title', 'LIKE', '%'.$request->keyword.'%')->orWhere('category_name', 'LIKE', '%'.$request->keyword.'%'):$news;
        $news = $news->orderBy('created_at', 'desc')->get();

        $data = [];
        foreach($news as $row)
        {
            $row->thumbnail = URL::asset('images/news').'/'.$row->thumbnail;
            
            $data[] = $row;
        }

        $ret['status']  = "success";
        $ret['data']    = $data;

        return response()->json($ret);
    }

    function changeProfileCustomer(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'birthdate' => 'required|date',
            'gender'    => 'required',
            'weight'    => 'required',
            'height'    => 'required',
        ]);

        if($validator->fails())
        {
            $response = [
                'status'    => 'error',
                'message'   => $validator->errors()->first()
            ];

            return response()->json($response, 400);       
        }

        $data = [
            'name'      => ($request->name!="")?$request->name:Auth::user()->name,
            'birthdate' => $request->birthdate,
            'gender'    => $request->gender,
            'weight'    => $request->weight,
            'height'    => $request->height,
        ];

        Customer::find(Auth::user()->id)->update($data);

        $ret['status']  = "success";
        $ret['message'] = "Profile changed successfully!";

        return response()->json($ret);
    }

    function changePasswordCustomer(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'old_password'          => 'required|string|min:6',
            'new_password'          => 'required|string|min:6',
            'confirm_new_password'  => 'required|string|min:6'
        ]);
        
        if($validator->fails())
        {
            $response = [
                'status'    => 'error',
                'message'   => $validator->errors()->first()
            ];

            return response()->json($response, 400);       
        }

        if($request->new_password != $request->confirm_new_password)
        {
            $ret['status']  = "error";
            $ret['message'] = "Confirm Password didn't match!";

            return response()->json($ret);
        }

        if(!Hash::check($request->old_password, Auth::user()->password))
        {
            $ret['status']  = "error";
            $ret['message'] = "Old Password Wrong!";
        }
        else
        {   
            $data['password'] = Hash::make($request->new_password);

            Customer::find(Auth::user()->id)->update($data);     
    
            $ret['status']  = "success";
            $ret['message'] = "Password changed successfully!";
        }

        return response()->json($ret);
    }
}
