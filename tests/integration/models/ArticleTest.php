<?php

namespace tests\integration\models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Article;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use  DatabaseTransactions;

    /**
     * @test
     */
    public function it_fetches_trending_articles()
    {
        //Givin
        factory(Article::class , 3)->create();
        factory(Article::class)->create(['reads' => 10 ]);
        $mostPopular =factory(Article::class)->create(['reads' => 20 ]);
        // when
        $articles = Article::trending();

        //Then
        $this->assertEquals($mostPopular->id , $articles->first()->id);
        $this->assertCount(4 , $articles );
    }

}