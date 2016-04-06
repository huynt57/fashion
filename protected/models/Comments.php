<?php

Yii::import('application.models._base.BaseComments');

class Comments extends BaseComments {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function checkUserHasCommented($user_id, $post_id) {
        $check = Comments::model()->findByAttributes(array('created_by' => $user_id, 'post_id' => $post_id));
        if ($check) {
            return TRUE;
        }
        return FALSE;
    }

    public function getListUserCommentedOnPost($post_id) {
        $data = Comments::model()->findAllByAttributes(array('post_id' => $post_id));
        return $data;
    }

    public function addComment($user_id, $post_id, $content) {
        $model = new Comments;
        $model->post_id = $post_id;
        $model->created_by = $user_id;
        $model->updated_at = time();
        $model->comment_content = $content;
        $model->status = 1;
        $model->created_at = time();
        $model->updated_at = time();
        $model->save(FALSE);
        $post = Posts::model()->findByPk($post_id);
        $post->post_comment_count++;
        $user = User::model()->findByPk($model->created_by);
        $user_commented = User::model()->findByPk($post->user_id);

        if ($user->id != Yii::app()->session['user_id']) {
            $users_have_commented = $this->getListUserCommentedOnPost($post_id);
            if ($users_have_commented) {
                foreach ($users_have_commented as $item) {
                    if ($item->created_by != $post->user_id) {
                        $arr_noti_others = array('user_id' => $user->id,
                            'content' => "$user->username cũng đã bình luận bài viết của $user_commented->username",
                            'type' => 'comment_also',
                            'recipient_id' => $item->created_by,
                            'url' => Yii::app()->createAbsoluteUrl('post/viewPost', array('post_id' => $post_id, array('ref' => 'noti'))));
                        Notifications::model()->add($arr_noti_others);
                    }
                }
            }
            $arr_noti = array('user_id' => $user->id,
                'content' => "$user->username vừa bình luận bài viết của bạn",
                'type' => 'comment',
                'recipient_id' => $user_commented->id,
                'url' => Yii::app()->createAbsoluteUrl('post/viewPost', array('post_id' => $post_id, array('ref' => 'noti'))));
            Notifications::model()->add($arr_noti);
        } else {
            $users_have_commented = $this->getListUserCommentedOnPost($post_id);
            if ($users_have_commented) {
                foreach ($users_have_commented as $item) {
                    if ($item->created_by != $post->user_id) {
                        $arr_noti_others = array('user_id' => $user->id,
                            'content' => "$user->username cũng đã bình luận bài viết của họ",
                            'type' => 'comment_also',
                            'recipient_id' => $item->created_by,
                            'url' => Yii::app()->createAbsoluteUrl('post/viewPost', array('post_id' => $post_id, array('ref' => 'noti'))));
                        Notifications::model()->add($arr_noti_others);
                    }
                }
            }
        }

        if ($model->save(FALSE) && $post->save(FALSE)) {
            $returnArr = array();
            $returnArr['created_by'] = $model->created_by;
            $returnArr['username'] = $user->username;
            $returnArr['photo'] = $user->photo;
            $returnArr['created_at'] = Util::time_elapsed_string($model->created_at);
            $returnArr['comment_content'] = $model->comment_content;
            return $returnArr;
        }
        return FALSE;
    }

    public function getCommentByPost($post_id, $limit, $offset) {

        $sql = "SELECT tbl_comments.*, tbl_user.username, tbl_user.photo FROM tbl_comments JOIN tbl_user ON tbl_comments.created_by = tbl_user.id WHERE tbl_comments.post_id = $post_id ORDER BY tbl_comments.comment_id DESC LIMIT $offset, $limit ";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        return $data;
    }

}
