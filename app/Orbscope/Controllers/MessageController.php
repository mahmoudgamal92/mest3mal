<?php

namespace App\Orbscope\Controllers;


use App\Events\MessageSent;
use App\Events\PrivateMessageSent;
use App\Notifications\BidNotification;
use App\Orbscope\Models\Message;
use App\Orbscope\Models\UserChats;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\CitiesDataTable;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use App\Authorizable;
use Session;

class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function privatechat(){


        return view('front.chat');

    }

    public function add_contact($id){

        $chat=new UserChats();
        $chat->user_id= auth()->id();
        $chat->chat_id= $id;
        $chat->save();

        return redirect('user/chatprivate');


    }

    public function users_chating(){
        $user=User::find(auth()->id());
        $chat_user=UserChats::where('user_id',$user->id)
            ->orWhere(function($query) use($user){
                $query->where('chat_id' , $user->id);
            })->select('user_id')
            ->get();
        $chat=UserChats::where('user_id',$user->id)
            ->orWhere(function($query) use($user){
                $query->where('chat_id' , $user->id);
            })->select('chat_id')
            ->get();


        return   User::whereIn('id',$chat)->orWhereIn('id',$chat_user)->where('id','!=',$user->id)->get();

    }

    public function search(Request $request){
        $user=User::find(auth()->id());
        $chat_user=UserChats::where('user_id',$user->id)
            ->orWhere(function($query) use($user){
                $query->where('chat_id' , $user->id);
            })->select('user_id')
            ->get();
        $chat=UserChats::where('user_id',$user->id)
            ->orWhere(function($query) use($user){
                $query->where('chat_id' , $user->id);
            })->select('chat_id')
            ->get();
           $m=User::whereIn('id',$chat)->orWhereIn('id',$chat_user);
        return   $m->Where('name', 'like', '%' . $request->name . '%')->where('id','!=',$user->id)->get();

    }


    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessages (Request $request)
    {

            $message = auth()->user()->messages()->create(['message' => $request->message]);

            broadcast(new MessageSent(auth()->user(),$message->load('user')))->toOthers();


        return response(['status'=>'Message sent successfully','message'=>$message]);
    }

    public function private_messages($id){
        $user=User::find($id);
        $privateCommunication= Message::with('user')
            ->where(['user_id'=> auth()->id(), 'reciver_id'=> $user->id])
            ->orWhere(function($query) use($user){
                $query->where(['user_id' => $user->id, 'reciver_id' => auth()->id()]);
            })
            ->get();
        $ar_message='لديك رسالة جديدة من'.' '.auth()->user()->name.'  ';
        $en_massage='You have a new message from'.' '.auth()->user()->name;
        $url='user/chat/';
        $user=User::find($user->id);
        $user->notify( new BidNotification($ar_message,$en_massage,$url));
        //return $privateCommunication;
        return response()->json([
            'user' => $user,
            'data' => $privateCommunication,
        ]);

    }

    public function sendPrivateMessage(Request $request,$id)
    {
        $input = $request->all();
        $user = User::find($id);

        if(request()->has('file')){
            //$filename = request('file')->store('chat');
            $message=new Message();
            $message->user_id=auth()->id();
            $message->reciver_id= $user->id;
            if(!empty(request('file')) && request('file') != ''){
                $uploaded_image               = Upload::uploadImages('chat', request('file'),'allowExtFiles');
                if($uploaded_image == 'false'){
                    return back()->withInput();
                }else{
                    $message->image       = $uploaded_image;
                }
            }
            $message->save();
        }else {
            $input['reciver_id'] = $user->id;

            $message = auth()->user()->messages()->create($input);
        }


        broadcast(new PrivateMessageSent($message->load('user')))->toOthers();

        return response(['status'=>'Message private sent successfully','message'=>$message]);

    }



}
