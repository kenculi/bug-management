<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueLink extends Model
{
	const TABLE_NAME  = 'issuelink';
    const PRIMARY_KEY = 'id';

    protected $table      = self::TABLE_NAME;
    protected $primaryKey = self::PRIMARY_KEY;
    protected $fillable = ['link_type_id', 'issue_id'];
    public $timestamps = false;

	public static function getAllIssueLink($getColumns = [])
	{
		$result = self::select($getColumns)->get();
		return $result;
	}
}
