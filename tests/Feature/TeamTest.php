<?php

namespace Tests\Feature;
use App\Team;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeamTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * @test
     */
    public function a_team_has_a_name()
    {
        $team = new Team(['name' => 'Acme']);

        $this->assertEquals('Acme' , $team->name );

    }


    /**
     * @test
     */
    public function a_team_can_add_members()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $team->add($user);
        $team->add($user2);

        $this->assertEquals(2 , $team->count() );
    }
    /**
     * @test
     */
    public function a_team_has_a_maximum_members()
    {
        $team = factory(Team::class)->create([ 'size' => 2 ]);
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $team->add($user1);
        $team->add($user2);

        $this->assertEquals(2 , $team->count() );

//        $this->setExpectedException('Exception');

//        $user3 = factory(User::class)->create();
//        $team->add($user3);


    }


    /**
     * @test
     */
    public function a_team_can_add_multiple_members_at_once()
    {
        $team = factory(Team::class)->create([ 'size' => 2 ]);
        $users = factory(User::class , 2 )->create();

        $team->add($users);

        $this->assertEquals(2 , $team->count());

    }

    /**
     * @test
     */
    public function a_team_can_remove_member()
    {
        $team = factory(Team::class)->create();
        $user1 = factory(User::class )->create();
        $user2 = factory(User::class )->create();
        $user3 = factory(User::class )->create();

        $team->add($user1);
        $team->add($user2);
        $team->add($user3);

        $team->remove($user1);

        $this->assertEquals(2 , $team->count() );
    }

    /**
     * @test
     */
    public function a_team_can_remove_more_then_one_at_once()
    {
        $team = factory(Team::class)->create(['size' => 3 ]);
        $users = factory(User::class , 3)->create();
        $team->add($users);

        $team->remove($users->slice(0,2));

        $this->assertEquals(1 , $team->count() );
    }

    /**
     * @test
     */
    public function a_team_can_remove_all_members()
    {
        $team = factory(Team::class)->create();
        $users = factory(User::class , 2)->create();
        $team->add($users);

        $team->restart($users);

        $this->assertEquals(0 , $team->count() );
    }


    /**
     * @test
     */
    public function when_adding_many_members_at_once_you_still_may_not_exceed_max()
    {
        $team = factory(Team::class)->create(['size' => 2 ]);
        $users = factory(User::class , 3)->create();

        $this->setExpectedException('Exception');

        $team->add($users);

    }

}
