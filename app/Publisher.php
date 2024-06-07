<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model {

    protected $table = 'tblPublisher';

    protected $primaryKey = 'PublisherId';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['PublisherName', 'Address'];

}
