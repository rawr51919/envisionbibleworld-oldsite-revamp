<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SourceQuoted extends Model {

    protected $table = 'tblSource_Quoted';

    protected $primaryKey = 'Source_QuotedId';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['SourceId', 'BeginChptrSectionMinute','BeginVersePageSecond',
                            'EndChptrSectionMinute', 'EndVersePageSecond',
                            'Source_Explanation', 'StatusTypeId', 'EntryDate'];


    public function source()
    {
        return $this->belongsTo('App\Source', 'SourceId');
    }

}
