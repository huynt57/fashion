<?php

class PostController extends Controller {

    public $layout;
    public $layoutPath;

    public function actionIndex() {
        $this->render('index');
    }

    public function actionGetPostById() {
        $request = Yii::app()->request;
        try {
            $post_id = StringHelper::filterString($request->getQuery('post_id'));
            $data = Posts::model()->getPostById($post_id);
            if ($request->getQuery('ref') == Yii::app()->params['REF_API']) {
                ResponseHelper::JsonReturnSuccess($data, "Success");
            } else {
                $this->render('single', array('data' => $data));
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionAdd() {
        $request = Yii::app()->request;
        try {
            $post_content = StringHelper::filterString($request->getPost('post_content'));
            $user_id = StringHelper::filterString($request->getPost('user_id'));
            $location = StringHelper::filterString($request->getPost('location'));
            $cats = $request->getPost('cats');
            if (count($_FILES['images']['tmp_name']) > 1) {
                $url_arr = UploadHelper::getUrlUploadMultiImages($_FILES['images'], $user_id);
            } else {
                $url_arr = UploadHelper::getUrlUploadSingleImage($_FILES['images'], $user_id);
            }
            // $album = StringHelper::filterString($request->getPost('album'));
            $album = NULL;
            $res = Posts::model()->addPost($user_id, $post_content, $location, $url_arr, $album, $cats);
            if ($res != FALSE) {
                ResponseHelper::JsonReturnSuccess($res, "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Server Error");
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetPostByCategory() {
        $request = Yii::app()->request;
        try {
            $cat_id = StringHelper::filterString($request->getQuery('cat_id'));
            $limit = StringHelper::filterString($request->getQuery('limit'));
            $offset = StringHelper::filterString($request->getQuery('offset'));

            $data = Posts::model()->getPostByCategory($cat_id, $limit, $offset);
            ResponseHelper::JsonReturnSuccess($data, "Success");
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetPostByUser() {
        $request = Yii::app()->request;
        try {
            $user_id = StringHelper::filterString($request->getQuery('user_id'));
            $limit = StringHelper::filterString($request->getQuery('limit'));
            $offset = StringHelper::filterString($request->getQuery('offset'));

            $data = Posts::model()->getPostByUser($user_id, $limit, $offset);
            ResponseHelper::JsonReturnSuccess($data, "Success");
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetPostByGender() {
        
    }

    public function actionReportPost() {
        try {
            $attr = StringHelper::filterArrayString($_POST);
            $result = Posts::model()->reportPost($attr);
            if ($result === 1) {
                ResponseHelper::JsonReturnError("", "Reported before");
            } else if ($result == 3) {
                ResponseHelper::JsonReturnError("", "Server Error");
            } else {
                ResponseHelper::JsonReturnSuccess("", "Success");
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionHidePostForUser() {
        $request = Yii::app()->request;
        try {
            $user_block = StringHelper::filterString($request->getPost('user_block'));
            $post_id = StringHelper::filterString($request->getPost('post_id'));
            $result = User::model()->blockPost($user_block, $post_id);
            if ($result == 1) {
                ResponseHelper::JsonReturnError('', 'Blocked before');
            } else if ($result == 0) {
                ResponseHelper::JsonReturnError('', 'Server Error');
            } else {
                ResponseHelper::JsonReturnSuccess('', 'Success');
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionLikePost() {
        try {
            $post_id = StringHelper::filterString(Yii::app()->request->getPost('post_id'));
            $from = StringHelper::filterString(Yii::app()->request->getPost('from'));
            $to = StringHelper::filterString(Yii::app()->request->getPost('to'));
            $type = StringHelper::filterString(Yii::app()->request->getPost('type'));
            $result = Posts::model()->likePost($from, $to, $post_id, $type);
            if ($result) {
                ResponseHelper::JsonReturnSuccess("", "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Server Error");
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionLikeImage() {
        try {
            $image_id = StringHelper::filterArrayString(Yii::app()->request->getPost('image_id'));
            $user_id = StringHelper::filterArrayString(Yii::app()->request->getPost('user_id'));
            $result = Posts::model()->likeImage($user_id, $image_id);
            if ($result) {
                ResponseHelper::JsonReturnSuccess("", "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Server Error");
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionUpload() {
        $this->layoutPath = Yii::getPathOfAlias('webroot') . "/themes/frontend2/views/layouts";
        $this->layout = 'main_modal';
        $male_cats = Categories::model()->getMaleCategory();
        $female_cats = Categories::model()->getFemaleCategory();
        $other_cats = Categories::model()->getOtherCategory();
        $albums = Albums::model()->getAlbumByUser(Yii::app()->session['user_id']);
        $this->render('upload', array('male_cats' => $male_cats, 'female_cats' => $female_cats, 'other_cats' => $other_cats, 'albums' => $albums));
    }

    public function actionViewPost() {
        $request = Yii::app()->request;
        try {
            $post_id = StringHelper::filterString($request->getQuery('post_id'));
            $data = Posts::model()->getPostById($post_id, Yii::app()->session['user_id']);
            Yii::app()->clientScript->registerMetaTag("fitme.vn - Khám phá thời trang", null, null, array('property' => 'og:title'));
            Yii::app()->clientScript->registerMetaTag(Images::model()->getImagePreviewByPostId($post_id), null, null, array('property' => 'og:image'));
            Yii::app()->clientScript->registerMetaTag("website", null, null, array('property' => 'og:type'));
            Yii::app()->clientScript->registerMetaTag(Yii::app()->createAbsoluteUrl('post/viewPost', array('post_id' => $post_id)), null, null, array('property' => 'og:url'));
            // $data = Posts::model()->getPostById($post_id, '1');
            if ($request->getQuery(Yii::app()->params['REF_API'])) {
                ResponseHelper::JsonReturnSuccess($data, "Success");
            } else {
                $this->render('view', array('data' => $data));
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionView() {
        $request = Yii::app()->request;
        $this->layoutPath = Yii::getPathOfAlias('webroot') . "/themes/frontend2/views/layouts";
        $this->layout = 'main_modal';
        try {
            $post_id = StringHelper::filterString($request->getQuery('post_id'));
            //$data = Posts::model()->getPostById($post_id, Yii::app()->session['user_id']);
            $data = Posts::model()->getPostById($post_id, Yii::app()->session['user_id']);
            if ($request->getQuery(Yii::app()->params['REF_API'])) {
                ResponseHelper::JsonReturnSuccess($data, "Success");
            } else {
                $this->render('post_modal', array('data' => $data));
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionAddPostForWeb() {
        $request = Yii::app()->request;
        try {
            $post_content = StringHelper::filterString($request->getPost('post_content'));
            $user_id = StringHelper::filterString($request->getPost('user_id'));
            $location = StringHelper::filterString($request->getPost('location'));
            $cats_arr = StringHelper::filterArrayString($request->getPost('cats'));
            $cats = json_encode($cats_arr);
            $url = Yii::app()->request->getUrlReferrer();
            //   $url_arr = NULL;
            $url_arr = UploadHelper::getUrlUploadMultiImages($_FILES['images'], $user_id);
            $album = StringHelper::filterString($request->getPost('album'));
            //$album = NULL;
            if (Posts::model()->addPost($user_id, $post_content, $location, $url_arr, $album, $cats)) {
                $this->redirect($url);
            } else {
                $this->redirect($url);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
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
