<?php

namespace App\Enums;

enum MovieGenreEnums: string
{
    case NotSpecified = "NOT_SPECIFIED";
    case Action = "ACTION";
    case Adventure = "ADVENTURE";
    case Animation = "ANIMATION";
    case Comedy = "COMEDY";
    case Crime = "CRIME";
    case Documentary = "DOCUMENTARY";
    case Drama = "DRAMA";
    case Family = "FAMILY";
    case Fantasy = "FANTASY";
    case Horror = "HORROR";
    case Musical = "MUSICAL";
    case Mystery = "MYSTERY";
    case Romance = "ROMANCE";
    case ScienceFiction = "SCI_FI";
    case Thriller = "THRILLER";
    case War = "WAR";
    case Western = "WESTERN";

    // Add a method to get a human-readable label
    public function label(): string
    {
        return match ($this) {
            self::NotSpecified => 'Not Specified',
            self::Action => 'Action',
            self::Adventure => 'Adventure',
            self::Animation => 'Animation',
            self::Comedy => 'Comedy',
            self::Crime => 'Crime',
            self::Documentary => 'Documentary',
            self::Drama => 'Drama',
            self::Family => 'Family',
            self::Fantasy => 'Fantasy',
            self::Horror => 'Horror',
            self::Musical => 'Musical',
            self::Mystery => 'Mystery',
            self::Romance => 'Romance',
            self::ScienceFiction => 'Science Fiction',
            self::Thriller => 'Thriller',
            self::War => 'War',
            self::Western => 'Western',
        };
    }
}
