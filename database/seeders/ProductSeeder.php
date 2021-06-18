<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createDataProducts();
    }

    public function createDataProducts()
    {
        $products = array(
            [
                'category_id'      => 1,
                'author_id'        => 1,
                'book_title'       => 'MR. MEN: THE GREAT BRITISH TOUR',
                'slug'             => 'great-british-tour',
                'book_summary'     => "Little Miss Sunshine has bought a double decker bus to do her very own tour of Great Britain. Join the Mr Men and Little Miss as they climb aboard and go from John O’Groats to Lands End, taking in all the famous sights like Stonehenge, Caernarfon Castle, the Giant's Causeway and Ben Nevis along the way, not to forget their very special appointment with the Queen! With so many different Mr Men and Little Miss to please, will Little Miss Sunshine's tour be as great as she hopes?!",
                'book_price'       => '3',
                'book_cover_photo' => 'tour.jpg',
            ],
            [
                'category_id'      => 1,
                'author_id'        => 1,
                'book_title'       => 'My Dad, the Hero (Walker Stories)',
                'slug'             => 'my-dad-the-hero',
                'book_summary'     => "A touching yet amusing story about a boy's admiration for his dad. T realizes that being the same as other people is not everything. His dad really is a hero!",
                'book_price'       => '3',
                'book_cover_photo' => 'mydad.jpg',
            ],
            [
                'category_id'      => 1,
                'author_id'        => 1,
                'book_title'       => 'A WHIFF OF MYSTERY (FOX INVESTIGATES)',
                'slug'             => 'whiff-of-mystery',
                'book_summary'     => "Fun and fast-paced detective stories, perfect for fans of Geronimo Stilton and The Dragon Detective Agency.",
                'book_price'       => '4',
                'book_cover_photo' => 'fox.jpg',
            ],
            [
                'category_id'      => 1,
                'author_id'        => 1,
                'book_title'       => 'A WHIFF OF MYSTERY (FOX INVESTIGATES)',
                'slug'             => 'early-maths',
                'book_summary'     => "Packed with fun practice activities and colourful stickers to reward effort and achievement, these books are perfect for holiday work, exam preparation and all kinds of home learning.",
                'book_price'       => '5',
                'book_cover_photo' => 'early-maths.jpg',
            ],
            [
                'category_id'      => 1,
                'author_id'        => 1,
                'book_title'       => '4 IN 1 SPIRALS: ALPHABET (FIRST TIME LEARNING)',
                'slug'             => '4-spials-alphabet',
                'book_summary'     => "Easy to turn pages help children learn the alphabet and first words much easier. With four times the content, there's enough in store for a whole term",
                'book_price'       => '4',
                'book_cover_photo' => '4-alphabet.jpg',
            ],
            [
                'category_id'      => 1,
                'author_id'        => 1,
                'book_title'       => '4 IN 1 SPIRALS: HANDWRITING (FIRST TIME LEARNING)',
                'slug'             => 'handwriting',
                'book_summary'     => "The content of the book has been applauded for its clarity, comprehensiveness, fun learning element, and straightforward approach. All the exercises are practice oriented and give children an easy start into the subject of handwriting",
                'book_price'       => '4',
                'book_cover_photo' => 'handwriting.jpg',
            ],
            [
                'category_id'      => 1,
                'author_id'        => 1,
                'book_title'       => '7+ MATHS - HELP WITH HOMEWORK SPIRAL',
                'slug'             => '7-maths-spiral',
                'book_summary'     => "Refreshed with new content and artwork to support the September 2014 National Curriculum changes, these spiral-bound workbooks link school and home learning for pupils in Year One.",
                'book_price'       => '4',
                'book_cover_photo' => 'maths-spiral.jpg',
            ],
            [
                'category_id'      => 1,
                'author_id'        => 1,
                'book_title'       => 'THE MAGICAL SNOW GARDEN',
                'slug'             => 'magical-snow-garden',
                'book_summary'     => "Far away, where snowflakes twinkle like stars, Wellington penguin dreams of growing a garden. “Impossible!” say his friends. “You can’t grow a garden in the snow.” But Wellington is determined to create something truly magical...",
                'book_price'       => '3',
                'book_cover_photo' => 'handwriting.jpg',
            ],
            [
                'category_id'      => 1,
                'author_id'        => 1,
                'book_title'       => 'The Lost Duckling',
                'slug'             => 'the-lost-duckling',
                'book_summary'     => "Abandoned, lost, neglected? There's always a home at Animal Magic! In a perfect world there'd be no need for Animal Magic. But Eva and Karl Harrison, who live at the animal rescue centre with their parents, know that life isn't perfect. Every day there's a new arrival in need of their help",
                'book_price'       => '3',
                'book_cover_photo' => 'duck.jpg',
            ],
            [
                'category_id'      => 1,
                'author_id'        => 1,
                'book_title'       => 'THE MOST WONDERFUL GIFT IN THE WORLD (HARDBACK)',
                'slug'             => 'most-wonderful-gift',
                'book_summary'     => "On Christmas morning, a magnificent, red-wrapped gift sits underneath the tree. But it isn’t for Esme. And it isn’t for Bear. So they set out to find the rightful owner. Little do they know that it’s the greatest gift in all the world.",
                'book_price'       => '3',
                'book_cover_photo' => 'wonderful-gift.jpg',
            ],
            [
                'category_id'      => 1,
                'author_id'        => 1,
                'book_title'       => 'MAGIC BALL (READING LADDER LEVEL 3)',
                'slug'             => 'magic-ball',
                'book_summary'     => "A warm and funny story about a boy who hates having to choose! From one of the nation's favourite children's authors, former Children's Laureate Anne Fine. Perfect for children learning to read.",
                'book_price'       => '5',
                'book_cover_photo' => 'magic-ball.jpg',
            ],
        );

        foreach ($products as $product) {
            $product = Product::firstOrCreate($product);
        }
    }
}
