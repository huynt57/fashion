<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UploadHelper {

    public static function getUrlUploadSingleImage($obj) {
        $ext_arr = array('png', 'jpg', 'jpeg', 'bmp');
        $name = StringHelper::filterString($obj['name']);
        $storeFolder = Yii::getPathOfAlias('webroot') . '/images/';
        $tempFile = $obj['tmp_name'];
        $targetFile = $storeFolder . $name;
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        if (in_array($ext, $ext_arr)) {
            if (move_uploaded_file($tempFile, $targetFile)) {
                $image_url = 'images/' . $name;
                return $image_url;
            } else {
                return NULL;
            }
        } else {
            return NULL;
        }
    }

    public static function getUrlUploadMultiImages($obj) {
        $url_arr = array();
        foreach($obj["tmp_name"] as $key=>$tmp_name) {
            $ext_arr = array('png', 'jpg', 'jpeg', 'bmp');
            $name = StringHelper::filterString($obj['name'][$key]);
            $storeFolder = Yii::getPathOfAlias('webroot') . '/images/';
            $tempFile = $obj['tmp_name'][$key];
            $targetFile = $storeFolder . $name;
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));           
            if (in_array($ext, $ext_arr)) {
                if (move_uploaded_file($tempFile, $targetFile)) {
                    $image_url = 'images/' . $name;
                    array_push($url_arr, $image_url);
                   
                } else {
                   
                    return NULL;
                }
            } else {
           
                return NULL;
            }
        }
        return $url_arr;
    }

}
