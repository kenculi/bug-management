<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table ='project';
	protected $guarded =[];

	public function user()
    {
        return $this->belongsTo('App\Models\User', 'lead_id', 'id');
    }

	public static function getAllProject($getColumns = [])
	{
		$result = self::select($getColumns)->get();
		return $result;
	}

	public static function getFirstLetterName($projectId = 0)
	{
		$result = self::select("name")
			->where("id", (int)$projectId)
			->first();

		if (empty($result)) {
			return "";
		}
		$arrString = explode(" ", $result->name);
		return count($arrString) > 1 ? $arrString[0][0] . $arrString[0][1] : $arrString[0][0];
	}
}
