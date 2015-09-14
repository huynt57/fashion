<?php

Yii::import('application.models._base.BaseComments');

class Comments extends BaseComments
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function addComment($user_id, $post_id, $content)
        {
            $model = new Comments;
            $model->post_id  = $post_id;
            $model->created_by = $user_id;
            $model->comment_content = $content;
            $model->status = 1;
            $model->created_at = time();
            if($model->save())
            {
                return TRUE;
            }
            return FALSE;
        }
        
        public function getCommentByPost($post_id, $limit, $offset)
        {
            $criteria = new CDbCriteria;
            $criteria->limit = $limit;
            $criteria->offset = $offset;
            $criteria->condition = "post_id = $post_id";
            
            $data = Comments::findAll($criteria);
            return $data;
        }
}