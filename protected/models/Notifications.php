<?php

Yii::import('application.models._base.BaseNotifications');

class Notifications extends BaseNotifications {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getNotification($user_id, $limit, $offset) {
        $criteria = new CDbCriteria;
        $criteria->limit = $limit;
        $criteria->offset = $offset;
        $criteria->condition = "user_id = $user_id";

        return $data = Notifications::model()->findAll($criteria);
    }

    public function getLatestNotification($user_id) {
        $criteria = new CDbCriteria;
        $criteria->condition = "user_id = $user_id AND is_read = 0";
        $cnt = Notifications::model()->count($criteria);
        $data = Notifications::model()->findAll($criteria);
        return array('count' => $cnt, 'data' => $data);
    }

    public function add($post) {
        $model = new Notifications;
        $model->setAttributes($post);
        if ($model->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

}
