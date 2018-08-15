<?php

class UploadController extends Controller
{
//	public $layout='column2';
        public $layout='//layouts/irradii';

        public $allowed_types = array(
            'image/jpeg'=>'image/jpeg',
            'image/png'=>'image/png',
            'image/gif'=>'image/gif'
        );
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
			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('index', 'summernote'),
//				'users'=>array('*'),
                            'roles'=>array('admin'),
                        ),
			array('allow', // allow authenticated users to access all actions
//				'users'=>array('@'),
                            'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Upload file from ckeditor
	 */
	public function actionIndex()
	{
            $result = 'error';
            $funcNum = 0;
            $url = '';
            if(Yii::app()->request->isPostRequest) // Yii::app()->request->isAjaxRequest
            {
                $cdnImages = Yii::app()->params['cdnImages'];
                $funcNum = Yii::app()->request->getParam('CKEditorFuncNum');
                $upload_image =  CUploadedFile::getInstanceByName( 'upload');
                if($upload_image){
                    // Check to make sure the image type is allowed
                    if ( isset($this->allowed_types[$upload_image->type])) {
                        $filename_avatar = mktime().$upload_image->name;
                        if(!empty($cdnImages)) {
                            CPathCDN::uploadS3Files($upload_image, 'blog', $filename_avatar );
                            $url = $cdnImages . '/images/blog/' . $filename_avatar;
                            $result = 'Success upload file';
                        } else {
                            $result = 'Error upload file';
                        }
                    } else {
			$result = 'Image type not allowed';
                    }
                } else {
                    $result = 'File not uploaded';
                }
                echo "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$result')</script>";
                Yii::app()->end(); 
            } else {
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            }
	}

	/**
	 * Upload file from Summernote
	 */
	public function actionSummernote()
	{
            $result = 'error';
            $url = '';
            $error = 1;
            if(Yii::app()->request->isPostRequest) // Yii::app()->request->isAjaxRequest
            {
                $cdnImages = Yii::app()->params['cdnImages'];
                $upload_image =  CUploadedFile::getInstanceByName( 'file');
                if($upload_image){
                    // Check to make sure the image type is allowed
                    if ( isset($this->allowed_types[$upload_image->type])) {
                        $filename_avatar = mktime().$upload_image->name;
                        if(!empty($cdnImages)) {
                            CPathCDN::uploadS3Files($upload_image, 'blog', $filename_avatar );
                            $url = $cdnImages . '/images/blog/' . $filename_avatar;
                            $result = 'Success upload file';
                            $error = 0;
                        } else {
                            $result = 'Error upload file';
                        }
                    } else {
			$result = 'Image type not allowed';
                    }
                } else {
                    $result = 'File not uploaded';
                }
                header('Content-Type: application/json; charset="UTF-8"');
                echo CJSON::encode(array('error'=>$error, 'result'=>$result, 'url'=>$url));
                Yii::app()->end(); 
            } else {
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            }
	}
}
