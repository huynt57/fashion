<?php

class NotificationController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionGetNotification() {
        $request = Yii::app()->request;
        try {
            $user_id = Yii::app()->session['user_id'];
            $limit = StringHelper::filterString($request->getPost('limit'));
            $offset = StringHelper::filterString($request->getPost('offset'));
            $data = Notifications::model()->getNotification($user_id, $limit, $offset);
            ResponseHelper::JsonReturnSuccess($data, "Success");
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetNotificationWeb() {
        // $request = Yii::app()->request;
        try {
            header('Content-Type: text/event-stream');
            header('Cache-Control: no-cache');
            echo "retry: 10000\n";
            $user_id = Yii::app()->session['user_id'];
            // $pages = StringHelper::filterString($request->getPost('pages'));
            $data = Notifications::model()->getNotificationWeb($user_id);
            echo "data: ".CJSON::encode($data);
            flush();
           // ResponseHelper::JsonReturnSuccess($data, "Success");
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
