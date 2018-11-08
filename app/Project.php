<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table ='project';
	protected $guarded =[];

	public static function getAllProject($getColumns = [])
	{
		$result = self::select($getColumns)->get();
		return $result;
	}
}
