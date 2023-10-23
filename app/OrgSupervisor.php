<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrgSupervisor extends Model
{
    protected $guarded = ['id'];
    protected $timestamp = true;
    protected $with = ['user', 'org'];

    public function org()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
