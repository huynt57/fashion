<?php

class RankController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionRankByMonth() {
        $data = User::model()->rankByMonth();
        ResponseHelper::JsonReturnSuccess($data, 'Success');
    }

    public function actionRankByWeek() {
        $data = User::model()->rankByWeek();
        ResponseHelper::JsonReturnSuccess($data, 'Success');
    }

    public function actionRankByDay() {
        $data = User::model()->rankByDay();
        ResponseHelper::JsonReturnSuccess($data, 'Success');
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
