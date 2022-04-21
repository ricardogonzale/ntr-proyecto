<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_user
 * @property string $name
 * @property string $lastaname
 * @property string $email
 * @property string $telephone
 * @property int $country
 * @property string $tradename
 * @property string $logo
 * @property string $logistic_address
 * @property string $agency_description
 * @property string $web_site
 * @property string $cif
 * @property int $province
 * @property string $documentation
 * @property string $documents_support
 * @property boolean $
availability
 * @property string $product_type
 * @property boolean $complete_profile
 * @property boolean $approve_profile
 * @property string $created_at
 * @property string $updated_at
 */
class Carrier extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'carrier';

    /**
     * @var array
     */
    protected $fillable = ['id_user', 'name', 'lastaname', 'email', 'telephone', 'country', 'tradename', 'logo', 'logistic_address', 'agency_description', 'web_site', 'cif', 'province', 'documentation', 'documents_support', '
availability', 'product_type', 'complete_profile', 'approve_profile', 'created_at', 'updated_at'];
}
