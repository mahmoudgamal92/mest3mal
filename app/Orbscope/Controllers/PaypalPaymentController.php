<?php

namespace App\Orbscope\Controllers;
use App\Http\Controllers\Controller;

use App\Notifications\OrderNotfication;
use App\Orbscope\Models\Order;
use App\Orbscope\Models\User_Order;
use App\Orbscope\Models\User_Point;
use App\Orbscope\Models\Withdrawal;
use App\User;
use Carbon\Carbon;
use Dompdf\Exception;
use PHPUnit\Util\TestDox\ResultPrinter;
use Validator;
use Illuminate\Http\Request;
use Logs;
use Session;
use Notification;
use App\Orbscope\Models\OnlinePayment;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;

class PaypalPaymentController extends Controller
{
    private $_apiContext;

    public function contextPaypal() {
        // config == Config files
        // Client Id
        $ClientId = config('Paypal.Account.ClientId'); // [Paypal => 'filename in contig direcotry'] [Account => 'array']
        // Client Secret
        $ClientSecret = config('Paypal.Account.ClientSecret'); // [Paypal => 'filename in contig direcotry'] [ClientSecret => 'array']

        // Came from Paypal SDK
        $OAuth = new OAuthTokenCredential($ClientId, $ClientSecret);
        // Came from Paypal SDK
        $this->_apiContext = new ApiContext($OAuth);
        // Account Connection && Log Setting
        $SetConfig = config('Paypal.Setting');
        // Set And Apply The Configration
        $this->_apiContext->setConfig($SetConfig);


    }

