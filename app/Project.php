<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Utils;
use App\Invite;

class Project extends Model
{
    protected $table ='project';
	protected $guarded =[];

	public function user()
    {
        return $this->belongsTo('App\Models\User', 'lead_id', 'id');
    }

	public static function getAllProjectOfUser($getColumns = [])
	{
		$builder = self::select($getColumns)
			->leftJoin('invite', 'invite.proj_id', '=', 'project.id')
			->where('lead_id', Auth::user()->id)
			->orWhere(function ($builder) {
                $builder->where('user_receive_id', '=', Auth::user()->id);
                $builder->where('type', '=', 2);
            })
            ->distinct('project.id')
			->get();
		return $builder;
	}

	public static function getFirstLetterName($projectId = 0)
	{
		$result = self::select("name")
			->where("id", (int)$projectId)
			->first();

		if (empty($result)) {
			return "";
		}
		$arrString = explode(" ", Utils::stripVN(html_entity_decode($result->name)));
		return count($arrString) > 1 ? $arrString[0][0] . $arrString[1][0] : $arrString[0][0];
	}
}
