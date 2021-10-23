<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Department
 *
 * @property int $id
 * @property string $name
 *
 * @package App\Models
 */
class Department extends Model
{
	protected $table = 'department';
	public $timestamps = false;

    protected $primaryKey = 'id';
    protected $hidden = array('pivot');

	protected $fillable = [
		'name'
	];

    public function workers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Worker::class, 'worker_department');
    }
}
