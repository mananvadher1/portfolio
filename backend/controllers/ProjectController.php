<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use common\models\Project;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use common\models\ProjectImage;
use backend\models\ProjectSearch;
use yii\web\NotFoundHttpException;
use backend\models\TestimonialSearch;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['view'],
                            'allow' => true,
                            'roles' => ['viewProject'],
                        ],
                        [
                            'allow' => true,
                            'roles' => ['manageProjects'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                        'dlt-project-img' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Project models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new TestimonialSearch();
        $searchModel->project_id = $id;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'projects' => ArrayHelper::map(Project::find()->all(), 'id', 'name'),
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Project();
        if ($this->request->isPost) {

            echo '<pre>';
            print_r($this->request->post());

            // echo '<pre>';
            // print_r($model);
            var_dump($_POST);
            var_dump($_FILES);


            if ($model->load($this->request->post())) {

                // echo '<pre>';
                // print_r($model);
                // exit;
                $model->loadUploadedImageFile();
                // echo $model->imageFile;
                if ($model->save()) {
                    $model->saveImages();
                    Yii::$app->session->setFlash('success', 'Successfully saved');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->loadUploadedImageFile();
            if ($model->save()) {
                $model->saveImages();
                Yii::$app->session->setFlash('success', 'Successfully updated');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteProjectImage()
    {
        $image = ProjectImage::findOne($this->request->post('key'));
        if (!$image) {
            throw new NotFoundHttpException();
        }
        if ($image->file->delete()) {
            return json_encode(null);
        }
        return json_encode(['error' => true]);

        // this is commented because we added a afterDelete method into a file model

        // if($image->file->delete()){
        //     $path = Yii::$app->params['uploads']['projects'].'/'.$image->file->name;
        //     unlink($path);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
