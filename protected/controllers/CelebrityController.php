<?php

class CelebrityController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAdd() {
        $this->render('add');
    }

    public function actionAddPost() {
        $male_cats = Categories::model()->getMaleCategory();
        $female_cats = Categories::model()->getFemaleCategory();
        $other_cats = Categories::model()->getOtherCategory();
        $celebs = Celebrities::model()->findAll();
        $this->render('addPost', array('celebs' => $celebs, 'male_cats' => $male_cats, 'female_cats' => $female_cats, 'other_cats' => $other_cats));
    }

    public function actionAddCeleb() {
        $request = Yii::app()->request;
        try {
            $celeb_image = UploadHelper::getUrlUploadSingleImage($_FILES['celeb_image'], 'celebs_image');
            $celeb_cover = UploadHelper::getUrlUploadSingleImage($_FILES['celeb_cover'], 'celebs_cover');
            $res = Celebrities::model()->addCeleb($_POST, $celeb_image, $celeb_cover);
            if ($res != FALSE) {
                Yii::app()->user->setFlash('success', 'Thêm người nổi tiếng thành công');
            } else {
                Yii::app()->user->setFlash('error', 'Có lỗi xảy ra');
            }
            $this->redirect(Yii::app()->createUrl('celebrity/add'));
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionInsertPostCeleb() {
        $request = Yii::app()->request;
        try {
            $post_content = StringHelper::filterString($request->getPost('post_content'));
            $celeb_id = StringHelper::filterString($request->getPost('celeb_id'));
            $location = StringHelper::filterString($request->getPost('location'));
            $cats = $request->getPost('cats');
            if (count($_FILES['images']['tmp_name']) > 1) {
                $url_arr = UploadHelper::getUrlUploadMultiImages($_FILES['images'], $celeb_id . 'celeb');
            } else {
                $url_arr = UploadHelper::getUrlUploadMultiImages($_FILES['images'], $celeb_id . 'celeb');
            }
            // $album = StringHelper::filterString($request->getPost('album'));
            $album = NULL;
            $res = Posts::model()->addPostCeleb($celeb_id, $post_content, $location, $url_arr, $album, $cats);
            if ($res != FALSE) {
                Yii::app()->user->setFlash('success', 'Thêm bài viết thành công');
            } else {
                Yii::app()->user->setFlash('error', 'Có lỗi xảy ra');
            }
            $this->redirect(Yii::app()->createUrl('celebrity/addPost'));
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
