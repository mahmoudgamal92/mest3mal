<?php

namespace App\Orbscope\Controllers\Frontend;

use App\Notifications\BidNotification;
use App\Orbscope\Controllers\Controller;
use App\Orbscope\Models\Ad;
use App\Orbscope\Models\Ads_service;
use App\Orbscope\Models\Auction;
use App\Orbscope\Models\Category;
use App\Orbscope\Models\Department;
use App\Orbscope\Models\Offer;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Validator;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use App\Orbscope\Controllers\UploadFiles as Upload;
use App\Authorizable;

class AuctionController extends Controller
{

    public function add_auction(){

        $departs=Department::OrderBy('created_at','asc')->get();
        return view('front.auction.create',compact('departs'));
    }

    public function edit_auction($id){
        $edit=Auction::findOrFail($id);
        $departs=Department::OrderBy('created_at','asc')->get();
        return view('front.auction.edit',compact('departs','edit'));
    }

    public function store_auction(Request $request){
        $rules = [
            'title'    => 'required',
            'details'    => 'required',
            'duration'    => 'required',
            'country_id'    => 'required',
            'city_id'    => 'required',
            'images'    => 'required',



        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'title'  =>trans('orbscope.title'),
            'details'  =>trans('orbscope.details'),
            'duration'  =>trans('orbscope.duration'),
            'country_id'  =>trans('orbscope.country'),
            'city_id'  =>trans('orbscope.city'),
            'images'  =>trans('orbscope.images'),


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $date=Carbon::now();
            $start=Carbon::now()->format('Y-m-d H:i:s');
            $end=$date->addDay($request->duration)->format('Y-m-d H:i:s');
            $new=new Auction();
            $new->user_id                  =auth()->user()->id;
            $new->auction_number             = generateBarcodeNumber();
            $new->title                        =$request->title;
            $new->details                     =$request->details;
            $new->duration                     =$request->duration;
            $new->state_id                     =$request->country_id;
            $new->city_id                     =$request->city_id;
            $new->start_date                     =$start;
            $new->end_date                     =$end;
            $new->time                     =strtotime($end);
            $new->address                     =$request->address;

            $images                  = $request->file('images');
            if(!empty($images) && $images != ''){
                foreach ($images as $img){
                    $uploadedImages[]     = Upload::uploadImages('auction', $img,'checkImages','false');
                }
                if($uploadedImages == 'false'){
                    return back()->withInput();
                }else{
                    $new->main_image       = $uploadedImages[0];
                    $project_imgs = implode('|', $uploadedImages);
                    $new->images       = $project_imgs;
                }
            }

            $new->save();
            session()->flash('success',trans('orbscope.success'));
            return redirect('user/all_auctions');
        }



    }


    public function update_auction($id,Request $request){
        $new=Auction::findOrFail($id);
        $rules = [
            'title'    => 'required',
            'details'    => 'required',
            'duration'    => 'required',
            'country_id'    => 'required',
            'city_id'    => 'required',




        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'title'  =>trans('orbscope.title'),
            'details'  =>trans('orbscope.details'),
            'duration'  =>trans('orbscope.duration'),
            'country_id'  =>trans('orbscope.country'),
            'city_id'  =>trans('orbscope.city'),



        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {


            $date=$new->start_date;
            $date=Carbon::parse($date);
            $end=Carbon::parse($date);
            $end=$end->addDay($request->duration)->format('Y-m-d H:i:s');

            if (strtotime($end) < strtotime(Carbon::now())){
                session()->flash('time_end',trans('front.time_end'));
                return redirect('user/all_auctions');
            }
            $new->title                        =$request->title;
            $new->details                     =$request->details;
            $new->duration                     =$request->duration;
            $new->state_id                     =$request->country_id;
            $new->city_id                     =$request->city_id;
            $new->end_date                     =$end;
            $new->time                        =strtotime($end);
            $new->address                     =$request->address;
            if (strtotime($end) < strtotime(Carbon::now())){

               $new->status ='done';
            }else{
                $new->status ='active';
            }

            $images                  = $request->file('images');

            if(!empty($images) && $images != ''){
                foreach ($images as $img){
                    $uploadedImages[]     = Upload::uploadImages('auction', $img,'checkImages');
                }
                if($uploadedImages == 'false'){

                    return back()->withInput();
                }else{
                    $new->main_image       = $uploadedImages[0];
                    $project_imgs = implode('|', $uploadedImages);
                    $new->images       = $project_imgs;

                }
            }
            $new->save();

            session()->flash('success',trans('orbscope.success'));
            return redirect('user/all_auctions');
        }



    }

    public function index(){

        $departs=Department::OrderBy('created_at','asc')->get();
        $auctions=Auction::where('user_id',auth()->id())->orderBy('id','desc')->paginate(12);
        return view('front.auction.index',compact('departs','auctions'));
    }

    public function add_offer($id,Request $request){
        $rules = [
            'amount'    => 'required|numeric',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'amount'  =>trans('orbscope.amount_money'),

        ]);
        $aucto=Auction::findOrFail($id);
        $new=new Offer();
        $new->user_id =auth()->id();
        $new->amount =$request->amount;
        $new->auction_id =$id;
        $new->save();
        $ar_message='تم اضافة عرض جديد علي مزاد'.' '.$aucto->title.'  ';
        $en_massage='new offer on auction'.' '.$aucto->title;
        $url='auction/'.$aucto->id.'/'.$aucto->title;
        $user=User::find($aucto->user_id);
        $user->notify( new BidNotification($ar_message,$en_massage,$url));

        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();

    }

    public function delete_auction($id){
        $auct=Auction::findOrFail($id);
        $auct->delete();
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();
    }




}
