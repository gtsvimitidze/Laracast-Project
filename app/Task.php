<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $guarded = [];
    // protected $fillable = [ 'title' , 'description' ];

    protected $table = 'tasks';

    public function complete($completed = true) {
        $this->update(compact('completed'));
    } 

    public function incomplete() {
        $this->complete(false);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

}
