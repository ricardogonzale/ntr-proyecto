<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $id_user
 * @property int $id_country
 * @property int $id_province
 * @property string $name
 * @property string $lastaname
 * @property string $email
 * @property string $telephone
 * @property string $tradename
 * @property string $logistic_address
 * @property string $cif
 * @property string $activity_memory
 * @property string $activity
 * @property boolean $active
 * @property boolean $accept_term
 * @property boolean $approv_profile
 * @property string $created_at
 * @property string $updated_at
 * @property GeoCountry $geoCountry
 * @property GeoProvince $geoProvince
 * @property User $user
 */
class Client extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'client';

    /**
     * @var array
     */
    protected $fillable = ['id_user', 'id_country', 'id_province', 'name', 'lastaname', 'email', 'telephone', 'tradename', 'logistic_address', 'cif', 'activity_memory', 'activity', 'active', 'accept_term', 'approv_profile', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function geoCountry()
    {
        return $this->belongsTo('App\GeoCountry', 'id_country');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function geoProvince()
    {
        return $this->belongsTo('App\GeoProvince', 'id_province');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
