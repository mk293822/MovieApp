<?php

namespace App\Enums;

enum RoleEnums: string
{
    case User = "USER";
    case Admin = "ADMIN";
    case Uploader = "UPLOADER";

    public function label(): string
    {
        return match ($this) {
            self::User => "User",
            self::Admin => "Admin",
            self::Uploader => "Uploader",
        };
    }
}
