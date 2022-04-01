<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_shipping_detail
 * @property int $id_shipping
 * @property string $pick_up_place
 * @property string $pick_up_date
 * @property string $pick_up_hour
 * @property string $delivery_place
 * @property string $delivery_date
 * @property string $delivery_hour
 * @property string $created_at
 * @property string $updated_at
 */
class ShippingDetail extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'shipping_detail';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_shipping_detail';

    /**
     * @var array
     */
    protected $fillable = ['id_shipping', 'pick_up_place', 'pick_up_date', 'pick_up_hour', 'delivery_place', 'delivery_date', 'delivery_hour', 'created_at', 'updated_at'];
}
