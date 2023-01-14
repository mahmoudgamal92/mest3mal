<?php

namespace App\Orbscope\Controllers;
use App\Notifications\OrderNotfication;
use App\Orbscope\Models\Ad;
use App\Orbscope\Models\Auction;
use App\Orbscope\Models\Balance;
use App\Orbscope\Models\Category;
use App\Orbscope\Models\City;
use App\Orbscope\Models\Click_ads;
use App\Orbscope\Models\ContactUs;
use App\Orbscope\Models\Country;
use App\Orbscope\Models\CV_style;
use App\Orbscope\Models\Deliver_Date;
use App\Orbscope\Models\Department;
use App\Orbscope\Models\Form_Detail;
use App\Orbscope\Models\Freelancer_Skill;
use App\Orbscope\Models\Language;
use App\Orbscope\Models\Message;
use App\Orbscope\Models\News;
use App\Orbscope\Models\Offer;
use App\Orbscope\Models\Order;
use App\Orbscope\Models\Rate;
use App\Orbscope\Models\Resource;
use App\Orbscope\Models\Review;
use App\Orbscope\Models\Service;
use App\Orbscope\Models\Service_Skill;
use App\Orbscope\Models\SubCategory;
use App\Orbscope\Models\User_Order;
use App\Orbscope\Models\User_Point;
use App\Orbscope\Models\Wishlist;
use App\Orbscope\Models\Withdrawal;
use Carbon\Carbon;
use Nexmo\Response;
use Notification;
use DB;
use App\Orbscope\Models\Log;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use Logs;
use File;
use Intervention\Image\ImageManager;
use Agents;
use Route;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Validator;

class FrontendController extends Controller
{


    public function index(){
        $time=strtotime(Carbon::now());
        $auctions=Auction::where('status','active')->where('time','>',$time)->OrderBy('id','desc')->take(5)->get();
        $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
        $ads=Ad::where('status','active')->OrderBy('id','DESC')->take(16)->get();


      return view('front.index',compact('departs','ads','auctions'));
    }

    public function chat(){

        return view('front.chat');

    }

    public function auctions_state($id){
        $state=Country::findOrFail($id);
        $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
        $time=strtotime(Carbon::now());
        $auctions=Auction::where('status','active')->where('state_id',$state->id)->where('time','>',$time)->paginate(12);
        return view('front.auctions',compact('departs','auctions','state'),['title'=>trans('front.Auctions')]);
    }

    public function auctions(){
        $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
        $time=strtotime(Carbon::now());
        $auctions=Auction::where('status','active')->where('time','>',$time)->paginate(12);
        return view('front.auctions',compact('departs','auctions'),['title'=>trans('front.Auctions')]);
    }

    public function get_auction($id){
        $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
        $show=Auction::findOrFail($id);
        $time=strtotime(Carbon::now());
        if ($show->time<$time){
            $show->status='done';
            $show->save();
        }
        $offers=Offer::where('auction_id',$id)->orderBy('id','desc')->paginate(12);


        return view('front.single_auction',compact('departs','show','offers'),['title'=>$show->title]);

    }

    public function add_to_favorites(Request $request){
     $new=new Wishlist();
     $new->user_id =auth()->id();
     $new->ad_id=$request->ad_id;
     $new->save();
     return 'done';
    }

    public function delete_favorites(Request $request){
     $wish=Wishlist::where('ad_id',$request->ad_id)->where('user_id',auth()->id())->first();
     $wish->delete();

     return 'done';

    }

    public function ads_ajax(Request $request){

        $cats=Category::where('depart_id',$request->main_cat)->where('status','active')->get();

        return view('front.ads.ajax_category',compact('cats'));

    }

    public function ads_country_ajax(Request $request){

        $city=City::where('country_id',$request->shop)->where('status','active')->get();


        return view('front.ads.ajax_country',compact('city'));
    }

    public function ads_sub_category_ajax(Request $request){

       $cat=Category::findOrFail($request->second_cat);


       $sub=SubCategory::where('cat_id',$request->second_cat)->where('status','active')->get();
       if (count($sub)>0){

           return view('front.ads.ajax_sub_cats',compact('sub'));

       }elseif($cat->type='realstate'){

           return view('front.ads.realstate',compact('cat'));
           //return redirect('user/add_ads/'.$cat->id.'/realstate');

       }elseif ($cat->type='car'){


       }else{

           return view('front.ads.steptwo',compact('cat'));
       }
    }




