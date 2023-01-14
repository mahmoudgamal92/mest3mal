<?php

namespace App\Orbscope\Controllers\Frontend;

use App\Notifications\BidNotification;
use App\Orbscope\Controllers\Controller;
use App\Orbscope\Models\Ad;
use App\Orbscope\Models\Ads_service;
use App\Orbscope\Models\Category;
use App\Orbscope\Models\Department;
use App\Orbscope\Models\OnlinePayment;
use App\Orbscope\Models\Order;
use App\Orbscope\Models\Payment;
use App\Orbscope\Models\Review;
use App\Orbscope\Models\Service;
use App\Orbscope\Models\SubCategory;
use App\Orbscope\Models\Wishlist;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Validator;
use Illuminate\Http\Request;
use Logs;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use File;
use Intervention\Image\ImageManager;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use App\Authorizable;

class UsersController extends Controller
{

    public function add_order($id){
        $ad=Ad::findOrFail($id);
        if ($ad->price <= user_balance()){
           $new= new Order();
           $new->order_number  =generateOrderNumber();
           $new->user_id=auth()->id();
           $new->seller_id =$ad->user_id;
            $new->ad_id = $ad->id;
           $new->amount =$ad->price;
           $new->save();

            $ra=$ad->price * GetSettings()->commission / 100;
            $net=$ad->price - $ra;

            //dd($net);

            $buy=new Payment();
            $buy->pay_number = generatePaymentNumber();
            $buy->user_id = auth()->id();
            $buy->reciver_id = $ad->user_id;
            $buy->order_id = $new->id;
            $buy->amount = $ad->price;
            $buy->net = $net;
            $buy->status = 'pending';
            $buy->save();

           $ad->status ='done';
           $ad->save();

            $ar_message='لديك طلب شراء قيد التنفيذ برقم'.' '.$new->order_number.'  ';
            $en_massage='You have a pending purchase order number'.' '.$new->order_number;
            $url='user/orders/'.$new->id.'/'.$new->order_number;
            $user=User::find($new->seller_id);
            $user->notify( new BidNotification($ar_message,$en_massage,$url));
            session()->flash('success',trans('orbscope.success'));
            return redirect('user/orders/'.$new->id.'/'.$new->order_number);
        }else{
            session()->flash('noblance',trans('front.noblance'));
            return redirect()->back();
        }
        //dd(user_balance());

    }

    public function ad_activation($id,$status){
       $ad=Ad::findOrFail($id);
       if ($ad->user_id == auth()->id()){
           $ad->status = $status;
           $ad->save();
           session()->flash('success',trans('orbscope.success'));
           return redirect()->back();
       }else{

           abort(404);
       }

    }

    public function order_received($id){
        if (Auth::check()){
            $order=Order::findOrFail($id);
            if ($order->user_id==auth()->id()){
                $order->status='done';
                $order->save();
                $finish = Carbon::now()->addDay(4);
                $buy=Payment::where('order_id',$order->id)->first();
                $buy->status ='done';
                $buy->time = strtotime($finish);
                $buy->save();
                $ar_message='تهانينا قام المشتري بااستلام المنتج الخاص بالطلب رقم'.' '.$order->order_number.'  ';
                $en_massage='Congratulations, the buyer has received the product of order No.'.' '.$order->order_number;
                $url='user/orders/'.$order->id.'/'.$order->order_number;
                $user=User::find($order->seller_id);
                $user->notify( new BidNotification($ar_message,$en_massage,$url));
                session()->flash('success',trans('orbscope.success'));
                return redirect()->back();
            }else{

                abort(404);
            }

        }else{
            abort(404);
        }


    }

    public function order_cancelled($id){
        if (Auth::check()){
            $order=Order::findOrFail($id);
            if ($order->user_id==auth()->id()){
                $order->status='canceled';
                $order->save();
                $buy=Payment::where('order_id',$order->id)->first();
                $buy->status ='cancel';
                $buy->save();
                $ar_message='للاسف تم الغاء الطلب رقم'.' '.$order->order_number.'  ';
                $en_massage='Unfortunately, the order number has been cancelled.'.' '.$order->order_number;
                $url='user/orders/'.$order->id.'/'.$order->order_number;
                $user=User::find($order->seller_id);
                $user->notify( new BidNotification($ar_message,$en_massage,$url));
                $ad=Ad::findOrFail($id);
                $ad->status ='active';
                $ad->save();
                session()->flash('success',trans('orbscope.success'));
                return redirect()->back();
            }else{

                abort(404);
            }

        }else{
            abort(404);
        }


    }

