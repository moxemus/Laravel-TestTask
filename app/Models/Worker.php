<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Worker
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property int $gender
 * @property float $salary
 *
 * @package App\Models
 */
class Worker extends Model
{
	protected $table = 'worker';
	public $timestamps = false;

    protected $primaryKey = 'id';

	protected $casts = [
		'gender' => 'int',
		'salary' => 'float'
	];

	protected $fillable = [
		'name',
		'surname',
		'patronymic',
		'gender',
		'salary'
	];

    public function departments(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
//        return $this->belongsToMany(Department::class);
        return $this->belongsToMany(Department::class, 'worker_department');
    }
}
