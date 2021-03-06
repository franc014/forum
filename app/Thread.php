<?php

namespace App;

use App\Filters\ThreadFilters;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    protected $guarded = [];
    public function path(){
        return "/threads/{$this->channel->name}/{$this->id}";
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function creator(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function addReply($reply){
        $this->replies()->create($reply);
    }

    public function channel(){
        return $this->belongsTo(Channel::class);
    }

    /**
     * Apply all relevant thread filters.
     *
     * @param  Builder       $query
     * @param  ThreadFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, ThreadFilters $filters)
    {
        return $filters->apply($query);
    }


}
