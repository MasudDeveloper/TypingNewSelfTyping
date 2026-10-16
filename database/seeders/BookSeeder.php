<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'বাংলা',
                'subtitle' => 'মন্ত্রণালয়, বিভাগ, অধিদপ্তর ও পরিদপ্তরে গ্রেড ১১তম থেকে ২০তম নিয়োগ সহায়িকা',
                'price' => 240,
                'original_price' => 340,
                'discount_percent' => '29% OFF',
                'stock_status' => 'In Stock',
                'external_url' => 'https://selfpublicationbd.com',
                'accent_color' => '#0284c7',
                'image_url' => '/images/books/bangla.png',
                'sort_order' => 1,
            ],
            [
                'title' => 'ইংরেজি',
                'subtitle' => 'মন্ত্রণালয়, বিভাগ, অধিদপ্তর ও পরিদপ্তরে লিখিত ও এমসিকিউ সহায়িকা',
                'price' => 300,
                'original_price' => 450,
                'discount_percent' => '33% OFF',
                'stock_status' => 'In Stock',
                'external_url' => 'https://selfpublicationbd.com',
                'accent_color' => '#ea580c',
                'image_url' => '/images/books/english.png',
                'sort_order' => 2,
            ],
            [
                'title' => 'গণিত',
                'subtitle' => 'লিখিত ও এমসিকিউ গণিত শর্টকাট টেকনিক ও নির্ভুল সমাধান',
                'price' => 250,
                'original_price' => 360,
                'discount_percent' => '31% OFF',
                'stock_status' => 'In Stock',
                'external_url' => 'https://selfpublicationbd.com',
                'accent_color' => '#2563eb',
                'image_url' => '/images/books/math.png',
                'sort_order' => 3,
            ],
            [
                'title' => 'সাধারণ জ্ঞান',
                'subtitle' => 'বাংলাদেশ, আন্তর্জাতিক ও আইসিটি পূর্ণাঙ্গ প্রস্তুতি সহায়িকা',
                'price' => 280,
                'original_price' => 450,
                'discount_percent' => '38% OFF',
                'stock_status' => 'In Stock',
                'external_url' => 'https://selfpublicationbd.com',
                'accent_color' => '#7c3aed',
                'image_url' => '/images/books/gk.png',
                'sort_order' => 4,
            ],
            [
                'title' => 'RECENT JOB SOLUTION',
                'subtitle' => 'গ্রেড ১১তম থেকে ২০তম লিখিত ও এমসিকিউ প্রশ্নব্যাংক',
                'price' => 320,
                'original_price' => 450,
                'discount_percent' => '30% OFF',
                'stock_status' => 'In Stock',
                'external_url' => 'https://selfpublicationbd.com',
                'accent_color' => '#16a34a',
                'image_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&auto=format&fit=crop&q=80',
                'sort_order' => 5,
            ],
            [
                'title' => 'BCC & Govt Typing Guide',
                'subtitle' => 'বিজয় বায়ান্ন ও সুতন্বীএমজে কিবোর্ড মাস্টার বুক',
                'price' => 220,
                'original_price' => 320,
                'discount_percent' => '31% OFF',
                'stock_status' => 'In Stock',
                'external_url' => 'https://selfpublicationbd.com',
                'accent_color' => '#ea580c',
                'image_url' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?w=400&auto=format&fit=crop&q=80',
                'sort_order' => 6,
            ],
        ];

        foreach ($books as $book) {
            Book::updateOrCreate(['title' => $book['title']], $book);
        }
    }
}
