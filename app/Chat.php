<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_cliente_shipping
 * @property int $id_cliente_transport
 * @property string $message
 * @property string $created_at
 * @property string $updated_at
 */
class Chat extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'chat';

    /**
     * @var array
     */
    protected $fillable = ['id_cliente_shipping', 'id_cliente_transport', 'message', 'created_at', 'updated_at'];
}
