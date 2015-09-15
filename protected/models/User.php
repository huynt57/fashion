<?php

Yii::import('application.models._base.BaseUser');

class User extends BaseUser
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function updateUserInfo($user_id, $post)
        {
            $model = User::model()->findByAttributes(array('id'=>$user_id));
            $model->setAttributes($post);
            $model->updated_at = time();
            if($model->save(FALSE))
            {
                return TRUE;
            }
            return FALSE;
        }
}