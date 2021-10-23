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
 *
 * @package App\Models
 */
class Department extends Model
{
	protected $table = 'department';
	public $timestamps = false;

    protected $primaryKey = 'id';

	protected $fillable = [
		'name'
	];
}
