<?php

Yii::import('application.models._base.BaseNotifications');

class Notifications extends BaseNotifications {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getNotificationWeb($user_id) {
        $criteria = new CDbCriteria;
        $criteria->condition = "recipient_id = $user_id";
        $count = Notifications::model()->count($criteria);
        //echo $count; die;
        $pages = new CPagination($count);
        $pages->validateCurrentPage = FALSE;
        $pages->pageSize = 4;
        $pages->applyLimit($criteria);
        $data = Notifications::model()->findAll($criteria);
        return $data;
    }

    public function markSeen($noti_id) {
        $noti = Notifications::model()->findByPk($noti_id);
        $noti->is_read = 1;
        if ($noti->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

    public function getNotification($user_id, $limit, $offset) {
        $criteria = new CDbCriteria;
        $criteria->limit = $limit;
        $criteria->offset = $offset;
        $criteria->condition = "recipient_id = $user_id";

        return $data = Notifications::model()->findAll($criteria);
    }

    public function getLatestNotification($user_id) {
        $criteria = new CDbCriteria;
        $criteria->condition = "recipient_id = $user_id AND is_read = 0 AND is_get = 0";
        $cnt_criteria = new CDbCriteria;
        $cnt_criteria->condition = "recipient_id = $user_id AND is_read = 0";
        $cnt = Notifications::model()->count($cnt_criteria);
        $data = Notifications::model()->findAll($criteria);
        foreach ($data as $item) {
            $item->is_get = 1;
            $item->save(FALSE);
        }
        return array('count' => $cnt, 'data' => $data);
    }

    public function add($post) {
        $model = new Notifications;
        $model->setAttributes($post);
        $model->created_at = time();
        $model->is_read = 0;
        if ($model->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

    public function markNotificationAsRead($noti_id) {
        $model = Notifications::model()->findByPk($noti_id);
        $model->is_read = 1;
        if ($model->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

    public function markAllNotificationAsSeen() {
        $flag = TRUE;
        $notis = Notifications::model()->findAllByAttributes(array('is_read' => 0));
        foreach ($notis as $noti) {
            $noti->is_read = 2;
            if (!$noti->save(FALSE)) {
                $flag = FALSE;
            }
        }
        return $flag;
    }

}
