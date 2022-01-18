<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Auth;
use Validator;
use File;
use App\Models\Quotes;
use App\Models\Activity;
use App\Models\Customer;
use App\Models\Category;
use App\Models\News;

class APIController extends Controller
{
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    function getQuotes()
    {
        $data = Quotes::all()->random(1);

        $ret['status']  = "success";
        $ret['data']    = $data;

        return response()->json($ret);
    }

    function getDataActivity(Request $request)
    {
        $classActivity = new Activity();

        $date           = !empty($request->date)?$request->date:date("Y-m-d");
        $id_customer    = Auth::user()->id;

        $trackers   = $classActivity->getTracker($date, $id_customer)->get();
        $tracker    = [];
        foreach($trackers as $row)
        {
            $tracker[$row->id_activity] = 1;
        }

        $activities = Activity::orderBy('order')->get();
        foreach($activities as $row)
        {
            $data[] = [
                'id'            => $row->id,
                'activity_name' => $row->activity_name,
                'icon'          => URL::asset('images/activity').'/'.$row->icon,
                'checked'       => isset($tracker[$row->id])?1:0
            ];
        }

        $ret['status']  = "success";
        $ret['data']    = $data;

        return response()->json($ret);
    }

    function setCheckActivity(Request $request)
    {
        $classActivity  = new Activity();

        $date           = !empty($request->date)?$request->date:date("Y-m-d");
        $id_customer    = Auth::user()->id;

        $update = $classActivity->checklistTracker($date, $id_customer, $request->id_activity, $request->checked);

        $ret['status']  = "success";
        
        return response()->json($ret);
    }

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
            $data[] = [
                "id_news"       => $row->id_news,
                "title"         => $row->title,
                'category_name' => $row->category_name,
                'thumbnail'     => URL::asset('images/news').'/'.$row->thumbnail,
            ];
        }

        $ret['status']  = "success";
        $ret['data']    = $data;

        return response()->json($ret);
    }

    function getRecommendedNews(Request $request)
    {
        $news = News::with("category", "user")
                ->select('news.*', 'category_name')
                ->leftJoin('category', 'news.id_category', '=', 'category.id_category')
                ->where('is_recommended', 1)
                ->orderBy('created_at', 'desc')
                ->offset(0)
                ->limit($request->limit)
                ->get();

        $data = [];
        foreach($news as $row)
        {
            $data[] = [
                "id_news"       => $row->id_news,
                "title"         => $row->title,
                'category_name' => $row->category_name,
                'thumbnail'     => URL::asset('images/news').'/'.$row->thumbnail,
            ];
        }

        $ret['status']  = "success";
        $ret['data']    = $data;

        return response()->json($ret);
    }

    function getDetailNews(Request $request)
    {
        $data = News::with("category", "user")
        ->select('news.*', 'category_name')
        ->leftJoin('category', 'news.id_category', '=', 'category.id_category')
        ->where('id_news', $request->id_news)
        ->first();
        
        if(!empty($data))
        {
            $data->thumbnail = URL::asset('images/news').'/'.$data->thumbnail;

            $ret['status']  = "success";
            $ret['data']    = $data;
        }
        else
        {
            $ret['status']  = "error";
            $ret['message'] = "News Not Found!";
        }

        return response()->json($ret);
    }

    function getProfileCustomer()
    {
        $customer = auth()->user();
        $customer->picture = ($customer->picture != "")?URL::asset('images/customer').'/'.$customer->picture:"";
        
        return $customer;
    }

    function registerProfileCustomer(Request $request)
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

    function changeProfileCustomer(Request $request) {

        $validator = Validator::make($request->all(),[
            'birthdate' => 'required|date',
            'gender'    => 'required',
            'weight'    => 'required',
            'height'    => 'required',
            'name' => 'required',
        ]);

        if($validator->fails())
        {
            $response = [
                'status'    => 'error',
                'message'   => $validator->errors()->first()
            ];

            return response()->json($response, 400);       
        }

        if ($request->hasFile('picture'))
        {
            $destinationPath    = "images/customer";
            $file               = $request->picture;
            $fileName           = Auth::user()->id.".".$file->getClientOriginalExtension();
            $pathfile           = $destinationPath.'/'.$fileName;

            if(Auth::user()->picture != "")
            {
                File::delete($destinationPath."/".Auth::user()->picture);
            }

            $file->move($destinationPath, $fileName); 

            $picture = $fileName;
        }
        else
        {
            $picture = Auth::user()->picture;
        }

        $customer = [
            'name'      => $request->name,
            'birthdate' => date('Y-m-d', strtotime($request->birthdate)),
            'gender'    => $request->gender,
            'weight'    => $request->weight,
            'height'    => $request->height,
            'picture'   => $picture,
        ];

        Customer::find(Auth::user()->id)->update($customer);

        $customer['picture'] = ($picture != "")?URL::asset('images/customer').'/'.$picture:"";

        $response = [
            'status'    => 'success',
            'message'   => 'Register successfully',
            'content'   => [
                'data'          => $customer,
            ]
        ];

        return response()->json($response, 200);
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
