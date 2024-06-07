<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFeedback extends Model {

    protected $table = 'tblUserFeedback';

    protected $primaryKey = 'UserFeedbackId';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['Username', 'UserEmail', 'UserFeedbackCategory', 'UserFeedback'];


}
