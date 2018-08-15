<?php

/**
 * Command for import user from registration_step1
 *  ./yiic import users
 */
class ImportCommand extends CConsoleCommand {

    public $verbose = false;

//    public function actionIndex() {
//        echo "### use : ./yiic import users", PHP_EOL;
//    }

    public function actionUsers() {
        ini_set("memory_limit","768M");
//        $rolesTmp = Yii::app()->db->createCommand('select member_type from registration_step1 group by member_type')->queryAll();
//        $roles = array();
//        foreach ($rolesTmp as $value) {
//            $roles[$value['member_type']] = $value['member_type'];
//        }
        // @TODO insert and check roles

        Yii::import('application.modules.user.*');
        Yii::import('application.modules.user.models.*');

        Yii::import('application.modules.rights.*');
//        Yii::import('application.modules.rights.models.*');
        Yii::import('application.modules.rights.components.*');
        $countregistration = RegistrationStep1::model()->count();
        $userOld = Yii::app()->db->createCommand()
                ->select('*')
                ->from('registration_step1')             
                ->where('mid > 311338') // debug ONLY
                ->queryAll();
        $userModule = Yii::app()->getModule('user');
//        $authorizer = Yii::app()->getModule('rights')->getComponent('authorizer');
        foreach ($userOld as $key => $value) {
            $model = new User;
            $model->id = $value['mid'];
            $model->username = $value['username'];
            $model->password = $value['password'];
            $model->create_at = $value['join_date'];
            $model->superuser = 0;
            $model->status = 1;
            $model->activkey = $userModule->encrypting(microtime() . $model->password);
            if ($model->validate()) {
                $model->password = $userModule->encrypting($model->password);
                if ($model->save()) {
                    Rights::assign($value['member_type'], $model->id);
                    $result = false;
                    switch ($value['member_type']) {
                        case 'AGENT':
                            $result = $this->loadProfileagent($model->id);
                            break;
                        case 'SELLER':
                            $result = $this->loadProfileseller($model->id);
                            break;
                        case 'INVESTOR':
                        case 'BUYER':
                            $result = $this->loadProfilebuyerinvestor($model->id);
                            break;
                        case 'BROKERAGE':
                            $result = $this->loadProfilebrokerage($model->id);
                            break;
                        default:
                            echo 'Error - Undefined ROLE not saved profile ', print_r($model->username, true), PHP_EOL;
                            break;
                    }
                    if(!$result) {
                        echo 'Error - not saved profile ', print_r($model->username, true), PHP_EOL;
                    }
                } else {
                    echo 'Error - not saved ', print_r($model->username, true), PHP_EOL;
                }
            } else {
                echo 'Error validate ', print_r($model->username, true), PHP_EOL;
                echo print_r($model->getErrors());
//                    break;
            }
            if($value['mid']%100 === 0){
                echo $value['mid']." from ".$countregistration."\r\n";
                
            }
        }
//        echo print_r($userOld,true), PHP_EOL;  
       // $this->loadAdminUsers();
    }

