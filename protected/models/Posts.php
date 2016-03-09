<?php

Yii::import('application.models._base.BasePosts');

class Posts extends BasePosts {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getFollowedUserByUser($user_id) {
        $follows = Follow::model()->findAllByAttributes(array('user_follow' => $user_id, 'type' => 'USER'));
        $follow_arr = array();
        foreach ($follows as $item) {
            $follow_arr[] = $item->user_followed;
        }
        return $follow_arr;
    }

    public function getFollowedCelebByUser($user_id) {
        $follows = Follow::model()->findAllByAttributes(array('user_follow' => $user_id, 'type' => 'CELEB'));
        $follow_arr = array();
        foreach ($follows as $item) {
            $follow_arr[] = $item->user_followed;
        }
        return $follow_arr;
    }

    public function getPostBookmarkedByUser($user_id) {
        $posts_bookmarked = Wishlist::model()->findAllByAttributes(array('user_id' => $user_id));
        $post_bookmarked_arr = array();
        foreach ($posts_bookmarked as $post) {
            $post_bookmarked_arr[] = $post->post_id;
        }
        $returnArr = array();
        $criteria = new CDbCriteria;
        $criteria->select = 't.*, u.username';
        $criteria->join = 'JOIN tbl_user u ON t.user_id = u.id';
        $criteria->order = 't.post_id DESC';
        $criteria->addInCondition("t.post_id", $post_bookmarked_arr);

        $count = Posts::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = Yii::app()->params['RESULT_PER_PAGE'];
        $pages->applyLimit($criteria);
        $data = Posts::model()->findAll($criteria);
        foreach ($data as $item) {
            $itemArr = $this->getPostById($item->post_id, $user_id);
            $itemArr['score'] = 1;
            $returnArr[] = $itemArr;
        }
        return array('data' => $returnArr, 'pages' => $pages);
    }

    public function addPostCeleb($celeb_id, $post_content, $location, $url_arr, $album, $cats) {
        $model = new Posts;
        $model->post_content = $post_content;
        $model->post_comment_count = 0;
        $model->post_like_count = 0;
        $model->post_view_count = 0;
        $model->location = $location;
        $model->created_at = time();
        $model->status = 1;
        $model->updated_at = time();
        $model->celeb_id = $celeb_id;
        if (!$model->save(FALSE)) {
            return FALSE;
        }
        //  $cats = json_decode($cats, TRUE);
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
                $image->created_by_celeb = $celeb_id;
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
            $image->created_by_celeb = $celeb_id;
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
        $returnArr = array();
        $news_feed_criteria = new CDbCriteria;
        $news_feed_criteria->select = 't.*, u.username';
        $news_feed_criteria->join = 'JOIN tbl_user u ON t.user_id = u.id';
        $news_feed_criteria->order = 't.post_id DESC';
        $news_feed_criteria->limit = $limit;
        $news_feed_criteria->offset = $offset;
        $news_feed_criteria->addCondition("user_id = $user_id");
        $data = Posts::model()->findAll($news_feed_criteria);
        foreach ($data as $item) {
            $itemArr = $this->getPostById($item->post_id, $user_id);
            $returnArr[] = $itemArr;
        }
        return $returnArr;
    }

    public function getPostByUserForWeb($user_id) {
        $returnArr = array();
        $news_feed_criteria = new CDbCriteria;
        $news_feed_criteria->select = 't.*, u.username';
        $news_feed_criteria->join = 'JOIN tbl_user u ON t.user_id = u.id';
        $news_feed_criteria->order = 't.post_id DESC';
        $news_feed_criteria->addCondition("t.user_id = $user_id");

        $count = Posts::model()->count($news_feed_criteria);
        $pages = new CPagination($count);
        $pages->pageSize = Yii::app()->params['RESULT_PER_PAGE'];
        $pages->applyLimit($news_feed_criteria);
        $data = Posts::model()->findAll($news_feed_criteria);
        foreach ($data as $item) {
            $itemArr = $this->getPostById($item->post_id, $user_id);
            $returnArr[] = $itemArr;
        }
        return array('data' => $returnArr, 'pages' => $pages);
    }

