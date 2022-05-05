<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $type_vehicle
 * @property int $id_carrier
 * @property string $mark
 * @property string $modelo
 * @property string $type_load
 * @property string $tuition
 * @property string $year
 * @property int $number_axes
 * @property string $observations
 * @property string $ubication
 * @property boolean $active
 * @property string $created_at
 * @property string $updated_at
 * @property TypeVehicle $typeVehicle
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
     * @var array
     */
    protected $fillable = ['type_vehicle', 'id_carrier', 'mark', 'modelo', 'type_load', 'tuition', 'year', 'number_axes', 'observations', 'ubication', 'active', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeVehicle()
    {
        return $this->belongsTo('App\TypeVehicle', 'type_vehicle');
    }
}
