<?php

class UserController extends Controller {

    public $layout;
    public $layoutPath;

    public function actionIndex() {
        $this->render('index');
    }

    public function actionLogin() {
        $this->layoutPath = Yii::getPathOfAlias('webroot') . "/themes/frontend/views/layouts";
        $this->layout = 'main_empty';
        $this->render('login');
    }

    public function actionProfile() {
        try {
            $request = Yii::app()->request;
            if ($request->getQuery('ref_api') == Yii::app()->params['REF_API']) {
                $user_id = $request->getQuery('user_id');
            } else {
                $user_id = Yii::app()->session['user_id'];
            }
            $data = User::model()->getProfile($user_id);
            $posts = Posts::model()->getPostByUserForWeb($user_id);
            $arr = array('profile' => $data, 'posts' => $posts['data'], 'pages' => $posts['pages']);
            if ($request->getQuery('ref_api') == Yii::app()->params['REF_API']) {
                ResponseHelper::JsonReturnSuccess($arr, 'Success');
            } else {
                $this->render('profile', $arr);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionEditProfile() {
        $this->render('editProfile');
    }

    public function actionLoginWithFacebook() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $facebook_id = StringHelper::filterString($request->getPost('facebook_id'));
                $age = StringHelper::filterString($request->getPost('age'));
                $gender = StringHelper::filterString($request->getPost('gender'));
                $facebook_access_token = StringHelper::filterString($request->getPost('facebook_access_token'));
                $photo = StringHelper::filterString($request->getPost('photo'));
                $username = StringHelper::filterString($request->getPost('username'));
                $device_id = StringHelper::filterString($request->getPost('device_id'));
                User::model()->processLoginWithFacebook($facebook_id, $age, $gender, $facebook_access_token, $photo, $username, $device_id);
            } catch (exception $e) {
                var_dump($e->getMessage());
            }
            Yii::app()->end();
        }
    }

    public function actionUpdateInfo() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $post = StringHelper::filterArrayString($_POST);
                $user_id = StringHelper::filterArrayString($request->getPost('user_id'));
                if (User::model()->updateUserInfo($user_id, $post)) {
                    ResponseHelper::JsonReturnSuccess("", "Success");
                } else {
                    ResponseHelper::JsonReturnError("", "Server Error");
                }
            } catch (exception $e) {
                var_dump($e->getMessage());
            }
            Yii::app()->end();
        }
    }

    public function actionBlockUser() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $user_blocked = StringHelper::filterString($request->getPost('user_blocked'));
                $user_block = StringHelper::filterString($request->getPost('user_block'));
                if (User::model()->blockUser($user_block, $user_blocked) == 1) {
                    ResponseHelper::JsonReturnSuccess("", "Blocked before");
                } else if (User::model()->blockUser($user_block, $user_blocked) == 0) {
                    ResponseHelper::JsonReturnError("", "Server Error");
                } else {
                    ResponseHelper::JsonReturnSuccess("", "Success");
                }
            } catch (exception $e) {
                var_dump($e->getMessage());
            }
            Yii::app()->end();
        }
    }

    public function actionBlockPost() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $user_block = StringHelper::filterString($request->getPost('user_block'));
                $post_id = StringHelper::filterString($request->getPost('post_id'));
                if (User::model()->blockPost($user_block, $post_id) == 1) {
                    ResponseHelper::JsonReturnSuccess("", "Blocked before");
                } else if (User::model()->blockUser($user_block, $user_blocked) == 0) {
                    ResponseHelper::JsonReturnError("", "Server Error");
                } else {
                    ResponseHelper::JsonReturnSuccess("", "Success");
                }
            } catch (exception $e) {
                var_dump($e->getMessage());
            }
            Yii::app()->end();
        }
    }

    public function actionLogout() {
        Yii::app()->session->destroy();
        $this->redirect(Yii::app()->createUrl('user/login'));
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