    public function get_main($id){
       $show=Department::findOrFail($id);
        $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
        $cats=Category::where('depart_id',$id)->where('status','active')->with('subCats')->get();
        $ads=Ad::where('depart_id',$id)->where('status','active')->OrderBy('id','desc')->paginate(12);
       return view('front.main_cats',compact('departs','cats','ads'),['title'=>VarByLang($show->name,GetLanguage())]);
    }

    public function category_by_city($state,$category){
        $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
        $cat=Category::find($category);
        if ($cat){
            $cat=$cat;
        }else{

            $cat=SubCategory::find($category);
            $cat=Category::findOrFail($cat->cat_id);
        }
        $show=$cat;
        $state=Country::findOrFail($state);
        $sub=SubCategory::where('cat_id',$cat)->where('status','active')->get();

        $ads=Ad::where('cat_id',$cat->id)->where('status','active')->where('state_id',$state->id)->OrderBy('id','desc')->paginate(12);;

        return view('front.second_cats',compact('departs','sub','ads','state','show'),['title'=>VarByLang($cat->name,GetLanguage())]);
    }

    public function subcat_by_city($state,$category){

        $show=SubCategory::findOrFail($category);
        $state=Country::findOrFail($state);
        $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
        $ads=Ad::where('subcat_id',$category)->where('state_id',$state->id)->where('status','active')->OrderBy('id','desc')->paginate(12);
        return view('front.subCats',compact('departs','ads','show','state'),['title'=>VarByLang($show->name,GetLanguage())]);
    }


    public function get_category($id){
        $show=Category::findOrFail($id);
        $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
        $sub=SubCategory::where('cat_id',$id)->where('status','active')->get();
        $ads=Ad::where('cat_id',$id)->where('status','active')->OrderBy('id','desc')->paginate(12);;
        return view('front.second_cats',compact('departs','sub','ads','show'),['title'=>VarByLang($show->name,GetLanguage())]);
    }

    public function get_subcat($id){

        $show=SubCategory::findOrFail($id);
        $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
        $ads=Ad::where('subcat_id',$id)->where('status','active')->OrderBy('id','desc')->paginate(12);;
        return view('front.subCats',compact('departs','ads','show'),['title'=>VarByLang($show->name,GetLanguage())]);
    }

    public function get_ad($id){
        $show=Ad::findOrFail($id);
        if (Auth::check()){
            $ad_clik=Click_ads::where('user_id',auth()->id())->where('ad_id',$id)->count();
            if ($ad_clik==0){
                $new=new Click_ads();
                $new->user_id =auth()->id();
                $new->ad_id=$id;
                $new->save();
            }
        }
        $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
        $related=Ad::where('cat_id',$show->cat_id)->where('status','active')->where('id','!=',$id)->OrderBy('id','Asc')->take(6)->get();
        return view('front.single_ad',compact('show','departs','related'),['title'=>$show->title]);
    }

    public function index_search(){
        $departs=Department::where('status','active')->with('category')->OrderBy('id','Asc')->get();
        $ads =Ad::query()->where(function($q){
            if(request()->has('title') && request('title')!=null)
            {
                return $q->where('ads.title','like','%' .request()->input('title'). '%');
            }})
            ->where(function($q){
                if(request()->has('depart_id') && request('depart_id')!=null){
                    return $q->where('ads.depart_id',request()->input('depart_id'));
                }})
            ->where(function($q){
                if(request()->has('state_id') && request('state_id')!=null){
                    return $q->where('ads.state_id',request()->input('state_id'));
                }})
            ->where(function($q){
                if(request()->has('city_id') && request('city_id')!=null){
                    return $q->where('ads.city_id',request()->input('city_id'));
                }})
            ->where(function($q){
                if(request()->has('cat_id') && request('cat_id')!=null){
                    return $q->where('ads.cat_id',request()->input('cat_id'));
                }
            })->where('status','active')->paginate(12);

       return view('front.search_result',compact('ads','departs'));




    }

