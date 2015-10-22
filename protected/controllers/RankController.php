<?php

class RankController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionRankByTime() {
        $request = Yii::app()->request;
        try {
            $time = StringHelper::filterString($request->getQuery('time'));
            $ref_api = StringHelper::filterString($request->getQuery('ref_api'));
            $limit = StringHelper::filterString($request->getQuery('limit'));
            $offset = StringHelper::filterString($request->getQuery('offset'));

            if ($ref_api == Yii::app()->params['REF_API'] && !empty($limit) && !empty($offset)) {
                $data = User::model()->rankByTimeApi($time, $limit, $offset);
                ResponseHelper::JsonReturnSuccess($data, 'Success');
            } else {
                $data = User::model()->rankByTimeForWeb($time);
                $this->render('index', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    
    public function actionRankForPost()
    {
        
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
