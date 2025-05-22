<?php

namespace App\Filament\Resources\MovieResource\Pages;

use App\Filament\Resources\MovieResource;
use App\Models\Movie;
use FFMpeg\FFMpeg;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CreateMovie extends CreateRecord
{
    protected static string $resource = MovieResource::class;

    public function mutateFormDataBeforeCreate(array $data): array
    {

        try {
            $video = $this->createMovie($data['video']);

            if (!$video || !($video instanceof Movie)) {
                Storage::disk('public')->delete($data['video']);
                throw new \Exception("Video processing failed.");
            }

            unset($data['video']);
            $data['movie_id'] = $video->id;
            $data['created_by'] = Filament::auth()->id();

            return $data;
        } catch (\Exception $e) {
            Storage::disk('public')->delete($data['video']);
            throw $e;
        }
    }

    protected function createMovie($videoPath)
    {

        $fullPath = Storage::disk('public')->path($videoPath);

        $ffmpeg = FFMpeg::create();
        $ff_video = $ffmpeg->open($fullPath);

        $streams = $ff_video->getStreams()->videos();
        $width = $streams->first()->get('width');
        $height = $streams->first()->get('height');

        try {
            DB::beginTransaction();
            $video = new Movie();

            $video->file_path = $videoPath;
            $video->mime_type = mime_content_type($fullPath);
            $video->file_size = filesize($fullPath);
            $video->duration = $ff_video->getFormat()->get('duration');
            $video->resolution = "{$width}x{$height}";
            $video->codec =  $streams->first()->get('codec_name');
            $video->bitrate = $streams->first()->get('bit_rate');
            $video->frame_rate =  $streams->first()->get('r_frame_rate');
            $video->save();
            DB::commit();
            return $video;
        } catch (\Exception $err) {
            DB::rollBack();
            // Just to be safe, delete again
            Storage::disk('public')->delete($videoPath);
            throw $err;
        }
    }
}
