<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Issue extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'proj_id', 'reporter', 'assignee', 'summary', 'issue_status', 'issue_type', 'issue_link', 'attachment', 'due_date', 'description', 'priority_id', 'label', 'original_estimate', 'remaining_estimate', 'resolution_id', 'country_id','created_at', 'updated_at'
    ];
}
