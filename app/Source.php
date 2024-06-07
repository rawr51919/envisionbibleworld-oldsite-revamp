<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{

    protected $table = 'tblSource';

    protected $primaryKey = 'SourceId';

    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Source_TypeId',
        'SourceName',
        'LastChptrOrSection',
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
