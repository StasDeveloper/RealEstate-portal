<?php

Class PayPalIpn{

    //Callen paypal --login: admin@propertyhookup.com   --pass:  envisage1

    //Switching between sandbox and live versions are implemented in change const USE_SANDBOX and const RECEIVER_EMAIL.

    const DEBUG = true;

    const USE_SANDBOX = false;
//    const RECEIVER_EMAIL = 'instanceofit-facilitator@gmail.com';    //sandbox
    const RECEIVER_EMAIL = 'kalkildea@aol.com';                     //live

    private $api_creds = array();

    private $ipnLog;

    private $process_steps = 'Steps: ';


    /*
     * Define will we use sandbox or won't
     *
     */
    public function __construct(){
        if(self::USE_SANDBOX === true){

            $this->api_creds = array('username'=>'kalkildea-facilitator_api1.aol.com'
                                    , 'password'=>'XNFVK6DNAS8YVRFA'
                                    , 'signature'=>'AFcWxV21C7fd0v3bYYYRCpSSRl31Ah4L0X7ekwAlRQoKcef2qFVoIUis');
        }else{

            $this->api_creds = array('username'=>'kalkildea_api1.aol.com'
                                    , 'password'=>'DWEA3NTKTDN9Q8WV'
                                    , 'signature'=>'AG9.aHoM7Z4ZxjRldkmpDc5g7clNABTJH-qdY2iNL-2c3Qtvzep5C70R');
        }

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

    public static function getSubscriptionFormData($planId = 1){

        $form_data = array();

        $plan = SubscriptionPlans::model()->findByPk($planId);

        /**/
        if(self::USE_SANDBOX === true){
            $form_data['payNowButtonUrl'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        }else{
            $form_data['payNowButtonUrl'] = 'https://www.paypal.com/cgi-bin/webscr';
        }
        $form_data['userId'] = Yii::app()->user->id; // id of current user
        $form_data['receiverEmail'] = self::RECEIVER_EMAIL; //receiver email (paypal account is belong to it)
        $form_data['serviceId'] = $plan->id;
        $form_data['serviceName'] = 'Service Pro';	// subscription name
        $form_data['servicePrice'] = $plan->price; // price ,$ -  for 1 user per month
        $form_data['quantity'] = 1;	// quantity of user
        $form_data['amount'] = $form_data['servicePrice'] * $form_data['quantity'];	// amount = 5$ * 1person
        $form_data['returnUrl'] = 'http://irradii.com/membership/membership/index/status/success';
        $form_data['customData'] = array('user_id' => $form_data['userId'], 'service_id' => $form_data['serviceId']);
        $form_data['jsonrow'] = json_encode($form_data['customData']);
        /**/

        return $form_data;

    }


    /**
     * Main method that process data
     *
     * @param $raw_post_data
     */
    public function createIpnProcessor($raw_post_data){

        $myPost = $this->getPostFromRawData($raw_post_data);
        if(self::DEBUG == true) {
            Yii::log("First input data from PayPal IPN -> ".print_r($myPost, 1), 'ERROR');
        }
        /*for test without paypal*/
//        $this->processPayment($myPost);
//        $this->writeToIpnLog($myPost, $raw_post_data);
        /* END for test without paypal*/


        /*for work with PayPal API*/

        $req = $this->createVerificationRequest($myPost);
        $res = $this->sendRequest($req);

        // Check is $res valid?
        if (strcmp ($res, "VERIFIED") == 0) {
            $this->writeToIpnLog($myPost, $raw_post_data);

            $payPalArrData = $myPost;
            if(self::DEBUG == true) {
                Yii::log('$_POST after verification ' . print_r($payPalArrData, 1), "ERROR");
            }

            $this->processPayment($payPalArrData);


            if(self::DEBUG == true) {
//                Yii::log('payPalArrData'.print_r($payPalArrData,1), "ERROR");
                Yii::log("Verified IPN: $req ". PHP_EOL,'ERROR');
            }
        } else if (strcmp ($res, "INVALID") == 0) {
            // log for manual investigation
            // Add business logic here which deals with invalid IPN messages
            if(self::DEBUG == true) {
                Yii::log("Invalid IPN: $req" . PHP_EOL,'ERROR');
            }
        }
        /*END for work with PayPal API*/

    }

    /**
     * Continue payment process after successful verification
     */
    public function processPayment($arrData){
        $this->process_steps .= '1; ' ;

        if(array_key_exists('custom', $arrData)){
            $this->process_steps .= '2; ' ;
            $custom_data = json_decode($arrData['custom'], 1);
            $userId = $custom_data['user_id'];
            $subscriptionPlan = array();
            $subscriptionPlan = SubscriptionPlans::model()->find('id=:id', array(':id'=>$custom_data['service_id']));
        }

        // Validate incoming data @TODO implement validateSubscription() method bellow
        if($this->validateSubscription($arrData)) {
            $this->process_steps .= '3; ' ;

            $subscription = Subscriptions::model()->find('subscr_id=:subscr_id', array(':subscr_id'=>$arrData['subscr_id']));
            $trial = Subscriptions::model()->find('user_id=:user_id AND trans_id=:trans_id', array(':user_id'=>$userId, ':trans_id'=>'trial'));

            if(array_key_exists('txn_id', $arrData)){
                                $this->process_steps .= '4; ' ;
                $transaction = SubscriptionTransactions::model()->find('txn_id=:txn_id', array(':txn_id' => $arrData['txn_id']));
            }

            //if subscription already exists
            if($subscription !== null){
                $this->process_steps .= '5; ' ;

                //@step_payment payment for subscription
                if($arrData['txn_type'] == 'subscr_payment'){
                    $this->process_steps .= '6; ' ;

                    // transaction not processed yet
                    if($transaction === null) {
                        $this->process_steps .= '7; ' ;

                        // update existed subscription
                        $subscription->status = 'active';
                        $subscription->payment_date = $payment_date = date('Y-m-d H:i:s', strtotime($arrData['payment_date']));
                        $subscription->updated_at = $updated_at = date('Y-m-d H:i:s');
                        $res = $subscription->save();

                        // create new transaction
                        $res2 = $this->saveNewTransaction($arrData, $userId, $subscription->id);

                        if($res && $res2){
                            $this->process_steps .= '8; ' ;
                            $this->setMembership($payment_date, $userId);
                            if(self::DEBUG == true) {
                                Yii::log('User paying for existed subscription. @step_payment', 'ERROR');
                            }
                        }else{
                            $this->process_steps .= '9; ' ;
                                Yii::log('[CUSTOM-LOG-SBSCR-ERROR] -> Membership wasn\'t set. But record in subscriptions or subscription_transactions tables was added. @step_payment', 'ERROR');
                        }

                    }
                    //transaction has been already proceeded. No need to do anything
                    else{
                        $this->process_steps .= '10; ' ;
                        Yii::log('Transaction has been already proceeded. No need to do anything. @step_payment', 'ERROR');
                    }
                }

                //@step_cancel - canceling subscription
                if($arrData['txn_type'] == 'subscr_cancel'){
                    $this->process_steps .= '11; ' ;
                    //@ToDo implement canceling
                    if($subscription->status == 'canceled'){
                        $this->process_steps .= '12; ' ;
                        Yii::log('Subscription '.$arrData['subscr_id'].' was successfully canceled. @step_cancel', 'ERROR');
                    }else{
                        $this->process_steps .= '13; ' ;
                        $cancel_res = $this->cancelSubscription($subscription);
                        if($cancel_res == false){
                            $this->process_steps .= '14; ' ;
                            Yii::log('[CUSTOM-LOG-SBSCR-ERROR] -> Subscription wasn\'t canceled. @step_cancel', 'ERROR');
                        }
                        if(self::DEBUG == true) {
                            $this->process_steps .= '14-1; ' ;
                            if($cancel_res){
                                Yii::log('Subscription was canceled at @step_cancel', 'ERROR');
                            }
                        }
                    }
                }

                //@step_subscr_eot - Subscription alresdy expired
                if($arrData['txn_type'] == 'subscr_eot'){
                    $this->process_steps .= '15; ' ;
                    $userProfile = TblUsersProfiles::model()->find('mid=:mid', array(':mid'=>$subscription->user_id));
                    $subscription->status = 'expired';
                    $subscription->updated_at = date('Y-m-d H:i:s');
                    $res = $subscription->save();
                    if($res && strtotime($userProfile->membership_expire_date) <= strtotime($subscription->payment_date) ){
                        $this->process_steps .= '16; ' ;
                        $userProfile->payment_type = 0;
                        $userProfile->save();
                        if(self::DEBUG == true) {
                            Yii::log('Subscription expired. @step_subscr_eot', 'ERROR');
                        }
                    }
                }

                //@step_subscr_signup - Subscription alresdy exists
                if($arrData['txn_type'] == 'subscr_signup'){
                    $this->process_steps .= '17; ' ;
                    if($trial != null){
                        if(self::DEBUG == true) {
                            Yii::log('Trial is used. @step_subscr_signup', 'ERROR');
                        }
                        return false;
                    } elseif ($arrData['subscr_id'] == $subscription->subscr_id){
                        if(self::DEBUG == true) {
                            Yii::log('Subscription alresdy exists. @step_subscr_signup', 'ERROR');
                        }
                    } else{
                        $this->process_steps .= '18; ' ;
                        Yii::log('Subscription does not exist yet. Waiting for subscr_payment message. @step_subscr_signup', 'ERROR');
                    }
                }

                //@step_modify_subscription - User changed conditions for subscription on a unilateral basis need to cancel a subscription and contact the user
                if($arrData['txn_type'] == 'subscr_modify'){
                    $this->process_steps .= '19; ' ;
                    $subscription->status = 'modified';
                    $subscription->updated_date = date('Y-m-d H:i:s');
                    $subscription->save();
                    //@ToDo cancel FullyPaidMemberShip status
                    Yii::log('User want to refund payment. @step_modify_subscription', 'ERROR');
                }

                // @step_refund_payment - Refund payment
                if(array_key_exists('payment_status', $arrData) && $arrData['payment_status'] == 'Refunded'){
                    $this->process_steps .= '20; ' ;
                    if($arrData['payment_status'] == 'Refunded' && $arrData['reason_code'] == 'refund'){
                        $this->process_steps .= '21; ' ;
                        //@ToDo cancel FullyPaidMemberShip status
                        Yii::log('User want to refund payment. @step_refund_payment', 'ERROR');
                    }
                }

            }
            //there is no such subscription yet
            else{
                $this->process_steps .= '22; ' ;

                //@step_first_payment first payment for subscription
                if($arrData['txn_type'] == 'subscr_payment'){
                    $this->process_steps .= '23; ' ;

//                    $activeSubscription = Subscriptions::model()->find('user_id=:user_id', array(':user_id'=>$userId));
                    $activeSubscription = Subscriptions::model()->find('user_id=:user_id AND status=:status', array(':user_id'=>$userId, ':status'=>'active'));

                    //check whether user has subscription or not
                    if($activeSubscription !== null && $activeSubscription->status === 'active' ){
                        $this->process_steps .= '24; ' ;
                        Yii::log('User cant has more than one active subscription! @step_first_payment', 'ERROR');
                    }
                    //if there isn't active subscr and there isn't such saved transaction
                    elseif($transaction === null ){
                        $this->process_steps .= '25; ' ;

                        $planId = $subscriptionPlan->id;
                        //create subscription
                        $subscription = $this->createNewSubscription($arrData, $custom_data, $planId);

                        //save incoming transaction
                        $this->saveNewTransaction($arrData, $userId, $subscription->id);

                        //update TblUserProfile
                        $this->setMembership(date('Y-m-d H:i:s', strtotime($arrData['payment_date'])), $userId);
                        if(self::DEBUG == true) {
                            Yii::log('New Subscription and Transaction were added! @step_first_payment', 'ERROR');
                        }
                    }
                else{
                    $this->process_steps .= '26; ' ;
                        //payment already processed
                        if(self::DEBUG == true) {
                            Yii::log('Payment has been already processed! @step_first_payment', 'ERROR');
                        }
                    }
                }
                //@step_signup_trial Signup trial plan
                elseif ( $arrData['txn_type'] == 'subscr_signup'){
                    $this->process_steps .= '0; ' ;

                    $activeSubscription = Subscriptions::model()->find('user_id=:user_id AND status=:status', array(':user_id'=>$userId, ':status'=>'active'));

                    //check whether user has subscription or not
                    if($activeSubscription !== null && $activeSubscription->status === 'active' ){

                        $this->process_steps .= '24; ' ;
                        Yii::log('User cant has more than one active subscription! @step_first_payment', 'ERROR');
                    } elseif ($trial){
                        $this->process_steps .= '24; ' ;
                        Yii::log('User cant has more than one trial period! @step_first_payment', 'ERROR');
                    }

                    //if there isn't active subscr and there isn't such saved transaction
                    elseif(
                        empty($transaction) &&
                        (isset($arrData['amount1']) || isset($arrData['amount2'])) &&
                        ($arrData['amount1'] == 0 || $arrData['amount2'] == 0)
                    ){
                        $this->process_steps .= '25; ' ;
                        if($trial != null){
                            if(self::DEBUG == true) {

                                Yii::log('Trial is used! @step_checking_trial_usage', 'ERROR');
                            }
                        }

                        //create subscription
                        $subscription = $this->createNewSubscription($arrData, $custom_data);
                        //save incoming transaction
//                        $this->saveNewTransaction($arrData, $userId, $subscription->id);

                        //update TblUserProfile
                        $this->setMembership(date('Y-m-d H:i:s', strtotime($arrData['subscr_date'])), $userId);
                        if(self::DEBUG == true) {
                            Yii::log('New Subscription and Transaction were added! @step_first_payment', 'ERROR');
                        }
                    }

                    else{
                        $this->process_steps .= '26; ' ;
                        //payment already processed
                        if(self::DEBUG == true) {
                            Yii::log('Payment has been already processed! @step_first_payment', 'ERROR');
                        }
                    }
                }
            }
        }
        else{
            $this->process_steps .= '27; ' ;
            //didn't pass validation
            Yii::log('Didn\'t pass validation -> '.print_r($arrData), 'ERROR');
        }
    }

    /**
     * Set new membership_expire_date in tbl_users_profiles
     *
     * @param $payment_date
     * @param $userId
     * @return bool
     */
    public function setMembership($payment_date, $userId){
        $this->process_steps .= '28; ' ;
        $payment_date = date_create($payment_date);
        $expire_date = date_add($payment_date, date_interval_create_from_date_string('1 month'));
        $expire_date = date_format($expire_date, 'Y-m-d H:i:s');
        $userProfile = TblUsersProfiles::model()->find('mid=:mid', array(':mid'=>$userId));
        $userProfile->membership_expire_date = $expire_date;
        $userProfile->payment_type = 1;
        if($userProfile->save()){
            return true;
        }else{
            Yii::log("[CUSTOM-LOG-SBSCR-ERROR] -> Can't update TblUsersProfiles", 'ERROR');
            exit;
        }
    }

    /**
     * Create and save new subscription for user
     *
     * @param $arrData
     * @param $custom_data
     * @param $plan_id
     * @return Subscriptions
     */
    private function createNewSubscription($arrData, $custom_data, $plan_id = null){
        $this->process_steps .= '29; ' ;
        $subscription = new Subscriptions();
        $subscription->user_id = $custom_data['user_id'];
        $subscription->trans_id = isset($arrData['txn_id']) ? $arrData['txn_id'] : 'trial';
        $subscription->subscr_id = $arrData['subscr_id'];
        $subscription->subscription_id = $plan_id; //because field 'subscription_id' corresponds with 'id' in SubscriptionPlans
        $date = isset($arrData['payment_date']) ? $arrData['payment_date'] : $arrData['subscr_date'];
        $subscription->payment_date = date('Y-m-d H:i:s',strtotime($date));
        $subscription->status = 'active';
        $subscription->items_count = $custom_data['service_id'];
        $subscription->created_at = date("Y-m-d H:i:s");
        $subscription->updated_at = date('Y-m-d H:i:s');
        if($subscription->save()){
            return $subscription;
        }else{
            Yii::log("[CUSTOM-LOG-SBSCR-ERROR] -> Can't create new subscription", 'ERROR'); exit;
        }
    }

    /**
     *
     *
     * @param Subscriptions $subscription
     * @return bool
     */
    private function cancelSubscription(Subscriptions $subscription){
        $this->process_steps .= '30; ' ;
        $subscription->status = 'canceled';
        $subscription->updated_at = date('Y-m-d H:i:s');
        if($subscription->save()){
            $userId = $subscription->user_id;
            $userProfile = TblUsersProfiles::model()->find('mid=:mid', array(':mid'=>$userId));
            $userProfile->payment_type = 0;
            if($userProfile->save()){
                return true;
            }
        }else{
            Yii::log("[CUSTOM-LOG-SBSCR-ERROR] -> Can't update subscription while canceling", 'ERROR');
            return false;
        }
    }

    /**
     * Save transaction to DB
     *
     * @param $arrData
     * @param $userId
     * @return SubscriptionTransactions
     */
    private function saveNewTransaction($arrData, $userId, $subscription_id){
        $this->process_steps .= '31; ' ;
        $transaction = new SubscriptionTransactions();
        $transaction->attributes = $arrData;
        $transaction->user_id = $userId;
        $transaction->site_sbsrc_id = $subscription_id;
        $transaction->payment_date = date('Y-m-d H:i:s',strtotime($arrData['payment_date']));
        $transaction->created_at = date('Y-m-d H:i:s');
        $transaction->updated_at = date('Y-m-d H:i:s');
        $transaction->full_txn_info = json_encode($arrData);
        if($transaction->save()){
            return $transaction;
        }else{
            Yii::log("[CUSTOM-LOG-SBSCR-ERROR] -> Can't create save new transaction", 'ERROR'); exit;
        }
    }

    // Validate incoming data
    public function validateSubscription($myPost){
        $this->process_steps .= '32; ' ;

        if($myPost['txn_type'] == 'subscr_cancel'){
            $this->process_steps .= '33; ' ;
            $subscription = Subscriptions::model()->find('subscr_id=:subscr_id', array(':subscr_id'=>$myPost['subscr_id']));
            if($subscription == null){
                $this->process_steps .= '34; ' ;
                return false;
            }
        }
        elseif($myPost['txn_type'] == 'subscr_payment'){
            $this->process_steps .= '35; ' ;

            $custom_data = json_decode($myPost['custom'], 1);
            $userId = $custom_data['user_id'];
            $subscriptionPlan = SubscriptionPlans::model()->find('id=:id', array(':id'=>$custom_data['service_id']));
            if($subscriptionPlan->price  != $myPost['mc_gross']){
                $this->process_steps .= '36; ' ;
                return false;
            }
            if($myPost['mc_gross'] == 0){
                $this->process_steps .= '37; ' ;
                return false;
            }
            if($myPost['receiver_email'] != self::RECEIVER_EMAIL){
                $this->process_steps .= '38; ' ;
                return false;
            }
            if($myPost['mc_currency'] != 'USD'){
                $this->process_steps .= '39; ' ;
                return false;
            }
            if($myPost['payment_status'] != 'Completed'){
                $this->process_steps .= '40; ' ;
                return false;
            }
            } elseif ($myPost['txn_type'] == 'subscr_eot'){
            $this->process_steps .= '41; ' ;
            return true;
            } elseif ($myPost['txn_type'] == 'subscr_signup'){
            $this->process_steps .= '42; ' ;
                if(self::DEBUG == true) {
                    Yii::log('Payment has been already processed! @step_first_payment', 'ERROR');
                    return true;
                }
                if($myPost['period3'] != '1 M') {
                    $this->process_steps .= '43; ' ;
                    Yii::log("[CUSTOM-LOG-SBSCR-ERROR] -> Subscription Period isn't equal to '1 M'", 'ERROR');
                    return false;
                }
        }
        elseif($myPost['reason_code'] == 'refund' && $myPost['payment_status'] == 'Refunded'){
            $this->process_steps .= '44; ' ;
            //@TODO implement refund subscription here
        }

        return true;
    }

    /**
     * Send request to PayPal to verify is $raw_post_data not fake.
     * Post IPN data back to PayPal to validate the IPN data is genuine.
     * Without this step anyone can fake IPN data
     *
     * @param $req
     * @return bool|mixed
     */
    private function sendRequest($req){
        if(self::USE_SANDBOX == true) {
            $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
        } else {
            $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
        }
        $ch = curl_init($paypal_url);
        if ($ch == FALSE) {
            return FALSE;
        }
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        if(self::DEBUG == true) {
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        }
// CONFIG: Optional proxy configuration
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
// Set TCP timeout to 30 seconds
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
// of the certificate as shown below. Ensure the file is readable by the webserver.
// This is mandatory for some environments.
//$cert = __DIR__ . "./cacert.pem";
//curl_setopt($ch, CURLOPT_CAINFO, $cert);
        $res = curl_exec($ch);
        if (curl_errno($ch) != 0) // cURL error
        {
            if(self::DEBUG == true) {
                Yii::log("Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL,'ERROR');
            }
            curl_close($ch);
            exit;
        } else {
            // Log the entire HTTP response if debug is switched on.
            if(self::DEBUG == true) {
                Yii::log("HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL,'ERROR');
                Yii::log("HTTP response of validation request: $res" . PHP_EOL,'ERROR');
            }
            curl_close($ch);
        }

        $tokens = explode("\r\n\r\n", trim($res));
        $res = trim(end($tokens));

        return $res;
    }

    /**
     * Convert raw POST data to array
     *
     * @param $raw_post_data
     * @return array
     */
    private function getPostFromRawData($raw_post_data){
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode ('=', $keyval);
            if (count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }
        return $myPost;
    }

    /**
     * Create verification request for curl
     *
     * @param $myPost
     * @return string
     */
    private function createVerificationRequest($myPost){
        $req = 'cmd=_notify-validate';
        if(function_exists('get_magic_quotes_gpc')) {
            $get_magic_quotes_exists = true;
        }

        foreach ($myPost as $key => $value) {
            if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }
            $req .= "&$key=$value";
        }

        return $req;
    }

    /**
     * '&PROFILEID=' - subscription id (parameter $myPost['subscr_id'])
     *
     * @param string $action
     * @return bool
     */
    public function changeSubscriptionStatus($action = 'Cancel'){
        $this->process_steps .= '48; ' ;
        $userId = Yii::app()->user->id;
        $subscr = Subscriptions::model()->find('user_id=:user_id AND status=:status', array(':user_id'=>$userId, ':status'=>'active'));
        $api_request = 'USER=' . urlencode( $this->api_creds['username'] )
            .  '&PWD=' . urlencode( $this->api_creds['password'] )
            .  '&SIGNATURE=' . urlencode( $this->api_creds['signature'] )
            .  '&VERSION=76.0'
            .  '&METHOD=ManageRecurringPaymentsProfileStatus'
//            .  '&PROFILEID=' . urlencode( 'I-41M13KG2Y006' )  //subscription id (parameter $myPost['subscr_id']) - uncomment string and to set custom 'subscr_id'
            .  '&PROFILEID=' . urlencode( $subscr->subscr_id )  //subscription id (parameter $myPost['subscr_id'])
            .  '&ACTION=' . urlencode( $action )
            .  '&NOTE=' . urlencode( 'Profile cancelled at store' );

        $ch = curl_init();

        if(self::USE_SANDBOX == true) {
            $paypal_url = 'https://api-3t.sandbox.paypal.com/nvp';
        } else {
            $paypal_url = 'https://api-3t.paypal.com/nvp';
        }

        curl_setopt( $ch, CURLOPT_URL, $paypal_url ); // For live transactions, change to 'https://api-3t.paypal.com/nvp'
        curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );

        // Set the API parameters for this transaction
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $api_request );

        // Request response from PayPal
        $response = curl_exec( $ch );

        // If no response was received from PayPal there is no point parsing the response
        if( ! $response ){
            return false;
        }

        curl_close( $ch );

        // An associative array is more usable than a parameter string
        parse_str( $response, $parsed_response );

        Yii::log('Subscription canceled successfully. $parsed_response from Cancel method'.print_r($parsed_response,1), 'ERROR');
//        return $parsed_response;
        if($parsed_response['ACK'] == 'Success' && $subscr->subscr_id == $parsed_response['PROFILEID']){
            $result = $this->cancelSubscription($subscr);
        }else{
            Yii::log("[CUSTOM-LOG-SBSCR-ERROR] -> Subscription wasn't canceled. @method_changeSubscriptionStatus. parsed_response is ".print_r($parsed_response,1), 'ERROR');
            $result = false;
        }
        return $result;
    }

    /**
     * Write log of steps to tbl_subscription_ipn_log table
     *
     * @param $myPost
     * @param $raw_post_data
     */
    private function writeToIpnLog($myPost, $raw_post_data){
        if(array_key_exists('custom', $myPost)) {
            $custom_data = json_decode($myPost['custom'], 1);
            $this->ipnLog->user_id = $custom_data['user_id'];
            $this->ipnLog->custom = $myPost['custom'];
        }

        $this->ipnLog->txn_type = $myPost['txn_type'];
        $this->ipnLog->subscr_id = $myPost['subscr_id'];
        $this->ipnLog->full_post = $raw_post_data;
        $this->ipnLog->created_at = date('Y-m-d H:i:s');
        $this->ipnLog->updated_at = date('Y-m-d H:i:s');
    }

}