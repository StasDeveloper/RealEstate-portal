<?php
// CPathCDN::baseurl( 'images' )
class CPathCDN {

    public static function baseurl($type = 'cdn') {
//Yii::log('Step 1-0: ' ,'ERROR'); 
        switch ($type) {
            // theme
            case 'css':
                if(!empty(Yii::app()->params['cdnCss'])) {
                    return Yii::app()->params['cdnCss'] /*. Yii::app()->theme->getBaseUrl()*/;
                }
                return Yii::app()->theme->getBaseUrl();
            // theme
            case 'js':
                if(!empty(Yii::app()->params['cdnJs'])) {
                    return Yii::app()->params['cdnJs'] /*. Yii::app()->theme->getBaseUrl()*/;
                }
                return Yii::app()->theme->getBaseUrl();
            // theme
            case 'img':
                if(!empty(Yii::app()->params['cdnImg'])) {
                    return Yii::app()->params['cdnImg'] /*. Yii::app()->theme->getBaseUrl()*/;
                }
                return Yii::app()->theme->getBaseUrl();
            // theme cdn
            case 'cdn':
                if(!empty(Yii::app()->params['cdnCdn'])) {
                    return Yii::app()->params['cdnCdn'] . Yii::app()->theme->getBaseUrl();
                }
                return Yii::app()->theme->getBaseUrl();
            // images
            case 'images':
                $cdnImages = Yii::app()->params['cdnImages'];
                if(!empty($cdnImages)) {
                    if(is_array($cdnImages)) {
                        // @todo array CDN
                        return $cdnImages[0];
                    } else {
                        return $cdnImages;
                    }
                }
                return Yii::app()->baseUrl;
            // photo
            case 'photo':
                $cdnPhotos = Yii::app()->params['cdnPhotos'];
                if(!empty($cdnPhotos)) {
                    if(is_array($cdnPhotos)) {
                        // @todo array CDN
                        return $cdnPhotos[0];
                    } else {
                        return $cdnPhotos;
                    }
                }
                return Yii::app()->baseUrl;

            default:
                break;
        }
        return Yii::app()->baseUrl;
    }

    
    public static function checkPhoto($param_photo, $class = '', $check = 0, $width = null) {
//Yii::log('checkPhoto: ' . print_r($param_photo,1) ,'ERROR');
        if($width !== null){ $width = ' width="'.$width.'" ';}
        $param_alt = (!empty($param_photo->fullAddress))? $param_photo->fullAddress:'';
            if (strtolower(substr($param_photo->photo1, 0, 4)) === 'http') {
                $cdnPhotos = Yii::app()->params['cdnPhotos'];
                if(!empty($cdnPhotos)) {
                    $param_photo->photo1 = str_replace( 'http://www.propertyhookup.com/admin/photos/', CPathCDN::baseurl( 'photo' ) . '/photo/', $param_photo->photo1);
                }
                if( !$check ) {
                    return '<img '.$width.' class="' . $class . '" src="' . $param_photo->photo1 . '" alt="'. $param_alt .'">';
                } else {
//Yii::log('checkPhoto on S3 ' ,'ERROR');
                    $file_headers=Yii::app()->cache->get($param_photo->photo1);
                    if($file_headers===false)
                    {
//                        $file_headers = @get_headers($param_photo->photo1);
                        $file_headers = CPathCDN::checkS3Photo($param_photo->photo1);
                        Yii::app()->cache->set($param_photo->photo1,$file_headers, 1000);
                    }
                    if($file_headers[0] != 'HTTP/1.1 404 Not Found') {
                        return '<img '.$width.' class="' . $class . '" src="' . $param_photo->photo1 . '" alt="'. $param_alt .'">';
                    } else {
                        return '<img class="' . $class . '" src="' . CPathCDN::baseurl( 'images' ) . '/image_absent.jpg" alt="'. $param_alt .'">';
                    }
                }
            } else {
                $photo1 = CPathCDN::baseurl( 'images' ) . '/images/property_image/' . $param_photo->photo1;
                $photo1_file = Yii::app()->basePath . "/../images/property_image/" . $param_photo->photo1;
                if (is_readable($photo1_file)) {
                    return '<img class="' . $class . '" src="' . $photo1 . '" alt="'. $param_alt .'" width="180">';
                } else {
                    return '<img class="' . $class . '" src="' . CPathCDN::baseurl( 'images' ) . '/image_absent.jpg" alt="'. $param_alt .'">';
                }
            }
    }

    public static function checkS3Photo( $photo ) {
        if (!Yii::app()->s3)
        	throw new CException('You need to configure the S3 component or set the variable s3Component properly');
        $photo = str_replace( array('http://www.propertyhookup.com/admin/photos/', 'http:' . CPathCDN::baseurl( 'photo' ) . '/', CPathCDN::baseurl( 'photo' ) . '/' ), 
                              array( 'photo/', '', ''), $photo);
        $resp = Yii::app()->s3->getObjectInfo('props3photos', $photo, false);
//Yii::log('Step 1-0: ' . ($resp?' Found ':'Not Found ') . $photo ,'ERROR'); 
        return $resp?array('HTTP/1.1 200 Found'):array('HTTP/1.1 404 Not Found');
    }
    
    public static function uploadS3Images($upload, $type, $filename ) {
        if (!Yii::app()->s3)
        	throw new CException('You need to configure the S3 component or set the variable s3Component properly');        
        Yii::app()->s3->putObjectFile($upload->getTempName(), 'props3photos',  $r = 'images/' .$type . '/' . $filename);
        
        $image = Yii::app()->image->load($upload->getTempName());
        $image->resize(180, 180, Image::WIDTH)->crop(180, 180)->save(CPathCDN::pathImage($type, '50_50_'.$filename));
        Yii::app()->s3->putObjectFile(CPathCDN::pathImage($type, '50_50_'.$filename), 'props3photos',  $r = 'images/' .$type . '/50_50_' . $filename);
        unlink(CPathCDN::pathImage($type, '50_50_'.$filename));
        
    }

    public static function uploadS3Files($upload, $type, $filename ) {
        if (!Yii::app()->s3)
        	throw new CException('You need to configure the S3 component or set the variable s3Component properly');        
        Yii::app()->s3->putObjectFile($upload->getTempName(), 'props3photos',  $r = 'images/' .$type . '/' . $filename);
    }

    public static function pathImage($image_category, $upload_photo) {
        return Yii::app()->basePath.
                "/../images/".
                $image_category."/".
                $upload_photo;
    }

    public static function publish($asset) {
        return Yii::app()->assetManager->publish($asset);
    }

    public static function gzipPublish($asset, $contentType) {
        $string = file_get_contents($asset);
        $compressedString = gzencode($string,9);
        return Yii::app()->assetManager->gzipPublish($asset, $compressedString, $contentType);
    }
}
