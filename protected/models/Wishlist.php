<?php

Yii::import('application.models._base.BaseWishlist');

class Wishlist extends BaseWishlist {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function addWishList($post_id, $user_id) {
        $check = Wishlist::model()->findByAttributes(array('post_id' => $post_id, 'user_id' => $user_id));
        if ($check) {
            return FALSE;
        } else {
            $model = new Wishlist;
            $model->post_id = $post_id;
            $model->user_id = $user_id;
            $model->status = 1;
            $model->created_at = time();
            $model->updated_at = time();
            if ($model->save(FALSE)) {
                return TRUE;
            }
        }
        return FALSE;
    }

    public function getWishListAPI($user_id, $limit, $offset) {
        $criteria = new CDbCriteria;
        $criteria->condition = "user_id = $user_id";
        $wishlists = Wishlist::model()->findAll($criteria);
        $wishlist_arr = array();
        foreach ($wishlists as $wishlist) {
            $wishlist_arr[] = $wishlist->post_id;
        }
        //var_dump($wishlist_arr); die;
        $returnArr = array();
        $criteria_post = new CDbCriteria;
        $criteria_post->addInCondition('t.post_id', $wishlist_arr);
        $criteria_post->limit = $limit;
        $criteria_post->offset = $offset;
        $posts = Posts::model()->findAll($criteria_post);

        foreach ($posts as $post) {
            $itemArr = Posts::model()->getPostById($post->post_id, Yii::app()->session['user_id']);
            $returnArr[] = $itemArr;
        }
        return $returnArr;
    }

    public function getWishListForWeb($user_id) {
        $profile = User::model()->findByPk($user_id);
        $criteria = new CDbCriteria;
        $criteria->condition = "user_id = $user_id";
        $wishlists = Wishlist::model()->findAll($criteria);
        $wishlist_arr = array();
        foreach ($wishlists as $wishlist) {
            $wishlist_arr[] = $wishlist->post_id;
        }
        //var_dump($wishlist_arr); die;
        $returnArr = array();
        $criteria_post = new CDbCriteria;
        $criteria_post->addInCondition('t.post_id', $wishlist_arr);
        $count = Posts::model()->count($criteria_post);
        $pages = new CPagination($count);
        $pages->validateCurrentPage = FALSE;
        $pages->pageSize = Yii::app()->params['RESULT_PER_PAGE'];
        $pages->applyLimit($criteria_post);
        $posts = Posts::model()->findAll($criteria_post);
        $is_followed = User::model()->isFollowedByUser(Yii::app()->session['user_id'], $user_id, 'USER');

        foreach ($posts as $post) {
            $itemArr = Posts::model()->getPostById($post->post_id, Yii::app()->session['user_id']);
            $returnArr[] = $itemArr;
        }
        return array('data' => $returnArr, 'pages' => $pages, 'profile' => $profile, 'is_followed'=>$is_followed);

        // return FALSE;
    }

}
