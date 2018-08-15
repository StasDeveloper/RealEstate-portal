<?php

class ProfileController extends Controller {

    public $defaultAction = 'profile';
    public $layout = '//layouts/irradii';
    

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * Shows a particular model.
     */
//    public function actionProfile() {
//        $model = $this->loadUser();
//        $this->render('user_profile', array(
//            'model' => $model,
//            'profile' => $model->profile,
//        ));
//    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param null $id
     * @throws CException
     *
     */
//  public function actionEdit() {
    public function actionProfile($id = null) {
        $anotherUserId = $id;
        if($anotherUserId !== null && SiteHelper::isAdmin()){
            $model = $this->loadAnotherUserData($anotherUserId);
            $editMode = true;
        }else{
            $model = $this->loadUserData();
            $editMode = false;
        }
//        echo "<pre>";
//        var_dump($anotherUserId);
//        var_dump($model);die;

        $profile             = $model->profile;
        $my_profession       = $model->profession;
        $criteria            = new CDbCriteria;
        $criteria->select    = 'name';
        $criteria->condition = "t.name!=:admin AND t.name!=:authenticated AND t.name!=:guest";
        $criteria->params    = array(':admin'=>'Admin',':authenticated'=>'Authenticated', ':guest'=>'Guest');
        $all_profession      = TblAuthItem::model()->findAll($criteria);
        $liststate           = State::model()->findAll();  
        
        $profession_collection_list = array();
        foreach ($my_profession as $val) {
            $profession_collection_list[] = TblProfessionFieldCollection::model()->findByAttributes(array('authitem_name'=>  strtolower($val->itemname)));
        }
        $modelChangePassword = new UserChangePassword;
        
        
        $list_country = !empty($profile->state) ? 
                County::model()->findAllByAttributes(array('state_id'=>$profile->state)) : '';
           
        $list_city = !empty($profile->country) ?
                City::model()->findAllByAttributes(array('county_id'=>$profile->country)) : '';
        
        $list_zip_code = !empty($profile->city) ?
                Zipcode::model()->findAllByAttributes(array('cityid'=>$profile->city)) : '';
        // ajax validator
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'profile-form') {
            echo UActiveForm::validate(array($model, $profile));
            Yii::app()->end();
        }

