<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class SummaryDetails extends Model {

    protected $table = 'tblSummary_Details';

    protected $primaryKey = 'Summary_DetailsId';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'StatusTypeId', 'SacrificeId', 'SummaryId',
        'Source_QuotedId', 'QuotationId', 'LocationId',
        'EraId', 'SubcategoryId', 'EntryDate'
    ];


}