    private function loadProfileagent($mid) {
        $agentmodel = AgentJoin::model()->findByAttributes(array('mid' => $mid));

        $model = new TblUsersProfiles;
        if($agentmodel){
            $row = Array
                (
                'TblUsersProfiles' => Array
                    (
                    'mid' => $agentmodel->mid,
                    'first_name' => $agentmodel->first_name,
                    'middle_name' => $agentmodel->middle_name,
                    'last_name' => $agentmodel->last_name,
                    'office' => $agentmodel->office,
                    'street_address' => $agentmodel->address1,
                    'address1' => $agentmodel->address2,
                    'street_number' => '',
                    'state' => '', 
                    'country' => '', 
                    'city' => '',
                    'zipcode' => $agentmodel->zipcode,
                    'phone' => '',
                    'phone_office' => $agentmodel->phone,
                    'phone_fax' => $agentmodel->pagent_phone_fax,
                    'phone_home' => $agentmodel->pagent_phone_home,
                    'phone_mobile' => $agentmodel->pagent_phone_mobile,
                    'website_url' => $agentmodel->website_url,
                    'tagline' => $agentmodel->tagline,
                    'years_of_experience' => $agentmodel->years_of_experience,
                    'years_of_experience_text' => $agentmodel->years_of_experience_text,
                    'area_expertise' => $agentmodel->area_expertise,
                    'area_expertise_text' => $agentmodel->area_expertise_text,
                    'about_me' => $agentmodel->about_me,
                    'upload_photo' => $agentmodel->upload_photo,
                    'office_logo' => $agentmodel->office_logo,
                    'upload_logo' => $agentmodel->upload_logo,
                    'listing_type' => $agentmodel->listing_type,
                    'payment_type' => $agentmodel->payment_type,
                    'join_date' => '',
                    'join_only_date' => '',
                    'membership_expire_date' => $agentmodel->membership_expire_date,
                    'membership_subscription_date'=>'',
                    'audit_expire_date' => '',
                    'profile_completion_percentage' => $agentmodel->profile_completion_percentage,
                    'rating_average' => $agentmodel->rating_average,
                    'agent_last_login' => $agentmodel->agent_last_login,
                    'agent_comments' => $agentmodel->agent_comments,
                    'profile_notification' => $agentmodel->profile_notification,
                    'website_notification' => $agentmodel->website_notification,
                    'listings_notification' => $agentmodel->listings_notification,
                    'news_offers'=>'',
                    'timestamp'=>'',
                )
            );
        } else {
            $row = Array
                (
                'TblUsersProfiles' => Array
                    (
                    'mid' => $mid,
                    'first_name' => '',
                    'middle_name' => '',
                    'last_name' => '',
                    'office' => '',
                    'street_address' => '',
                    'address1' => '',
                    'street_number' => '',
                    'state' => '', 
                    'country' => '', 
                    'city' => '',
                    'zipcode' => '',
                    'phone' => '',
                    'phone_office' => '',
                    'phone_fax' => '',
                    'phone_home' => '',
                    'phone_mobile' => '',
                    'website_url' => '',
                    'tagline' => '',
                    'years_of_experience' => '',
                    'years_of_experience_text' => '',
                    'area_expertise' => '',
                    'area_expertise_text' => '',
                    'about_me' => '',
                    'upload_photo' => '',
                    'office_logo' => '',
                    'upload_logo' => '',
                    'listing_type' => '',
                    'payment_type' => '',
                    'join_date' => '',
                    'join_only_date' => '',
                    'membership_expire_date' => '',
                    'membership_subscription_date'=>'',
                    'audit_expire_date' => '',
                    'profile_completion_percentage' => '',
                    'rating_average' => '',
                    'agent_last_login' => '',
                    'agent_comments' => '',
                    'profile_notification' => '',
                    'website_notification' => '',
                    'listings_notification' => '',
                    'news_offers'=>'',
                    'timestamp'=>'',
                )
            );
        }

        $model->attributes = $row['TblUsersProfiles'];

        if($model->validate()) {
            if (!$model->save()) {
                return false;
            }
        } else {
            echo 'Error validate profile ', print_r(array('mid'=>$model->mid,$model->getErrors()), true), PHP_EOL;
            return false;
        }
        unset($row);
        unset($model);
        return true;
    }

