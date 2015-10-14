<?php

Yii::import('application.models._base.BaseComments');

class Comments extends BaseComments {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function addComment($user_id, $post_id, $content) {
        $model = new Comments;
        $model->post_id = $post_id;
        $model->created_by = $user_id;
        $model->updated_at = time();
        $model->comment_content = $content;
        $model->status = 1;
        $model->created_at = time();
        $post = Posts::model()->findByPk($post_id);
        $post->post_comment_count++;
        if ($model->save(FALSE) && $post->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

    public function getCommentByPost($post_id, $limit, $offset) {

//        $data = Yii::app()->db->createCommand()
//                ->select('tbl_comments.*, tbl_user.username')
//                ->from('tbl_comments')
//                ->join('tbl_user', '`tbl_comments`.`created_by`=`tbl_user`.`user_id`')
//                ->where('`tbl_comments`.`post_id`=:post_id', array(':post_id' => $post_id))
//                ->limit($limit)
//                ->offset($offset)
//                ->order('comment_id DESC')
//                ->queryAll();
        $sql = "SELECT tbl_comments.*, tbl_user.username FROM tbl_comments JOIN tbl_user ON tbl_comments.created_by = tbl_user.id WHERE tbl_comments.post_id = $post_id LIMIT $offset, $limit";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        return $data;
    }

}
