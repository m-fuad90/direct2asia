<?php 

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */

    public function rules()
    {

        return [
            [['file'], 'file', 'extensions' => 'jpg, jpeg, png', 'mimeTypes' => 'image/jpeg, image/jpg, image/png','maxSize' => 1572864, 'tooBig' => 'Limit is 1.5MB'],
        ];


    }


}
