<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookV2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createDataBooks();
    }

    public function createDataBooks()
    {
        $book_summary = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

        $books = array(
            [
                'category_id'      => 2,
                'author_id'        => 2,
                'book_title'       => 'Lift-The-Flap Book: No Biting! (Hardcover)',
                'slug'             => 'lift-the-flap-book',
                'book_summary'     => $book_summary,
                'book_price'       => '4',
                'book_cover_photo' => 'lift.jpeg',
            ],
            [
                'category_id'      => 2,
                'author_id'        => 2,
                'book_title'       => 'Steam Train Dream Train (Board Book)',
                'slug'             => 'steam-train-dream-train',
                'book_summary'     => $book_summary,
                'book_price'       => '5',
                'book_cover_photo' => 'steam.jpeg',
            ],
            [
                'category_id'      => 2,
                'author_id'        => 2,
                'book_title'       => 'All Souls Trilogy: The Book of Life (Series #03) (Hardcover)',
                'slug'             => 'souls-trilogy',
                'book_summary'     => $book_summary,
                'book_price'       => '4',
                'book_cover_photo' => 'trilogy.jpg',
            ],
            [
                'category_id'      => 2,
                'author_id'        => 2,
                'book_title'       => 'Little Golden Book: DreamWorks How to Train Your Dragon (Hardcover)',
                'slug'             => 'little-golden-book-dragon',
                'book_summary'     => $book_summary,
                'book_price'       => '5',
                'book_cover_photo' => 'dragon.jpeg',
            ],
            [
                'category_id'      => 2,
                'author_id'        => 2,
                'book_title'       => 'The Incal by Alejandro Jodorowsky (English) Paperback Book !',
                'slug'             => 'the-incal-by-alejandro',
                'book_summary'     => $book_summary,
                'book_price'       => '4',
                'book_cover_photo' => 'the-incal.jpeg',
            ],
            [
                'category_id'      => 2,
                'author_id'        => 2,
                'book_title'       => "Rosemary Gladstar's Medicinal Herbs Brand New Paperback Edition Book WT67229",
                'slug'             => 'rosemary-gladstars-medicinal',
                'book_summary'     => $book_summary,
                'book_price'       => '4',
                'book_cover_photo' => 'rosemary.jpg',
            ],
            [
                'category_id'      => 2,
                'author_id'        => 3,
                'book_title'       => 'The Books of Enoch: Complete edition',
                'slug'             => 'the-books-of-enoch',
                'book_summary'     => $book_summary,
                'book_price'       => '4',
                'book_cover_photo' => 'books-enoch.jpg',
            ],
            [
                'category_id'      => 2,
                'author_id'        => 3,
                'book_title'       => 'The Cat in The Hat by Seuss Dr',
                'slug'             => 'the-cat-in-the-hat',
                'book_summary'     => $book_summary,
                'book_price'       => '3',
                'book_cover_photo' => 'cat-hat.webp',
            ],
            [
                'category_id'      => 3,
                'author_id'        => 3,
                'book_title'       => 'Michael Jordan: The Life [Book]',
                'slug'             => 'micheal-jordan',
                'book_summary'     => $book_summary,
                'book_price'       => '3',
                'book_cover_photo' => 'micheal.webp',
            ],
            [
                'category_id'      => 3,
                'author_id'        => 3,
                'book_title'       => "I've Loved You Since Forever - by Hoda Kotb",
                'slug'             => 'ive-love-you-since-forever',
                'book_summary'     => $book_summary,
                'book_price'       => '3',
                'book_cover_photo' => 'love-you.jpeg',
            ],
            [
                'category_id'      => 3,
                'author_id'        => 3,
                'book_title'       => 'Corduroy (Board Book) by Don Freeman',
                'slug'             => 'corduroy-by-don-freman',
                'book_summary'     => $book_summary,
                'book_price'       => '5',
                'book_cover_photo' => 'corduroy.jpeg',
            ],
        );

        foreach ($books as $book) {
            $book = Book::firstOrCreate($book);
        }
    }
}
