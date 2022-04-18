<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ChatGroup extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
        'last_chat'
    ];
    protected $fillable = [
        'u_id',
        'user_one',
        'user_two',
        'last_chat',
    ];
    protected $table = 'chat_group';
    protected $appends = ['user', 'last_msg','see_msg'];
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('latest', function (Builder $builder) {
            $builder->orderby('last_chat', 'desc');
        });
    }
    public function getUserAttribute()
    {
        if (Auth::guard('customer')->check()) {
            return  Instructor::find($this->attributes['user_one']);
        } else {
            return  Student::find($this->attributes['user_two']);
        }
    }
    public function getSeeMsgAttribute()
	{
		 $msg = ChatMsg::where('group_id', $this->attributes['id'])->latest()->first();
        if ($msg) {
            return $msg->seen;
        }
        return 2;
	}
    public function getLastMsgAttribute()
    {

        $msg = ChatMsg::where('group_id', $this->attributes['id'])->latest()->first();
        if ($msg) {
            return $msg->msg;
        }
        return null;
    }

   
    public function Messages()
    {
        return $this->hasMany('App\Models\ChatMsg', 'group_id', 'id');
    }
}
