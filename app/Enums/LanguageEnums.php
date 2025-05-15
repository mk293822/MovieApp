<?php

namespace App\Enums;

enum MovieLanguageEnums: string
{
    case English = "ENGLISH";
    case Spanish = "SPANISH";
    case French = "FRENCH";
    case German = "GERMAN";
    case Italian = "ITALIAN";
    case Portuguese = "PORTUGUESE";
    case Russian = "RUSSIAN";
    case Chinese = "CHINESE";
    case Japanese = "JAPANESE";
    case Hindi = "HINDI";
    case Arabic = "ARABIC";
    case Korean = "KOREAN";
    case Turkish = "TURKISH";
    case Dutch = "DUTCH";
    case Greek = "GREEK";
    case Myanmar = "MYANMAR";
    case Thailand = "THAILAND";
    case Philippines = "PHILIPPINES";
    case India = "INDIA";
    case NotSpecified = "NOT_SPECIFIED";

    public function label(): string
    {
        return match ($this) {
            self::English => 'English',
            self::Spanish => 'Spanish',
            self::French => 'French',
            self::German => 'German',
            self::Italian => 'Italian',
            self::Portuguese => 'Portuguese',
            self::Russian => 'Russian',
            self::Chinese => 'Chinese',
            self::Japanese => 'Japanese',
            self::Hindi => 'Hindi',
            self::Arabic => 'Arabic',
            self::Korean => 'Korean',
            self::Turkish => 'Turkish',
            self::Dutch => 'Dutch',
            self::Greek => 'Greek',
            self::Myanmar => 'Myanmar',
            self::Thailand => 'Thailand',
            self::Philippines => 'Philippines',
            self::India => 'India',
            self::NotSpecified => 'Not Specified',
        };
    }
}
