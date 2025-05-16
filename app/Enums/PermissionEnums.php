<?php

namespace App\Enums;

enum PermissionEnums: string
{
    case ApproveUploader = 'APPROVE_UPLOADER';
    case UploadMovies = 'UPLOAD_MOVIES';
    case WatchMovies = 'WATCH_MOVIES';

    public function label()
    {
        return match ($this){
            self::ApproveUploader => 'Approve Uploader',
            self::UploadMovies => 'Upload Movies',
            self::WatchMovies => 'Watch Movies',
        };
    }
}
