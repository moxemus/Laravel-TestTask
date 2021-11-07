<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $perPage = 10;

	protected $table = 'department';
	public $timestamps = false;

    protected $primaryKey = 'id';
    protected $hidden = array('pivot');

    protected $appends = ['workers_count', 'max_salary'];

	protected $fillable = [
		'name'
	];

    public function workers()
    {
        return $this->belongsToMany(Worker::class, 'worker_department');
    }

    public function getWorkersCountAttribute()
    {
        return self::workers()->get()->count();
    }

    public function getMaxSalaryAttribute()
    {
        $max = self::workers()->get()->max('salary');

        return (is_null($max) ? 0 : $max);
    }
}