    public function getPostByCelebForWeb($user_id) {
        $returnArr = array();
        $news_feed_criteria = new CDbCriteria;
        $news_feed_criteria->select = 't.*, c.celeb_name';
        $news_feed_criteria->join = 'JOIN tbl_celebrities c ON t.celeb_id = c.id';
        $news_feed_criteria->order = 't.post_id DESC';
        $news_feed_criteria->addCondition("t.celeb_id = $user_id");

        $count = Posts::model()->count($news_feed_criteria);
        $pages = new CPagination($count);
        $pages->pageSize = Yii::app()->params['RESULT_PER_PAGE'];
        $pages->applyLimit($news_feed_criteria);
        $data = Posts::model()->findAll($news_feed_criteria);
        foreach ($data as $item) {
            $itemArr = $this->getPostById($item->post_id, Yii::app()->session['user_id']);
            $returnArr[] = $itemArr;
        }
        return array('data' => $returnArr, 'pages' => $pages);
    }

    public function getPostByCategory($cat_id, $limit, $offset) {
        $returnArr = array();
        $criteria = new CDbCriteria;
        $criteria->join = 'JOIN tbl_cat_post c ON c.post_id = t.post_id';
        // $criteria->join .= ' JOIN tbl_categories a ON a.cat_id = c.cat_id ';
        $criteria->order = 't.post_id DESC';
        $criteria->condition = "c.cat_id = $cat_id";
        //   $hidden_post = $this->getHiddenPostByUser($user_id);
        //  $blocked_user = $this->getBlockedUserByUser($user_id);
        //  $criteria->addNotInCondition('t.post_id', $hidden_post); // = "tbl_posts.post_id NOT IN ($hidden_post) AND tbl_posts.user_id NOT IN ($blocked_user)";
        //  $criteria->addNotInCondition('t.user_id', $blocked_user);
        $criteria->limit = $limit;
        $criteria->offset = $offset;
        $data = Posts::model()->findAll($criteria);
        foreach ($data as $item) {
            $itemArr = $this->getPostById($item->post_id, Yii::app()->session['user_id']);
            $returnArr[] = $itemArr;
        }
        return $returnArr;
    }

    public function reportPost($attr) {
        $check = Reports::model()->findByAttributes(array('post_id' => $attr['post_id']));
        if ($check) {
            return 1;
        } else {
            $model = new Reports;
            $model->setAttributes($attr);
            $model->created_at = time();
            $model->status = 0;
            $model->updated_at = time();
            // $model->type = Yii::app()->params['USER_REPORT'];

            $rel = new UserPostRelationship;
            $rel->user_id = $attr['from'];
            $rel->post_id = $attr['post_id'];
            $rel->created_at = time();
            $rel->updated_at = time();
            $rel->type = Yii::app()->params['USER_REPORT'];

            if ($model->save(FALSE) && $rel->save(FALSE)) {
                return 2;
            }
        }
        return 3;
    }

    public function getHiddenPostByUser($user_id) {
        $hidden_post_criteria = new CDbCriteria;
        $hidden_post_criteria->select = 'post_id';
        $hidden_post_criteria->condition = 'user_id=:user_id';
        $hidden_post_criteria->params = array(':user_id' => $user_id);
        $hidden_post = UserPostRelationship::model()->findAll($hidden_post_criteria);
        //return implode(',', $hidden_post);
        $returnArr = array();
        foreach ($hidden_post as $item) {
            $returnArr[] = $item->post_id;
        }
        return $returnArr;
    }

    public function getBlockedUserByUser($user_id) {
        $blocked_user_criteria = new CDbCriteria;
        $blocked_user_criteria->select = 'user_id_2';
        $blocked_user_criteria->condition = 'user_id_1=:user_id';
        $blocked_user_criteria->params = array(':user_id' => $user_id);
        $blocked_user = Relationship::model()->findAll($blocked_user_criteria);
        //return implode(',', $blocked_user);
        $returnArr = array();
        foreach ($blocked_user as $item) {
            $returnArr[] = $item->user_id_2;
        }
        return $returnArr;
    }

    public function getNewsFeedForUser($user_id, $limit, $offset) {
        $returnArr = array();


        $hidden_post = $this->getHiddenPostByUser($user_id);
        $blocked_user = $this->getBlockedUserByUser($user_id);


        $news_feed_criteria = new CDbCriteria;
        $news_feed_criteria->select = '*';
        $news_feed_criteria->join = 'JOIN tbl_user u ON t.user_id = u.id';
        $news_feed_criteria->addNotInCondition('t.post_id', $hidden_post); // = "tbl_posts.post_id NOT IN ($hidden_post) AND tbl_posts.user_id NOT IN ($blocked_user)";
        $news_feed_criteria->addNotInCondition('t.user_id', $blocked_user);
        $news_feed_criteria->order = 't.post_id DESC';
        $news_feed_criteria->limit = $limit;
        $news_feed_criteria->offset = $offset;
        $data = Posts::model()->findAll($news_feed_criteria);
        foreach ($data as $item) {
            $itemArr = $this->getPostById($item->post_id, $user_id);
            $returnArr[] = $itemArr;
        }
        return $returnArr;
    }

