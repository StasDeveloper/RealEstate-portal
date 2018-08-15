<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends RController {
        
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $signin;
    public $body_ID;
    public $body_onload;
    public $title;



    /**
     * @return array action filters
     */
    public function filters() {
        return array('accessControl');
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // Allow superusers to access Rights
//				'actions'=>array(
//					'view',
//					'user',
//					'revoke',
//				),
                'users' => array('@'),
            ),
            array('deny', // Deny all users
                'users' => array('*'),
            ),
        );
    }

    public function formatMoney($number, $fractional = false) {
        if ($fractional) {
            $number = sprintf('%.2f', $number);
        }
        while (true) {
            $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
            if ($replaced != $number) {
                $number = $replaced;
            } else {
                break;
            }
        }
        return $number;
    }

    public function getDistance($latitude1, $longitude1, $latitude2, $longitude2) {
        $theta = $longitude1 - $longitude2;
        $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return $miles;
    }

    public function showDump($arr) {
        echo '<pre>', print_r($arr, true), '</pre>';
    }

    /**
     * @return int
     */
    public function getExpireUser() {
        $expire_user = 0;
        if (!Yii::app()->user->isGuest) {
            $model = TblUsersProfiles::model()->cache(3)->findByAttributes(array('mid' => Yii::app()->user->id));
            if ($model && $model->membership_expire_date) {
                $datetime_now = new DateTime();
                $datetime_exp = new DateTime($model->membership_expire_date);
                $interval = $datetime_now->diff($datetime_exp);
                if ($interval->days > 0 || $interval->h > 0 || $interval->i > 0 || $interval->s > 0) {
                    $expire_user = $model->payment_type;
                }
            }
        }
        return $expire_user;
    }

}
