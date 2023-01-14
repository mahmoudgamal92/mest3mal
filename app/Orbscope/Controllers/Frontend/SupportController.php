<?php

namespace App\Orbscope\Controllers\Frontend;

use App\Orbscope\Controllers\Controller;

use App\Orbscope\Models\Blogs;
use App\Orbscope\Models\Ticket;
use App\Orbscope\Models\User_Point;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use PDF;
use Illuminate\Http\Request;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use App\Authorizable;
use Session;

class SupportController extends Controller
{

    public function my_reward(){
        $points=User_Point::where('user_id',auth()->id())->where('status','pending')->sum('point');
        return view('front.reword.index',compact('points'),['title'=>trans('front.my_reward')]);
    }

    public function get_support(){
        $blog=Blogs::where('status','active')->OrderBy('created_at','desc')->take(3)->get();
        return view('front.support.index',compact('blog'));
    }

    public function tickets(){
        $open=Ticket::where('user_id',auth()->id())->where('status','open')->OrderBy('created_at','desc')->get();
        $close=Ticket::where('user_id',auth()->id())->where('status','closed')->OrderBy('created_at','desc')->get();
        return view('front.support.tickets',compact('open','close'),['title'=>trans('front.tickets')]);
    }

    public function add_ticket(){

        return view('front.support.create_ticket',['title'=>trans('front.contact')]);
    }

    public function store_ticket(Request $request){

        $rules = [
            'name'         => 'required',
            'email'        => 'required',
            'depart'        => 'required',
            'subject'        => 'required',
            'message'        => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'name'       =>trans('orbscope.name'),
            'email'      =>trans('orbscope.email'),
            'depart'   =>trans('orbscope.depart'),
            'subject'   =>trans('orbscope.subject'),
            'message'   =>trans('front.message'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
           $ticket=new Ticket();
           $ticket->name = $request->name;
           if (auth::check()){
               $ticket->user_id = auth()->id();
           }
            $ticket->email = $request->email;
            $ticket->depart = $request->depart;
            $ticket->subject = $request->subject;
            $ticket->message = $request->message;

            $main_image             = $request->file('file');
            if(!empty($main_image) && $main_image != ''){
                $uploaded_image               = Upload::uploadImages('tickets', $main_image,'allowExtFiles');
                if($uploaded_image == 'false'){
                    return back()->withInput();
                }else{
                    $ticket->file       = $uploaded_image;
                }
            }
            $ticket->save();
            session()->flash('contactMessage',trans('front.contactMessage'));
            return redirect()->back();
        }

    }

    public function searh_tickets(Request $request){

        $open=Ticket::where('user_id',auth()->id())->where('subject', 'like', '%' . $request->title . '%')->where('status','open')->OrderBy('created_at','desc')->get();
        $close=Ticket::where('user_id',auth()->id())->where('subject', 'like', '%' . $request->title . '%')->where('status','closed')->OrderBy('created_at','desc')->get();
        return view('front.support.tickets',compact('open','close'),['title'=>trans('front.tickets')]);
    }


}