    function mySortScoreNewsFeed($a, $b) {

        if ($a['score'] == $b['score']) {
            // score is the same, sort by endgame
            if ($a['post_id'] < $b['post_id'])
                return 1;
        }
        // sort the higher score first:
        return $a['score'] < $b['score'] ? 1 : -1;
    }

    public function getFollowedPostCeleb($user_id) {
        $follows_celeb = $this->getFollowedCelebByUser($user_id);
        $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->addInCondition('t.celeb_id', $follows_celeb);
        //$criteria->addInCondition('t.user_id', $follows_user);
        $count = Posts::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->validateCurrentPage = FALSE;
        $pages->pageSize = Yii::app()->params['RESULT_PER_PAGE'];
        $pages->applyLimit($criteria);
        $data = Posts::model()->findAll($criteria);
        // var_dump($data); die;
        return $this->getInfoAndScore($data, $user_id);
    }

    public function getFollowedPostUser($user_id) {
        $follows_user = $this->getFollowedUserByUser($user_id);
        //$follows_celeb = $this->getFollowedCelebByUser($user_id);
        $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->addInCondition('t.user_id', $follows_user);
        //$criteria->addInCondition('t.user_id', $follows_user);
        $count = Posts::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->validateCurrentPage = FALSE;
        $pages->pageSize = Yii::app()->params['RESULT_PER_PAGE'];
        $pages->applyLimit($criteria);
        $data = Posts::model()->findAll($criteria);
        // var_dump($data); die;
        return $this->getInfoAndScore($data, $user_id);
    }

    public function getInfoAndScore($data, $user_id) {
        $returnArr = array();
        foreach ($data as $item) {
            $itemArr = $this->getPostById($item->post_id, $user_id);
            if (!empty($itemArr['celeb_id'])) {
                $itemArr['score'] = 2;
            } else {
                $itemArr['score'] = 1.5;
            }
            $returnArr[] = $itemArr;
        }
        return $returnArr;
    }

    public function getNewsFeedForWeb($user_id) {

        $returnArr = array();
        //  $retVal = array();
        $hidden_post = $this->getHiddenPostByUser($user_id);
        $blocked_user = $this->getBlockedUserByUser($user_id);

        //    var_dump($blocked_user); die;
        $news_feed_criteria = new CDbCriteria;
        $news_feed_criteria->select = '*';
        $news_feed_criteria->join = 'JOIN tbl_user u ON t.user_id = u.id';
        $news_feed_criteria->addNotInCondition('t.post_id', $hidden_post); // = "tbl_posts.post_id NOT IN ($hidden_post) AND tbl_posts.user_id NOT IN ($blocked_user)";
        $news_feed_criteria->addNotInCondition('t.user_id', $blocked_user);
        $news_feed_criteria->order = 't.post_id DESC';

        $count = Posts::model()->count($news_feed_criteria);
        $pages = new CPagination($count);
        $pages->validateCurrentPage = FALSE;
        $pages->pageSize = Yii::app()->params['RESULT_PER_PAGE'];
        $pages->applyLimit($news_feed_criteria);
        $data = Posts::model()->findAll($news_feed_criteria);
        foreach ($data as $item) {
            $itemArr = $this->getPostById($item->post_id, $user_id);
            if (!empty($itemArr['celeb_id'])) {
                $itemArr['score'] = 2;
            } else {
                $itemArr['score'] = 1;
            }
            $returnArr[] = $itemArr;
        }
        $follows_arr_celeb = $this->getFollowedPostCeleb($user_id);
        $follows_arr_user = $this->getFollowedPostUser($user_id);

        if (!empty($follows_arr_celeb)) {
            foreach ($follows_arr_celeb as $item) {
                $returnArr[] = $item;
            }
        }
        if (!empty($follows_arr_user)) {
            foreach ($follows_arr_user as $item) {
                $returnArr[] = $item;
            }
        }

        usort($returnArr, array($this, "mySortScoreNewsFeed"));
        return array('data' => $returnArr, 'pages' => $pages);
    }

