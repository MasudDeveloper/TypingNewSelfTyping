<?php

namespace App\Services;

class BijoyConverter
{
    private static array $preMap = [
        '  ' => ' ',
        'yy' => 'y',
        'vv' => 'v',
        "\xAD\xAD" => "\xAD",
        'y&' => 'y',
        " , " => ", ",
        " |" => "|",
        "\n\n\n" => "\n\n",
    ];

    private static array $conversionMap = [
        // Multi-char sequences
        "i\xE6" => "রু",
        "i\u{201C}" => "রু",
        "i\u{0192}" => "রূ",
        "M\xF8" => "গ্ল",
        "\u{201D}Q\xA6" => "চ্ছ্ব",
        "c\xF8" => "প্ল",
        "e\xF8" => "ব্ল",
        "k\xF8" => "শ্ল",
        "\xA4\xF8" => "ম্ল",
        "\xAF\xF8" => "স্ল",
        "\xE5\u{201C}" => "ভ্রু",
        "\xAF\xCD" => "স্ত",
        "\u{0161}\xCD" => "ন্ত",
        "\xAF\xCD\xA1" => "স্ত্ব",
        "\u{0161}\xCD\xA1" => "ন্ত্ব",
        "\xCB\xA1" => "ত্ত্ব",

        // Vowels
        'Av' => 'আ',
        'A' => 'অ',
        'B' => 'ই',
        'C' => 'ঈ',
        'D' => 'উ',
        'E' => 'ঊ',
        'F' => 'ঋ',
        'G' => 'এ',
        'H' => 'ঐ',
        'I' => 'ও',
        'J' => 'ঔ',

        // Consonants
        'K' => 'ক',
        'L' => 'খ',
        'M' => 'গ',
        'N' => 'ঘ',
        'O' => 'ঙ',
        'P' => 'চ',
        'Q' => 'ছ',
        'R' => 'জ',
        'S' => 'ঝ',
        'T' => 'ঞ',
        'U' => 'ট',
        'V' => 'ঠ',
        'W' => 'ড',
        'X' => 'ঢ',
        'Y' => 'ণ',
        'Z' => 'ত',
        '_' => 'থ',
        '`' => 'দ',
        'a' => 'ধ',
        'b' => 'ন',
        'c' => 'প',
        'd' => 'ফ',
        'e' => 'ব',
        'f' => 'ভ',
        'g' => 'ম',
        'h' => 'য',
        'i' => 'র',
        'j' => 'ল',
        'k' => 'শ',
        'l' => 'ষ',
        'm' => 'স',
        'n' => 'হ',
        'o' => 'ড়',
        'p' => 'ঢ়',
        'q' => 'য়',
        'r' => 'ৎ',
        's' => 'ং',
        't' => 'ঃ',
        'u' => 'ঁ',

        // Numbers
        '0' => '০',
        '1' => '১',
        '2' => '২',
        '3' => '৩',
        '4' => '৪',
        '5' => '৫',
        '6' => '৬',
        '7' => '৭',
        '8' => '৮',
        '9' => '৯',

        // Kars
        'v' => 'া',
        'w' => 'ি',
        'x' => 'ী',
        'y' => 'ু',
        'z' => 'ু',
        '~' => 'ূ',
        "\u{0192}" => 'ূ',
        "\u{201E}" => 'ৃ',
        "\u{2020}" => 'ে',
        "\u{2021}" => 'ে',
        "\u{02C6}" => 'ৈ',
        "\u{2030}" => 'ৈ',
        "\u{0160}" => 'ৌ',
        '|' => '।',
        '&' => '্',

        // Conjuncts
        '^' => '্ব',
        "\u{2018}" => 'তু',
        "\u{2019}" => '্থ',
        "\u{2039}" => '্ক',
        "\u{201D}" => 'চ্',
        "\u{2014}" => '্ত',
        "\u{0161}" => 'ন্',
        "\xA1" => '্ব',
        "\xA2" => '্ভ',
        "\xA4" => 'ম্',
        "\xA5" => '্ম',
        "\xA6" => '্ব',
        "\xA7" => '্ম',
        "\xA8" => '্য',
        "\xA9" => 'র্',
        "\xAA" => '্র',
        "\xAB" => '্র',
        "\xAC" => '্ল',
        "\xAD" => '্ল',
        "\xAE" => 'ষ্',
        "\xAF" => 'স্',
        "\xB0" => 'ক্ক',
        "\xB1" => 'ক্ট',
        "\xB2" => 'ক্ষ্ণ',
        "\xB3" => 'ক্ত',
        "\xB4" => 'ক্ম',
        "\xB5" => 'ক্র',
        "\xB6" => 'ক্ষ',
        "\xB7" => 'ক্স',
        "\xB8" => 'গু',
        "\xB9" => 'জ্ঞ',
        "\xBA" => 'গ্দ',
        "\xBB" => 'গ্ধ',
        "\xBC" => 'ঙ্ক',
        "\xBD" => 'ঙ্গ',
        "\xBE" => 'জ্জ',
        "\xBF" => 'ত্র',
        "\xC0" => 'জ্ঝ',
        "\xC1" => 'জ্ঞ',
        "\xC2" => 'ঞ্চ',
        "\xC3" => 'ঞ্ছ',
        "\xC4" => 'ঞ্জ',
        "\xC5" => 'ঞ্ঝ',
        "\xC6" => 'ট্ট',
        "\xC7" => 'ড্ড',
        "\xC8" => 'ণ্ট',
        "\xC9" => 'ণ্ঠ',
        "\xCA" => 'ণ্ড',
        "\xCB" => 'ত্ত',
        "\xCC" => 'ত্থ',
        "\xCD" => 'ত্ম',
        "\xCE" => 'ত্র',
        "\xCF" => 'দ্দ',
        "\xD6" => '্র',
        "\xD7" => 'দ্ধ',
        "\xD8" => 'দ্ব',
        "\xD9" => 'দ্ম',
        "\xDA" => 'ন্ঠ',
        "\xDB" => 'ন্ড',
        "\xDC" => 'ন্ধ',
        "\xDD" => 'ন্স',
        "\xDE" => 'প্ট',
        "\xDF" => 'প্ত',
        "\xE0" => 'প্প',
        "\xE1" => 'প্স',
        "\xE2" => 'ব্জ',
        "\xE3" => 'ব্দ',
        "\xE4" => 'ব্ধ',
        "\xE5" => 'ভ্র',
        "\xE6" => 'ু',
        "\xE7" => 'ম্ফ',
        "\xE8" => '্ন',
        "\xE9" => 'ল্ক',
        "\xEA" => 'ল্গ',
        "\xEB" => 'ল্ট',
        "\xEC" => 'ল্ড',
        "\xED" => 'ল্প',
        "\xEE" => 'ল্ফ',
        "\xEF" => 'শু',
        "\xF0" => 'শ্চ',
        "\xF1" => 'শ্ছ',
        "\xF2" => 'ষ্ণ',
        "\xF3" => 'ষ্ট',
        "\xF4" => 'ষ্ঠ',
        "\xF5" => 'ষ্ফ',
        "\xF6" => 'স্খ',
        "\xF7" => 'স্ট',
        "\xF8" => 'স্ন',
        "\xF9" => 'স্ফ',
        "\xFA" => '্প',
        "\xFB" => 'হু',
        "\xFC" => 'হৃ',
        "\xFD" => 'হ্ন',
        "\xFE" => 'হ্ম',
        "\xFF" => 'ক্ষ',
    ];

