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

    public function reportPost($attr) {
        $model = new Reports;
        $model->setAttributes = $attr;
        $model->created_at = time();
        $model->status = 0;
        $model->updated_at = time();
        $model->type = Yii::app()->params['USER_REPORT'];

        $hide_post = new UserPostRelationship;
        $rel->user_id = $attr['from'];
        $rel->post_id = $attr['post_id'];
        $rel->created_at = time();
        $rel->updated_at = time();
        $rel->type = Yii::app()->params['USER_REPORT'];

        if ($model->save(FALSE) && $hide_post->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

    public function getHiddenPostByUser($user_id) {
        $hidden_post_criteria = new CDbCriteria;
        $hidden_post_criteria->select = 'post_id';
        $hidden_post_criteria->condition = 'user_id=:user_id';
        $hidden_post_criteria->params = array(':user_id' => $user_id);
        $hidden_post = UserPostRelationship::model()->findAll($hidden_post_criteria);
        return implode(',', $hidden_post);
    }

    public function getBlockedUserByUser($user_id) {
        $blocked_user_criteria = new CDbCriteria;
        $blocked_user_criteria->select = 'user_id_2';
        $blocked_user_criteria->condition = 'user_id_1=:user_id';
        $blocked_user_criteria->params = array(':user_id' => $user_id);
        $blocked_user = Relationship::model()->findAll($blocked_user_criteria);
        return implode(',', $blocked_user);
    }

    public function getNewsFeedForUser($user_id, $limit, $offset) {
        $hidden_post = $this->getHiddenPostByUser($user_id);
        $blocked_user = $this->getBlockedUserByUser($user_id);
        $news_feed_criteria = new CdbCriteria;
        $news_feed_criteria->select = 'tbl_posts.*, tbl_user.username';
        $news_feed_criteria->join = 'JOIN tbl_user ON tbl_posts.user_id = tbl_user.id';
        $news_feed_criteria->condition = "tbl_posts.post_id NOT IN ($hidden_post) AND tbl_posts.user_id NOT IN ($blocked_user)";
        $news_feed_criteria->limit = $limit;
        $news_feed_criteria->offset = $offset;
        $news_feed_criteria->order = 'tbl_post.post_id DESC';
        $data = Posts::model()->findAll($news_feed_criteria);
        return $data;
    }

    public function getNewsFeedForWeb($user_id) {
        $hidden_post = $this->getHiddenPostByUser($user_id);
        $blocked_user = $this->getBlockedUserByUser($user_id);
        $news_feed_criteria = new CdbCriteria;
        $news_feed_criteria->select = 'tbl_posts.*, tbl_user.username';
        $news_feed_criteria->join = 'JOIN tbl_user ON tbl_posts.user_id = tbl_user.id';
        $news_feed_criteria->condition = "tbl_posts.post_id NOT IN ($hidden_post) AND tbl_posts.user_id NOT IN ($blocked_user)";
        $news_feed_criteria->order = 'tbl_post.post_id DESC';
        $count = Posts::model()->count($news_feed_criteria);
        $pages = new CPagination($count);
        $pages->pageSize = Yii::app()->params['RESULT_PER_PAGE'];
        $pages->applyLimit($news_feed_criteria);
        $data = Posts::model()->findAll($news_feed_criteria);
        return array('data' => $data, 'pages' => $pages);
    }

}
