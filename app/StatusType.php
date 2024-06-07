<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusType extends Model {

    protected $table = 'tblStatusType';

    protected $primaryKey = 'StatusTypeId';

    public $timestamps = false;

    protected $fillable = ['StatusType'];

}
