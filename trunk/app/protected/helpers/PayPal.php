<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 07.10.16
 * Time: 15:56
 * Version: Developing
 */

class PayPal
{
    //Callen paypal --login: admin@propertyhookup.com   --pass:  envisage1

    //Switching between sandbox and live versions are implemented in change const USE_SANDBOX and const RECEIVER_EMAIL.

    const DEBUG = true;
    const HOMEURL = 'http://devirradii.com';
    const USE_SANDBOX = true;
    const RECEIVER_EMAIL = 'instanceofit-facilitator@gmail.com';    //sandbox
//    const RECEIVER_EMAIL = 'kalkildea@aol.com';                     //live

    public $ipnLog;

    public $process_steps = 'Steps: ';


    /*
     * Define will we use sandbox or won't
     *
     */
    private function __construct(){


        $this->ipnLog = new SubscriptionIpnLog();
    }

    /**
     * Save incoming IPN data to tbl_subscription_ipn_log table
     *
     */
    public function __destruct(){
        $this->ipnLog->process_step = $this->process_steps;
        $this->ipnLog->save();
    }


    /**
     * Collect data for payment form
     *
     * @param int $planId
     * @return array
     */
    public function subscribeTrial($token = null){
        if($token != null){
            if(isset($_GET['token'])){
                self::CreatePlan($_GET['token'],2);
//                $profile = SiteHelper::getUserProfile();
                $this->redirect(self::HOMEURL);
            } else {
                $this->redirect(self::HOMEURL);
            }


        } else {
            $auth = self::auth();
            if($auth['ACK'] && $auth['TOKEN']){
                $this->redirect('https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$auth['TOKEN']);
            }
        }
    }
    public function auth()
    {
        $custom_data = array(
            'user_id'=>Yii::app()->user->id,
            'service_id'=>2
        );
        $additional_request =
            '&METHOD=SetExpressCheckout'
            .   '&L_BILLINGTYPE0=RecurringPayments'
            .   '&L_BILLINGAGREEMENTDESCRIPTION0=Test'
            .   '&cancelUrl='.self::HOMEURL.'/user/subscription/error'
            .   '&returnUrl='.self::HOMEURL.'/user/subscription/success'
        ;


        try{
            $res = self::send($additional_request);
            return $res;
        } catch (PayPal\Exception\PayPalConnectionException $e){
            return false;
        }
    }
    public function CreatePlan($token, $plan_id){
        echo '<pre>';
        var_dump($token);
        echo '</pre>';
        $api_request =
            '&METHOD=GetExpressCheckoutDetails'
            . '&TOKEN='.$token
        ;
        $subscribe = self::send($api_request);
        echo '<pre>';
        var_dump($subscribe);
        echo '</pre>';
        if($subscribe['ACK']=="Success"){
            $api_request =
                '&METHOD=CreateRecurringPaymentsProfile'
                . '&TOKEN='.$subscribe['TOKEN']
                . '&PAYERID='.$subscribe['PAYERID']
                . '&PROFILESTARTDATE='.$subscribe['TIMESTAMP']
                . '&VERSION=94'
                . '&DESC=Test'
                . '&BILLINGPERIOD=Month'
                . '&BILLINGFREQUENCY=1'
                . '&AMT=49'
                . '&TRIALBILLINGPERIOD=Month'
                . '&TRIALBILLINGFREQUENCY=1'
                . '&TRIALTOTALBILLINGCYCLES=0'
                . '&TRIALAMT=25'
                . '&CURRENCYCODE=USD'
                . '&COUNTRYCODE=US'
                . '&MAXFAILEDPAYMENTS=3'
            ;
            $subscribe = self::send($api_request);
        }
    }
    public function send($additional_request){
        $ch = curl_init();

        if(self::USE_SANDBOX === true)
        {
            $api_creds = array('username'=>'kalkildea-facilitator_api1.aol.com'
            , 'password'=>'XNFVK6DNAS8YVRFA'
            , 'signature'=>'AFcWxV21C7fd0v3bYYYRCpSSRl31Ah4L0X7ekwAlRQoKcef2qFVoIUis');
        } else {
            $api_creds = array('username'=>'instanceofit-facilitator_api1.gmail.com'
            , 'password'=>'HX5VB2GEBE7BYD6F'
            , 'signature'=>'AFcWxV21C7fd0v3bYYYRCpSSRl31At2O1WJWuRySQdxxLyZNO88zVj95');
        }
        $api_request =
            'USER=' . urlencode( $api_creds['username'] )
            .   '&PWD=' . urlencode( $api_creds['password'] )
            .   '&SIGNATURE=' . urlencode( $api_creds['signature'] )
            .   '&VERSION=94';
        $api_request .= $additional_request;
        if(self::USE_SANDBOX == true) {
            $paypal_url = 'https://api-3t.sandbox.paypal.com/nvp';
        } else {
            $paypal_url = 'https://api-3t.paypal.com/nvp';
        }
        curl_setopt( $ch, CURLOPT_URL, $paypal_url ); // For live transactions, change to 'https://api-3t.paypal.com/nvp'
        curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );

        // Set the API parameters for this transaction
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $api_request );
        // Request response from PayPal
        $response = curl_exec( $ch );

        // If no response was received from PayPal there is no point parsing the response
        if(empty($response) ){
            return false;
        }

        curl_close( $ch );

        // An associative array is more usable than a parameter string
        parse_str( $response, $parsed_response );
        Yii::log('Subscription canceled successfully. $parsed_response from Cancel method'.print_r($parsed_response,1), 'ERROR');
//        return $parsed_response;
        if($parsed_response['ACK'] == 'Success' && isset($parsed_response['TOKEN'])){
            $result = $parsed_response;
        }else{
            Yii::log("[CUSTOM-LOG-SBSCR-ERROR] -> Subscription wasn't canceled. @postToPaypal. parsed_response is ".print_r($parsed_response,1), 'ERROR');
            $result = false;
        }

        return $result;
    }
}