<?php

class ChatAction extends CAction {

    public function run() {

        $action = isset($_POST['action']) ? $_POST['action'] : '';
        $owner_mid = isset($_POST['owner_mid']) ? $_POST['owner_mid'] : 0;
        $property_zipcode = isset($_POST['property_zipcode'])? $_POST['property_zipcode'] : 0;
        $list_customers = isset($_POST['list_customers']) ? $_POST['list_customers'] : '';
        $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : '';
        
        $datetime_now = new DateTime();
        $result = array();
        
        $result['chat_users'] = array();
        if($user_type){
            $collocitors_list = $this->getCollocutorList();
            if($collocitors_list){
                foreach ($collocitors_list as $collocitor_list) {
                    $online = 'no';
                    $datetime_exp = new DateTime($collocitor_list->users->lastvisit_at);
                    $interval = $datetime_now->diff($datetime_exp);
                    if(($interval->days == 0) && ($interval->h == 0) && ($interval->i < 5)){
                        $online = 'yes';
                    } 
                    $ext = array('.png','.jpg','.gif','.jpeg');
                    $ext_f = strrpos($collocitor_list->users->profile->upload_photo, '.');
                    if($ext_f){ 
                        $sud_str_f = substr($collocitor_list->users->profile->upload_photo, $ext_f);  
                        if(in_array($sud_str_f, $ext)){
                            !is_readable(Yii::app()->basePath."/../images/avatars/".$collocitor_list->users->profile->upload_photo) ? 
                            $collocitor_list->users->profile->upload_photo = 'male.png' : '';
                        } 
                    } else {
                        $collocitor_list->users->profile->upload_photo = 'male.png';
                    }
                    
                    $ext_f = strrpos($collocitor_list->users->profile->office_logo, '.');
                    if($ext_f){ 
                        $sud_str_f = substr($collocitor_list->users->profile->office_logo, $ext_f);  
                        if(in_array($sud_str_f, $ext)){
                            !is_file(Yii::app()->basePath."/../images/office_logo/".$collocitor_list->users->profile->office_logo) ? 
                                $collocitor_list->users->profile->office_logo = 'male.png' : '';
                        } 
                    } else {
                        $collocitor_list->users->profile->office_logo = 'male.png';
                    }
                    
                    $result['chat_users'][$collocitor_list->users->id] = array('profile'=>$collocitor_list->users->profile,'user'=>$online);
                   
                    unset($online);
                    unset($datetime_exp);
                    unset($interval);
                }
            }
            clearstatcache();
            header("Content-type: application/json");
            echo CJSON::encode($result);
            exit();
        }

        $result['user_type'] = 'user';
        if ($action == 'post' || $action == 'get') {

            if($property_zipcode != 0){
                $criteria = new CDbCriteria();
                $criteria->select = array('mid');
                $criteria->group = 'mid';
                $criteria->condition = 'zipcode = :property_zipcode';
                $criteria->params = array(':property_zipcode'=>$property_zipcode);
                //$agent_mids = RegistrationStep2::model()->findAll($criteria);
                $agent_mids = TblUsersProfiles::model()->findAll($criteria);

                $result['advertising_agents_list'] = array();
                if(count($agent_mids)>0){
                    foreach ($agent_mids as $agents) {

                        $agent_info = User::model()->with('zip_n','profile','city_n','county_n','state_n')->findByPk($agents->mid);
                        if(empty($agent_info))
                            continue;

                        $online = 'no';
                        if(!Yii::app()->user->isGuest){
                            if($result['user_type'] === 'user'){
                                $result['user_type'] = $this->checkUserType($agents->mid);
                            }
                        }
                        $ext = array('.png','.jpg','.gif','.jpeg');
                        $ext_f = strrpos($agent_info->profile->upload_photo, '.');
                        if($ext_f){ 
                            $sud_str_f = substr($agent_info->profile->upload_photo, $ext_f);  
                            if(in_array($sud_str_f, $ext)){
                                !is_readable(Yii::app()->basePath."/../images/avatars/".$agent_info->profile->upload_photo) ? 
                                $agent_info->profile->upload_photo = 'male.png' : ''; 
                            } 
                        } else {
                            $agent_info->profile->upload_photo = 'male.png';
                        }
                        
                        $ext = array('.png','.jpg','.gif','.jpeg');
                        $ext_f = strrpos($agent_info->profile->office_logo, '.');
                        if($ext_f){ 
                            $sud_str_f = substr($agent_info->profile->office_logo, $ext_f);  
                            if(in_array($sud_str_f, $ext)){
                                !is_file(Yii::app()->basePath."/../images/office_logo/".$agent_info->profile->office_logo) ? 
                                $agent_info->profile->office_logo = 'male.png' : ''; 
                            } 
                        } else {
                            $agent_info->profile->office_logo = 'male.png';
                        }
                        

                         $datetime_exp = new DateTime($agent_info->lastvisit_at);
                         $interval = $datetime_now->diff($datetime_exp);
                         if(($interval->days == 0) && ($interval->h == 0) && ($interval->i < 5)){
                             $online = 'yes';
                         } 
                        
                        $result['advertising_agents_list'][] = array('profile'=>$agent_info->profile,
                                                                    'user'=>$online, 
                                                                    'zip'=>$agent_info->zip_n->zip_code,
                                                                    'city'=>$agent_info->city_n->city_name,
                                                                    'county'=>$agent_info->county_n->county_name,
                                                                    'state'=>$agent_info->state_n->state_name );
                        
                        $result['chat_users'][$agent_info->profile->mid] = array('profile'=>$agent_info->profile,
                                                                                'user'=>$online, 
                                                                                'zip'=>$agent_info->zip_n->zip_code,
                                                                                'city'=>$agent_info->city_n->city_name,
                                                                                'county'=>$agent_info->county_n->county_name,
                                                                                'state'=>$agent_info->state_n->state_name );
                        unset($online);
                        unset($datetime_exp);
                        unset($interval);
                    } 
                    
                }     
            } 
            $owner_info = User::model()->with('zip_n','profile','city_n','county_n','state_n')->findByPk($owner_mid);

            $result['owner'] = array();
            if($owner_info){
                $online = 'no';
                if(!empty($owner_info->profile)){
                    $zipCodeArray = array();
                    if($owner_info->city_n && $owner_info->zip_n) {
                        $command = Yii::app()->db->createCommand();
                        $zipCodeObjArray = $command->select('zip_code')->from('zipcode')->where('cityid = :cityid', array(':cityid' =>$owner_info->city_n->cityid))->queryAll();
                        foreach($zipCodeObjArray as $zipObj){
                            $zipCodeArray[] = $zipObj['zip_code'];
                        }
                        if(!in_array($owner_info->zip_n->zip_code, $zipCodeArray)){
                            $owner_info->zip_n->zip_code = 0;
                            $owner_info->city_n->city_name = '';
                            $owner_info->county_n->county_name = '';
                        }
                    }
                    $ext = array('.png','.jpg','.gif','.jpeg');
                    $ext_f = strrpos($owner_info->profile->upload_photo, '.');
                    if($ext_f){ 
                        $sud_str_f = substr($owner_info->profile->upload_photo, $ext_f);  
                        if(in_array($sud_str_f, $ext)){
                            !is_readable(Yii::app()->basePath."/../images/avatars/".$owner_info->profile->upload_photo) ? 
                                   $owner_info->profile->upload_photo = 'male.png' : ''; 
                        } 
                    } else {
                        $owner_info->profile->upload_photo = 'male.png';
                    }
                    $ext_f = strrpos($owner_info->profile->office_logo, '.');
                    if($ext_f){ 
                        $sud_str_f = substr($owner_info->profile->office_logo, $ext_f);  
                        if(in_array($sud_str_f, $ext)){
                            !is_file(Yii::app()->basePath."/../images/office_logo/".$owner_info->profile->office_logo) ? 
                                   $owner_info->profile->office_logo = 'male.png' : '';     
                        } 
                    } else {
                        $owner_info->profile->office_logo = 'male.png';
                    }
                    $datetime_exp = new DateTime($owner_info->lastvisit_at);
                    $interval = $datetime_now->diff($datetime_exp);
                    if(($interval->days == 0) && ($interval->h == 0) && ($interval->i < 5)){
                        $online = 'yes';
                    }
                    $result['owner'][] = array('profile'=>$owner_info->profile,
                                                'user'=>$online, 
                                                'zip'=>$owner_info->zip_n ? $owner_info->zip_n->zip_code : 0,
                                                'city'=>$owner_info->city_n ? $owner_info->city_n->city_name : '',
                                                'county'=>$owner_info->county_n ? $owner_info->county_n->county_name : '',
                                                'state_code'=>$owner_info->state_n ? $owner_info->state_n->state_code : '',
                                                'state'=>$owner_info->state_n ? $owner_info->state_n->state_name : '' );

                    $result['chat_users'][$owner_info->profile->mid] = array('profile'=>$owner_info->profile,
                                                                            'user'=>$online, 
                                                                            'zip'=>$owner_info->zip_n ? $owner_info->zip_n->zip_code : 0,
                                                                            'city'=>$owner_info->city_n ? $owner_info->city_n->city_name : '',
                                                                            'county'=>$owner_info->county_n ? $owner_info->county_n->county_name : '',
                                                                            'state'=>$owner_info->state_n ? $owner_info->state_n->state_name : '' );
                    if(!Yii::app()->user->isGuest){
                        if($result['user_type'] === 'user'){
                            $result['user_type'] = $this->checkUserType($owner_mid);
                        }
                    }
                    unset($online);
                    unset($datetime_exp);
                    unset($interval);
                }
            }
            $result['saved_agents'] = array();
            if(!Yii::app()->user->isGuest){
                $saved_agents = SavedAgent::model()->with('saved_agent',
                                                        'profile',
                                                        'zip_n',
                                                        'city_n',
                                                        'county_n',
                                                        'state_n')->findAllByAttributes(array('mid'=>Yii::app()->user->id));
                
                if(count($saved_agents)>0){
                    
                    foreach ($saved_agents as $saved_agent) {
                        $online = 'no';
                        $ext = array('.png','.jpg','.gif','.jpeg');
                        $ext_f = strrpos($saved_agent->saved_agent->profile->upload_photo, '.');
                        if($ext_f){ 
                            $sud_str_f = substr($saved_agent->saved_agent->profile->upload_photo, $ext_f);  
                            if(in_array($sud_str_f, $ext)){
                                !is_readable(Yii::app()->basePath."/../images/avatars/".$saved_agent->saved_agent->profile->upload_photo) ? 
                                   $saved_agent->saved_agent->profile->upload_photo = 'male.png' : '';
                            } 
                        } else {
                            $saved_agent->saved_agent->profile->upload_photo = 'male.png';
                        }
                        $ext_f = strrpos($saved_agent->saved_agent->profile->office_logo, '.');
                        if($ext_f){ 
                            $sud_str_f = substr($saved_agent->saved_agent->profile->office_logo, $ext_f);  
                            if(in_array($sud_str_f, $ext)){
                                !is_file(Yii::app()->basePath."/../images/office_logo/".$saved_agent->saved_agent->profile->office_logo) ? 
                               $saved_agent->saved_agent->profile->office_logo = 'male.png' : ''; 
                            } 
                        } else {
                            $saved_agent->saved_agent->profile->office_logo = 'male.png';
                        }
                        
                        
                        $datetime_exp = new DateTime($saved_agent->saved_agent->lastvisit_at);
                        $interval = $datetime_now->diff($datetime_exp);
                        if(($interval->days == 0) && ($interval->h == 0) && ($interval->i < 5)){
                            $online = 'yes';
                        } 
                        $result['saved_agents'][] = array('profile'=>$saved_agent->saved_agent->profile,
                                                        'user'=>$online,
                                                        'zip'=>$saved_agent->saved_agent->zip_n->zip_code,
                                                        'city'=>$saved_agent->saved_agent->city_n->city_name,
                                                        'county'=>$saved_agent->saved_agent->county_n->county_name,
                                                        'state'=>$saved_agent->saved_agent->state_n->state_name );
                        
                        $result['chat_users'][$saved_agent->saved_agent->profile->mid] = array(
                                                        'profile'=>$saved_agent->saved_agent->profile,
                                                        'user'=>$online,
                                                        'zip'=>$saved_agent->saved_agent->zip_n->zip_code,
                                                        'city'=>$saved_agent->saved_agent->city_n->city_name,
                                                        'county'=>$saved_agent->saved_agent->county_n->county_name,
                                                        'state'=>$saved_agent->saved_agent->state_n->state_name);
                        if(!Yii::app()->user->isGuest){
                            if($result['user_type'] === 'user'){
                                $result['user_type'] = $this->checkUserType($saved_agent->saved_agent->profile->mid);
                            }
                        }
                        unset($online);
                        unset($datetime_exp);
                        unset($interval);
                    }
                }
            }
            
            
            $result['max_rating'] = array();
            /* AND `t1`.`rating_average` = (SELECT max(`t3`.`rating_average`) 
                                            FROM `tbl_users_profiles` AS t3
                                            WHERE `t3`.`zipcode`='".$property_zipcode."') AND (`t3`.`rating_average`!='0' OR `t3`.`rating_average`!='0.00')*/
            $max_ratings = Yii::app()->db->createCommand("SELECT `t1`.`mid` AS mid, 
                                                            `t1`.`first_name` AS first_name, 
                                                            `t1`.`middle_name` AS middle_name, 
                                                            `t1`.`last_name` AS last_name, 
                                                            `t1`.`office` AS office, 
                                                            `t1`.`phone` AS phone, 
                                                            `t1`.`phone_office` AS phone_office, 
                                                            `t1`.`phone_fax` AS phone_fax, 
                                                            `t1`.`phone_home` AS phone_home, 
                                                            `t1`.`phone_mobile` AS phone_mobile, 
                                                            `t1`.`website_url` AS website_url, 
                                                            `t1`.`upload_photo` AS upload_photo, 
                                                            `t1`.`office_logo` AS office_logo, 
                                                            `t1`.`upload_logo` AS upload_logo, 
                                                            `t1`.`rating_average` AS rating_average,
                                                            `t2`.`itemname` AS role, 
                                                            `t4`.`lastvisit_at` AS lastvisit, 
                                                            `t5`.`zip_code` AS zip,
                                                            `t6`.`city_name` AS city,
                                                            `t7`.`county_name` AS county,
                                                            `t8`.`state_name` AS state
                                                          FROM `tbl_users_profiles` AS t1 
                                                          INNER JOIN `tbl_AuthAssignment` AS t2 
                                                                ON (`t2`.`userid`=`t1`.`mid` AND  (`t2`.`itemname` IN ('agent') AND `t2`.`itemname` IS NOT NULL ))
                                                          LEFT JOIN `tbl_users` AS t4 ON `t4`.`id`=`t1`.`mid`
                                                          LEFT JOIN `zipcode` AS t5 ON `t5`.`zip_id`=`t1`.`zipcode`
                                                          LEFT JOIN `city` AS t6 ON `t6`.`cityid`=`t5`.`cityid`
                                                          LEFT JOIN `county` AS t7 ON `t7`.`county_id`=`t6`.`county_id`
                                                          LEFT JOIN `state` AS t8 ON `t8`.`stid`=`t7`.`state_id`
                                                          WHERE `t1`.`zipcode`='".$property_zipcode."' 
                                                          AND `t1`.`rating_average` = (SELECT max(`t3`.`rating_average`) 
                                                                            FROM `tbl_users_profiles` AS t3
                                                                            WHERE `t3`.`zipcode`='".$property_zipcode."'
                                                                            AND (`t3`.`rating_average`!='0' 
                                                                                OR `t3`.`rating_average`!='0.00')
                                                                            ) ")->queryAll();
            if(count($max_ratings)>0){
                foreach ($max_ratings as $max_rating){
                    $max_rating = (object)$max_rating;
                    $online = 'no';
                    !is_readable(Yii::app()->basePath."/../images/avatars/".$max_rating->upload_photo) ? 
                                  $max_rating->upload_photo = '' : '';
                    
                    $datetime_exp = new DateTime($max_rating->lastvisit);
                    $interval = $datetime_now->diff($datetime_exp);
                    if(($interval->days == 0) && ($interval->h == 0) && ($interval->i < 5)){
                        $online = 'yes';
                    } 
                    $result['max_rating'][] = array('profile'=>$max_rating,'user'=>$online);
                    $result['chat_users'][$max_rating->mid] = array('profile'=>$max_rating,'user'=>$online, );
                    if(!Yii::app()->user->isGuest){
                        if($result['user_type'] === 'user'){
                            $result['user_type'] = $this->checkUserType($max_rating->mid);
                        }
                    }
                    unset($online);
                    unset($datetime_exp);
                    unset($interval);
                }
  
            }
            $result['current_user'] = array();
            if(!Yii::app()->user->isGuest){
                $current_user = TblUsersProfiles::model()->with(
                                                        'users', 
                                                        'zip_n',
                                                        'city_n',
                                                        'county_n',
                                                        'state_n')->findByAttributes(array('mid'=>Yii::app()->user->id));
                
                if($current_user){
                    $online = 'no';
                    $datetime_exp = new DateTime($current_user->users->lastvisit_at);
                    $interval = $datetime_now->diff($datetime_exp);
                    if(($interval->days == 0) && ($interval->h == 0) && ($interval->i < 5)){
                        $online = 'yes';
                    } 

                    $result['current_user'] = array(
                        'profile'=>$current_user,
                        'user'=>$online,
                        'zip'=>isset($current_user->zip_n->zip_code)?$current_user->zip_n->zip_code:'',
                        'city'=>isset($current_user->city_n->city_name)?$current_user->city_n->city_name:'',
                        'county'=>isset($current_user->county_n->county_name)?$current_user->county_n->county_name:'',
                        'state'=>isset($current_user->state_n->state_name)?$current_user->state_n->state_name:''
                        );
                    unset($online);
                    unset($datetime_exp);
                    unset($interval);
                }
            }
            $result['collocutor_list'] = array();
            if(!Yii::app()->user->isGuest && $result['user_type'] === 'owner'){
               if($this->isChatRoomOwner() > 0){
                                      
                  $collocutors_list = $this->getCollocutorList();
                  
                   if(count($collocutors_list)>0){
                       foreach ($collocutors_list as $collocutor) {
                            $online = 'no';
                            $datetime_exp = new DateTime($collocutor->users->lastvisit_at);
                            $interval = $datetime_now->diff($datetime_exp);
                            if(($interval->days == 0) && ($interval->h == 0) && ($interval->i < 5)){
                                $online = 'yes';
                            } 
                            $result['collocutor_list'][] = array(
                                'profile'=>$collocutor->users->profile,
                                'user'=>$online,
                                'zip'=>$collocutor->users->zip_n->zip_code,
                                'city'=>$collocutor->users->city_n->city_name,
                                'county'=>$collocutor->users->county_n->county_name,
                                'state'=>$collocutor->users->state_n->state_name
                                );
                            $result['chat_users'][$collocutor->users->id] = array('profile'=>$collocutor->users->profile,
                                'user'=>$online,
                                'zip'=>$collocutor->users->zip_n->zip_code,
                                'city'=>$collocutor->users->city_n->city_name,
                                'county'=>$collocutor->users->county_n->county_name,
                                'state'=>$collocutor->users->state_n->state_name);
                            
                            unset($online);
                            unset($datetime_exp);
                            unset($interval);
                       }
                   }
                   
               }
               
            }
        }
        clearstatcache();
        //echo '<pre>',  print_r($result),'</pre>';die();
        header("Content-type: application/json");
        echo CJSON::encode($result);
        exit();
    }
    
    private function checkUserType($mid) {
        return $mid == Yii::app()->user->id ? 'owner' : 'user';
    }
    
    private function isChatRoomOwner() {
        $criteria = new CDbCriteria();
        $criteria->select = 'owner_room';
        $criteria->condition = 'owner_room = :owner_room';
        $criteria->params = array(':owner_room'=>Yii::app()->user->id);
        return TblChat::model()->count($criteria);
    }
    
    private function getCollocutorList(){
        $criteria = new CDbCriteria();
        $criteria->select = 'collocutor_id';       
        $criteria->condition = 'owner_room  = :owner_room';
        $criteria->group = 'collocutor_id';
        $criteria->params = array(':owner_room'=>Yii::app()->user->id);
        return TblChat::model()->with('users','zip_n','city_n','county_n','state_n')->findAll($criteria);
    }

    

}