<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model {

    protected $table = 'tblQuotation';

    protected $primaryKey = 'QuotationId';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['Quotation', 'StatusTypeId', 'EntryDate'];


}