    public function orders(){
        $departs=Department::OrderBy('created_at','asc')->get();
        $orders = Order::where('user_id',auth()->id())->orwhere('seller_id',auth()->id())->orderBy('id','desc')->paginate(8);
        $operation = Order::where('user_id',auth()->id())->where('status','operation')->orwhere('seller_id',auth()->id())->where('status','operation')->orderBy('id','desc')->paginate(8);
        $done = Order::where('user_id',auth()->id())->where('status','done')->orwhere('seller_id',auth()->id())->where('status','done')->orderBy('id','desc')->paginate(8);
        $canceled = Order::where('user_id',auth()->id())->where('status','canceled')->orwhere('seller_id',auth()->id())->where('status','canceled')->orderBy('id','desc')->paginate(8);
        //dd($operation,$done,$canceled,$orders);

        return view('front.user.orders',compact('departs','orders','done','operation','canceled'));
    }

    public function get_order($id){
        $show=Order::findOrFail($id);
        $departs=Department::OrderBy('created_at','asc')->get();
        return view('front.user.show_order',compact('departs','show'));
    }

    public function wallet(){
        $user=User::find(auth()->id());

        $payment=Payment::where('user_id',$user->id)->orWhere('reciver_id',auth()->id())->get();
        $online=OnlinePayment::where('user_id',$user->id)->get();
        //$mergedCollection = $online->concat($payment)->sortBy('created_at');
        $all = $payment->merge($online);
        $all = array_reverse(array_sort($all, function ($value) {
            return $value['created_at'];
        }));
        //dd($all);
        $departs=Department::OrderBy('created_at','asc')->get();
        return view('front.user.wallet',compact('departs','user','all'));
    }

    public function ads_type($status){
        $departs=Department::OrderBy('created_at','asc')->get();
        $ads=Ad::where('user_id',auth()->id())->where('status',$status)->orderBy('id','DESC')->paginate(10);
        return view('front.ads.index',compact('departs','ads'));
    }

