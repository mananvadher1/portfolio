<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property string $name
 * @property string $path_url
 * @property string $base_url
 * @property string $mine_type
 *
 * @property ProjectImage[] $projectImages
 * @property Testimonial[] $testimonials
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'path_url', 'base_url', 'mine_type'], 'required'],
            [['name', 'path_url', 'base_url', 'mine_type'], 'string', 'max' => 255],
            // ['base_url', 'url']
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
            'path_url' => Yii::t('app', 'Path Url'),
            'base_url' => Yii::t('app', 'Base Url'),
            'mine_type' => Yii::t('app', 'Mine Type'),
        ];
    }

    /**
     * Gets query for [[ProjectImages]].
     *
    //  * @return \yii\db\ActiveQuery|ProjectImageQuery
     */
    public function getProjectImages()
    {
        return $this->hasMany(ProjectImage::class, ['file_id' => 'id']);
    }

    /**
     * Gets query for [[Testimonials]].
     *
    //  * @return \yii\db\ActiveQuery|TestimonialQuery
     */
    public function getTestimonials()
    {
        return $this->hasMany(Testimonial::class, ['customer_image_id' => 'id']);
    }

    /**
    //  * {@inheritdoc}
    //  * @return FileQuery the active query used by this AR class.
     */
    // public static function find()
    // {
    //     return new FileQuery(get_called_class());
    // }

    public function absoluteUrl()
    {
        return $this->base_url . '/' . $this->name;
    }

    public function afterDelete()
    {
        parent::afterDelete();
        unlink($this->path_url . '/' . $this->name);
    }
}
