    <!-- <?php foreach ($model->projectImages as $image) : ?>
        <div id="project-form__img-container-<?= $image->id ?>" class="project-form__image-container">
        <?= Html::img($image->file->absoluteUrl(), [
                    'alt' => 'Demonstration of the user interface',
                    'height' => 200,
                    'width' => 300,
                    'class' => 'project-form_img',

                ]); ?>
            <?= Html::button(Yii::t('app', 'Delete'), [
                    'class' => 'btn btn-danger btn-dlt-project-img',
                    'data-project-img-id' => $image->id,

                ]) ?>
            <div id="project-form__img-error-msg-<?= $image->id ?>" class="text-danger"></div>
        </div>
    <?php endforeach; ?>

    <?= $form->field($model, 'imageFile')->fileInput(['multiple' => true]) ?> -->


    //////////////////////////////////

        <!-- <?= $form->field($model, 'end_date')->textInput() ?> -->
    <!-- <pre>
    <?= print_r(Yii::$app->formatter) ?>
    </pre> -->


    ///////////////////////////////////

    <!-- <?= $form->field($model, 'tech_stack')->textarea(['rows' => 5]) ?> -->
    <!-- <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?> -->
    <!-- <?= $form->field($model, 'start_date')->textInput() ?> -->
