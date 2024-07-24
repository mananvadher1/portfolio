<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_image".
 *
 * @property int $id
 * @property int $project_id
 * @property int $file_id
 *
 * @property File $file
 * @property Project $project
 */
class ProjectImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'file_id'], 'required'],
            [['project_id', 'file_id'], 'integer'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::class, 'targetAttribute' => ['file_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_id' => Yii::t('app', 'Project ID'),
            'file_id' => Yii::t('app', 'File ID'),
        ];
    }

    /**
     * Gets query for [[File]].
     *
    //  * @return \yii\db\ActiveQuery|FileQuery
     */
    public function getFile()
    {
        return $this->hasOne(File::class, ['id' => 'file_id']);
    }

    /**
     * Gets query for [[Project]].
     *
    //  * @return \yii\db\ActiveQuery|ProjectQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    // /**
    //  * {@inheritdoc}
    //  * @return ProjectImageQuery the active query used by this AR class.
    //  */
    // public static function find()
    // {
    //     return new ProjectImageQuery(get_called_class());
    // }
}
