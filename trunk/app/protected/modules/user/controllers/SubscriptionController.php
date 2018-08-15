<?php

/**
 * Created by PhpStorm.
 * User: developer
 * Date: 07.10.16
 * Time: 17:14
 */
class SubscriptionController extends Controller
{
    public function accessRules() {
        return array(
            array(
                'allow', // allow all user to perform 'create' and 'update' actions
                'actions' => array('GetSubscriptionButton'),
                'users' => array('*'),
            ),
            array(
                'allow', // allow authenticated users to perform 'index' and 'view' actions
                'actions' => array('index', 'GetSubscriptionButton'),
                'users' => array('@'),
            ),
            array('allow', // allow admin to perform 'admin' and 'delete' actions
                'actions' => array('GetSubscriptionButton', 'subscribe', 'error', 'success'),
                'roles' => array('admin'),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionGetSubscriptionButton(){
        /*Validate critical form data*/
        if(isset($_POST['id']) && isset($_POST['paypalFormId'])){

            $formConf = $_POST;

        } else {

            header('HTTP/1.1 424 Failed Dependency');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'Failed Dependency:Form data required', 'code'=> 424)));
        }
        /*Check user status*/
        if(!Yii::app()->user->isGuest){
            $userId = Yii::app()->user->id;
            $trial = Subscriptions::model()->find('user_id=:user_id AND trans_id=:trans_id', array(':user_id'=>$userId, ':trans_id'=>'trial'));
        }

        if(Yii::app()->user->isGuest){

            $form = '<form action="http://'.$_SERVER['HTTP_HOST'].'" id="'.$formConf['id'].'">';
            $status = 'Guest';

        } else if(!SiteHelper::isAdmin() && !SiteHelper::isMember()){

            $form = $formConf['paypalFormId'] == 1 || $trial ? SiteHelper::buildPaymentStandardForm($formConf) : SiteHelper::buildPaymentFormFreeTrial($formConf);
            $status = $trial ? 'Trial used' : 'Unsubscribed';

        } else {

            $form = '<form action="http://'.$_SERVER['HTTP_HOST'].'" id="'.$formConf['id'].'">';
            $status = SiteHelper::isMember() ? 'Membership' : 'Admin';
        }

        $response = array(
            'data'=>$form,
            'status'=>$status
        );
        echo json_encode($response);
    }

    public function actionSuccess (){
        if(isset($_GET['token']))
            PayPal::subscribeTrial($_GET['token']);
        else
            $this->redirect(Yii::app()->getHomeUrl());
    }

    public function actionSubscribe (){
        PayPal::subscribeTrial();
    }

    public function actionError (){
        self::writeToLog('some happens');
//        $this->redirect(Yii::app()->getHomeUrl());
    }

    private function writeToLog($content) {
        $filename = Yii::app()->basePath.'/runtime/targetLog.txt';
        $fp = fopen($filename, 'a');
        if($fp){
            fwrite($fp, $content."\r\n");
        }

        fclose($fp);
    }
}