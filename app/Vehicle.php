<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_carrier
 * @property boolean $type_vehicle
 * @property string $mark
 * @property string $modelo
 * @property string $type_load
 * @property string $tuition
 * @property string $year
 * @property int $number_axes
 * @property string $observations
 * @property string $ubication
 * @property string $created_at
 * @property string $updated_at
 */
class Vehicle extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'vehicle';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['id_carrier', 'type_vehicle', 'mark', 'modelo', 'type_load', 'tuition', 'year', 'number_axes', 'observations', 'ubication', 'created_at', 'updated_at'];
}
