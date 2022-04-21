<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $date_certification
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
    protected $fillable = ['title', 'date_certification', 'created_at', 'updated_at'];
}
