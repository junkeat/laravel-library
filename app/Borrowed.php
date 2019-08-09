<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrowed extends Model
{
    //Table Name
    protected $table = 'borrowed';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
}
