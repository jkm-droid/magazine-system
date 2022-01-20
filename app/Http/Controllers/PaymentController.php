<?php

namespace App\Http\Controllers;


use App\HelperFunctions\AccessFirstCode;
use App\Jobs\SubscriptionJob;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use AccessFirstCode;

    public function __construct(){
        $this->middleware('guest')->except('portal', 'logout');

        $this->accessKey = 'NAvzQnSJhAgRckhVxPVALxEGDhGnynwkdugEbhQdCUeTeXyVLAyCYTuVdRuqW';
        $this->ivKey = "McjqbdvDTPhDaLqS";
        $this->secretKey = "FpgrKqHXDGSjChDS";
    }

    /**
     * show the subscription plan page, select the plan
     */
    public function show_subscription_plan($email){
        $user = User::where('email', $email)->first();

        return view('payments.subscription_plan', compact('user'));
    }

    /**
     * save the subscription details &
     * the payment page
     */
    public function save_subscription_plan(Request $request, $email){
        $user = User::where('email', $email)->first();
        $subscription_plan = '';
        $amount = 0;
        $sub_data = $request->all();

        //get the checked button to know the subscription plan
        if($sub_data['subscription_plan'] == 6){
            $subscription_plan = "quarterly";
            $amount = 6;
        }else if($sub_data['subscription_plan'] == 24){
            $subscription_plan = "annual";
            $amount = 24;
        }

        //update the rest of the details
        $user->amount = $amount;
        $user->subscription_plan = $subscription_plan;
        $user->update();

        $data = array(
            'requestAmount'=> $amount,
            'currencyCode'=> 'USD',
            'accountNumber'=>$user->phone_number,
            'dueDate'=> date("Y-m-d H:m:s", time()+(14*24*60*60)),
            'requestDescription'=>ucfirst($subscription_plan).''.' Magazine Subscription Plan',
            'MSISDN'=>$user->phone_number,
            'countryCode'=>$user->country,
            'customerFirstName'=>$user->first_name,
            'customerLastName'=>$user->last_name,
            'customerEmail'=>$user->email,
            'serviceCode'=>'FIRSTCODE'
        );

        $my_data =  $this->newTinggRequest($data);

        return view('payments.subscribe', compact('user','my_data'));
    }

    /**
     * make a Tingg request
     */
    public function newTinggRequest($payrequest){
        $token = $this->accessFirstcode();

        $data = array("integration"=>"Tingg", "payrequest"=>$payrequest);

        $url = 'https://central.firstcodesystems.com/payment/new.php';
        $ch = curl_init($url);

        $authorization = "Authorization: Bearer $token";
        $payload = json_encode($data);
        // echo $payload;
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
//        dd($result);
        return json_decode($result, true);
    }

    /**
     * checking out the encryption
     */
    public function checkoutEncryption(Request $request){
        $request->header("Access-Control-Allow-Origin: *");
        $get_payload = json_decode($request->getContent());

        $encryptedParams = $this->encrypt($this->ivKey, $this->secretKey, $get_payload);

        //update the user merchant id
        $user = User::where('email', $get_payload->customerEmail)->first();
        $user->merchant_id = $get_payload->merchantTransactionID;
        $user->account_number = $get_payload->accountNumber;
        $user->update();

        $result = array(
            'params' => $encryptedParams,
            'accessKey' => $this->accessKey,
            'countryCode' => $get_payload->countryCode
        );

        return response()->json($result);
    }

    /**
     * Encrypt the string containing customer details with the IV and secret
     * key provided in the developer portal
     *
     * @return $encryptedPayload
     */
    public function encrypt($ivKey, $secretKey, $payload = []){
        //The encryption method to be used
        $encrypt_method = "AES-256-CBC";

        // Hash the secret key
        $key = hash('sha256', $secretKey);

        // Hash the iv - encrypt method AES-256-CBC expects 16 bytes
        $iv = substr(hash('sha256', $ivKey), 0, 16);
        $encrypted = openssl_encrypt(
            json_encode($payload, true), $encrypt_method, $key, 0, $iv
        );

        //Base 64 Encode the encrypted payload
        $encryptedPayload = base64_encode($encrypted);

        return $encryptedPayload;
    }

    /**
     * get details from the central system and update user
     * payment status
     */

    public function get_details_from_central_system(Request $request){
        $request->header("Access-Control-Allow-Origin: *");
        $payment_details = json_decode($request->getContent());

        $payments = $payment_details->details->payments;
        $merchant_id = '';
        $account_number = '';
        $payment_date = '';
        foreach ($payments as $payment){
            $merchant_id = $payment->merchantTransactionID;
            $account_number = $payment->accountNumber;
            $payment_date = $payment->datePaymentReceived;
        }

        //find the user associated with the account number/merchant_id
        $user = User::where('merchant_id',$merchant_id)->where('account_number', $account_number)->first();
        $user->payment_status = 1;
        $user->payment_date = $payment_date;
        $user->update();

        //send details to admin for the subscription
        $details = array([
            'user_email'=>$user->email,
            'user_name'=>$user->first_name.''.$user->last_name
        ]);

        //send the notification to every admin in the system
        $admins = Admin::get();
        foreach ($admins as $admin){
            SubscriptionJob::dispatch($admin->email, $details);
        }
    }

    /**
     * access remote application
     */
    public function access_industrialising_africa(){
        $data = array(
            'status'=>'Success',
            'status_code'=>200
        );

        $url = "https://industrialisingafrica.com/api/subscribe/payment";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

}
