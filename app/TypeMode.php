<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 */
class TypeMode extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'type_mode';

    /**
     * @var array
     */
    protected $fillable = ['name'];
}
