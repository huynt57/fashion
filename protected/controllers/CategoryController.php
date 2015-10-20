<?php

class CategoryController extends Controller {

    public function actionIndex() {
        $this->render('index');
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