    private function loadProfileseller($mid) {
        $sellermodel = SellerJoin::model()->findByAttributes(array('mid' => $mid));

        $model = new TblUsersProfiles;
        if($sellermodel){
            $row = Array
                (
                'TblUsersProfiles' => Array
                    (
                    'mid' => $sellermodel->mid,
                    'first_name' => $sellermodel->first_name,
                    'middle_name' => $sellermodel->middle_name,
                    'last_name' => $sellermodel->last_name,
                    'office' => '',
                    'street_address' => $sellermodel->address1,
                    'address1' => $sellermodel->address2,
                    'street_number' => '',
                    'state' => '', 
                    'country' => '', 
                    'city' => '',
                    'zipcode' => $sellermodel->zipcode,
                    'phone' => '',
                    'phone_office' => $sellermodel->phone,
                    'phone_fax' => '',
                    'phone_home' => '',
                    'phone_mobile' => '',
                    'website_url' => '',
                    'tagline' => '',
                    'years_of_experience' => '',
                    'years_of_experience_text' => '',
                    'area_expertise' => '',
                    'area_expertise_text' => '',
                    'about_me' => '',
                    'upload_photo' => '',
                    'office_logo' => '',
                    'upload_logo' => '',
                    'listing_type' => '',
                    'payment_type' => '',
                    'join_date' => '',
                    'join_only_date' => '',
                    'membership_expire_date' => '',
                    'membership_subscription_date'=>'',
                    'audit_expire_date' => $sellermodel->AUDIT_EXPIRE_DATE,
                    'profile_completion_percentage' => '',
                    'rating_average' => '',
                    'agent_last_login' => '',
                    'agent_comments' => '',
                    'profile_notification' => '',
                    'website_notification' => '',
                    'listings_notification' => '',
                    'news_offers'=>'',
                    'timestamp'=>'',
                )
            );
        } else {
            $row = Array
                (
                'TblUsersProfiles' => Array
                    (
                    'mid' => $mid,
                    'first_name' => '',
                    'middle_name' => '',
                    'last_name' => '',
                    'office' => '',
                    'street_address' => '',
                    'address1' => '',
                    'street_number' => '',
                    'state' => '', 
                    'country' => '', 
                    'city' => '',
                    'zipcode' => '',
                    'phone' => '',
                    'phone_office' => '',
                    'phone_fax' => '',
                    'phone_home' => '',
                    'phone_mobile' => '',
                    'website_url' => '',
                    'tagline' => '',
                    'years_of_experience' => '',
                    'years_of_experience_text' => '',
                    'area_expertise' => '',
                    'area_expertise_text' => '',
                    'about_me' => '',
                    'upload_photo' => '',
                    'office_logo' => '',
                    'upload_logo' => '',
                    'listing_type' => '',
                    'payment_type' => '',
                    'join_date' => '',
                    'join_only_date' => '',
                    'membership_expire_date' => '',
                    'membership_subscription_date'=>'',
                    'audit_expire_date' => '',
                    'profile_completion_percentage' => '',
                    'rating_average' => '',
                    'agent_last_login' => '',
                    'agent_comments' => '',
                    'profile_notification' => '',
                    'website_notification' => '',
                    'listings_notification' => '',
                    'news_offers'=>'',
                    'timestamp'=>'',
                )
            );
        }

        $model->attributes = $row['TblUsersProfiles'];
        
        if($model->validate()) {
            if (!$model->save()) {
                return false;
            }
        } else {
            echo 'Error validate profile ', print_r(array('mid'=>$model->mid,$model->getErrors()), true), PHP_EOL;
            return false;
        }
        unset($row);
        unset($model);
        return true;
    }

