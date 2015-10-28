<?php

class CategoryController extends Controller {

    public function actionIndex() {
        $request = Yii::app()->request;
        try {
            $type = StringHelper::filterString($request->getQuery('type'));
            $data = Posts::model()->getPostByCategoryType($type);
            $this->render('index', $data);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionDetailCategory() {
        $request = Yii::app()->request;
        try {
            $cat_id = StringHelper::filterString($request->getQuery('cat_id'));
            $data = Posts::model()->getPostByCategoryId($cat_id);
            $this->render('categoryById', $data);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetAllCategory() {
        $data = Categories::model()->findAll();
        ResponseHelper::JsonReturnSuccess($data, "Success");
    }

    public function actionAddCategory() {
        try {
            $attr = StringHelper::filterArrayString($_POST);
            if (Categories::model()->addCategory($attr)) {
                ResponseHelper::JsonReturnSuccess('', 'Success');
            } else {
                ResponseHelper::JsonReturnSuccess('', 'Error');
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
