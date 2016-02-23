<?php

class RecommendController extends Controller {

    public function actionIndex() {
        $this->render('recommend');
    }

    public function actionCeleb() {
        $request = Yii::app()->request;
        try {
            $rate_height = StringHelper::filterString($request->getQuery('rate_height'));
            $rate_weight = StringHelper::filgetPostByIdterString($request->getQuery('rate_weight'));
            $data = Celebrities::model()->recommend($rate_height, $rate_weight);
            if ($request->getQuery('ref') == Yii::app()->params['REF_API']) {
                ResponseHelper::JsonReturnSuccess($data, "Success");
            } else {
                $this->render('index', array('data' => $data));
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