    private function loadProfilebuyerinvestor($mid) {
        $buyermodel = BuyerJoin::model()->findByAttributes(array('mid' => $mid));

        $model = new TblUsersProfiles;
        if($buyermodel){
            $row = Array
                (
                'TblUsersProfiles' => Array
                    (
                    'mid' => $buyermodel->mid,
                    'first_name' => $buyermodel->first_name,
                    'middle_name' => '',
                    'last_name' => $buyermodel->last_name,
                    'office' => '',
                    'street_address' => $buyermodel->street_address,
                    'street_number' => '',
                    'address2' => '',
                    'state' => '', 
                    'country' => '', 
                    'city' => '',
                    'zipcode' => $buyermodel->zipcode,
                    'phone' => $buyermodel->phone,
                    'phone_office' => '',
                    'phone_fax' => '',
                    'phone_home' => '',
                    'phone_mobile' => '',
                    'website_url' => '',
                    'tagline' => '',
                    'years_of_experience' => '',
                    'years_of_experience_text' => '',
                    'area_expertise' => '',
                    'area_expertise_text' => '',
                    'about_me' => '',
                    'upload_photo' => '',
                    'office_logo' => '',
                    'upload_logo' => '',
                    'listing_type' => '',
                    'payment_type' => $buyermodel->payment_type,
                    'join_date' => $buyermodel->join_date,
                    'join_only_date' => $buyermodel->join_only_date,
                    'membership_expire_date' => $buyermodel->membership_expire_date,
                    'membership_subscription_date'=>$buyermodel->membership_subscription_date,
                    'audit_expire_date' => '',
                    'profile_completion_percentage' => '',
                    'rating_average' => '',
                    'agent_last_login' => '',
                    'agent_comments' => '',
                    'profile_notification' => '',
                    'website_notification' => '',
                    'listings_notification' => '',
                    'news_offers'=>'',
                    'timestamp'=>'',
                )
            );
        } else {
            $row = Array
                (
                'TblUsersProfiles' => Array
                    (
                    'mid' => $mid,
                    'first_name' => '',
                    'middle_name' => '',
                    'last_name' => '',
                    'office' => '',
                    'street_address' => '',
                    'address1' => '',
                    'street_number' => '',
                    'state' => '', 
                    'country' => '', 
                    'city' => '',
                    'zipcode' => '',
                    'phone' => '',
                    'phone_office' => '',
                    'phone_fax' => '',
                    'phone_home' => '',
                    'phone_mobile' => '',
                    'website_url' => '',
                    'tagline' => '',
                    'years_of_experience' => '',
                    'years_of_experience_text' => '',
                    'area_expertise' => '',
                    'area_expertise_text' => '',
                    'about_me' => '',
                    'upload_photo' => '',
                    'office_logo' => '',
                    'upload_logo' => '',
                    'listing_type' => '',
                    'payment_type' => '',
                    'join_date' => '',
                    'join_only_date' => '',
                    'membership_expire_date' => '',
                    'membership_subscription_date'=>'',
                    'audit_expire_date' => '',
                    'profile_completion_percentage' => '',
                    'rating_average' => '',
                    'agent_last_login' => '',
                    'agent_comments' => '',
                    'profile_notification' => '',
                    'website_notification' => '',
                    'listings_notification' => '',
                    'news_offers'=>'',
                    'timestamp'=>'',
                )
            );
        }

        $model->attributes = $row['TblUsersProfiles'];

        if($model->validate()) {
            if (!$model->save()) {
                return false;
            }
        } else {
            echo 'Error validate profile ', print_r(array('mid'=>$model->mid, $model->getErrors()), true), PHP_EOL;
            return false;
        }
        unset($row);
        unset($model);
        return true;
    }

    private function loadAdminUsers() {

        Yii::import('application.modules.user.*');
        Yii::import('application.modules.user.models.*');

        Yii::import('application.modules.rights.*');
        Yii::import('application.modules.rights.components.*');

        $adminOld = AdminInfo::model()->findAll();
        $userModule = Yii::app()->getModule('user');
        $adminRole = Yii::app()->getModule('rights')->superuserName;
        foreach ($adminOld as $key => $value) {
            $model = new User;
//            $model->id = 0;
            $model->username = $value['adminusername']. '@admin.com' ; // Yii::app()->params['adminEmail'];
            $model->password = $value['adminpassword'];
//            $model->email =  $value['adminusername'] . '@admin.com' ; 
            $model->superuser = 1;
            $model->status = 1;
            $model->activkey = $userModule->encrypting(microtime() . $model->password);
            if ($model->validate()) {
                $model->password = $userModule->encrypting($model->password);
                if ($model->save()) {
                    Rights::assign($adminRole, $model->id);
                    $profile = new TblUsersProfiles;

                    $row = Array('TblUsersProfiles' => Array(
                            'mid' =>  $model->id,
                            ));
                    $profile->attributes = $row['TblUsersProfiles'];

                    if($profile->validate()) {
                        if ($profile->save()) {
                            echo 'Admin - saved : ', print_r($model->username, true), PHP_EOL;
                        } 
                    } else {
                        echo 'Error validate profile ', print_r(array('mid'=>$profile->mid, $profile->getErrors()), true), PHP_EOL;
                    }                
                } else {
                    echo 'Error - not saved ', print_r($model->username, true), PHP_EOL;
                }
            } else {
                echo 'Error validate ', print_r(array($model->username, $model->getErrors()), true), PHP_EOL;
//                    break;
            }
        }
//        echo print_r($adminOld,true), PHP_EOL;  
    }
    
