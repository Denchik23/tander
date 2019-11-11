<?php
namespace app\api\modules\v1\controllers;

//use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
//use yii\web\Response;

class BookController extends ActiveController
{
    // We are using the regular web app modules:
    public $modelClass = 'app\models\Books';

/*
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'only' => ['index'],  // in a controller
                // if in a module, use the following IDs for user actions
                // 'only' => ['user/view', 'user/index']
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
                'languages' => [
                    'en',
                    'de',
                ],
            ],
        ]);
    }
*/

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = function ($action) {
            return new ActiveDataProvider([
                'query' => $this->modelClass::find()->with('authors'),
                //'query' => $this->modelClass::find(),
            ]);
        };

        return $actions;
    }

}