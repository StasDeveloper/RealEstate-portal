<?php

class MembershipController extends Controller
{
//	public $layout='column2';
    public $layout='//layouts/irradii';
    public $searchParams = array();


    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array(
                'allow', // allow all user to perform 'create' and 'update' actions
                'actions' => array('details', 'search', 'history', 'yiichat', 'chat' ,  'messages', 'online', 'listenToIpn', 'example'),
                'users' => array('*'),
            ),
            array(
                'allow', // allow authenticated users to perform 'index' and 'view' actions
                'actions' => array('index', 'unsubscribe'),
                'users' => array('@'),
            ),
            array('allow', // allow admin to perform 'admin' and 'delete' actions
                'actions' => array('searchMembership', 'saveUserChanges', 'pageNavigate'),
                'roles' => array('admin'),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex(){
        $profile = $this->getUserProfile();
        $this->render('indexMembershipView', array(
            'profile' => Yii::app()->user->isGuest ? '' : $profile,
            )
        );

    }

    /**
     * All incoming data from PayPal goes here
     *
     */
    public function actionListenToIpn(){
        $raw_post_data = file_get_contents('php://input');
        $ipnProcessor = new PayPalIpn();
        $ipnProcessor->createIpnProcessor($raw_post_data);
    }

    /**
     * Unsubscribe button runs this method
     *
     */
    public function actionUnsubscribe(){
        $ipnProcessor = new PayPalIpn();
        $result = $ipnProcessor->changeSubscriptionStatus();
        $profile = $this->getUserProfile();

        if($result){
            $this->render('indexMembershipView', array(
                    'profile' => Yii::app()->user->isGuest ? '' : $profile,
                    'status' => 'canceled'
                )
            );
        }else{
            $this->render('indexMembershipView', array(
                    'profile' => Yii::app()->user->isGuest ? '' : $profile,
                    'status' => 'error'
                )
            );
        }
    }

    private function getUserProfile(){
        $profile = '';
        if(!Yii::app()->user->isGuest) {
            $userModel = User::model()->with('profile', 'profession')->findByPk(Yii::app()->user->id);
            $profile = $userModel->profile;
        }
        return $profile;
    }

    public function actionSearchMembership(){
        $profile = $this->getUserProfile();
        $previewsSearchParams = '';
        if(count($_POST) == 0) {

            $this->render('indexMembershipView', array(
                    'profile' => $profile,
                    'searchMode' => true,
                    'previewsSearchParams' => $previewsSearchParams,
                    'result' => $result = array(),
                )
            );
        }
        else{
            $membersSearch = new MembersSearch();
            $this->searchParams = $_POST;

            $result = $membersSearch->findMembers($this->searchParams);
            $members = $result['members'];

            $this->render('indexMembershipView', array(
                    'profile' => $profile,
                    'searchMode' => true,
                    'members' => $members,
                    'previewsSearchParams' => $this->searchParams,
                    'result' => $result
                )
            );
        }
    }

    public function actionPageNavigate(){
        $membersSearch = new MembersSearch();
        parse_str($_POST['ajaxData'], $post);
//        Yii::log(print_r($post, 1), 'error');
        $result = $membersSearch->findMembers($post);
        $result['renderedSearchForm'] = $renderedSearchForm = $this->renderPartial('_membershipSearchFormView', array('previewsSearchParams'=>$post, 'result'=>$result), true);
        $result['renderedMembersTable'] = $renderedMembersTable = $this->renderPartial('_foundMembersView', array('members' => $result['members']), true);
//        Yii::log(print_r($renderedSearchForm, 1), 'error');
        if(Yii::app()->request->isAjaxRequest){
            header('Content-Type: application/json; charset="UTF-8"');
            echo CJSON::encode(array('result'=>$result));
            Yii::app()->end();
        }
    }

    public function actionSaveUserChanges(){
        parse_str($_POST['ajaxData'], $post);
//        Yii::log('incoming Ajax -> '.print_r($post,1), 'error');
        $profile = TblUsersProfiles::model()->findByPk($post['profile_id']);
        $profile->payment_type = $post['membershipType'];
        $profile->membership_expire_date = date('Y-m-d', strtotime($post['membership_expire_date']));
        if($profile->save()) {
//            Yii::log('user profile -> '.print_r($profile,1), 'error');
            if (Yii::app()->request->isAjaxRequest) {
                header('Content-Type: application/json; charset="UTF-8"');
                echo CJSON::encode(array('output' => $post));
                Yii::app()->end();
            }
        }
    }


}