        if (isset($_POST['User'])) {
//            echo '<pre>',  var_dump($_POST['User']['professionsArray']),'</pre>';die();
            $model->attributes = $_POST['User'];

            $profile->attributes = $_POST['TblUsersProfiles'];

            $newProfessionsArray = $_POST['User']['professionsArray'];


            if(!is_numeric($model->zipcode)){
                $model->zipcode = 0; 
            }
            if($model->street_number){
                $profile->street_number  != $model->street_number  ? $profile->street_number = $model->street_number   : '';
            }
            if($model->street_address){
                $profile->street_address != $model->street_address ? $profile->street_address = $model->street_address : '';
            }
            if($model->state){
                $profile->state          != $model->state          ? $profile->state = $model->state                   : '';
            }
            if($model->country){
                $profile->country        != $model->country        ? $profile->country = $model->country               : '';
            }
            if($model->city){
                $profile->city           != $model->city           ? $profile->city = $model->city                     : '';
            }
            if($model->zipcode){
                $profile->zipcode        != $model->zipcode        ? $profile->zipcode = $model->zipcode               : '';
            }
            
            
            $cdnImages = Yii::app()->params['cdnImages'];
           
            
            $upload_avatar =  CUploadedFile::getInstance($model, 'avatar_image');
            if($upload_avatar){
                $filename_avatar = mktime().$upload_avatar->name;
                $profile->upload_photo = $filename_avatar;
                if(!empty($cdnImages)) {
                    // If avatar is stored at S3
                    CPathCDN::uploadS3Images($upload_avatar, 'avatars', $filename_avatar );
                } else {
                    $saved_avatar = $upload_avatar->saveAs($this->pathImage('avatars', $filename_avatar));
                    if($saved_avatar){

                        $image = Yii::app()->image->load($this->pathImage('avatars', $filename_avatar));
                        $image->resize(180, 180, Image::WIDTH)->crop(180, 180)->save($this->pathImage('avatars', '50_50_'.$filename_avatar));
                    } 
                }
            } 
            
            $upload_company_logo = CUploadedFile::getInstance($model, 'company_logo');
            if($upload_company_logo){
                $filename_company_logo = mktime().$upload_company_logo->name;
                $profile->office_logo = $filename_company_logo;
                if(!empty($cdnImages)) {
                    CPathCDN::uploadS3Images($upload_company_logo, 'office_logo', $filename_company_logo );
                } else {
                    $saved_company_logo = $upload_company_logo->saveAs($this->pathImage('office_logo', $filename_company_logo));
                    if($saved_company_logo){

                        $image = Yii::app()->image->load($this->pathImage('office_logo', $filename_company_logo));
                        $image->resize(180, 180, Image::WIDTH)->crop(180, 180)->save($this->pathImage('office_logo', '50_50_'.$filename_company_logo));
                    }
                }
            } 
            
            $upload_certifications = CUploadedFile::getInstance($model, 'certifications');
            if($upload_certifications){
                $filename_certifications = mktime().$upload_certifications->name;
                $profile->upload_logo = $filename_certifications;
                if(!empty($cdnImages)) {
                    CPathCDN::uploadS3Images($upload_certifications, 'bankers_office_logo', $filename_certifications );
                } else {
                    $saved_company_logo = $upload_certifications->saveAs($this->pathImage('bankers_office_logo', $filename_certifications));
                    if($saved_company_logo){
                                                     
                        $image = Yii::app()->image->load($this->pathImage('bankers_office_logo', $filename_certifications));
                        $image->resize(180, 180, Image::WIDTH)->crop(180, 180)->save($this->pathImage('bankers_office_logo', '50_50_'.$filename_certifications));
                    } 
                }
            }
            $model->lastvisit_at = date('Y-m-d H:i:s');
            if ($model->validate() && $profile->validate()) {

                $db = Yii::app()->db;
                $transaction = $db->beginTransaction();
                try{
                    TblAuthAssignment::model()->updateUserProfessions($model->id, $newProfessionsArray, $editMode);
                    $transaction->commit();
                }catch (Exception $e){
                    $transaction->rollback();
                    echo $e->getMessage();
                }

                $model->save();
                
                $profile->save();
                
                Yii::app()->user->setFlash('profileMessage', UserModule::t("Your changes have been saved."));
                $this->redirect(array('/user/profile'.'/'.$anotherUserId));
                
            } else
               $profile->validate();
        }
//        if(!empty($profile->upload_photo)){
//            if(empty($cdnImages)) {
//            if(file_exists($this->pathImage('avatars', $profile->upload_photo))){
//                if(!file_exists($this->pathImage('avatars', '50_50_'.$profile->upload_photo))){
//                    $image = Yii::app()->image->load($this->pathImage('avatars', $profile->upload_photo));
//                    $image->resize(50, 50, Image::WIDTH)->crop(50, 50)->save($this->pathImage('avatars', '50_50_'.$profile->upload_photo));
//                }
//            }
//            }
//        }
        if(!empty($profile->office_logo)){
            if(empty($cdnImages)) {
            if(file_exists($this->pathImage('office_logo', $profile->office_logo))){
                if(!file_exists($this->pathImage('office_logo', '50_50_'.$profile->office_logo))){
                    $image = Yii::app()->image->load($this->pathImage('office_logo', $profile->office_logo));
                    $image->resize(50, 50, Image::WIDTH)->crop(50, 50)->save($this->pathImage('office_logo', '50_50_'.$profile->office_logo));
                }
            }
            }
        }
        if(!empty($profile->upload_logo)){
            if(empty($cdnImages)) {
            if(file_exists($this->pathImage('bankers_office_logo', $profile->upload_logo))){
                if(!file_exists($this->pathImage('bankers_office_logo', '50_50_'.$profile->upload_logo))){
                    $image = Yii::app()->image->load($this->pathImage('bankers_office_logo', $profile->upload_logo));
                    $image->resize(50, 50, Image::WIDTH)->crop(50, 50)->save($this->pathImage('bankers_office_logo', '50_50_'.$profile->upload_logo));
                }
            }
            }
        }

        if (!Yii::app()->session->sessionID) {
            Yii::app()->session->open();
        }

        $subscr_form_data = PayPalIpn::getSubscriptionFormData();
        $subscr_form_data['subscriptions_left'] = 31 - Subscriptions::model()->count('subscription_id = :subscription_id', array(':subscription_id'=>'1'));
        
//      unset(Yii::app()->session['invitesBox']);
        $invites = Yii::app()->session['invitesBox'];
            
