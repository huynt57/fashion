<?php

class WishlistController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAdd() {
        $request = Yii::app()->request;
        try {
            $user_id = StringHelper::filterString($request->getPost('user_id'));
            $post_id = StringHelper::filterString($request->getPost('post_id'));

            if (Wishlist::model()->addWishList($post_id, $user_id)) {
                ResponseHelper::JsonReturnSuccess("", "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Server Error");
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetWishList() {
        $request = Yii::app()->request;
        try {
            $user_id = StringHelper::filterString($request->getQuery('user_id'));
            $limit = StringHelper::filterString($request->getQuery('limit'));
            $offset = StringHelper::filterString($request->getQuery('offset'));

            $data = Wishlist::model()->getWishListAPI($user_id, $limit, $offset);
            ResponseHelper::JsonReturnSuccess($data, "Success");
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
