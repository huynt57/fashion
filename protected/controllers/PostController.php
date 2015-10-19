<?php

class PostController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionGetPostById() {
        $request = Yii::app()->request;
        try {
            $post_id = StringHelper::filterString($request->getQuery('post_id'));
            $data = Posts::model()->getPostById($post_id);
            if ($request->getQuery(Yii::app()->params['REF_API'])) {
                ResponseHelper::JsonReturnSuccess($data, "Success");
            } else {
                $this->render();
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
            if ($result) {
                ResponseHelper::JsonReturnSuccess("", "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Server Error");
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionHidePostForUser() {
        
    }

    public function actionLikePost() {
        try {
            $post_id = StringHelper::filterArrayString(Yii::app()->request->getPost('post_id'));
            $user_id = StringHelper::filterArrayString(Yii::app()->request->getPost('$user_id'));
            $result = Posts::model()->likePost($user_id, $post_id);
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
            $user_id = StringHelper::filterArrayString(Yii::app()->request->getPost('$user_id'));
            $result = Posts::model()->likePost($user_id, $image_id);
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
        $this->render('upload');
    }

    public function actionViewPost() {
        $this->render('viewPost');
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