        $this->render('user_profile', array(
            'model'                 => $model,
            'profile'               => $profile,
            'my_profession'         => $my_profession,
            'all_profession'        => $all_profession,
            'liststate'             => $liststate,
            'profession_collection' => (object)$profession_collection_list,
            'modelChangePassword'   => $modelChangePassword,
            'list_country'          => $list_country,
            'list_city'             => $list_city,
            'list_zip_code'         => $list_zip_code,
            'invites'               => $invites,
            'criteria'              => $criteria,
            'subscr_form_data'      => $subscr_form_data,
            'anotherUserId'         => $anotherUserId
        ));
    }
    
    
    private function pathImage($image_category, $upload_photo) {
        return Yii::app()->basePath.
                "/../images/".
                $image_category."/".
                $upload_photo;
    }
    
    public function actionCounty(){
        
        $stid = $_POST['stid'];
        $country_list = array();
        $c_list = County::model()->findAllByAttributes(array('state_id'=>$stid));
        
        foreach ($c_list as $value) {
            $country_list[]=array('country_name'=>$value->country_name, 'county_id'=>$value->county_id);
        }
        
        echo json_encode($country_list);
        
        exit();
    }
    
    public function actionCity(){
        
        $coid = $_POST['coid'];
        $city_list = array();
        $c_list = City::model()->findAllByAttributes(array('county_id'=>$coid));
        
        foreach ($c_list as $value) {
            $city_list[]=array('city_name'=>$value->city_name, 'city_id'=>$value->cityid);
        }
        
        echo json_encode($city_list);
        
        exit();
    }

    public function actionZip(){
        
        $cityid = $_POST['cityid'];
        $zip_list = array();
        $z_list = Zipcode::model()->findAllByAttributes(array('cityid'=>$cityid));
        
        foreach ($z_list as $value) {
            $zip_list[]=array('zip_code'=>$value->zip_code, 'zip_id'=>$value->zip_id);
        }
        
        echo json_encode($zip_list);
        
        exit();
    }
    /**
     * Change password
     */
    public function actionChangepassword() {
        $anotherUserId = null;
        $model = new UserChangePassword;
        if (Yii::app()->user->id) {
           
            // ajax validator
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'changepassword-form') {
                echo UActiveForm::validate($model);
                Yii::app()->end();
            }
            
            if (isset($_POST['UserChangePassword'])) {
                $model->attributes = $_POST['UserChangePassword'];

                if(!isset($_POST['UserChangePassword']['anotherUserId'])){
                    if ($model->validate()) {
                        $new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
                    }
                }
                else{
                    $anotherUserId = $_POST['UserChangePassword']['anotherUserId'];
                    $new_password = User::model()->notsafe()->findbyPk($anotherUserId);
                }
                $new_password->password = UserModule::encrypting($model->password);
                $new_password->activkey = UserModule::encrypting(microtime() . $model->password);
                $new_password->save();
                Yii::app()->user->setFlash('profileMessage', UserModule::t("New password is saved."));
                $this->redirect(array("profile/".$anotherUserId));
                
            }
            Yii::app()->request->isAjaxRequest ?
            $this->renderPartial('changepassword', array('model' => $model)):
            $this->render('changepassword', array('model' => $model));
        }
    }
    
    

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
     */
    public function loadUser() {
        if ($this->_model === null) {
            if (Yii::app()->user->id)
                $this->_model = Yii::app()->controller->module->user();
            if ($this->_model === null)
                $this->redirect(Yii::app()->controller->module->loginUrl);
        }
        return $this->_model;
        
        
    }
    
    public function loadUserData(){
        if ($this->_model === null) {
            if (Yii::app()->user->id) {
                $dependency = new CDbCacheDependency('SELECT lastvisit_at FROM tbl_users WHERE id='.Yii::app()->user->id);
                $this->_model = User::model()->cache(36000, $dependency, 1)->with('profile','profession')->findByPk(Yii::app()->user->id);
            }
            if ($this->_model === null)
                $this->redirect(Yii::app()->controller->module->loginUrl);
        }
        return $this->_model;
    }



    public function loadAnotherUserData($uid){
        $dependency = new CDbCacheDependency('SELECT lastvisit_at FROM tbl_users WHERE id='.$uid);
        $this->_model = User::model()->cache(36000, $dependency, 1)->with('profile','profession')->findByPk($uid);
        return $this->_model;
    }
    
    
    
    public function actionAutocompletelocation(){
        $zipcode = intval($_POST['zipcode']);
        $zipcode_db_info = Zipcode::model()->
                with('city', 'country','state')->
                findByAttributes(array('zip_code'=>$zipcode));
        //$zipcode_list = Zipcode::model()->findAllByAttributes(array('cityid'=>$zipcode_db_info->city->cityid));
        
        $result = array();
        $result['zip'] = array('zip_id' => $zipcode_db_info->zip_id, 'zip_code'=> $zipcode_db_info->zip_code);
        $result['city'] = array('cityid'=> $zipcode_db_info->city->cityid, 'city_name'=> $zipcode_db_info->city->city_name);
        $result['country'] = array('county_id'=> $zipcode_db_info->country->county_id, 'country_name'=> $zipcode_db_info->country->country_name);
        $result['state'] = array('stid' => $zipcode_db_info->state->stid, 'state_name'=> $zipcode_db_info->state->state_name);
        //echo '<pre>',  print_r($zipcode_db_info),'</pre>';die();
        echo json_encode($result);
        exit();
    }
    
    public function actionCloseInvites() {
        if(Yii::app()->request->isPostRequest)
        {
            if (Yii::app()->user->id) {
                if (!Yii::app()->session->sessionID) {
                    Yii::app()->session->open();
                }
                Yii::app()->session['invitesBox'] = true;
            }
            Yii::app()->end();
        }
        else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

    }





}
