<?php

Yii::import('application.models._base.BaseFollow');

class Follow extends BaseFollow {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function remove($user_follow, $user_followed, $type) {
        $model = Follow::model()->findByAttributes(array('user_follow' => $user_follow, 'user_followed' => $user_followed, 'type' => $type));
        if ($model) {
            if ($model->delete()) {
                return TRUE;
            }
        }
        return FALSE;
    }

    public function add($user_follow, $user_followed, $type) {
        $check = Relationship::model()->findAllByAttributes(array('user_id_1' => $user_follow, 'user_id_2' => $user_followed));
        $check_2 = Relationship::model()->findAllByAttributes(array('user_id_2' => $user_follow, 'user_id_1' => $user_followed));
        $check_3 = Follow::model()->findByAttributes(array('user_follow' => $user_follow, 'user_followed' => $user_followed));
        if ($check || $check_2 || $check_3) {
            return FALSE;
        }
        $model = new Follow;
        $model->user_follow = $user_follow;
        $model->user_followed = $user_followed;
        $model->created_at = time();
        $model->update_at = time();
        $model->type = $type;

        // if ($to != Yii::app()->session['user_id']) {
//            $arr_noti = array('user_id' => $from,
//                'content' => "$user->username vừa bình luận ở bài post của $user_commented->username",
//                'type' => 'post',
//                'recipient_id' => $user_commented->id,
//                'url' => Yii::app()->createAbsoulteUrl('post/view'));
//            Notifications::model()->add($arr_noti);
        // }

        if ($model->save(FALSE)) {
            return TRUE;
        }

        return FALSE;
    }

}
