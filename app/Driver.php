<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_carrier
 * @property int $id_user
 * @property string $name
 * @property string $lastaname
 * @property string $date_birth
 * @property string $dni
 * @property int $type_card
 * @property string $email
 * @property string $telephone
 * @property string $observations
 * @property boolean $active
 * @property string $created_at
 * @property string $updated_at
 */
class Driver extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'driver';

    /**
     * @var array
     */
    protected $fillable = ['id_carrier', 'id_user', 'name', 'lastaname', 'date_birth', 'dni', 'type_card', 'email', 'telephone', 'observations', 'active', 'created_at', 'updated_at'];
}
