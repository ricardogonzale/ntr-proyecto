<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_carrier
 * @property string $title
 * @property string $file_path
 * @property string $date_certification
 * @property boolean $active
 * @property string $created_at
 * @property string $updated_at
 */
class Certification extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'certification';

    /**
     * @var array
     */
    protected $fillable = ['id_carrier', 'title', 'file_path', 'date_certification', 'active', 'created_at', 'updated_at'];
}