    public function depart_main_page(Request $request){

        $cats=Category::where('depart_id',$request->shop)->where('status','active')->get();

        return view('front.ajax.categories',compact('cats'));

    }

    public function state_main_page(Request $request){

        $cities=City::where('country_id',$request->country_id)->where('status','active')->get();

        return view('front.ajax.cities',compact('cities'));
    }






    public function Terms_Conditions(){
        $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
        return view('front.terms_conditions',compact('departs'),['title'=>trans('orbscope.terms_conditions')]);
    }

    public function how_does_work(){

        $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
        return view('front.how_does_work',compact('departs'),['title'=>trans('front.How_does_work')]);
    }

    public function news_add_email(Request $request){
        $rules = [
            'email' => 'required|string|email|max:255|unique:news',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'email'       =>trans('orbscope.email'),
        ]);
        if ($validator->fails()) {
            session()->flash('email_error',trans('front.email_error'));
            return back();
        } else {

           $news=new News();
           $news->email=$request->email;
           $news->save();

            session()->flash('success',trans('orbscope.success'));
            return redirect()->back();

        }

    }









    public function withdrawals(Request $request){
        $date=date('Y-m-d H:i:s');
        $date_num= strtotime($date);
        $withda=Balance::where('user_id',auth()->user()->id)->where('status','done')->where('recived_date','<=',$date_num)->sum('net');


        if ($withda==0){
            session()->flash('error', trans('orbscope.error'));
            return redirect()->back();
        }else {


            $with = Withdrawal::where('user_id', auth()->user()->id)->get();

            $withdar = $withda - $with->sum('amount');


            if ($withdar == 0) {
                session()->flash('error', trans('orbscope.error'));
                return redirect()->back();
            } elseif ($withdar > 0 && $request->amount <= $withdar) {

                $with = new Withdrawal();

                $with->amount = $request->amount;
                $with->email = $request->email;
                $with->user_id = auth()->user()->id;
                $with->status = 'pending';
                $with->save();

                session()->flash('success', trans('orbscope.success'));
                return redirect()->back();
            } elseif ($withdar > 0 && $request->amount > $withdar) {

                session()->flash('error', trans('orbscope.error'));
                return redirect()->back();
            }
        }

    }


    public function settings(){


        return view('user.settings',['title'=>trans('log.settings')]);
    }



    public function contact_us(Request $request)
    {

        $rules = [
            'email' => 'required|email',
            'message' => 'required',

        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'email'  =>trans('orbscope.email'),
            'message'     =>trans('orbscope.message'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $c = new ContactUs();
            $c->email = $request->email;
            $c->message = $request->message;
            $c->save();
            session()->flash('scusses', trans('front.contactMessage'));
            return redirect()->back();


        }


    }

    public function search(Request $request){

        $resource=Resource::where('name', 'LIKE', "%{$request->rescourse}%")->orWhere('desc', 'LIKE', "%{$request->rescourse}%")->inRandomOrder()->paginate(12);

        return view('front.department',compact('resource'),['title'=>trans('orbscope.resources')]);

    }




    public function balance(){


        $total=Balance::where('user_id',auth()->user()->id)->sum('net');
        if ($total==0){

            $balance=0; $pending=0; $withdarawl=0; $withdar=0; $sum=0; $with=0;

        }else{
            $date=date('Y-m-d H:i:s');
            $date_num= strtotime($date);

            $min=Withdrawal::where('user_id',auth()->user()->id)->sum('amount');
            $balance=$total-$min;

            $pending=Balance::where('user_id',auth()->user()->id)->where('status','pending')->orWhere('status','done')->sum('net');

            $withdar=Balance::where('user_id',auth()->user()->id)->where('status','done')->where('recived_date','<=',$date_num)->sum('net');



            $sum=Balance::where('user_id',auth()->user()->id)->where('status','done')->get();


            $with=Withdrawal::where('user_id',auth()->user()->id)->where('status','done')->get();

            $withdarawl=$withdar-$with->sum('amount');


            //date("Y-m-d H:i:s", intval($s->recived_date))  1593109773   (1594319600 after 14)



        }

        return view('user.balance',compact('balance','withdar','pending','withdarawl','sum','with'),['title'=>trans('front.balance')]);
    }


















}
