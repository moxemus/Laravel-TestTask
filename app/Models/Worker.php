<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $perPage = 10;

	protected $table = 'worker';
	public $timestamps = false;

    protected $primaryKey = 'id';
    protected $hidden = array('pivot');

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

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'worker_department');
    }
}
