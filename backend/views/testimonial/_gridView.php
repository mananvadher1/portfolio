<?php

use common\models\Testimonial;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\TestimonialSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var \common\models\Project[] $projects */
/** @var boolean $isProjectColumnVisible */
?>
<?php  // echo $this->render('_search', ['model' => $searchModel]); 
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    // 'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        // 'id',
        [
            'attribute' => 'project_id',
            'format' => 'raw',
            'filter' => $projects,
            'visible' => $isProjectColumnVisible,
            'value' => function ($model) {
                /**
                 * @var $model common\models\testimonial
                 */
                return Html::a($model->project->name, ['project/view', 'id' => $model->project->id]);
            }
        ],
        [
            'attribute' => 'customer_image_id',
            'format' => 'raw',
            'value' => function ($model) {
                /**
                 * @var $model common\models\testimonial
                 */
                if (!$model->customerImage) {
                    return null;
                }
                return Html::img($model->imageAbsolteUrl(), [
                    // 'width' => 200,
                    'height' => 75,
                    'alt' => $model->customer_name,
                ]);
            },
        ],
        'title',
        'customer_name',
        'rating',
        //'review:ntext',
        [
            'class' => ActionColumn::class,
            // 'urlCreator' => function ($action, Testimonial $model, $key, $index, $column) {
            //     return Url::toRoute(['testimonial/'.$action, 'id' => $model->id]);
            // }

            //or we can use this also achieve same functionality
            'controller' => 'testimonial',
        ],
    ],
]); ?>