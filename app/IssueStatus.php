<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueStatus extends Model
{
    protected $table ='issuestatus';
	protected $guarded =[];

	public static function getFirstStatusByProjectID($projectId = 0)
	{
		$result = self::select("id")
			->where("proj_id", (int)$projectId)
			->orderBy("sequence", "ASC")
			->first();
		return $result->id;
	}

	public static function getStatusByProjectID($projectId = 0)
	{
		$result = self::select()
			->where("proj_id", (int)$projectId)
			->orderBy("sequence", "ASC")
			->get();
		return $result;
	}

	public static function getStatusName($issueStatusId = 0)
	{
    	$result = self::select("name")
			->where("id", (int)$issueStatusId)
			->first();
		return $result->name;
	}
}