    public function withdrawals_done($id){
        $with=Withdrawal::findOrFail($id);
        $user=User::find($with->user_id);
        if ($with && $user){
             /*
            $this->contextPaypal();
            $payouts = new \PayPal\Api\Payout();
            $senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();
            $senderBatchHeader->setSenderBatchId(uniqid().microtime(true))
                ->setEmailSubject("You have a payment");


            $senderItem = new \PayPal\Api\PayoutItem();
            $senderItem->setRecipientType('Email')
                ->setNote('Thanks you.')
                ->setReceiver($with->email)
                ->setSenderItemId("item_1" . uniqid().microtime('true'))
                ->setAmount(new \PayPal\Api\Currency('{
                    "value":"50.0",
                    "currency":"USD"
                }'));
            $payouts->setSenderBatchHeader($senderBatchHeader)->addItem($senderItem);
            $request = clone $payouts;

            $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                    config('Paypal.Account.ClientId'),
                    config('Paypal.Account.ClientSecret')
                )
            );
            try {
                $output = $payouts->create(null,$apiContext);
            } catch (Exception $ex) {
                abort(404);
            }
            dd($output);
           // Flash::success(trans('payout.payout_success'));
            //return redirect()->back();
            */


            $this->contextPaypal();

            $payouts = new \PayPal\Api\Payout();
            $senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();
            $senderBatchHeader->setSenderBatchId(uniqid())
                ->setEmailSubject("You have a Payout from motamakin");
            $senderItem = new \PayPal\Api\PayoutItem();
            $senderItem->setRecipientType('Email')
                ->setNote('motamakin send your withdrawal')
                ->setReceiver($with->email)
                ->setSenderItemId(uniqid())
                ->setAmount(new \PayPal\Api\Currency('{
                        "value":'.$with->amount.',
                        "currency":"USD"
                    }'));
            $payouts->setSenderBatchHeader($senderBatchHeader)
                ->addItem($senderItem);

            $request = clone $payouts;
            $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                    config('Paypal.Account.ClientId'),
                    config('Paypal.Account.ClientSecret')
                )
            );
            try {
                //$output = $payouts->createSynchronous($apiContext);
               $output = $payouts->create(null,$apiContext);
            } catch (PayPalConnectionException $ex) {

                abort(404);
             }
           // ResultPrinter::printResult("Created Single Synchronous Payout", "Payout", $output->getBatchHeader()->getPayoutBatchId(), $request, $output);
             //dd($output);

            $payoutItems = $output->getItems();
            $payoutItem = $payoutItems[0];
            if ($payoutItem==null){

                session()->flash('error',trans('orbscope.error'));
                return redirect('admin/withdrawals/requests');
            }
            $payoutItemId = $output->getItems()[0]->getPayoutItemId();

            try {
                $output = \PayPal\Api\PayoutItem::get($payoutItemId, $apiContext);
                if ($output->transaction_status=='SUCCESS'){
                    $with->status = 'done';
                    $with->status = $output->transaction_id;
                    $with->save();
                    session()->flash('success',trans('orbscope.success'));
                    return redirect('admin/withdrawals/requests');

                }else{
                    $with->status = 'faild';
                    $name = array('ar'=>'لديك مشكلة بحساب الباي بال الخاص بك','en'=>'you have aproblem with your PayPal');
                    $names = EncodeVar($name);
                    $with->comment =$names;
                    $with->save();
                    session()->flash('error',trans('orbscope.problem_with_account'));
                    return redirect('admin/withdrawals/requests');
                }

            } catch (Exception $ex) {

                abort(404);

            }

        }else{

            abort(404);
        }
    }


    public function store_gharge(Request $request){

       // dd($request);

           // const  min = budget * rate / 100;

        $r=$request->amount * GetSettings()->proccessing_fee /100;

        $price=$request->amount + $r;

        //dd($price);

        $this->contextPaypal();
        $payer = new Payer();

        $payer->setPaymentMethod("paypal");


        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($price);
        $transaction = new Transaction();
        $transaction->setAmount($amount);

        $baseUrl = url('/');
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/ExecuteGhargePayment/".$request->amount."/true")
            ->setCancelUrl("$baseUrl/ExecuteGhargePayment/".$request->amount."/false");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $request = clone $payment;

        try {
            $payment->create($this->_apiContext);
        } catch (Exception $ex) {
            exit(1);
        }



        $approvalUrl = $payment->getApprovalLink();


        return redirect($approvalUrl);


    }

    public function check_out_order(){




           $this->contextPaypal();
           $payer = new Payer();

           $payer->setPaymentMethod("paypal");


           $amount = new Amount();
           $amount->setCurrency("USD")
               ->setTotal(GetSettings()->subscribes);
           $transaction = new Transaction();
           $transaction->setAmount($amount);

               $baseUrl = url('/confirm_order');


           $redirectUrls = new RedirectUrls();
           $redirectUrls->setReturnUrl("$baseUrl/ExecuteGhargePayment/true")
               ->setCancelUrl("$baseUrl/ExecuteGhargePayment/false");

           $payment = new Payment();
           $payment->setIntent("sale")
               ->setPayer($payer)
               ->setRedirectUrls($redirectUrls)
               ->setTransactions(array($transaction));

           $request = clone $payment;

           try {
               $payment->create($this->_apiContext);
           } catch (Exception $ex) {
               exit(1);
           }



           $approvalUrl = $payment->getApprovalLink();


           return redirect($approvalUrl);




    }

    public function confirm_order(Request $request,$amount,$status){
        

        if($status=='true' && $request->paymentId && $request->token && $request->PayerID){

            try {
                $pay = new OnlinePayment();
                $pay->pay_id = $request->paymentId;
                $pay->user_id = auth()->user()->id;
                $pay->payment_method = 'paypal';
                $pay->state = 'done';
                $pay->price = $amount;
                if ($pay->save()) {
                    $po=User_Point::where('user_id',auth()->id())->where('type','pay')->count();
                    if ($po==0){
                        $point=new User_Point();
                        $point->point=100;
                        $point->user_id =auth()->id();
                        $name = array('ar'=>'استخدمك إحدي طرق الدفع','en'=>'You use one of the payment methods');
                        $names = EncodeVar($name);
                        $point->details=$names;
                        $point->type='pay';
                        $point->save();
                    }
                    session()->flash('success_paypal',trans('orbscope.paypalSuccess'));
                    return redirect('user/deposit_fund');
                } else {
                    session()->flash('error',trans('orbscope.paypalError'));
                    return redirect('user/deposit_fund')->with('error', trans('orbscope.paypalError'));
                }
            } catch (Exception $ex) {
                session()->flash('error',trans('orbscope.paypalError'));
                return redirect('user/deposit_fund')->with('error', trans('orbscope.paypalError'));
            }

        } else{
            session()->flash('error',trans('orbscope.paypalError'));
            return redirect('user/deposit_fund')->with('error', trans('orbscope.paypalError'));
        }

    }

    public function GetPaymentInfoById($id) {

        $pay = Payment::get($id, $this->_apiContext);
        return $pay;
    }
}
