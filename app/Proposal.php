<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_shipping
 * @property int $id_cliente
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 */
class Proposal extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'proposal';

    /**
     * @var array
     */
    protected $fillable = ['id_shipping', 'id_cliente', 'note', 'created_at', 'updated_at'];
}