    public function findImagesByPost($post_id) {
        $sql = "SELECT * FROM tbl_images WHERE post_id = $post_id";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        return $data;
    }

    public function findCategoryById($cat_id) {
        $cat = Categories::model()->findByPk($cat_id);
        if ($cat) {
            return array($cat->cat_name, $cat->cat_id);
        }
        return array('', '');
    }

    public function findUsernameByPostId($post_id) {
        $user_id = Posts::model()->findByPk($post_id);
        $user = User::model()->findByPk($user_id->user_id);
        if ($user) {
            return $user->username;
        }
        return '';
    }

    public function findCelebUsernameByPostId($post_id) {
        $user_id = Posts::model()->findByPk($post_id);
        $user = Celebrities::model()->findByPk($user_id->celeb_id);
        if ($user) {
            return $user->celeb_name;
        }
        return '';
    }

    public function findUserPhotoByPostId($post_id) {
        $user_id = Posts::model()->findByPk($post_id);
        $user = User::model()->findByPk($user_id->user_id);
        if ($user) {
            return $user->photo;
        }
        return '';
    }

    public function findCelebPhotoByPostId($post_id) {
        $user_id = Posts::model()->findByPk($post_id);
        $user = Celebrities::model()->findByPk($user_id->celeb_id);
        if ($user) {
            return $user->celeb_image;
        }
        return '';
    }

    public function findUserByPostId($post_id) {
        $user_id = Posts::model()->findByPk($post_id);
        $user = User::model()->findByPk($user_id->user_id);
        if ($user) {
            return array('username' => $user->username, 'photo' => $user->photo);
        }
        return array('username' => '', 'photo' => '');
    }

    public function findCategoryNameByPostId($post_id) {
        $cat_ids = CatPost::model()->findAllByAttributes(array('post_id' => $post_id));
        $returnArr = array();
        foreach ($cat_ids as $cat_id) {
            $returnArr[] = $this->findCategoryById($cat_id->cat_id);
        }
        return $returnArr;
    }

