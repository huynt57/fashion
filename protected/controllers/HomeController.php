<?php

class HomeController extends Controller {

//    public function actionIndex() {
//        $this->render('index');
//    }

    public function actionNewFeedApi() {
        $request = Yii::app()->request;
        try {
            $user_id = $request->getQuery('user_id');
            if (isset($user_id)) {
                $feed = Posts::model()->getNewsFeedForUser($user_id);
                ResponseHelper::JsonReturnSuccess($feed, 'Success');
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionNewFeed() {
        $request = Yii::app()->request;
        try {
            $user_id = Yii::app()->session['user_id'];
            if (isset($user_id)) {
                $feed = Posts::model()->getNewsFeedForWeb($user_id);
                $this->render('index', $feed);
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
