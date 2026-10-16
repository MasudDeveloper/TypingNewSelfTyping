<?php

namespace App\Services;

class BijoyConverter
{
    private static ?array $maps = null;

    private static function initMaps(): void
    {
        if (self::$maps !== null) {
            return;
        }

        $jsonFile = __DIR__ . '/bijoy_map.json';
        if (file_exists($jsonFile)) {
            self::$maps = json_decode(file_get_contents($jsonFile), true);
        } else {
            self::$maps = ['pre' => [], 'conv' => [], 'post' => []];
        }
    }

    public static function convert(string $text): string
    {
        if (empty($text)) {
            return $text;
        }

        if (self::isPureBengaliUnicode($text)) {
            return self::normalizeBengali($text);
        }

        self::initMaps();

        // 1. Pre conversion
        $out = strtr($text, self::$maps['pre']);

        // 2. Main conversion
        $out = strtr($out, self::$maps['conv']);

        // Double halant cleanup (e.g. ন্ + ্থ -> ন্থ)
        $out = str_replace("\u{09CD}\u{09CD}", "\u{09CD}", $out);

        // 3. Re-arrange Bengali reph and pre-kars (ি, ে, ৈ)
        $out = self::rearrangeBengali($out);

        // 4. Post conversion
        $out = strtr($out, self::$maps['post']);

        return self::normalizeBengali($out);
    }

    public static function isPureBengaliUnicode(string $text): bool
    {
        $bengaliChars = preg_match_all('/[\x{0980}-\x{09FF}]/u', $text);
        $totalChars = mb_strlen(trim($text));
        return ($totalChars > 0 && ($bengaliChars / $totalChars) > 0.6);
    }

    public static function normalizeBengali(string $text): string
    {
        if (class_exists('Normalizer')) {
            $text = \Normalizer::normalize($text, \Normalizer::FORM_C);
        }

        // Common normalization replacements
        $text = str_replace('|', '।', $text);
        $text = str_replace(["\u{200B}", "\u{200C}", "\u{200D}", "\u{FEFF}", "\u{00AD}"], '', $text);

        // Decomposed characters normalization
        $replacements = [
            '/\\x{09AF}\\x{09BC}/u' => 'য়',
            '/\\x{09A1}\\x{09BC}/u' => 'ড়',
            '/\\x{09A2}\\x{09BC}/u' => 'ঢ়',
            '/\\x{0985}\\x{09BE}/u' => 'আ',
            '/\\x{09C7}\\x{09BE}/u' => 'ো',
            '/\\x{09C7}\\x{09D7}/u' => 'ৌ',
            '/\\x{09A4}\\x{09CD}\\x{200D}/u' => 'ৎ',
        ];

        foreach ($replacements as $pattern => $rep) {
            $text = preg_replace($pattern, $rep, $text);
        }

        // Remove extra spaces
        $text = preg_replace('/[ \t]+/u', ' ', $text);
        return trim($text);
    }

    private static function isBanglaPreKar(string $c): bool
    {
        return $c === 'ি' || $c === 'ৈ' || $c === 'ে';
    }

    private static function isBanglaBanjonborno(string $c): bool
    {
        if ($c === '') return false;
        $consonants = 'কখগঘঙচছজঝঞটঠডঢণতথদধনপফবভমযরলশষসহড়ঢ়য়ৎংঃঁ';
        return mb_strpos($consonants, $c) !== false;
    }

    private static function isBanglaHalant(string $c): bool
    {
        return $c === '্';
    }

    private static function isBanglaKar(string $c): bool
    {
        return self::isBanglaPreKar($c) || in_array($c, ['া', 'ো', 'ৌ', 'ৌ', 'ু', 'ূ', 'ী', 'ৃ'], true);
    }

    private static function rearrangeBengali(string $input): string
    {
        $chars = mb_str_split($input);
        $len = count($chars);

        // Pass 1: Reph rearrangement (র + ্ + consonant)
        $i = 0;
        while ($i < count($chars) - 1) {
            if ($chars[$i] === 'র' && isset($chars[$i + 1]) && $chars[$i + 1] === '্' && $i > 0 && self::isBanglaBanjonborno($chars[$i - 1])) {
                $j = 1;
                while (($i - $j - 1) >= 0 && self::isBanglaBanjonborno($chars[$i - $j - 1]) && self::isBanglaHalant($chars[$i - $j])) {
                    $j += 2;
                }
                
                // Extract reph
                $reph = ['র', '্'];
                $cluster = array_slice($chars, $i - $j, $j);
                array_splice($chars, $i - $j, $j + 2, array_merge($reph, $cluster));
                $i += 2;
                continue;
            }
            $i++;
        }

        // Pass 2: Pre-kars (ি, ে, ৈ)
        $i = 0;
        while ($i < count($chars)) {
            if ($i < count($chars) - 1 && self::isBanglaPreKar($chars[$i]) && $chars[$i + 1] !== ' ') {
                $kar = $chars[$i];
                $j = 1;
                while (($i + $j) < count($chars) && self::isBanglaBanjonborno($chars[$i + $j])) {
                    if (($i + $j + 1) < count($chars) && self::isBanglaHalant($chars[$i + $j + 1])) {
                        $j += 2;
                    } else {
                        break;
                    }
                }

                $cluster = array_slice($chars, $i + 1, $j);
                $l = 0;
                $combinedKar = $kar;
                
                // ও-কার (ে + া -> ো)
                if ($kar === 'ে' && isset($chars[$i + $j + 1]) && $chars[$i + $j + 1] === 'া') {
                    $combinedKar = 'ো';
                    $l = 1;
                } elseif ($kar === 'ে' && isset($chars[$i + $j + 1]) && $chars[$i + $j + 1] === 'ৗ') {
                    $combinedKar = 'ৌ';
                    $l = 1;
                }

                $replacement = array_merge($cluster, [$combinedKar]);
                array_splice($chars, $i, $j + 1 + $l, $replacement);
                $i += $j;
            }
            $i++;
        }

        return implode('', $chars);
    }
}
