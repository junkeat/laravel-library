<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pending extends Model
{
    //Table Name
    protected $table = 'pending';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

}