    public function actionAdmins() {
        $this->loadAdminUsers();
    }
    
      private function loadProfilebrokerage($mid) {
        $brokeragemodel = BrokerageJoin::model()->findByAttributes(array('mid' => $mid));

        $model = new TblUsersProfiles;
        if($brokeragemodel){
            $row = Array
                (
                'TblUsersProfiles' => Array
                    (
                    'mid' => $brokeragemodel->mid,
                    'first_name' => $brokeragemodel->brokerage_name,
                    'middle_name' => '',
                    'last_name' => '',
                    'office' => '',
                    'street_address' => $brokeragemodel->brokerage_address,
                    'street_number' => '',
                    'address2' => '',
                    'state' => '', 
                    'country' => '', 
                    'city' => '',
                    'zipcode' => $brokeragemodel->brokerage_zipcode,
                    'phone' => '',
                    'phone_office'=> $brokeragemodel->brokerage_phone,
                    'phone_fax' => $brokeragemodel->brokerage_phone_fax,
                    'phone_home' => $brokeragemodel->brokerage_phone_home,
                    'phone_mobile' => $brokeragemodel->brokerage_phone_mobile,
                    'website_url' => $brokeragemodel->brokerage_website_address,
                    'tagline' => '',
                    'years_of_experience' => '',
                    'years_of_experience_text' => '',
                    'area_expertise' => '',
                    'area_expertise_text' => '',
                    'about_me' => '',
                    'upload_photo' => '',
                    'office_logo' => '',
                    'upload_logo' => $brokeragemodel->brokerage_logo_image_link,
                    'listing_type' => '',
                    'payment_type' => '',
                    'join_date' => '',
                    'join_only_date' => '',
                    'membership_expire_date' => '',
                    'membership_subscription_date'=>'',
                    'audit_expire_date' => '',
                    'profile_completion_percentage' => '',
                    'rating_average' => '',
                    'agent_last_login' => '',
                    'agent_comments' => '',
                    'profile_notification' => '',
                    'website_notification' => '',
                    'listings_notification' => '',
                    'news_offers'=>'',
                    'timestamp'=>$brokeragemodel->timestamp,
                )
            );
        } else {
            $row = Array
                (
                'TblUsersProfiles' => Array
                    (
                    'mid' => $mid,
                    'first_name' => '',
                    'middle_name' => '',
                    'last_name' => '',
                    'office' => '',
                    'street_address' => '',
                    'address1' => '',
                    'street_number' => '',
                    'state' => '', 
                    'country' => '', 
                    'city' => '',
                    'zipcode' => '',
                    'phone' => '',
                    'phone_office' => '',
                    'phone_fax' => '',
                    'phone_home' => '',
                    'phone_mobile' => '',
                    'website_url' => '',
                    'tagline' => '',
                    'years_of_experience' => '',
                    'years_of_experience_text' => '',
                    'area_expertise' => '',
                    'area_expertise_text' => '',
                    'about_me' => '',
                    'upload_photo' => '',
                    'office_logo' => '',
                    'upload_logo' => '',
                    'listing_type' => '',
                    'payment_type' => '',
                    'join_date' => '',
                    'join_only_date' => '',
                    'membership_expire_date' => '',
                    'membership_subscription_date'=>'',
                    'audit_expire_date' => '',
                    'profile_completion_percentage' => '',
                    'rating_average' => '',
                    'agent_last_login' => '',
                    'agent_comments' => '',
                    'profile_notification' => '',
                    'website_notification' => '',
                    'listings_notification' => '',
                    'news_offers'=>'',
                    'timestamp'=>'',
                )
            );
        }

        $model->attributes = $row['TblUsersProfiles'];

        if($model->validate()) {
            if (!$model->save()) {
                return false;
            }
        } else {
            echo 'Error validate profile ', print_r(array('mid'=>$model->mid, $model->getErrors()), true), PHP_EOL;
            return false;
        }
        unset($row);
        unset($model);
        return true;
    }
    
    
    public function actionPhoto(){
        ini_set("memory_limit","768M");
        $countmodel = PropertyInfoPhoto::model()->count();
        for ($i = 0; $i < $countmodel; $i++) {
            $criteria = new CDbCriteria();
            $criteria->limit = 1;
            $criteria->offset = $i;
            $model = PropertyInfoPhoto::model()->find($criteria);
            for ($j = 2; $j <=40 ; $j++) {
                $new_str = array();
                $photo_key = 'photo'.$j;
                $caption_key = 'caption'.$j;
                if(!empty($model->$photo_key)){
                    $caption = property_exists($model, $caption_key) ? $model->$caption_key : '';
                    $new_str=array(
                            'property_id'=>$model->property_id,
                            'caption'=>$caption,
                            'photo'=>$model->$photo_key  
                    );
                }  else {
                    continue;
                }
                $photo_new = new PropertyInfoPhotoNew;
                $photo_new->attributes = $new_str;
                if($photo_new->validate()){
                    $photo_new->save();
                }else{
                    $photo_new->getErrors();
                }
            }
            if($i%200 === 0){
                echo $i." from ".$countmodel."\r\n";
            }
        }
    }
    
