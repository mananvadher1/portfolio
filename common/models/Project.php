<?php

namespace common\models;

use Yii;
use yii\helpers\Url;
use yii\imagine\Image;
use yii\bootstrap5\Html;
use yii\web\UploadedFile;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name
 * @property string $tech_stack
 * @property string $description
 * @property string|null $start_date
 * @property string|null $end_date
 *
 * @property ProjectImage[] $projectImages
 * @property Testimonial[] $testimonials
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFiles;
    // public $base_url;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'tech_stack', 'description'], 'required'],
            [['tech_stack', 'description'], 'string'],
            [['start_date', 'end_date'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'tech_stack' => Yii::t('app', 'Tech Stack'),
            'description' => Yii::t('app', 'Description'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
        ];
    }

    /**
     * Gets query for [[ProjectImages]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getProjectImages()
    {
        return $this->hasMany(ProjectImage::class, ['project_id' => 'id']);
    }

    /**
     * Gets query for [[Testimonials]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getTestimonials()
    {
        return $this->hasMany(Testimonial::class, ['project_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }

    public function saveImages()
    {
        Yii::$app->db->transaction(
            function ($db) {
                /**
                 * @var $db yii\db\connection
                 */
                foreach ($this->imageFiles as $imageFile) {
                    // echo  Yii::$app->urlManager->createAbsoluteUrl(Yii::$app->params['uploads']['projects']);
                    // echo "<br>";
                    // echo mime_content_type($this->imageFile->tempName);
                    // echo "<br>";
                    // echo uniqid(true) . '.' . $this->imageFile->extension;
                    // echo "<br>";
                    // // echo $this->id;
                    // echo "<br>";
                    // echo "<br>";
                    $file = new File();
                    $file->name = uniqid(true) . '.' . $imageFile->extension;
                    $file->path_url = Yii::$app->params['uploads']['projects'];
                    $file->base_url = Yii::$app->urlManager->createAbsoluteUrl($file->path_url);
                    $file->mine_type = mime_content_type($imageFile->tempName);
                    $file->save();
                    // $file->validate();
                    // echo "<pre>";
                    // print_r($file);

                    // exit;
                    // if (!$file->save()) {
                    //     // File save failed, log errors
                    //     Yii::error("File save failed: " . json_encode($file->errors));
                    //     throw new Exception('File save failed');
                    // }

                    // var_dump($file->save());

                    // echo $file->id;
                    // echo $file->name;
                    // echo "<br>";
                    // echo $file->base_url;
                    // echo "<br>";
                    // echo $file->mime_type;
                    $projectImage = new ProjectImage();
                    $projectImage->project_id = $this->id;
                    $projectImage->file_id = $file->id;
                    $projectImage->save();

                    $thumbnail = Image::thumbnail($imageFile->tempName, null, 1080);;
                    // $imageFile->saveAs($file->path_url . '/' . $file->name);
                    if (!$thumbnail->save($file->path_url . '/' . $file->name)) {
                        $db->transaction->rollBack();
                    }
                }
            }
        );
    }
    // public function saveImage()
    // {
    //     $transaction = Yii::$app->db->beginTransaction();
    //     try {
    //         $file = new File();
    //         $file->name = uniqid(true) . '.' . $this->imageFile->extension;
    //         $file->base_url = Yii::$app->urlManager->createAbsoluteUrl(Yii::$app->params['uploads']['projects']);
    //         $file->mime_type = mime_content_type($this->imageFile->tempName);
    //         $file->save();

    //         $projectImage = new ProjectImage();
    //         $projectImage->project_id = $this->id;
    //         $projectImage->file_id = $file->id;
    //         $projectImage->save();

    //         if (!$this->imageFile->saveAs(Yii::$app->params['uploads']['projects'] . $file->name)) {
    //             $transaction->rollBack();
    //             Yii::error('File save failed.');
    //             return false;
    //         }

    //         $transaction->commit();
    //         return true;
    //     } catch (\Exception $e) {
    //         $transaction->rollBack();
    //         Yii::error($e->getMessage());
    //         return false;
    //     }
    // }

    public function hasImages()
    {
        return count($this->projectImages) > 0;
    }

    public function imageAbsoluteUrls()
    {
        $urls = [];
        foreach ($this->projectImages as $image) {
            $urls[] = $image->file->absoluteUrl();
        }
        return $urls;
    }

    public function imageConfigs()
    {
        $configs = [];
        foreach ($this->projectImages as $image) {
            $configs[] = [
                'key' => $image->id,
            ];
        }
        return $configs;
    }

    public function loadUploadedImageFile()
    {
        $this->imageFiles = UploadedFile::getInstances($this, 'imageFiles');
    }
    public function delete()
    {
        /**
         * @var $db yii\db\Connection
         */
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            foreach ($this->projectImages as $image) {
                $image->file->deleteInternal();
            }
            parent::deleteInternal();
            $transaction->commit();
            return true;
        } catch (\Exception $e) { // not mandetory in php8.3> version
            $transaction->rollBack();
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Failed to delete'));
            return false;
        } catch (\Throwable $e) { // not mandetory in php8.3> version
            $transaction->rollBack();
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Failed to delete'));
            return false;
        }
    }

    public function carouselImages()
    {
        return array_map(function ($projectImage) {
            return Html::img($projectImage->file->absoluteUrl(), [
                'alt' => $this->name,
                'class' => 'project-view__carousel-images'
            ]);
        }, $this->projectImages);
    }
}
