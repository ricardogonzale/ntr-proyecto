<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_shipping
 * @property int $id_client
 * @property int $type_mode
 * @property int $type_merchandise
 * @property int $type_expose
 * @property string $description
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class Shipping extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'shipping';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_shipping';

    /**
     * @var array
     */
    protected $fillable = ['id_client', 'type_mode', 'type_merchandise', 'type_expose', 'description', 'status', 'created_at', 'updated_at'];
}
