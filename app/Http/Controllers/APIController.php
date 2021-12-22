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

        $ret['status']  = "success";
        $ret['data']    = $category;

        return response()->json($ret);
    }

    function getDataNews(Request $request)
    {
        $news = News::with("category", "user")
                ->where('id_category', $request->id_category)
                ->orderBy('created_at', 'desc')
                ->get();

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
            'name'      => 'required|string|max:255',
            'birthdate' => 'required|date',
            'gender'    => 'required',
            'weight'    => 'required',
            'height'    => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors());       
        }

        $data = [
            'name'      => $request->name,
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
            return response()->json($validator->errors());       
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
