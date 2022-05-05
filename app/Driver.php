<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $type_card
 * @property int $id_carrier
 * @property int $id_user
 * @property string $name
 * @property string $lastaname
 * @property string $date_birth
 * @property string $dni
 * @property string $email
 * @property string $telephone
 * @property string $observations
 * @property boolean $active
 * @property string $created_at
 * @property string $updated_at
 * @property TypeCard $typeCard
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
    protected $fillable = ['type_card', 'id_carrier', 'id_user', 'name', 'lastaname', 'date_birth', 'dni', 'email', 'telephone', 'observations', 'active', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeCard()
    {
        return $this->belongsTo('App\TypeCard', 'type_card');
    }
}
