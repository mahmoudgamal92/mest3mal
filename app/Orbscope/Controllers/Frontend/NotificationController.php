<?php

namespace App\Orbscope\Controllers\Frontend;

use App\Orbscope\Controllers\Controller;

use App\Orbscope\Models\Category;
use App\Orbscope\Models\Freelancer_Skill;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\CitiesDataTable;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use App\Authorizable;
use Session;

class NotificationController extends Controller
{

    public function setting(Request $request){

        $user=User::find(auth()->id());
       if ($request->name=='projects_skill'){

          if($user->projects_skill=='active'){

              $user->projects_skill='inactive';
          }else{

              $user->projects_skill='active';
          }
           $user->save();
       }elseif ($request->name=='montly_news'){

           if($user->montly_news=='active'){

               $user->montly_news='inactive';
           }else{

               $user->montly_news='active';
           }
           $user->save();
       }elseif ($request->name=='milestone'){

           if($user->milestone=='active'){

               $user->milestone='inactive';
           }else{

               $user->milestone='active';
           }
           $user->save();
       }elseif ($request->name=='private_message'){

           if($user->private_message=='active'){

               $user->private_message='inactive';
           }else{

               $user->private_message='active';
           }
           $user->save();
       }elseif ($request->name=='about_project'){

           if($user->about_project=='active'){

               $user->about_project='inactive';
           }else{

               $user->about_project='active';
           }
           $user->save();
       }elseif ($request->name=='motamakin_staf'){

           if($user->motamakin_staf=='active'){

               $user->motamakin_staf='inactive';
           }else{

               $user->motamakin_staf='active';
           }
           $user->save();
       }elseif ($request->name=='news'){

           if($user->news=='active'){

               $user->news='inactive';
           }else{

               $user->news='active';
           }
           $user->save();
       }elseif ($request->name=='awarded_project'){

           if($user->awarded_project=='active'){

               $user->awarded_project='inactive';
           }else{

               $user->awarded_project='active';
           }
           $user->save();
       }else{


           return false;
       }

    }



    public function update_email(Request $request){

        $rules = ['email'=>'required|email','password'=>'required'];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames(['email'=>trans('orbscope.email'),'password'=>trans('orbscope.password')]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {


            $user=User::find(auth()->id());

            if(auth()->attempt(['email'=>$user->email,'password'=>$request->input('password')])) {
                $user->email =$request->email;
                $user->save();
                session()->flash('updated',trans('orbscope.updated'));
                return back();
            } else {
                session()->flash('error',trans('orbscope.fails_login'));
                return back()->withInput()->withErrors($validator);
            }

        }
    }

    public function update_password(){

        $user=User::find(auth()->id());
        return view('front.setting.password',compact('user'));
    }

    public function store_password(Request $request){

        $rules = [
            'old_password'=>'required',
            'password' => 'required|string|min:6|confirmed',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames(['old_password'=>trans('orbscope.password'),'password'=>trans('orbscope.password')]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $user=User::find(auth()->id());
            if(auth()->attempt(['email'=>$user->email,'password'=>$request->input('old_password')])) {
                $user->password =bcrypt($request->input('password'));
                $user->save();
                session()->flash('updated',trans('orbscope.updated'));
                return back();
            } else {
                session()->flash('error',trans('orbscope.fails_login'));
                return back()->withInput()->withErrors($validator);
            }

        }


    }

    public function account(){
        $user=User::find(auth()->id());
        return view('front.setting.account',compact('user'));
    }

    public function close_account(){
        $user=User::find(auth()->id());
        $user->status ='inactive';
        $user->save();

        return redirect('/logout');

    }

    public function type_account(Request $request){

        $rules = [
            'type'=>'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames(['type'=>trans('front.Select_Account_Type')]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $user=User::find(auth()->id());
            $user->type =$request->type;
            $user->save();
            return redirect('/logout');
        }


    }


    public function invite_team($id){
         $ids=Freelancer_Skill::where('user_id',auth()->id())->select('cat_id')->get();
         $cats=Category::whereIn('id',$ids)->get();

         $user=User::findOrFail($id);
        return view('front.project.invite_team',compact('user','cats'));

    }



}
