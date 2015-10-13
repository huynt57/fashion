<?php

Yii::import('application.models._base.BaseUser');

class User extends BaseUser {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function updateUserInfo($user_id, $post) {
        $model = User::model()->findByAttributes(array('id' => $user_id));
        $model->setAttributes($post);
        $model->updated_at = time();
        if ($model->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

    public function processLoginWithFacebook($facebook_id, $age, $gender, $facebook_access_token, $photo, $username, $device_id) {
        $check = User::model()->findByAttributes(array('facebook_id' => $facebook_id));
        if ($check) {
            $check->updated_at = time();
            if ($check->save(FALSE)) {
                ResponseHelper::JsonReturnSuccess($check, "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Server Error");
            }
        } else {
            $model = new User;
            $model->facebook_id = $facebook_id;
            $model->age = $age;
            $model->gender = $gender;
            $model->facebook_access_token = $facebook_access_token;
            $model->photo = $photo;
            $model->username = $username;
            $model->device_id = $device_id;
            $model->created_at = time();
            $model->updated_at = time();
            $model->status = 1;
            if ($model->save(FALSE)) {
                ResponseHelper::JsonReturnSuccess($model, "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Server Error");
            }
        }
    }

    public function blockUser($user_block, $user_blocked) {
        $model = Relationship::model()->findByAttributes(array('user_id_1' => $user_block, 'user_id_2' => $user_blocked));
        if ($model) {
            return 1;
        } else {
            $rel = new Relationship;
            $rel->user_id_1 = $user_block;
            $rel->user_id_2 = $user_blocked;
            $rel->status = 1;
            $rel->created_at = time();
            $rel->updated_at = time();
            $rel->type = Yii::app()->params['USER_BLOCK'];
            if ($rel->save(FALSE)) {
                return 2;
            } else {
                return 0;
            }
        }
    }

    public function blockPost($user_block, $post_id) {
        $model = UserPostRelationship::model()->findByAttributes(array('user_id' => $user_block, 'post_id' => $post_id));
        if ($model) {
            return 1;
        } else {
            $rel = new UserPostRelationship;
            $rel->user_id = $user_block;
            $rel->post_id = $post_id;
            $rel->created_at = time();
            $rel->updated_at = time();
            $rel->type = Yii::app()->params['USER_BLOCK'];
            if ($rel->save(FALSE)) {
                return 2;
            } else {
                return 0;
            }
        }
    }
    
    public function rankByDay()
    {
        $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->addBetweenCondition = '';
    }
    
    public function rankByMonth()
    {
        
    }
    
    public function rankByWeek()
    {
        
    }

}
