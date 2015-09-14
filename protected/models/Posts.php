<?php

Yii::import('application.models._base.BasePosts');

class Posts extends BasePosts
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function addPost($user_id, $post_content, $location, $url_arr)
        {
            $model = new Posts;
            $model->post_content = $post_content;
            $model->post_comment_count = 0;
            $model->post_like_count = 0;
            $model->location = $location;
            $model->created_at = time();
            $model->status = 1;
            $model->updated_at = time();
            $model->user_id = $user_id;
            if(!$model->save(FALSE))
            {
                return FALSE;
            }
            foreach ($url_arr as $url) 
            {
                $image = new Images;
                $image->img_url = $url;
                $image->post_id = $model->post_id;
                $image->created_at = time();
                $image->created_by = $user_id;
                $image->status = 1;
                if(!$image->save(FALSE))
                {
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
                ->order('DESC')
                ->queryAll();
        return $data;
    }
}