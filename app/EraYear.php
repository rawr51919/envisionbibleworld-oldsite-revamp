<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class EraYear extends Model {

    protected $table = 'tblEra_Year';

    protected $primaryKey = 'Era_YearId';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['Year', 'IsBC'];

    public function eras()
    {
        return $this->belongsToMany('App\Era','tblEra_BeginEnd','EraId','EraId','tblEra');
    }

}
