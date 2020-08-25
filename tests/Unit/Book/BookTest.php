<?php

namespace Tests\Unit\Book;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class BookTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->book = factory(Book::class)->create();
        $this->user = factory(User::class)->create();
    }

    public function test_it_belongs_to_many_authors()
    {
        $book = factory(Book::class)->create();

        $book->authors()->attach(
            factory(Author::class)->create()
        );

        $this->assertInstanceOf(Author::class, $book->authors->first());
    }

    public function test_it_belongs_to_many_categories()
    {
        $book = factory(Book::class)->create();

        $book->categories()->attach(
            factory(Category::class)->create()
        );

        $this->assertInstanceOf(Category::class, $book->categories->first());
    }

    public function test_it_has_many_to_a_book()
    {
        $book = factory(Book::class)->create();

        $book->comments()->save(
            factory(Comment::class)->make()
        );


        $this->assertInstanceOf(Comment::class, $book->comments->first());
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_can_be_rated()
    {
        Sanctum::actingAs(
            $this->user,
            ['*']
        );

        $this->book->rate(5, $this->user);

        $this->assertCount(1, $this->book->ratings);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_can_get_average_rating()
    {
        Sanctum::actingAs(
            $this->user,
            ['*']
        );

        $this->book->rate(5, $this->user);
        $this->book->rate(3, factory(User::class)->create());

        $this->assertEquals(4, $this->book->rating());
    }

    public function test_it_cannot_be_more_than_five()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->book->rate(6);
    }

    public function test_it_cannot_be_less_than_one()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->book->rate(0);
    }

    public function test_can_only_be_rated_one_per_user()
    {
        Sanctum::actingAs(
            $this->user,
            ['*']
        );

        $this->book->rate(5, $this->user);
        $this->book->rate(2, $this->user);

        $this->assertCount(1, $this->book->ratings);
    }
}
