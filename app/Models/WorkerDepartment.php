<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WorkerDepartment
 *
 * @property int $id
 * @property int $worker_id
 * @property int $department_id
 *
 * @package App\Models
 */
class WorkerDepartment extends Model
{
	protected $table = 'worker_department';
	public $timestamps = false;

    protected $primaryKey = 'id';

	protected $casts = [
		'worker_id' => 'int',
		'department_id' => 'int'
	];

	protected $fillable = [
		'worker_id',
		'department_id'
	];
}
