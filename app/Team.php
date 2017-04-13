<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Monolog\Handler\UdpSocketTest;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add($users)
    {
        $this->guardAgainstTooManyMembers($users);

//        if ($user instanceof  User ){
//           return $this->members()->save($user);
//        }
//
//        return $this->members()->saveMany($user);

        /**
         * or $methode
         */
        $method = $users instanceof User ? 'save' : 'saveMany';

        return $this->members()->$method($users);

    }

    public function remove($users = null)
    {
        if ($users instanceof User) {

            $users->leaveTeam();

        } else {

            $this->removeMany($users);
        }

    }

    public function removeMany($users)
    {
        return $this->members()
            ->whereIn('id', $users->pluck('id'))
            ->update(['team_id' => null]);
    }

    public function restart()
    {
        return $this->members()->update(['team_id' => null]);
    }


    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function count()
    {
        return $this->members()->count();
    }

    public function guardAgainstTooManyMembers($users)
    {
        $numUserToAdd = ( $users instanceof  User ) ? 1 : count($users);
        $newTeamCount= $this->count() + $numUserToAdd ;

        if ( $newTeamCount > $this->size ) {
            throw new \Exception;
        }
    }
}
