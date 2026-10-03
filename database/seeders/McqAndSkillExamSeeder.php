<?php

namespace Database\Seeders;

use App\Models\McqExam;
use App\Models\McqQuestion;
use App\Models\PracticalQuestion;
use App\Models\WrittenQuestion;
use Illuminate\Database\Seeder;

class McqAndSkillExamSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create MCQ Exam
        $exam = McqExam::create([
            'title' => 'BCC ও কম্পিউটার অপারেটর মডেল টেস্ট - ০১',
            'category' => 'BCC & Govt Standard',
            'time_limit_minutes' => 15,
            'total_marks' => 20,
            'pass_marks' => 10,
            'negative_marking' => 0.25,
            'is_active' => true,
        ]);

        $questions = [
            [
                'question' => 'বিজয় কিবোর্ডে "ক্ষ" লেখার নিয়ম কী?',
                'option_a' => 'k + g + K',
                'option_b' => 'j + g + N',
                'option_c' => 'k + g + N',
                'option_d' => 'j + g + k',
                'correct_option' => 'a',
                'explanation' => 'বিজয় কিবোর্ডে ক (k) + লিঙ্ক (g) + ষ (K) = ক্ষ।',
            ],
            [
                'question' => 'বিজয় কিবোর্ডে "জ্ঞ" লেখার সঠিক কিবোর্ড কমান্ড কোনটি?',
                'option_a' => 'U + g + I',
                'option_b' => 'u + g + I',
                'option_c' => 'u + g + i',
                'option_d' => 'U + g + i',
                'correct_option' => 'b',
                'explanation' => 'জ (u) + লিঙ্ক (g) + ঞ (I) = জ্ঞ।',
            ],
            [
                'question' => 'MS Word-এ কোনো লেখার বানান ও ব্যাকরণ (Spelling & Grammar) পরীক্ষার শর্টকাট কী?',
                'option_a' => 'F2',
                'option_b' => 'F5',
                'option_c' => 'F7',
                'option_d' => 'F12',
                'correct_option' => 'c',
                'explanation' => 'F7 কি চাপলে Spelling and Grammar ডায়ালগ বক্স ওপেন হয়।',
            ],
            [
                'question' => 'MS Excel-এ কোনো রেঞ্জের যোগফল নির্ণয়ের সঠিক ফর্মুলা কোনটি?',
                'option_a' => '=ADD(A1:A10)',
                'option_b' => '=SUM(A1:A10)',
                'option_c' => '=TOTAL(A1:A10)',
                'option_d' => '=PLUS(A1:A10)',
                'correct_option' => 'b',
                'explanation' => 'Excel-এ সংখ্যার যোগফল বের করতে SUM ফাংশন ব্যবহৃত হয়।',
            ],
            [
                'question' => 'বিসিসি পরীক্ষায় টাইপিংয়ে সর্বোচ্চ কত শতাংশ ভুল ক্ষমার যোগ্য?',
                'option_a' => '২%',
                'option_b' => '৫%',
                'option_c' => '১০%',
                'option_d' => '১৫%',
                'correct_option' => 'b',
                'explanation' => 'বাংলাদেশ কম্পিউটার কাউন্সিল (BCC) স্ট্যান্ডার্ডে সর্বোচ্চ ৫% ভুল ছাড় দেওয়া হয়।',
            ],
        ];

        foreach ($questions as $q) {
            McqQuestion::create(array_merge($q, ['mcq_exam_id' => $exam->id]));
        }

        // 2. Create Written Questions
        WrittenQuestionsList();

        // 3. Create Practical Questions
        PracticalQuestionsList();
    }
}

function WrittenQuestionsList()
{
    WrittenQuestion::create([
        'title' => 'জনপ্রশাসন মন্ত্রণালয় - অফিস সহকারী কাম কম্পিউটার মুদ্রাক্ষরিক লিখিত প্রশ্ন',
        'category' => 'Ministry & Directorate',
        'organization' => 'Ministry of Public Administration',
        'exam_year' => '2025',
        'question_content' => "১. সংক্ষিপ্ত উত্তর দিন:\nক) RAM ও ROM-এর মধ্যে দুটি মূল পার্থক্য লিখুন।\nখ) বিজয় কিবোর্ড ও ইউনিকোড কিবোর্ডের মধ্যে পার্থক্য কী?\nগ) MS Excel-এ VLOOKUP ফাংশনের ব্যবহার ব্যাখ্যা করুন।\n\n২. একটি অফিসিয়াল সরকারি সার্কুলার ড্রাফট করুন।"
    ]);

    WrittenQuestion::create([
        'title' => 'বাংলাদেশ সুপ্রিম কোর্ট - সাঁট-মুদ্রাক্ষরিক লিখিত ও প্র্যাকটিক্যাল প্রশ্নপত্র',
        'category' => 'High Court & Judiciary',
        'organization' => 'Supreme Court of Bangladesh',
        'exam_year' => '2025',
        'question_content' => "১. লিগ্যাল টার্মিনোলজি ও কোর্ট অর্ডার টাইপিং নির্দেশনা।\n২. পাওয়ারপয়েন্টে প্রেজেন্টেশন স্লাইড ডিজাইন ও ট্রানজিশন ইফেক্ট যুক্ত করার নিয়ম।"
    ]);
}

function PracticalQuestionsList()
{
    PracticalQuestion::create([
        'title' => 'Excel Salary Sheet with Bonus & Tax Calculation',
        'software' => 'excel',
        'problem_statement' => '১০ জন কর্মকর্তার Basic Salary, House Rent (45%), Medical (1500 Tk), Provident Fund (10%) এবং Net Salary ফর্মুলার সাহায্যে তৈরি করুন।',
        'step_instructions' => '১. A1 থেকে G1 পর্যন্ত কলাম হেডার তৈরি করুন।\n২. IF ফাংশন ব্যবহার করে ১০,০০০ টাকার বেশি হলে বোনাস ৫% দিন।'
    ]);

    PracticalQuestion::create([
        'title' => 'PowerPoint Official Presentation Layout',
        'software' => 'powerpoint',
        'problem_statement' => 'ডিজিটাল বাংলাদেশ ও স্মার্ট বাংলাদেশ রূপকল্পের উপর ৫ স্লাইডের একটি প্রেজেন্টেশন তৈরি করুন।',
        'step_instructions' => '১. স্লাইড ১: টাইটেল স্লাইড।\n২. স্লাইড ২: স্মার্ট সিটিজেন ও স্মার্ট গভর্ন্যান্স।\n৩. কাস্টম অ্যানিমেশন ও ট্রানজিশন যোগ করুন।'
    ]);
}
