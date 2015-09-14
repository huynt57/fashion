<?php

Yii::import('application.models._base.BaseWishlist');

class Wishlist extends BaseWishlist
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function addWishList($post_id, $user_id)
        {
            $model = new Wishlist;
            $model->post_id = $post_id;
            $model->user_id = $user_id;
            $model->status = 1;
            $model->created_at = time();
            if($model->save())
            {
                return TRUE;
            }
            return FALSE;
        }
        
        public function getWishList($user_id, $limit, $offset)
        {
            $data = Yii::app()->db->createCommand()
                ->select('*')
                ->from('tbl_wishlist w')
                ->join('tbl_posts p', 'w.post_id=p.post_id')
                ->where('user_id=:user_id', array(':user_id' => $user_id))
                ->limit($limit)
                ->offset($offset)
                ->order('DESC')
                ->queryAll();
        return $data;
        }
}