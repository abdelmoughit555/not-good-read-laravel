<?php

namespace Tests\Unit\Category;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Category;

class CategorTest extends TestCase
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_it_belongs_to_many_books()
    {
        $category = factory(Category::class)->create();

        $category->books()->attach(
            factory(Book::class)->create()
        );

        $this->assertInstanceOf(Book::class, $category->books->first());
    }
}
