<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Label;

class Issue extends Model
{
	protected $table ='issue';
	protected $guarded =[];

	public function assigneeinfo()
    {
        return $this->belongsTo('App\Models\User', 'assignee', 'id');
    }

    public function getFullNameById()
    {
    	if ($this->assignee == 0 || $this->assignee == null) {
    		return "Unassign";
    	}
    	$result = User::select("full_name")
			->where("id", (int)$this->assignee)
			->first();
		return $result->full_name;
    }

    public function getOldLabelName()
    {
        $arrLabel = explode(",", $this->label);
        $labelName = [];

        foreach ($arrLabel as $value) {
            $checkLabelExisted = Label::find($value);
            if (!empty($checkLabelExisted)) {
                $labelName[] = $checkLabelExisted->label;
            }
        }

        return implode(",", $labelName);
    }
}