    public function add_review($id,Request $request){
        $order=Order::findOrFail($id);
        if ($order->user_id==auth()->id()){
            $rules = [
                'rate' => 'required',
                'details' => 'required',
            ];
            $validator = Validator::make($request->all(),$rules);
            $validator->SetAttributeNames([
                'rate'       =>trans('front.evaluation'),
                'details'       =>trans('front.write_comment'),
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }
          $re=new Review();
          $re->owner_id=$order->user_id;
          $re->user_id=$order->seller_id;
          $re->order_id=$order->id;
          $re->rate=$request->rate;
          $re->details=$request->details;
          $re->save();
            $ar_message='لديك تقييم جديد خاص بالطلب برقم'.' '.$order->order_number.'  ';
            $en_massage='You have a new evaluation of the order Nu'.' '.$order->order_number;
            $url='user/orders/'.$order->id.'/'.$order->order_number;
            $user=User::find($order->seller_id);
            $user->notify( new BidNotification($ar_message,$en_massage,$url));
            session()->flash('success',trans('orbscope.success'));
            return redirect()->back();
        }else{

           abort(404);
        }


    }

    public function profile(){
        $user=User::find(auth()->id());
        $departs=Department::OrderBy('created_at','asc')->get();
        return view('front.user.profile',compact('departs','user'));
    }

    public function update_profile (Request $request){
        $user = User::findOrFail(auth()->id());
        $rules = [
            'name' => 'required|string|max:60',
            'phone' => 'required|max:15|min:6',
            'email'        => 'required|unique:users,email,'.$user->id.',id',
            //'password' => 'required|string|min:6|confirmed',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'name'       =>trans('orbscope.name'),
            'phone'      =>trans('orbscope.phone'),
            'email'   =>trans('orbscope.email'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $user->name           = $request->input('name');
            $user->email          = $request->input('email');
            $user->phone          = $request->input('phone');
            //$user->identy_id          = $request->input('identy_id');
            if ($request->input('password') != '') {
                $user->password       = bcrypt($request->input('password'));
            }
            if ($request->image != '') {
                $uploaded_image  = Upload::uploadImages('agents', $request->image,'checkImages');
                if($uploaded_image == 'false'){
                    return back()->withInput();
                }else{
                    $user->image = $uploaded_image;
                }
            }
            $user->save();

            session()->flash('success',trans('orbscope.success'));
            return redirect()->back();

        }
    }

    public function all_ads(){
        $departs=Department::OrderBy('created_at','asc')->get();

        $ads=Ad::where('user_id',auth()->id())->orderBy('id','DESC')->paginate(10);
        //$active_ads=Ad::where('user_id',auth()->id())->where('status','active')->count();
        //$inactive_ads=Ad::where('user_id',auth()->id())->where('status','inactive')->count();

        return view('front.ads.index',compact('departs','ads'));
    }

    public function add_ads(){


        $departs=Department::OrderBy('created_at','asc')->get();

        return view('front.ads.stepone',compact('departs'),['title'=>trans('orbscope.add').' '.trans('front.ad')]);
    }


      public function store_realstate_ad(Request $request){

          $rules = [
              'title'         => 'required|min:10',
              'country_id'     => 'required',
              'city_id'        => 'required',
              'price'        => 'required',
          ];
          $validator = Validator::make($request->all(),$rules);
          $validator->SetAttributeNames([
              'title'       =>trans('orbscope.title'),
              'country_id'      =>trans('orbscope.country'),
              'city_id'   =>trans('orbscope.city'),
              'price'   =>trans('orbscope.price'),
          ]);
          if ($validator->fails()) {
              return back()->withInput()->withErrors($validator);
          } else {




              $new=new Ad();
              $new->user_id                  =auth()->user()->id;
              $new->ad_number             = generateBarcodeNumber();
              $new->title                 =$request->title;
              $new->details                =$request->details;
              $new->price                  =$request->price;
              $new->state_id                =$request->country_id;
              if (isset($request->Category)){

                 $cat=Category::findOrFail($request->Category);

                  $new->cat_id                  =$request->Category;
                  $new->depart_id                  =$cat->depart_id;
              }elseif(isset($request->subcat)){

                  $sub=SubCategory::findOrFail($request->subcat);
                  $new->cat_id                   =$sub->cat_id;
                  $new->depart_id                  =$sub->depart_id;
                  $new->subcat_id                  =$request->subcat;
              }
              $new->city_id                  =$request->city_id;
              $new->age                      =$request->age;
              $new->surface_area              =$request->surface_area;
              $new->number_halls               =$request->number_halls;
              $new->number_bathrooms           =$request->number_bathrooms;
              $new->bedrooms                     =$request->bedrooms;
              $new->address                     =$request->address;

              $images                  = $request->file('images');
              if(!empty($images) && $images != ''){
                  foreach ($images as $img){
                      $uploadedImages[]     = Upload::uploadImages('projects', $img,'checkImages','false');
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

              if (!empty($request->service) && $request->service!=null){
                foreach ($request->service as $key=>$s){

                    $service= new Ads_service();
                    $service->ad_id =$new->id;
                    $service->service_id =$s;
                    $service->save();

                }

              }

             return redirect('user/all_ads');

          }

    }


    public function store_car_ad(Request $request){


        $rules = [
            'title'         => 'required|min:10',
            'country_id'     => 'required',
            'city_id'        => 'required',
            'price'        => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'title'       =>trans('orbscope.title'),
            'country_id'      =>trans('orbscope.country'),
            'city_id'   =>trans('orbscope.city'),
            'price'   =>trans('orbscope.price'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {


            $new=new Ad();
            $new->user_id                  =auth()->user()->id;
            $new->ad_number             = generateBarcodeNumber();
            $new->title                 =$request->title;
            $new->details                =$request->details;
            $new->price                  =$request->price;
            $new->state_id                =$request->country_id;
            if (isset($request->Category)){

                $cat=Category::findOrFail($request->Category);

                $new->cat_id                  =$request->Category;
                $new->depart_id                  =$cat->depart_id;
            }elseif(isset($request->subcat)){

                $sub=SubCategory::findOrFail($request->subcat);
                $new->cat_id                   =$sub->cat_id;
                $new->depart_id                  =$sub->depart_id;
                $new->subcat_id                  =$request->subcat;
            }
            $new->city_id                  =$request->city_id;
            $new->car_type                  =$request->car_conditions;
            $new->seats_number                      =$request->seats;
            $new->car_gear                    =$request->car_gear;
            $new->engine_type              =$request->engine_type;
            $new->drive_system                     =$request->drive_system;
            $new->model                     =$request->model;
            $new->address                     =$request->address;

            $images                  = $request->file('images');
            if(!empty($images) && $images != ''){
                foreach ($images as $img){
                    $uploadedImages[]     = Upload::uploadImages('projects', $img,'checkImages','false');
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


            return redirect('user/all_ads');

        }


    }


    public function all_type_ads(Request $request){

        $rules = [
            'title'         => 'required|min:10',
            'country_id'     => 'required',
            'city_id'        => 'required',
            'price'        => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'title'       =>trans('orbscope.title'),
            'country_id'      =>trans('orbscope.country'),
            'city_id'   =>trans('orbscope.city'),
            'price'   =>trans('orbscope.price'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {



            $new=new Ad();
            $new->user_id                  =auth()->user()->id;
            $new->ad_number             = generateBarcodeNumber();
            $new->title                 =$request->title;
            $new->details                =$request->details;
            $new->price                  =$request->price;
            $new->state_id                =$request->country_id;
            if (isset($request->Category)){

                $cat=Category::findOrFail($request->Category);

                $new->cat_id                  =$request->Category;
                $new->depart_id                  =$cat->depart_id;
            }elseif(isset($request->subcat)){

                $sub=SubCategory::findOrFail($request->subcat);
                $new->cat_id                   =$sub->cat_id;
                $new->depart_id                  =$sub->depart_id;
                $new->subcat_id                  =$request->subcat;
            }
            $new->city_id                  =$request->city_id;
            $new->address                     =$request->address;

            $images                  = $request->file('images');
            if(!empty($images) && $images != ''){
                foreach ($images as $img){
                    $uploadedImages[]     = Upload::uploadImages('projects', $img,'checkImages','false');
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


            return redirect('user/all_ads');
        }
    }

    public function update_ads($id,Request $request){
        $new=Ad::findOrFail($id);
        $rules = [
            'title'         => 'required|min:10',
            'country_id'     => 'required',
            'city_id'        => 'required',
            'price'        => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'title'       =>trans('orbscope.title'),
            'country_id'      =>trans('orbscope.country'),
            'city_id'   =>trans('orbscope.city'),
            'price'   =>trans('orbscope.price'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $new->title                 =$request->title;
            $new->details                =$request->details;
            $new->price                  =$request->price;
            $new->state_id                =$request->country_id;
            $new->city_id                  =$request->city_id;
            if (isset($request->realtstate)){

                $new->age                      =$request->age;
                $new->surface_area              =$request->surface_area;
                $new->number_halls               =$request->number_halls;
                $new->number_bathrooms           =$request->number_bathrooms;
                $new->bedrooms                     =$request->bedrooms;


                if (!empty($request->service) && $request->service!=null){
                    @$new->services()->delete();

                    foreach ($request->service as $key=>$s){

                        $service= new Ads_service();
                        $service->ad_id =$new->id;
                        $service->service_id =$s;
                        $service->save();

                    }

                }

            }
            if (isset($request->cars)){

                $new->car_type                  =$request->car_conditions;
                $new->seats_number                      =$request->seats;
                $new->car_gear                    =$request->car_gear;
                $new->engine_type              =$request->engine_type;
                $new->drive_system                     =$request->drive_system;
                $new->model                     =$request->model;

            }
            $new->address                     =$request->address;

            $images                  = $request->file('images');
            if(!empty($images) && $images != ''){
                foreach ($images as $img){
                    $uploadedImages[]     = Upload::uploadImages('projects', $img,'checkImages','false');
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
            return redirect('user/all_ads');
        }

    }

    public function select_subcategory($id){

       $subcat=SubCategory::findOrFail($id);
        $category=Category::find($subcat->cat_id);


       if ($category->type == 'cars'){

           $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
           return view('front.ads.cars',compact('subcat','departs'));

       }elseif ($category->type == 'realstate'){

           $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
           return view('front.ads.realstate',compact('subcat','departs'));

       }else{

           $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
           return view('front.ads.create_all',compact('subcat','departs'));
       }


    }


    public function select_category($id){

        $cat=Category::findOrFail($id);


        $sub=SubCategory::where('cat_id',$id)->where('status','active')->get();

        if (count($sub)>0){
            $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
            return view('front.ads.ajax_sub_cats',compact('sub','departs'));

        }elseif($cat->type=='realstate'){

            $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
            return view('front.ads.realstate',compact('cat','departs'));
            //return redirect('user/add_ads/'.$cat->id.'/realstate');

        }elseif ($cat->type=='cars'){

            $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
            return view('front.ads.cars',compact('cat','departs'));

        }else{
            $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
            return view('front.ads.create_all',compact('cat','departs'));
        }
    }



    public function get_cats(Request $request){

        $id                 = $request->input('depart_id');

        $cats   = Category::where('depart_id',$id)->where('status','active')->get();
        return view('front.project.cats',['cats'=>$cats]);

    }



    public function favorite_ads(){
        $departs=Department::OrderBy('created_at','asc')->get();
        $user=Wishlist::where('user_id',auth()->id())->select('ad_id')->get();
        $ads=Ad::whereIn('id',$user)->OrderBy('id','desc')->get();
        return view('front.user.wishlist',compact('ads','departs'));
    }





    public function setting(){

        $user=User::find(auth()->user()->id);
        return view('front.setting.index',compact('user'));
    }

    public function setting_update(Request $request){
        $user=User::find(auth()->id());
        $user->name =$request->name;
        $user->gender =$request->gender;
        $user->birth =$request->birth;
        $user->country_id =$request->country_id;
        $user->language_id =$request->language_id;
        $user->whats_app =$request->whats_app;
        $user->phone =$request->phone;
        $user->lang =$request->lang_setting;
        if(!empty($request->hasFile('main_image')) && $request->hasFile('main_image') != ''){

            $uploaded_logo       = Upload::uploadImages('users', $request->file('main_image'),'allowExtFilesImage');
            if($uploaded_logo == 'false'){
                return back()->withInput();
            }else{
                @unlink('uploads/'.$user->image);
                $user->image       = $uploaded_logo;
            }
        }
       $user->save();
        session()->flash('updated',trans('orbscope.updated'));
        return redirect()->back();

    }

    public function setting_email(){
        $user=User::find(auth()->user()->id);
        return view('front.setting.email',compact('user'));
    }

    public function account_verfication(){
        $user=User::find(auth()->user()->id);
        return view('front.setting.account_verfication',compact('user'));
    }

    public function store_verfication(Request $request){
        $main_image             = $request->file('file');
        $new=new User_Verfication();
        if(!empty($main_image) && $main_image != ''){
            $uploaded_image               = Upload::uploadImages('video', $main_image,'allowExtFiles');
            if($uploaded_image == 'false'){
                return back()->withInput();
            }else{
                $new->file       = $uploaded_image;
            }
        }
        $new->user_id =auth()->id();
        $new->save();
        session()->flash('done',trans('orbscope.done'));
        return redirect()->back();
    }

    public function download_cv($id){
        $file_path = public_path('uploads').'/cv/'.$id;
        return response()->download($file_path);
    }

    public function edit_ad($id){
        $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
        $edit=Ad::findOrFail($id);
        return view('front.ads.edit',compact('edit','departs'));
    }

    public function delete_ad($id){

        $ad=Ad::findOrFail($id);
        if (count($ad->orders)>0){
            session()->flash('cant_delete',trans('orbscope.error'));
            return redirect()->back();

        }else{
            $ad->delete();
        }
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();
    }







}
