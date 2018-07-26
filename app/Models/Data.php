<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'data';

    protected $fillable = ['title', 'description'];

}
