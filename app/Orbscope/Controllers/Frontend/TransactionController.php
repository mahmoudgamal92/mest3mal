<?php

namespace App\Orbscope\Controllers\Frontend;

use App\Orbscope\Controllers\Controller;

use App\Orbscope\Models\Category;
use App\Orbscope\Models\Country;
use App\Orbscope\Models\Department;
use App\Orbscope\Models\OnlinePayment;
use App\Orbscope\Models\Payment;
use App\Orbscope\Models\Withdrawal;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use PDF;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\CitiesDataTable;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use App\Authorizable;
use Session;

class TransactionController extends Controller
{

    public function deposit_fund(){

        return view('front.transaction.deposit');
    }

    public function transaction_history(){


        $payment=Payment::where('user_id',auth()->id())->orWhere('reciver_id',auth()->id())->get();
        $online=OnlinePayment::where('user_id',auth()->id())->get();
        //$mergedCollection = $online->concat($payment)->sortBy('created_at');
        $all = $payment->merge($online);
        $all = array_reverse(array_sort($all, function ($value) {
            return $value['created_at'];
        }));

        return view('front.transaction.transaction',compact('all','online','payment'),['title'=>trans('front.transaction_history')]);
    }

    public function createPDF() {
        // retreive all records from db
        $payment=Payment::where('user_id',auth()->id())->orWhere('reciver_id',auth()->id())->get();
        $online=OnlinePayment::where('user_id',auth()->id())->get();
        //$mergedCollection = $online->concat($payment)->sortBy('created_at');
        $all = $payment->merge($online);
        $data = array_reverse(array_sort($all, function ($value) {
            return $value['created_at'];
        }));

        // share data to view
        view()->share('transactions',$data);
        $pdf = PDF::loadView('pdf_view', ['data'=>$data]);

        //return view('pdf_view',compact('data'));

        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }

    public function withdrawal(){
        $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
        $with=Withdrawal::where('user_id',auth()->id())->where('status','pending')->OrderBy('created_at','desc')->get();
        return view('front.transaction.withdrawal',compact('with','departs'),['title'=>trans('front.withdrawals')]);
    }

    public function pay_withdrawal(){


        return view('front.transaction.paypal',['title'=>trans('front.Withdraw_Fund')]);

    }

    public function add_withdrawal(Request $request){
       if (Auth::check()){
           if (user_balance() >= $request->amount){
               $with=new Withdrawal();
               $with->amount =$request->amount;
               $with->email =$request->email;
               $with->user_id =auth()->id();
               $with->type ='PayPal';
               $with->save();
               session()->flash('sent',trans('orbscope.sent'));
               return redirect('user/withdrawal');
           }else{

               session()->flash('no_balance',trans('orbscope.no_balance'));
               return redirect()->back();
           }

       }else{

           abort(404);
       }

    }

    public function financial_dashboard(){

        $payment=Payment::where('user_id',auth()->id())->OrderBy('created_at','desc')->get();
        $order=Payment::where('reciver_id',auth()->id())->OrderBy('created_at','desc')->get();
        $withdrawal=Withdrawal::where('user_id',auth()->id())->OrderBy('created_at','desc')->get();
        return view('front.transaction.dashbord',compact('payment','order','withdrawal'),['title'=>trans('front.Financial_Dashboard')]);

    }

    public function invite_friend(){

        return view('front.invite_friend');
    }

    public function share_lin($user){
        if (auth::Check()){
            return redirect('/');
        }
       $user= User::where('name',$user)->first();
       if ($user){
           $name = array('ar'=>'مشاركة رابط الخاص بك','en'=>'sharing your link');
           $names = EncodeVar($name);
           $point=new User_Point();
           $point->point=20;
           $point->user_id =$user->id;
           $point->details=$names;
           $point->save();
           return redirect('register');

       }else{


           return redirect('register');
       }

    }


}
