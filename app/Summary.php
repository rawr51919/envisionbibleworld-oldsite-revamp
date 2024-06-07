<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model {

    protected $table = 'tblSummary';

    protected $primaryKey = 'SummaryId';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Summary',
        'StatusTypeId'
    ];


}
