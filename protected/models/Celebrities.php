<?php

Yii::import('application.models._base.BaseCelebrities');

class Celebrities extends BaseCelebrities {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function recommend($rate_height, $rate_weight) {
        $celebs = Celebrities::model()->findAllByAttributes(array('celeb_height_rate' => $rate_height, 'celeb_weight_rate' => $rate_weight));
        $returnArr = array();
        foreach ($celebs as $celeb) {
            $post_id = Posts::model()->findByAttributes(array('celeb_id' => $celeb->id));
            $returnArr[] = Posts::model()->getPostById($post_id->post_id, Yii::app()->session['user_id']);
        }
        return $returnArr;
    }
    
    

}