    public function actionSetNewPhoto() {
        $last_id = Yii::app()->db->createCommand()->select('max(property_id) as max')->from('property_info_photo')->queryScalar();
        $criteria = new CDbCriteria();
        $criteria->condition = "property_id > :property_id";
        $criteria->params = array(':property_id'=>$last_id); 
        $model_rows = PropertyInfoPhoto::model()->findAll($criteria);
        foreach ($model_rows as $model) {
            for ($j = 2; $j <=40 ; $j++) {
                    $new_str = array();
                    $photo_key = 'photo'.$j;
                    $caption_key = 'caption'.$j;
                    if(!empty($model->$photo_key)){
                        $caption = property_exists($model, $caption_key) ? $model->$caption_key : '';
                        $new_str=array(
                                'property_id'=>$model->property_id,
                                'caption'=>$caption,
                                'photo'=>$model->$photo_key  
                        );
                    }  else {
                        continue;
                    }
                    $photo_new = new PropertyInfoPhoto;
                    $photo_new->attributes = $new_str;
                    if($photo_new->validate()){
                        $photo_new->save();
                    }else{
                        $photo_new->getErrors();
                    }
            }
            echo $model->property_id."\r\n";
        }
        echo "Done!\r\n";
    }
    
    public function actionAddNewUsers() {
        ini_set("memory_limit","768M");
        $last_id = Yii::app()->db->createCommand()->select('max(id) as max')->from('tbl_users')->queryScalar();

        Yii::import('application.modules.user.*');
        Yii::import('application.modules.user.models.*');
        Yii::import('application.modules.rights.*');
        Yii::import('application.modules.rights.components.*');
        
        $userOld = Yii::app()->db->createCommand()
                ->select('*')
                ->from('registration_step1')             
                ->where("mid > {$last_id}") 
                ->queryAll();
        $userModule = Yii::app()->getModule('user');
        
        if($userOld){
            foreach ($userOld as $key => $value) {
                $model = new User;
                $model->id = $value['mid'];
                $model->username = $value['username'];
                $model->password = $value['password'];
                $model->create_at = $value['join_date'];
                $model->superuser = 0;
                $model->status = 1;
                $model->activkey = $userModule->encrypting(microtime() . $model->password);
                if ($model->validate()) {
                    $model->password = $userModule->encrypting($model->password);
                    if ($model->save()) {
                        Rights::assign($value['member_type'], $model->id);
                        $result = false;
                        switch ($value['member_type']) {
                            case 'AGENT':
                                $result = $this->loadProfileagent($model->id);
                                break;
                            case 'SELLER':
                                $result = $this->loadProfileseller($model->id);
                                break;
                            case 'INVESTOR':
                            case 'BUYER':
                                $result = $this->loadProfilebuyerinvestor($model->id);
                                break;
                            case 'BROKERAGE':
                                $result = $this->loadProfilebrokerage($model->id);
                                break;
                            default:
                                echo 'Error - Undefined ROLE not saved profile ', print_r($model->username, true), PHP_EOL;
                                break;
                        }
                        if(!$result) {
                            echo 'Error - not saved profile ', print_r($model->username, true), PHP_EOL;
                        }
                    } else {
                        echo 'Error - not saved ', print_r($model->username, true), PHP_EOL;
                    }
                } else {
                    echo 'Error validate ', print_r($model->username, true), PHP_EOL;
                    echo print_r($model->getErrors());
                }
                echo $value['mid']."\r\n";
            }
        }
    }
    
