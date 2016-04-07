<?php

class HomeController extends Controller {

//    public function actionIndex() {
//        $this->render('index');
//    }
    public $layout;
    public $layoutPath;

    public function actionNewsFeedApi() {
        $request = Yii::app()->request;
        try {
            $user_id = $request->getQuery('user_id');
            $limit = $request->getQuery('limit');
            $offset = $request->getQuery('offset');
            if (isset($user_id)) {
                $feed = Posts::model()->getNewsFeedForUser($user_id, $limit, $offset);
                ResponseHelper::JsonReturnSuccess($feed, 'Success');
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionNewsFeed() {
        try {
            $user_id = Yii::app()->session['user_id'];
            // $user_id = 1;
            if (isset($user_id)) {
                // $feed = Posts::model()->getNewsFeedForWeb($user_id);
                //for testing
                $feed = Posts::model()->getNewsFeedForWeb($user_id);

                $this->render('index', $feed);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionExplore() {
        try {
//            $this->layoutPath = Yii::getPathOfAlias('webroot') . "/themes/frontend2/views/layouts";
//            $this->layout = 'main_empty_2';
            $feed = Posts::model()->getExplore();
            $this->render('explore', $feed);
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
