<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Department
 *
 * @property int $id
 * @property string $name
 * @property mixed $workers_count
 * @property mixed $max_salary
 *
 * @package App\Models
 */
class Department extends Model
{
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
