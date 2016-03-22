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

    public function getAlbumByUser($user_id) {
        $data = Albums::model()->findAllByAttributes(array('user_id' => $user_id));
        return $data;
    }

    public function countNumberPostAlbum($album_id) {
        $criteria = new CDbCriteria;
        $criteria->condition = "album_id = $album_id";
        $cnt = Posts::model()->count($criteria);
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
            $itemArr['image_preview'] = $this->getRandomPostOfAlbum($item->album_id);
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
        $criteria->limit = 1;
        $post = Posts::model()->find($criteria);
        if($post) {
        $image = Images::model()->getImagePreviewByPostId($post->post_id);
        } else {
            $image = 'https://placeholdit.imgix.net/~text?txtsize=19&txt=200%C3%97300&w=200&h=300';
        }
        return $image;
    }

}
