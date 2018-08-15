<?php

class DefaultController extends Controller
{
    public $layout='//layouts/column1';

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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','error'),
//                'expression'=>'isset(Yii::app()->userseo->name)',
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionIndex()
    {
//        $this->verifyTable();
        $this->redirect(Yii::app()->createUrl("yiiseo/seo/"));
    }

    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
//
//    /**
//     * Displays the login page
//     */
//    public function actionLogin()
//    {
//        $this->verifyTable();
//        $model=Yii::createComponent('yiiseo.models.LoginForm');
//
//        // collect user input data
//        if(isset($_POST['LoginForm']))
//        {
//            $model->attributes=$_POST['LoginForm'];
//            // validate user input and redirect to the previous page if valid
//            if($model->validate() && $model->login())
//                $this->redirect(Yii::app()->createUrl('yiiseo/seo/index'));
//        }
//        // display the login form
//        $this->render('login',array('model'=>$model));
//    }
//
//    /**
//     * Logs out the current user and redirect to homepage.
//     */
//    public function actionLogout()
//    {
//        Yii::app()->userseo->logout(false);
//        $this->redirect(Yii::app()->createUrl('yiiseo/seo/index'));
//    }

}