<?php

class CronEmailAlertsSenderCommand extends CConsoleCommand {

    public function run(){
        $today = new DateTime('now');

        $emailFreqs = array(
            SavedSearch::EMAIL_FREQ_IMMEDIATELY
        );

        if(intval($today->format('G')) == SavedSearch::EMAIL_FREQ_DAILY_HOUR){
            $emailFreqs[] = SavedSearch::EMAIL_FREQ_DAILY;
        }

        if(intval($today->format('w')) == SavedSearch::EMAIL_FREQ_WEEKLY_DAY &&
            intval($today->format('G')) == SavedSearch::EMAIL_FREQ_WEEKLY_HOUR
        ){
            $emailFreqs[] = SavedSearch::EMAIL_FREQ_WEEKLY;
        }

        $criteria=new CDbCriteria();
        $criteria->addInCondition('email_freq',$emailFreqs);
        $plannedEmails = PlannedEmailAlert::model()->findAll($criteria);

        if(empty($plannedEmails))
            return;

        $plannedEmailIDs = array();
        $savedSearchAndProperties = array();
        foreach($plannedEmails as $plannedEmail){
            $plannedEmailIDs[] = $plannedEmail->id;
            $savedSearchAndProperties[$plannedEmail->saved_search_id][] = $plannedEmail->property_id;
        }

        //get daily messages from tbl_alerts_scheduled_messages
        $today = date('Y-m-d');
        $dailyMessages = AlertsScheduledMessages::model()->find('date=:date', array(':date'=>$today));

        //$propertiesPerEmail = 5;
        foreach($savedSearchAndProperties as $savedSearchID => $propertiesIDs){
            $savedSearchModel = SavedSearch::model()->with('alertEmails', 'user')->findByPk($savedSearchID);
            if(!$savedSearchModel)
                continue;

            //$propertiesSliceIDs = array_slice($propertiesIDs, 0, $propertiesPerEmail);

            $propertyModels = PropertyInfo::model()
                /*->cache(1000, null, 7)*/
                ->with(array(
                    'city', 'county', 'state', 'zipcode' /*, 'brokerage_join'*/
                    , 'propertyInfoAdditionalBrokerageDetails' => array(
                        'alias'=>'piabd',
                        'joinType'=>'INNER JOIN',
                        'condition'=>"UPPER(piabd.status) NOT IN ('EXPIRED')" // 'HISTORY',
                    ),
                    'slug'
                ))->findAllByAttributes(
                    array('property_id' => $propertiesIDs),
                    array(
                        'order' => 't.property_id desc',
                        //'limit' => $propertiesPerEmail,
                    )
                );

            // find agents (ChatAction.php line 66)
            // $criteria = new CDbCriteria();
            // $criteria->select = array('mid');
            // $criteria->group = 'mid';
            // $criteria->condition = 'zipcode = :property_zipcode';
            // $criteria->params = array(':property_zipcode'=>$property_zipcode);
            // $agent_mids = TblUsersProfiles::model()->findAll($criteria);

            if(!empty($propertyModels)) {

                foreach($savedSearchModel->getEmails() as $email){

                    $theme_path = __DIR__.'/../..'.Yii::app()->params['YiiMailer']['viewPath'];

                    $templateData = array(
                        'theme_path' => $theme_path,
                        'propertyModels' => $propertyModels,
                        'savedSearchModel' => $savedSearchModel,
                        'email'=>$email,
                        'dailyMessages'=>$dailyMessages,
                    );

                    $pathToTemplate = $theme_path.'/savedSearchEmailAlert.php';

                    $html = $this->renderFile($pathToTemplate, $templateData, true);

                    $mail = new YiiMailer();
                    $mail->clearLayout();//if layout is already set in config
                    $mail->setFrom('noreply@irradii.com', 'irradii.com');
                    $mail->setTo($email);
                    $mail->setSubject('"'.$savedSearchModel->name.'" Property Search Results');
                    $mail->setBody($html);
                    if($mail->send()) {
//                        Yii::log('Email Alert: Sended to ' . $email ,'ERROR'); 
                    } else {
                        Yii::log('Email Alert: NOT Sended to ' . $email ,'ERROR'); 
                    }
                }
            } else {
                Yii::log('Email Alert: Empty properties list ','ERROR'); 
            }
        }

        // delete all planedEmails that sent
        $criteria = new CDbCriteria;
        $criteria->addInCondition('id',$plannedEmailIDs);
        PlannedEmailAlert::model()->deleteAll($criteria);
    }

    /**
     * Draw the status label
     *
     * @param PropertyInfo $property_model
     * @param $labelStyle
     */
    public function drawStatusLabel(PropertyInfo $property_model,$labelStyle)
    {
        if (isset($property_model->propertyInfoAdditionalBrokerageDetails->status)) {
            $status = $property_model->propertyInfoAdditionalBrokerageDetails->status;
            $percentage = $property_model->getDiscontValue();
            $discount = $percentage >= Yii::app()->params['underValueDeals'];
            $colorScheme = SiteHelper::getColorScheme($status, $discount);
            $colorScheme['stat'] = $status;
            $labelStyle .= $colorScheme['color_m'];
            echo '<span style="'.$labelStyle.'">'.$status.'</span>';
        }
    }

    /**
     * Show difference between TMV and AskedPrice
     *
     * @param $trueMV
     * @param $price
     * @return mixed
     */
    public function showEstimatedEquity($trueMV, $price){
        if($trueMV > $price){
            $estimatedEquity = $trueMV - $price;
            return $estimatedEquity;
        }
    }


    /**
     * Display the % bellow TMV if the condition is true
     *
     * @param PropertyInfo $property_model
     * @return null|string
     */
    public function showBellowPercentage(PropertyInfo $property_model){
        $percentage = $property_model->getDiscontValue();
        if ($percentage >= Yii::app()->params['underValueDeals']) {
//            $style = "top: 0px; left: 0px; position: absolute; z-index: 15; background-color: #496949 !important; display: inline-block;min-width: 10px;padding: 3px 7px;font-size: 12px;font-weight: bold;color: #ffffff;line-height: 1;vertical-align: baseline;white-space: nowrap;text-align: center;background-color: #999999;border-radius: 10px;";
            $style = "z-index: 15; background-color: #496949 !important; display: inline-block;min-width: 10px;padding: 3px 7px;font-size: 12px;font-weight: bold;color: #ffffff;line-height: 1;vertical-align: baseline;white-space: nowrap;text-align: center;background-color: #999999;border-radius: 10px;";
            return "<span style='$style'>&nbsp;".round($percentage)." % Below TMV &nbsp;</span>";
        }
        else{
            return null;
        }
    }

}



