    public function actionCreateNewPhoto() {
        ini_set("memory_limit","768M");
        $criteria = new CDbCriteria;
        $criteria->condition='TRIM(upload_photo) !="" ';
//        $criteria->limit = 100;
            
        $profiles = TblUsersProfiles::model()->findAll($criteria, array(
                        'limit' => 10
                    )
                );
        foreach ($profiles as $profile) {
echo 'File ', print_r($this->pathImage('avatars', $profile->upload_photo), true), PHP_EOL;
            if(!empty($profile->upload_photo) && file_exists($this->pathImage('avatars', $profile->upload_photo))){
                if(!file_exists($this->pathImage('avatars', '50_50_'.$profile->upload_photo))){
                    $image = Yii::app()->image->load($this->pathImage('avatars', $profile->upload_photo));
                    $image->resize(50, 50, Image::WIDTH)->crop(50, 50)->save($this->pathImage('avatars', '50_50_'.$profile->upload_photo));
                } else {
                    echo 'Exist ', print_r($this->pathImage('avatars', '50_50_'.$profile->upload_photo), true), PHP_EOL;
                }
            } else {
                echo 'Error - not exist ', print_r($profile->upload_photo, true), PHP_EOL;
            }
echo 'File office ', print_r($this->pathImage('office_logo', $profile->office_logo), true), PHP_EOL;
            if(!empty($profile->office_logo) && file_exists($this->pathImage('office_logo', $profile->office_logo))){
                if(!file_exists($this->pathImage('office_logo', '50_50_'.$profile->office_logo))){
                    $image = Yii::app()->image->load($this->pathImage('office_logo', $profile->office_logo));
                    $image->resize(50, 50, Image::WIDTH)->crop(50, 50)->save($this->pathImage('office_logo', '50_50_'.$profile->office_logo));
                } else {
                    echo 'Exist ', print_r($this->pathImage('office_logo', '50_50_'.$profile->office_logo), true), PHP_EOL;
                }
            } else {
                echo 'Error - not exist ', print_r($profile->office_logo, true), PHP_EOL;
            }
        }
        
    }
    
    private function pathImage($image_category, $upload_photo) {
        return Yii::app()->basePath.
                "/../images/".
                $image_category."/".
                $upload_photo;
    }
    
//    public function actionFixAgent() {
//        ini_set("memory_limit","768M");
//        Yii::import('application.modules.user.*');
//        Yii::import('application.modules.user.models.*');
//        Yii::import('application.modules.rights.*');
//        Yii::import('application.modules.rights.components.*');
//        
//        $userOld = User::model()->findAll();
//
//        if($userOld){
//            foreach ($userOld as $key => $value) {
//                echo $value->id."\r\n";
////                if(empty($value->profession)) {
////                        Rights::assign('AGENT', $value->id);
////                        echo " ADDED AGENT\r\n";
////                } else {
////                    print_r($value->profession);
////                }
//            }
//        }
//    }
}
