<?php

class PostController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAdd() {
        $request = Yii::app()->request;
        try {
            $post_content = StringHelper::filterString($request->getPost('post_content'));
            $user_id = StringHelper::filterString($request->getPost('user_id'));
            $location = StringHelper::filterString($request->getPost('location'));
            if (count($_FILES['images']['tmp_name']) > 1) {
                $url_arr = UploadHelper::getUrlUploadMultiImages($_FILES['images'], $user_id);
            } else {
                $url_arr = UploadHelper::getUrlUploadSingleImage($_FILES['images'], $user_id);
            }
            // $album = StringHelper::filterString($request->getPost('album'));
            $album = NULL;

            if (Posts::model()->addPost($user_id, $post_content, $location, $url_arr, $album)) {
                ResponseHelper::JsonReturnSuccess($url_arr, "Success");
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
            $result = Posts::model()->likePost($post_id);
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
            $result = Posts::model()->likePost($image_id);
            if ($result) {
                ResponseHelper::JsonReturnSuccess("", "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Server Error");
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
