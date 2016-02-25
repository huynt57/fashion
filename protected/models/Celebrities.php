<?php

Yii::import('application.models._base.BaseCelebrities');

class Celebrities extends BaseCelebrities {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function recommend($rate_height, $rate_weight) {

        $criteria = new CDbCriteria;
        $criteria->condition = "t.celeb_height_rate = '" . $rate_height . "' AND t.celeb_weight_rate = '" . $rate_weight . "'";
        $celebs = Celebrities::model()->findAll($criteria);
        $celebs_arr = array();
        foreach ($celebs as $celeb) {
            $celebs_arr[] = $celeb->id;
        }
        //   var_dump($celebs_arr); die;
        $returnArr = array();
        $criteria_post = new CDbCriteria;
        $criteria_post->addInCondition('t.celeb_id', $celebs_arr);

        $count = Posts::model()->count($criteria_post);
        $pages = new CPagination($count);
        $pages->validateCurrentPage = FALSE;
        $pages->pageSize = Yii::app()->params['RESULT_PER_PAGE'];
        $pages->applyLimit($criteria_post);

        $posts = Posts::model()->findAll($criteria_post);
        foreach ($posts as $post) {
            $returnArr[] = Posts::model()->getPostById($post->post_id, Yii::app()->session['user_id']);
        }
        return array('data' => $returnArr, 'pages' => $pages);
    }

    public function addCeleb($profile, $image, $cover) {
        $model = new Celebrities;
        $model->setAttributes($profile);
        $model->celeb_image = $image;
        $model->celeb_image_cover = '/themes/frontend2/assets/stock/cover1.jpg';
        if ($model->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

    public function addPostCeleb() {
        
    }

}
