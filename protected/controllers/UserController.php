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

    public function actionProfileCeleb() {
        try {
            $request = Yii::app()->request;
            if ($request->getQuery('ref_api') == Yii::app()->params['REF_API']) {
                $user_id = $request->getQuery('celeb_id');
            } else if ($request->getQuery('ref_web') == 'ref_web') {
                $user_id = $request->getQuery('celeb_id');
            }
            $data = User::model()->getProfileCeleb($user_id);
            $posts = Posts::model()->getPostByCelebForWeb($user_id);
            if ($user_id != Yii::app()->session['user_id']) {
                $check_block = Relationship::model()->findByAttributes(array('user_id_2' => Yii::app()->session['user_id'], 'user_id_1' => $user_id, 'user_type' => 'CELEB'));
                $is_followed = User::model()->isFollowedByUser(Yii::app()->session['user_id'], $user_id, 'USER');
                if ($check_block) {
                    return;
                }
            }
            $arr = array('profile' => $data, 'posts' => $posts['data'], 'pages' => $posts['pages'], 'is_followed' => $is_followed);
            if ($request->getQuery('ref_api') == Yii::app()->params['REF_API']) {
                ResponseHelper::JsonReturnSuccess($arr, 'Success');
            } else {
                $this->render('profile_celeb', $arr);
            }
        } catch (Exception $ex) {
            //var_dump($ex->getMessage());
            echo '<pre>';
            var_dump($ex->getMessage());
            var_dump($ex->getTrace());
            echo '</pre>';
        }
    }

    public function actionProfile() {
        try {
            $is_followed = FALSE;
            $request = Yii::app()->request;
            if ($request->getQuery('ref_api') == Yii::app()->params['REF_API']) {
                $user_id = $request->getQuery('user_id');
            } else if ($request->getQuery('ref_web') == 'ref_web') {
                $user_id = $request->getQuery('user_id');
            } else {
                $user_id = Yii::app()->session['user_id'];
            }


            $data = User::model()->getProfile($user_id);
            $posts = Posts::model()->getPostByUserForWeb($user_id);
            if ($user_id != Yii::app()->session['user_id']) {
                $check_block = Relationship::model()->findByAttributes(array('user_id_2' => Yii::app()->session['user_id'], 'user_id_1' => $user_id, 'user_type' => 'USER'));
                $is_followed = User::model()->isFollowedByUser(Yii::app()->session['user_id'], $user_id, 'USER');
                if ($check_block) {
                    return;
                }
            }
            $arr = array('profile' => $data, 'posts' => $posts['data'], 'pages' => $posts['pages'], 'is_followed' => $is_followed);
            if ($request->getQuery('ref_api') == Yii::app()->params['REF_API']) {
                ResponseHelper::JsonReturnSuccess($arr, 'Success');
            } else {
                $this->render('profile', $arr);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetAlbum() {
        $request = Yii::app()->request;
        try {
            if ($request->getQuery('ref_api') == Yii::app()->params['REF_API']) {
                $user_id = $request->getQuery('user_id');
            } else {
                $user_id = Yii::app()->session['user_id'];
            }
            $data = Albums::model()->getDetailAlbumByUser($user_id);
            $this->render('albums', array('data' => $data));
        } catch (Exception $ex) {
              echo '<pre>';
            var_dump($ex->getMessage());
            var_dump($ex->getTrace());
            echo '</pre>';
        }
    }
    

    public function actionWishList() {
        $request = Yii::app()->request;
        try {
            if ($request->getQuery('ref_api') == Yii::app()->params['REF_API']) {
                $user_id = $request->getQuery('user_id');
            } else {
                $user_id = Yii::app()->session['user_id'];
            }
            $data = Wishlist::model()->getWishListForWeb($user_id);
            $this->render('wishlist', $data);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionEditProfile() {
        $profile = User::model()->findByPk(Yii::app()->session['user_id']);
        $this->render('editProfile', array('profile' => $profile));
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
                $username = StringHelper::filterString($request->getPost('name'));
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
                //$user_id = StringHelper::filterArrayString($request->getPost('user_id'));
                $user_id = Yii::app()->session['user_id'];
                $user_photo = UploadHelper::getUrlUploadSingleImage($_FILES['user_photo'], $user_id);
                $user_cover = UploadHelper::getUrlUploadSingleImage($_FILES['user_cover'], $user_id);
                if (User::model()->updateUserInfo($user_id, $post, $user_photo, $user_cover)) {
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
                $type = StringHelper::filterString($request->getPost('type'));
                if (User::model()->blockUser($user_block, $user_blocked, $type) == 1) {
                    ResponseHelper::JsonReturnSuccess("", "Blocked before");
                } else if (User::model()->blockUser($user_block, $user_blocked, $type) == 0) {
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

    public function actionFollow() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $user_follow = StringHelper::filterString($request->getPost('user_follow'));
                $user_followed = StringHelper::filterString($request->getPost('user_followed'));
                if (Follow::model()->add($user_follow, $user_followed)) {
                    ResponseHelper::JsonReturnSuccess('', 'Thành công');
                } else {
                    ResponseHelper::JsonReturnError('', 'Có lỗi xảy ra');
                }
            } catch (exception $e) {
                var_dump($e->getMessage());
            }
            Yii::app()->end();
        }
    }

    public function actionUnFollow() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $user_follow = StringHelper::filterString($request->getPost('user_follow'));
                $user_followed = StringHelper::filterString($request->getPost('user_followed'));
                $user_type = StringHelper::filterString($request->getPost('user_type'));
                if (Follow::model()->remove($user_follow, $user_followed, $user_type)) {
                    ResponseHelper::JsonReturnSuccess('', 'Thành công');
                } else {
                    ResponseHelper::JsonReturnError('', 'Có lỗi xảy ra');
                }
            } catch (exception $e) {
                var_dump($e->getMessage());
            }
            Yii::app()->end();
        }
    }
    
    public function actionAddAlbum()
    {
        $post = StringHelper::filterArrayString($_POST);
        if(Albums::model()->add($post))
        {
            ResponseHelper::JsonReturnSuccess('', 'Success');
        } else {
            ResponseHelper::JsonReturnError('', 'Error');
        }
    }

    public function actionAddCategoryForUser() {
        $users = User::model()->findAll();
        foreach ($users as $user) {
            $album = new Albums;
            $album->user_id = $user->id;
            $album->album_name = 'Album chưa phân loại';
            $album->created_at = time();
            $album->updated_at = time();
            $album->status = 1;
            if ($album->save(FALSE)) {
                $posts = Posts::model()->findAllByAttributes(array('user_id' => $user->id));
                foreach ($posts as $post) {
                    $post->album_id = $album->album_id;
                    $post->save(FALSE);
                }
            }
        }
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