    public static function convert(string $text): string
    {
        if (empty($text)) {
            return $text;
        }

        // If it already has rich Bengali Unicode characters and no Bijoy markers, return as is
        if (self::isPureBengaliUnicode($text)) {
            return self::normalizeBengali($text);
        }

        // 1. Pre Map
        $out = strtr($text, self::$preMap);

        // 2. Conversion Map
        $out = strtr($out, self::$conversionMap);

        // 3. Post Rearrangements (Pre-kars e.g. ি, ে, ৈ)
        $out = self::rearrangeBengali($out);

        return self::normalizeBengali($out);
    }

    public static function isPureBengaliUnicode(string $text): bool
    {
        // Check if text is predominantly Bengali unicode range U+0980-U+09FF
        $bengaliChars = preg_match_all('/[\x{0980}-\x{09FF}]/u', $text);
        $totalChars = mb_strlen(trim($text));
        return ($totalChars > 0 && ($bengaliChars / $totalChars) > 0.6);
    }

    public static function normalizeBengali(string $text): string
    {
        if (class_exists('Normalizer')) {
            $text = \Normalizer::normalize($text, \Normalizer::FORM_C);
        }

        // Literal string replacements first
        $text = str_replace('|', '।', $text);
        $text = str_replace(["\u{200C}", "\u{200D}", "\u{FEFF}", "\u{00AD}"], '', $text);

        // Decomposed nukta replacements
        $replacements = [
            '\\x{09AF}\\x{09BC}' => 'য়', // য + ় -> য়
            '\\x{09A1}\\x{09BC}' => 'ড়', // ড + ় -> ড়
            '\\x{09A2}\\x{09BC}' => 'ঢ়', // ঢ + ় -> ঢ়
            '\\x{0985}\\x{09BE}' => 'আ', // অ + া -> আ
            '\\x{09C7}\\x{09BE}' => 'ো', // ে + া -> ো
            '\\x{09C7}\\x{09D7}' => 'ৌ', // ে + ৗ -> ৌ
            '\\x{09A4}\\x{09CD}\\x{200D}' => 'ৎ', // ত + ্ + ZWJ -> ৎ
        ];

        foreach ($replacements as $pattern => $rep) {
            $text = preg_replace('/' . $pattern . '/u', $rep, $text);
        }

        $text = preg_replace('/[ \t]+/u', ' ', $text);
        return trim($text);
    }

    private static function rearrangeBengali(string $str): string
    {
        // Rearrange e-kar (ে), i-kar (ি), oi-kar (ৈ) appearing before consonants
        $pattern = '/([\x{09BF}\x{09C7}\x{09C8}])([\x{0995}-\x{09B9}\x{09CE}\x{09DC}-\x{09DF}](?:\x{09CD}[\x{0995}-\x{09B9}])?)/u';
        $str = preg_replace($pattern, '$2$1', $str);

        // O-kar (ে + া -> ো)
        $str = preg_replace('/ো/u', 'ো', $str);
        // Ou-kar (ে + ৌ -> ৌ)
        $str = preg_replace('/েৌ/u', 'ৌ', $str);

        return $str;
    }
}
