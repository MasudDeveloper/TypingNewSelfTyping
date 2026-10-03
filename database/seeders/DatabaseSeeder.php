<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@typing.com',
            'password' => bcrypt('password'),
            'role' => 'superadmin',
        ]);

        $institution = \App\Models\Institution::create([
            'name' => 'Demo Coaching Center',
            'slug' => 'demo-coaching',
            'subscription_status' => true,
        ]);

        User::create([
            'name' => 'Institution Admin',
            'email' => 'institute@typing.com',
            'password' => bcrypt('password'),
            'role' => 'institution_admin',
            'institution_id' => $institution->id,
        ]);

        User::create([
            'name' => 'Student One',
            'email' => 'student@typing.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'institution_id' => $institution->id,
        ]);

        $labs = [
            'BCC Lab' => ['bn_bijoy', 'en'],
            'High Court Lab' => ['bn_bijoy', 'en'],
            'BUET Lab' => ['bn_unicode', 'en'],
            'Software Type' => ['bn_unicode', 'en'],
            'Bijoy Classic' => ['bn_bijoy', 'en'],
            'Advanced Type' => ['bn_unicode', 'en'],
            'Exam Mode' => ['bn_unicode', 'en'],
            'Practical Question Paper' => ['bn_bijoy', 'en'],
            'Ministry & Directorate' => ['bn_unicode', 'en'],
            'Newspaper Type' => ['bn_unicode', 'en'],
            'Unlimited Manual Type' => ['bn_unicode', 'en'],
            'Basic Level' => ['bn_unicode', 'en'],
            'Level 2' => ['bn_unicode', 'en'],
            'Level 3' => ['bn_unicode', 'en'],
        ];

        $sampleBanglaPassages = [
            'BCC Lab' => 'বাংলাদেশ কম্পিউটার কাউন্সিল একটি স্বায়ত্তশাসিত সরকারি প্রতিষ্ঠান। তথ্য ও যোগাযোগ প্রযুক্তি বিভাগের অধীনে এটি দেশের তথ্যপ্রযুক্তি খাতের মানবসম্পদ উন্নয়ন ও সরকারি নিয়োগের টাইপিং পরীক্ষার মান নিয়ন্ত্রণে কাজ করে। টাইপিং দক্ষতা বৃদ্ধির জন্য নিয়মিত অনুশীলন অত্যন্ত জরুরি। সঠিক নিয়ম ও নির্ভুল গতি বজায় রাখলে পরীক্ষায় সফল হওয়া সম্ভব।',
            'High Court Lab' => 'বাংলাদেশ সুপ্রিম কোর্ট দেশের সর্বোচ্চ বিচারালয়। সংবিধান অনুযায়ী হাইকোর্ট বিভাগ ও আপিল বিভাগ নিয়ে এটি গঠিত। আদালতের দৈনন্দিন কার্যক্রমে দ্রুত ও নির্ভুল টাইপিং অত্যন্ত গুরুত্বপূর্ণ ভূমিকা পালন করে। আইনি নথিপত্র প্রস্তুত ও সংরক্ষণে মুদ্রাক্ষরিকদের বিশেষ দক্ষতা প্রয়োজন হয়।',
            'BUET Lab' => 'বাংলাদেশ প্রকৌশল বিশ্ববিদ্যালয় প্রকৌশল ও প্রযুক্তি শিক্ষার একটি শীর্ষস্থানীয় বিদ্যাপীঠ। আন্তর্জাতিক মানের গবেষণা ও প্রযুক্তিগত উদ্ভাবনে এই প্রতিষ্ঠান অগ্রণী ভূমিকা রাখছে। কম্পিউটার সায়েন্স ও তথ্যপ্রযুক্তি খাতে শিক্ষার্থীদের দক্ষতা বৃদ্ধিতে আধুনিক ল্যাব অত্যন্ত কার্যকর।',
            'Software Type' => 'সফটওয়্যার ডেভেলপমেন্ট ও প্রোগ্রামিংয়ে বাংলা ভাষার ব্যবহার দিন দিন বৃদ্ধি পাচ্ছে। আধুনিক ওয়েব অ্যাপ্লিকেশন তৈরিতে ইউজার ইন্টারফেস ও ডাটাবেস সমন্বয় অপরিহার্য। গতিশীল ও ব্যবহারবান্ধব সফটওয়্যার তৈরিতে সঠিক কোডিং স্ট্যান্ডার্ড অনুসরণ করা প্রয়োজন।',
            'Bijoy Classic' => 'বিজয় বায়ান্ন কিবোর্ড বাংলাদেশে বহুল ব্যবহৃত একটি টাইপিং লেআউট। সরকারি দপ্তর ও মুদ্রণ শিল্পে এর ব্যাপক ব্যবহার রয়েছে। লিঙ্ক কি জি ব্যবহার করে যুক্তবর্ণ লেখার কৌশল আয়ত্ত করলে দ্রুত গতি অর্জন করা সম্ভব হয়। নিয়মিত টাইপিং অনুশীলনের বিকল্প নেই।',
            'Advanced Type' => 'উন্নত টাইপিং অনুশীলনে জটিল বাক্য ও যতিচিহ্নের ব্যবহার শিখতে হয়। প্রমিত বাংলা বানানরীতি ও ব্যাকরণগত নির্ভুলতা বজায় রাখা সফল মুদ্রাক্ষরিকের অন্যতম প্রধান গুণ। গতি বৃদ্ধির পাশাপাশি শতভাগ সঠিকতা নিশ্চিত করাই মূল লক্ষ্য।',
            'Exam Mode' => 'সরকারি ও স্বায়ত্তশাসিত প্রতিষ্ঠানের নিয়োগ পরীক্ষায় টাইপিং টেস্ট একটি বাধ্যতামূলক ধাপ। বিসিসি স্ট্যান্ডার্ডে প্রতি মিনিটে নির্দিষ্ট সংখ্যক শব্দ নির্ভুলভাবে টাইপ করতে হয়। পরীক্ষায় পাঁচ শতাংশের বেশি ভুল হলে প্রার্থী অনুত্তীর্ণ বলে গণ্য হয়।',
            'Practical Question Paper' => 'অফিস সহকারী ও কম্পিউটার অপারেটর পদের ব্যবহারিক পরীক্ষায় মাইক্রোসফট ওয়ার্ড, এক্সেল ও পাওয়ারপয়েন্টের কাজ থাকে। স্যালারি শিট তৈরি, ডাটা এন্ট্রি ও প্রাতিষ্ঠানিক সার্কুলার ড্রাফটিংয়ে সঠিক নির্দেশিকা মেনে কাজ করতে হয়।',
            'Ministry & Directorate' => 'জনপ্রশাসন মন্ত্রণালয় সহ বিভিন্ন সরকারি অধিদপ্তরের দৈনন্দিন দাপ্তরিক চিঠিপত্র, প্রজ্ঞাপন ও সার্কুলার তৈরিতে দ্রুত মুদ্রাক্ষরিক প্রয়োজন। ই-নথি ও ডিজিটাল অফিস ব্যবস্থাপনায় কম্পিউটার টাইপিং দক্ষতা আবশ্যক।',
            'Newspaper Type' => 'সংবাদপত্র ও গণমাধ্যমে সংবাদ প্রকাশের জন্য দ্রুত গতিতে টাইপিং অপরিহার্য। তাৎক্ষণিক সংবাদ সম্পাদনা ও নির্ভুল কম্পোজের মাধ্যমে পাঠকের কাছে সঠিক তথ্য পৌঁছে দেওয়া হয়। সংবাদ শিরোনাম ও প্রতিবেদন কম্পোজে বিশেষ সতর্কতা প্রয়োজন।',
            'Unlimited Manual Type' => 'সীমাহীন ম্যানুয়াল টাইপিং ল্যাবে পরীক্ষার্থীরা যেকোনো সময়সীমায় দীর্ঘ অনুচ্ছেদ অনুশীলন করতে পারে। সময়ের সীমাবদ্ধতা ছাড়া দীর্ঘক্ষণ টাইপ করার অভ্যাস আঙুলের গতি ও স্মৃতিশক্তি বৃদ্ধি করে।',
            'Basic Level' => 'প্রাথমিক স্তরে কিবোর্ডের হোম রো, আপার রো ও লোয়ার রো এর প্রতিটি অক্ষরের অবস্থান মুখস্থ করা হয়। আঙুল নির্দিষ্ট স্থানে রেখে না দেখে টাইপ করার কৌশলকে টাচ টাইপিং বলা হয়।',
            'Level 2' => 'দ্বিতীয় স্তরে যুক্তবর্ণ ও সাধারণ বাক্য গঠন অনুশীলন করা হয়। নিয়মিত অনুশীলনের মাধ্যমে টাইপিং গতি স্বাভাবিক গতিতে পৌঁছায় এবং ভুলের হার কমতে শুরু করে।',
            'Level 3' => 'তৃতীয় স্তরে উচ্চগতির টাইপিং ও নির্ভুলতা অর্জনের জন্য সময় নিয়ন্ত্রিত পরীক্ষা দেওয়া হয়। বিভিন্ন সরকারি ও বিসিসি মডেল টেস্টে অংশ নিয়ে আত্মবিশ্বাস তৈরি করা সম্ভব।',
        ];

        foreach ($labs as $lab => $langs) {
            foreach ($langs as $lang) {
                $isBangla = in_array($lang, ['bn_bijoy', 'bn_unicode', 'bn']);
                $content = $isBangla 
                    ? ($sampleBanglaPassages[$lab] ?? $sampleBanglaPassages['BCC Lab'])
                    : 'This is an official standard typing passage for ' . $lab . '. Consistent practice with accuracy and speed will help you succeed in all competitive examinations.';

                \App\Models\TypingTest::create([
                    'title' => $lab . ' Test (' . strtoupper($lang) . ')',
                    'content' => $content,
                    'category' => $lab,
                    'language' => $lang,
                    'mode' => 'screen',
                    'time_limit_minutes' => 10,
                    'pass_wpm' => 30,
                ]);
            }
        }
        \App\Models\Package::create([
            'name' => '1 Month Premium',
            'price' => 200,
            'duration_days' => 30,
        ]);

        \App\Models\Package::create([
            'name' => '3 Months Master',
            'price' => 500,
            'duration_days' => 90,
        ]);

        \App\Models\Package::create([
            'name' => '6 Months Pro',
            'price' => 800,
            'duration_days' => 180,
        ]);
    }
}
