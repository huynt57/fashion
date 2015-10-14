<?php

Yii::import('application.models._base.BasePosts');

class Posts extends BasePosts {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function addPost($user_id, $post_content, $location, $url_arr, $album, $cats) {
        $model = new Posts;
        $model->post_content = $post_content;
        $model->post_comment_count = 0;
        $model->post_like_count = 0;
        $model->post_view_count = 0;
        $model->location = $location;
        $model->created_at = time();
        $model->status = 1;
        $model->updated_at = time();
        $model->user_id = $user_id;
        if (!$model->save(FALSE)) {
            return FALSE;
        }
        $cats = json_decode($cats, TRUE);
        foreach ($cats as $cat) {
            $cat_model = new CatPost();
            $cat_model->cat_id = $cat;
            $cat_model->post_id = $model->post_id;
            $cat_model->status = 1;
            $cat_model->created_at = time();
            $cat_model->updated_at = time();
            if (!$cat_model->save(FALSE)) {
                return FALSE;
            }
        }
        if (is_array($url_arr)) {
            foreach ($url_arr as $url) {
                $image = new Images;
                $image->post_id = $model->post_id;
                $image->created_at = time();
                $image->created_by = $user_id;
                $image->updated_at = time();
                $image->status = 1;
                $image->album_id = $album;
                $image->image_like_count = 0;
                $image->img_url = $url;
                if (!$image->save(FALSE)) {
                    return FALSE;
                }
            }
        } else {
            $image = new Images;
            $image->post_id = $model->post_id;
            $image->created_at = time();
            $image->created_by = $user_id;
            $image->updated_at = time();
            $image->status = 1;
            $image->album_id = $album;
            $image->image_like_count = 0;
            $image->img_url = $url_arr;
            if (!$image->save(FALSE)) {
                return FALSE;
            }
        }
        return $model->post_id;
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
        //return implode(',', $hidden_post);
        return $hidden_post;
    }

    public function getBlockedUserByUser($user_id) {
        $blocked_user_criteria = new CDbCriteria;
        $blocked_user_criteria->select = 'user_id_2';
        $blocked_user_criteria->condition = 'user_id_1=:user_id';
        $blocked_user_criteria->params = array(':user_id' => $user_id);
        $blocked_user = Relationship::model()->findAll($blocked_user_criteria);
        //return implode(',', $blocked_user);
        return $blocked_user;
    }

    public function getNewsFeedForUser($user_id, $limit, $offset) {
        $returnArr = array();
        $hidden_post = $this->getHiddenPostByUser($user_id);
        $blocked_user = $this->getBlockedUserByUser($user_id);
        $news_feed_criteria = new CdbCriteria;
        $news_feed_criteria->select = '*';
        // $news_feed_criteria->join = 'JOIN tbl_user u ON t.user_id = u.id JOIN tbl_cat_post c ON t.post_id = c.post_id';
        $news_feed_criteria->addNotInCondition('t.post_id', $hidden_post); // = "tbl_posts.post_id NOT IN ($hidden_post) AND tbl_posts.user_id NOT IN ($blocked_user)";
        $news_feed_criteria->addNotInCondition('t.user_id', $blocked_user);
        $news_feed_criteria->order = 't.post_id DESC';
        $news_feed_criteria->limit = $limit;
        $news_feed_criteria->offset = $offset;
        $data = Posts::model()->findAll($news_feed_criteria);
        foreach ($data as $item) {
            $itemArr = array();
            $itemArr['username'] = $this->findUserByPostId($item->post_id);
            $itemArr['post_id'] = $item->post_id;
            $itemArr['post_content'] = $item->post_content;
            $itemArr['created_at'] = $item->created_at;
            $itemArr['updated_at'] = $item->updated_at;
            $itemArr['post_like_count'] = $item->post_like_count;
            $itemArr['post_view_count'] = $item->post_view_count;
            $itemArr['post_comment_count'] = $item->post_comment_count;
            $itemArr['location'] = $item->location;
            $itemArr['cat_name'] = $this->findCategoryNameByPostId($item->post_id);
            $itemArr['images'] = $this->findImagesByPost($item->post_id);
            $returnArr[] = $itemArr;
        }
        return $returnArr;
    }

    public function getNewsFeedForWeb($user_id) {
        $returnArr = array();
        $hidden_post = $this->getHiddenPostByUser($user_id);
        $blocked_user = $this->getBlockedUserByUser($user_id);
        $news_feed_criteria = new CdbCriteria;
        $news_feed_criteria->select = 't.*, u.username';
        $news_feed_criteria->join = 'JOIN tbl_user u ON t.user_id = u.id JOIN tbl_cat_post c ON t.post_id = c.post_id';
        $news_feed_criteria->addNotInCondition('t.post_id', $hidden_post); // = "tbl_posts.post_id NOT IN ($hidden_post) AND tbl_posts.user_id NOT IN ($blocked_user)";
        $news_feed_criteria->addNotInCondition('t.user_id', $blocked_user);
        $news_feed_criteria->order = 't.post_id DESC';
        $count = Posts::model()->count($news_feed_criteria);
        $pages = new CPagination($count);
        $pages->pageSize = Yii::app()->params['RESULT_PER_PAGE'];
        $pages->applyLimit($news_feed_criteria);
        $data = Posts::model()->findAll($news_feed_criteria);
        foreach ($data as $item) {
            $itemArr = array();
            $itemArr['username'] = $this->findUserByPostId($item->post_id);
            $itemArr['post_id'] = $item->post_id;
            $itemArr['post_content'] = $item->post_content;
            $itemArr['created_at'] = $item->created_at;
            $itemArr['updated_at'] = $item->updated_at;
            $itemArr['post_like_count'] = $item->post_like_count;
            $itemArr['post_view_count'] = $item->post_view_count;
            $itemArr['post_comment_count'] = $item->post_comment_count;
            $itemArr['location'] = $item->location;
            $itemArr['cat_name'] = $this->findCategoryNameByPostId($item->post_id);
            $itemArr['images'] = $this->findImagesByPost($item->post_id);
            $returnArr[] = $itemArr;
        }
        return array('data' => $returnArr, 'pages' => $pages);
    }

    public function findImagesByPost($post_id) {
        $sql = "SELECT * FROM tbl_images WHERE post_id = $post_id";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        return $data;
    }

    public function findCategoryById($cat_id) {
        $cat = Categories::model()->findByPk($cat_id);
        return $cat->cat_name;
    }

    public function findUserByPostId($post_id) {
        $user_id = Posts::model()->findByPk($post_id);
        $user = User::model()->findByPk($user_id->user_id);
        return $user->username;
    }

    public function findCategoryNameByPostId($post_id) {
        $cat_id = CatPost::model()->findByAttributes(array('post_id' => $post_id));
        return $this->findCategoryById($cat_id->cat_id);
    }

    public function likePost($user_id, $post_id) {
        $model = Posts::model()->findByPk($post_id);
        $model->post_like_count++;
        $like = new Like();
        $like->from = $user_id;
        $like->post_id = $post_id;
        $like->status = 1;
        $like->created_at = time();
        $like->updated_at = time();
        if ($model->save(FALSE) && $like->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

    public function likeImage($user_id, $image_id) {
        $model = Images::model()->findByPk($image_id);
        $model->image_like_count++;
        $like = new Like();
        $like->from = $user_id;
        $like->image_id = $image_id;
        $like->status = 1;
        $like->created_at = time();
        $like->updated_at = time();
        if ($model->save(FALSE) && $like->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

}
