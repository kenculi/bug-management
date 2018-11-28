<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Project;
use App\Label;
use Carbon\Carbon;

class Issue extends Model
{
	protected $table ='issue';
	protected $guarded =[];

	public function assigneeinfo()
    {
        return $this->belongsTo('App\Models\User', 'assignee', 'id');
    }

    public function project()
    {
        return $this->belongsTo('App\Project', 'proj_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\IssueStatus', 'issue_status', 'id');
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

    public static function getIssueBuilder($options)
    {
        $builder = self::selectRaw('*, issue.created_at as issue_created_at, issue.id as id')
            ->leftJoin('project', 'project.id', '=', 'proj_id')
            ->leftJoin('users', 'users.id', '=', 'assignee');
        if ($options['data']) {
            parse_str($options['data'], $data);
            if (!empty($data['summary'])) {
                $builder->where('summary', 'like', '%'.$data['summary'].'%');
            }

            if (!empty($data['createdFrom']) && !empty($data['createdTo'])) {
                $from = Carbon::createFromFormat('d/m/Y', $data['createdFrom'])->format('Y-m-d 00:00:00');
                $to = Carbon::createFromFormat('d/m/Y', $data['createdTo'])->format('Y-m-d 23:59:59');
                $builder->whereBetween('issue.created_at', [$from, $to]);
            }

            if (!empty($data['projectId'])) {
                $builder->where('proj_id', (int)$data['projectId']);
            }

            if (!empty($data['assignee'])) {
                $builder->where('assignee', (int)$data['assignee']);
            }

            if (!empty($data['status'])) {
                $builder->where('issue_status', (int)$data['status']);
            }
        }
        return $builder;
    }

    public static function getIssueList($builder, $options)
    {
        $builder->orderBy($options['order'], $options['dir'])
            ->offset($options['offset'])
            ->limit($options['limit']);

        return $builder->get();
    }

    public function getIssueCode()
    {
        $firstLetter = Project::getFirstLetterName($this->proj_id);
        return $firstLetter.$this->id;
    }
}
