<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class SourceType extends Model {

    protected $table = 'tblSource_Type';

    protected $primaryKey = 'Source_TypeId';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['Source_Type', 'Source_Type_Abbreviation'];

}
