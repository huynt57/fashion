<?php

Yii::import('application.models._base.BaseAlbums');

class Albums extends BaseAlbums {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function add($post) {
        $model = new Albums;
        $model->setAttributes($post);
        $model->created_at = time();
        $model->status = 1;
        $model->user_id = Yii::app()->session['user_id'];
        $model->updated_at = time();
        if ($model->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

    public function getPostOfAlbum($album_id) {
        $albums = PostAlbum::model()->findAllByAttributes(array('album_id' => $album_id));
        $post_arr = array();
        foreach ($albums as $album) {
            $post_arr[] = $album->post_id;
        }
        $criteria = new CDbCriteria;
        $criteria->addInCondition('t.post_id', $post_arr);
        $count = Posts::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = Yii::app()->params['RESULT_PER_PAGE'];
        $pages->applyLimit($criteria);
        $data = Posts::model()->findAll($criteria);
        $returnArr = array();
        foreach ($data as $item) {
            $returnArr[] = Posts::model()->getPostById($item->post_id, Yii::app()->session['user_id']);
        }
        $album = Albums::model()->findByPk($album_id);
        return array('data' => $returnArr, 'pages' => $pages, 'album' => $album);
    }

    public function getAlbumByUser($user_id) {
        $data = Albums::model()->findAllByAttributes(array('user_id' => $user_id));
        return $data;
    }

    public function countNumberPostAlbum($album_id) {
        $criteria = new CDbCriteria;
        $criteria->condition = "album_id = $album_id";
        $cnt = PostAlbum::model()->count($criteria);
        return $cnt;
    }

    public function getDetailAlbumByUser($user_id) {
        $returnArr = array();
        $data = Albums::model()->findAllByAttributes(array('user_id' => $user_id));
        foreach ($data as $item) {
            $itemArr = array();
            $itemArr['album_id'] = $item->album_id;
            $itemArr['album_name'] = $item->album_name;
            $itemArr['updated_at'] = date('d/m/Y', $item->created_at);
            $itemArr['number_posts'] = $this->countNumberPostAlbum($item->album_id);
            $itemArr['images_preview'] = $this->getRandomPostOfAlbum($item->album_id);
            $itemArr['description'] = $item->description;
            $returnArr[] = $itemArr;
        }
        return $returnArr;
    }

    public function getRandomPostOfAlbum($album_id) {
        $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->order = 'RAND()';
        $criteria->condition = "album_id = $album_id";
        $criteria->limit = 4;
        $posts = Posts::model()->findAll($criteria);
        $images = array();
        if ($posts) {
            foreach ($posts as $post) {
                $images[] = Images::model()->getImagePreviewByPostId($post->post_id);
            }
        }
        $cnt = count($images);
        if ($cnt < 4) {
            for ($i = 0; $i < (4 - $cnt); $i++) {
                $images[] = '';
            }
        }
        return $images;
    }

}
