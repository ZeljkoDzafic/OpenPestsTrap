<?php

namespace app\controllers;

use Yii;
use app\models\PestReports;
use app\models\PestReportsSearch;
use app\models\Traps;
use app\models\PestFamilies;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * PestReportsController implements the CRUD actions for PestReports model.
 */
class PestReportsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all PestReports models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PestReportsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PestReports model.
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
     * Creates a new PestReports model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PestReports();
        $traps = ArrayHelper::map(Traps::find()->asArray()->all(), 'id', 'name');
        $pestFamilies = ArrayHelper::map(PestFamilies::find()->asArray()->all(), 'id', 'name');

        $model->created_at = date('Y-m-d H:i:s');
        $model->updated_at = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/pest-reports']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'traps' => $traps,
                'pestFamilies' => $pestFamilies
            ]);
        }
    }

    /**
     * Updates an existing PestReports model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $traps = ArrayHelper::map(Traps::find()->asArray()->all(), 'id', 'name');
        $pestFamilies = ArrayHelper::map(PestFamilies::find()->asArray()->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'traps' => $traps,
                'pestFamilies' => $pestFamilies
            ]);
        }
    }

    /**
     * Deletes an existing PestReports model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PestReports model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PestReports the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PestReports::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
