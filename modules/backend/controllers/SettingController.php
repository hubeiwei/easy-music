<?php

namespace app\modules\backend\controllers;

use app\models\search\SettingSearch;
use app\models\Setting;
use app\modules\backend\controllers\base\ModuleController;
use hubeiwei\yii2tools\helpers\Message;
use Yii;
use yii\base\ErrorException;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * SettingController implements the CRUD actions for Setting model.
 */
class SettingController extends ModuleController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Setting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SettingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Setting model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Setting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Setting();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Message::setSuccessMsg('添加成功');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Setting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Message::setSuccessMsg('修改成功');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * 为了适应grid是否开启pjax而这样写的，
     * 有个坑，要用ajax来判断，
     * 代码写两遍算是方便以后分别调整吧
     *
     * @param $id
     * @return \yii\web\Response
     * @throws ErrorException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (!Yii::$app->request->isAjax) {
            if ($model->delete()) {
                Message::setSuccessMsg('删除成功');
            } else {
                Message::setErrorMsg('删除失败');
            }
            return $this->redirect(['index']);
        } else {
            if (!$model->delete()) {
                throw new ErrorException('删除失败');
            }
        }
    }

    /**
     * Finds the Setting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Setting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Setting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
