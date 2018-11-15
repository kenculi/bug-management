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

	public static function addFourFirstStatus($projectId = 0)
	{
		if ($projectId) {
			$insertData = [
				['sequence' => 1, 'name' => 'Khởi tạo', 'proj_id' => (int)$projectId],
				['sequence' => 2, 'name' => 'Thực thi', 'proj_id' => (int)$projectId],
				['sequence' => 3, 'name' => 'Kiểm tra', 'proj_id' => (int)$projectId],
				['sequence' => 4, 'name' => 'Hoàn thành', 'proj_id' => (int)$projectId],
			];
			
			self::insert($insertData);
		}
	}
}
