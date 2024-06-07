<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class SourceDetail extends Model {

    protected $table = 'tblSource_Detail';

    protected $primaryKey = 'Source_DetailId';

    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'SourceId',
        'ChptrOfLastVrs',
        'LastVerseOrPage',
        'ScreenShotName',
        'PublisherId',
        'StatusTypeId',
        'EntryDate'
    ];


    public function sourceType()
    {
        return $this->belongsTo('App\SourceType', 'SourceTypeId');
    }

   public function publisher()
   {
       return $this->belongsTo('App\Publisher', 'PublisherId');
   }

   public function statusType()
   {
       return $this->belongsTo('App\StatusType', 'StatusTypeId');
   }
}
