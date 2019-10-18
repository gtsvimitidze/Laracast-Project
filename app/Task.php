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

    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
