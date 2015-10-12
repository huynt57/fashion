<?php

Yii::import('application.models._base.BasePosts');

class Posts extends BasePosts {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function addPost($user_id, $post_content, $location, $url_arr, $album) {
        $model = new Posts;
        $model->post_content = $post_content;
        $model->post_comment_count = 0;
        $model->post_like_count = 0;
        $model->location = $location;
        $model->created_at = time();
        $model->status = 1;
        $model->updated_at = time();
        $model->user_id = $user_id;
        if (!$model->save(FALSE)) {
            return FALSE;
        }
        $image = new Images;
        $image->post_id = $model->post_id;
        $image->created_at = time();
        $image->created_by = $user_id;
        $image->updated_at = time();
        $image->status = 1;
        $image->album_id = $album;
        if (is_array($url_arr)) {
            foreach ($url_arr as $url) {
                $image->img_url = $url;
                if (!$image->save(FALSE)) {
                    return FALSE;
                }
            }
        } else {
            $image->img_url = $url_arr;
            if (!$image->save(FALSE)) {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function getPostByUser($user_id, $limit, $offset) {
        $data = Yii::app()->db->createCommand()
                ->select('*')
                ->from('tbl_posts p')
                ->where('user_id=:user_id', array(':user_id' => $user_id))
                ->limit($limit)
                ->offset($offset)
                ->order('post_id DESC')
                ->queryAll();
        return $data;
    }

    public function getPostByCategory($cat_id, $limit, $offset) {
        $data = Yii::app()->db->createCommand()
                ->select('*')
                ->from('tbl_posts p')
                ->join('tbl_cat_post c', 'p.post_id=c.post_id')
                ->where('cat_id=:cat_id', array(':cat_id' => $cat_id))
                ->limit($limit)
                ->offset($offset)
                ->order('post_id DESC')
                ->queryAll();
        return $data;
    }

}
