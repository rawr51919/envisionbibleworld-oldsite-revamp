<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model {

    protected $table = 'tblSubCategory';

    protected $primaryKey = 'SubcategoryId';

    public $timestamps = false;

    protected $fillable = [
        'Subcategory',
        'CategoryId',
        'Subcategory_Explanation',
        'StatusTypeId'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