    public function likePost($from, $to, $post_id) {
        $check = Like::model()->findByAttributes(array('from' => $from, 'to' => $to, 'post_id' => $post_id));
        $model = Posts::model()->findByPk($post_id);
        if ($check && $check->status == 1 && $model->post_like_count > 0) {
            $model->post_like_count--;
            $check->status = 0;
            if ($model->save(FALSE) && $check->save(FALSE)) {
                return TRUE;
            }
        } else if ($check && $check->status == 0) {
            $model->post_like_count++;
            $check->status = 1;
            if ($model->save(FALSE) && $check->save(FALSE)) {
                return TRUE;
            }
        } else {
            $model->post_like_count++;
            $like = new Like();
            $like->from = $from;
            $like->to = $to;
            $like->post_id = $post_id;
            $like->status = 1;
            $like->created_at = time();
            $like->updated_at = time();
            if ($model->save(FALSE) && $like->save(FALSE)) {
                return TRUE;
            }
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

    public function getCommentsByPost($post_id) {
        $sql = "SELECT * FROM tbl_comments JOIN tbl_user ON tbl_comments.created_by = tbl_user.id WHERE tbl_comments.post_id = $post_id ORDER BY tbl_comments.created_at DESC";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        return $data;
    }

    public function getPostById($post_id, $user_id = NULL) {
        $item = Posts::model()->findByPk($post_id);
        if ($item) {
            $itemArr = array();
            //  var_dump($item);
            // die();
            $itemArr['user'] = array($this->findUserByPostId($item->post_id));
            $itemArr['user_id'] = $item->user_id;
            $itemArr['celeb_id'] = $item->celeb_id;
            $itemArr['username'] = $this->findUsernameByPostId($item->post_id);
            $itemArr['photo'] = $this->findUserPhotoByPostId($item->post_id);
            $itemArr['post_id'] = $item->post_id;
            $itemArr['post_content'] = $item->post_content;
            if (!empty($user_id)) {
                $itemArr['is_liked'] = $this->checkIfPostIsLiked($post_id, $user_id);
                $itemArr['is_bookmarked'] = $this->checkIfPostIsBookmarked($post_id, $user_id);
            }
            iF (!empty($item->celeb_id)) {
                $itemArr['photo_celeb'] = $this->findCelebPhotoByPostId($item->post_id);
                $itemArr['username_celeb'] = $this->findCelebUsernameByPostId($item->post_id);
            }
            $itemArr['created_at'] = $item->created_at;
            $itemArr['updated_at'] = $item->updated_at;
            $itemArr['post_like_count'] = $item->post_like_count;
            $itemArr['post_view_count'] = $item->post_view_count;
            $itemArr['post_comment_count'] = $item->post_comment_count;
            $itemArr['location'] = $item->location;
            $itemArr['cat'] = $this->findCategoryNameByPostId($item->post_id);
            $itemArr['images'] = $this->findImagesByPost($item->post_id);
            $itemArr['comments'] = $this->getCommentsByPost($item->post_id);
            return $itemArr;
        }
        return NULL;
    }

    public function checkIfPostIsLiked($post_id, $user_id) {
        $check = Like::model()->findByAttributes(array('post_id' => $post_id, 'from' => $user_id, 'status' => 1));
        if ($check) {
            return TRUE;
        }
        return FALSE;
    }

    public function checkIfPostIsBookmarked($post_id, $user_id) {
        $check = Wishlist::model()->findByAttributes(array('post_id' => $post_id, 'user_id' => $user_id));
        if ($check) {
            return TRUE;
        }
        return FALSE;
    }

    public function getPostByCategoryType($type) {

        $returnArr = array();
        $user_id = Yii::app()->session['user_id'];
        $hidden_post = $this->getHiddenPostByUser($user_id);
        $blocked_user = $this->getBlockedUserByUser($user_id);
        $categories = $this->getCategoryByType($type);
        $criteria = new CDbCriteria;
        $criteria->distinct = true;
        $criteria->join = 'JOIN tbl_cat_post c ON c.post_id = t.post_id';
        $criteria->join .= ' JOIN tbl_categories a ON a.cat_id = c.cat_id ';

        $criteria->addNotInCondition('t.post_id', $hidden_post); // = "tbl_posts.post_id NOT IN ($hidden_post) AND tbl_posts.user_id NOT IN ($blocked_user)";
        $criteria->addNotInCondition('t.user_id', $blocked_user);
        $criteria->order = 't.post_id DESC';
        $criteria->condition = "a.type = $type";
        //var_dump($criteria); die;
        //   $criteria->group = 't.post_id';
        $count = Posts::model()->count($criteria);
        //echo $count; die;
        $pages = new CPagination($count);
        $pages->validateCurrentPage = FALSE;
        $pages->pageSize = Yii::app()->params['RESULT_PER_PAGE'];
        $pages->applyLimit($criteria);
        $data = Posts::model()->findAll($criteria);
//        echo '<pre>';
//         var_dump($data); echo '</pre>'; die;
        foreach ($data as $item) {
            $itemArr = $this->getPostById($item->post_id, Yii::app()->session['user_id']);
            $returnArr[] = $itemArr;
        }

        return array('data' => $returnArr, 'pages' => $pages, 'cats' => $categories);
    }

    public function getPostByCategoryId($cat_id) {
        $returnArr = array();
        $criteria = new CDbCriteria;
        $criteria->join = 'JOIN tbl_cat_post c ON c.post_id = t.post_id';
        $criteria->join .= ' JOIN tbl_categories a ON a.cat_id = c.cat_id ';
        $criteria->order = 't.post_id DESC';
        $criteria->condition = "a.cat_id = $cat_id";
        $count = Posts::model()->count($criteria);
        $pages = new CPagination($count);
        $user_id = Yii::app()->session['user_id'];
        $hidden_post = $this->getHiddenPostByUser($user_id);
        $blocked_user = $this->getBlockedUserByUser($user_id);
        $criteria->addNotInCondition('t.post_id', $hidden_post); // = "tbl_posts.post_id NOT IN ($hidden_post) AND tbl_posts.user_id NOT IN ($blocked_user)";
        $criteria->addNotInCondition('t.user_id', $blocked_user);
        $pages->validateCurrentPage = FALSE;
        $pages->pageSize = Yii::app()->params['RESULT_PER_PAGE'];
        $pages->applyLimit($criteria);
        $data = Posts::model()->findAll($criteria);
        foreach ($data as $item) {
            $itemArr = $this->getPostById($item->post_id, Yii::app()->session['user_id']);
            $returnArr[] = $itemArr;
        }
        return array('data' => $returnArr, 'pages' => $pages);
    }

    public function getCategoryByType($type) {
        $data = Categories::model()->findAllByAttributes(array('type' => $type));
        return $data;
    }

    public function rankByTimeApi($time, $limit, $offset) {
        $time = strtoupper($time);
        $criteria = new CDbCriteria;
        if ($time == 'DAY') {
            $time_start = strtotime('-1 day');
        } else if ($time == 'WEEK') {
            $time_start = strtotime('-1 week');
        } else if ($time == 'MONTH') {
            $time_start = strtotime('-1 month');
        }
        $time_end = time();
        $criteria->select = 'COUNT(*) AS count_like';
        $criteria->addBetweenCondition('l.created_at', $time_start, $time_end);
        $criteria->join = 'JOIN tbl_like l ON t.user_id = l.to';
        $criteria->order = 'count_like DESC';
        $criteria->limit = $limit;
        $criteria->offset = $offset;
        $data = Posts::model()->findAll($criteria);
        return $data;
    }

    public function rankByTimeForWeb($time) {
        $time = strtoupper($time);
        $returnArr = array();
        $criteria = new CDbCriteria;
        if ($time == 'DAY') {
            $time_start = strtotime('-1 day');
        } else if ($time == 'WEEK') {
            $time_start = strtotime('-1 week');
        } else if ($time == 'MONTH') {
            $time_start = strtotime('-1 month');
        } else if ($time == 'YEAR') {
            $time_start = strtotime('-1 year');
        }
        $time_end = time();
        $user_id = Yii::app()->session['user_id'];
        $hidden_post = $this->getHiddenPostByUser($user_id);
        $blocked_user = $this->getBlockedUserByUser($user_id);
        $criteria->addNotInCondition('t.post_id', $hidden_post); // = "tbl_posts.post_id NOT IN ($hidden_post) AND tbl_posts.user_id NOT IN ($blocked_user)";
        $criteria->addNotInCondition('t.user_id', $blocked_user);
        $criteria->select = 't.post_id, t.post_like_count';

        $criteria->join = 'JOIN tbl_like l ON t.user_id = l.to';
        $criteria->addBetweenCondition('l.created_at', $time_start, $time_end);
        $criteria->group = 't.post_id';

        $criteria->order = 't.post_like_count DESC';

        //    var_dump($returnArr);
        //  die();
        $count = Posts::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->validateCurrentPage = FALSE;
        $pages->pageSize = Yii::app()->params['RESULT_PER_PAGE'];
        $pages->applyLimit($criteria);
        $data = Posts::model()->findAll($criteria);
        foreach ($data as $item) {
            $itemArr = $this->getPostById($item->post_id, Yii::app()->session['user_id']);
            $returnArr[] = $itemArr;
        }
        return array('data' => $returnArr, 'pages' => $pages);
    }

    public function searchByPostContentAPI($content, $limit, $offset) {
        $returnArr = array();
        $criteria = new CDbCriteria;
        $criteria->limit = $limit;
        $criteria->offset = $offset;
        $criteria->addSearchCondition('post_content', $content, 'OR');
        $criteria->addSearchCondition('post_title', $content);
        $data = Posts::model()->findAll($criteria);
        foreach ($data as $item) {
            $returnArr[] = $this->getPostById($item->post_id, Yii::app()->session['user_id']);
        }
        return $returnArr;
    }

    public function searchPost($query, $user_id) {
        $returnArr = array();
        $hidden_post = $this->getHiddenPostByUser($user_id);
        $blocked_user = $this->getBlockedUserByUser($user_id);
        $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->join = 'JOIN tbl_user u ON t.user_id = u.id';
        $criteria->addNotInCondition('t.post_id', $hidden_post); // = "tbl_posts.post_id NOT IN ($hidden_post) AND tbl_posts.user_id NOT IN ($blocked_user)";
        $criteria->addNotInCondition('t.user_id', $blocked_user);
        $criteria->order = 't.post_id DESC';
        $criteria->addSearchCondition('t.post_content', $query, true, 'AND');
        //$criteria->addSearchCondition('t.post_title', $query, true, 'OR');
        $count = Posts::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->validateCurrentPage = FALSE;
        $pages->pageSize = Yii::app()->params['RESULT_PER_PAGE'];
        $pages->applyLimit($criteria);
        $data = Posts::model()->findAll($criteria);
        foreach ($data as $item) {
            $returnArr[] = $this->getPostById($item->post_id, $user_id);
        }
        return array('data' => $returnArr, 'pages' => $pages);
    }

}
