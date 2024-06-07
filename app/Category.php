<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    //
    protected $table = 'tblCategory';

    protected $primaryKey = 'CategoryId';

    public $timestamps = false;

    protected $fillable = [
        'Category',
        'Explanation'
    ];

    public function subcategories() {
        return $this->hasMany(SubCategory::class);
    }
}
