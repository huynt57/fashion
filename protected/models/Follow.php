<?php

Yii::import('application.models._base.BaseFollow');

class Follow extends BaseFollow {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function add($user_follow, $user_followed) {
        $check = Relationship::model()->findAllByAttributes(array('user_id_1' => $user_follow, 'user_id_2' => $user_followed));
        if ($check) {
            return FALSE;
        }
        $model = new Follow;
        $model->user_follow = $user_follow;
        $model->user_followed = $user_followed;
        $model->created_at = time();
        $model->update_at = time();

        if ($model->save(FALSE)) {
            return TRUE;
        }

        return FALSE;
    }

}
