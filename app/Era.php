<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Era extends Model {

/**
* The database table used by the model.
*
* @var string
*/
    protected $table = 'tblEra';

    protected $primaryKey = 'EraId';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Era', 
        'Era_Explanation'
    ];


    public function years()
    {
        return $this->belongsToMany('App\EraYear', 'tblEra_BeginEnd', 'EraId');
    }

    public function beginYears()
    {
        return $this->belongsToMany('App\EraYear', 'tblEra_BeginEnd', 'EraId', 'BeginYearId');
    }

    public function endYears()
    {
        return $this->belongsToMany('App\EraYear', 'tblEra_BeginEnd', 'EraId', 'EndYearId');
    }

}
