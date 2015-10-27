<?php

class CommentController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAdd() {
        $request = Yii::app()->request;
        try {
            $user_id = StringHelper::filterString($request->getPost('user_id'));
            $post_id = StringHelper::filterString($request->getPost('post_id'));
            $content = StringHelper::filterString($request->getPost('comment_content'));
            
            $response = Comments::model()->addComment($user_id, $post_id, $content);
            if ($response) {
                ResponseHelper::JsonReturnSuccess($response, "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Server Error");
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetCommentByPost() {
        $request = Yii::app()->request;
        try {
            $post_id = StringHelper::filterString($request->getQuery('post_id'));
            $limit = StringHelper::filterString($request->getQuery('limit'));
            $offset = StringHelper::filterString($request->getQuery('offset'));

            $data = Comments::model()->getCommentByPost($post_id, $limit, $offset);
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
