<?php

class SearchController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function seachByPostContent($content, $limit, $offset) {
        $data = Posts::model()->searchByPostContent($content, $limit, $offset);
        return $data;
    }

    public function actionSearchPostWeb() {
        $request = Yii::app()->request;
        try {
            $query = StringHelper::filterString($request->getQuery('query'));       
            $data = Posts::model()->searchPost($query, Yii::app()->session['user_id']);
            //   var_dump($data); die;
            $this->render('index', $data);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function searchByUsername($username, $limit, $offset) {
        $data = User::model()->searchByUsername($username, $limit, $offset);
        return $data;
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
