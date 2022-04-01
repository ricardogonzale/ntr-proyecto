<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_shipping
 * @property string $ubication
 * @property string $created_at
 * @property string $updated_at
 */
class InfoRute extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'info_rute';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['id_shipping', 'ubication', 'created_at', 'updated_at'];
}
