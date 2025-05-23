<?php

namespace App\Filament\Resources\MovieResource\Pages;

use App\Filament\Resources\MovieResource;
use App\Models\Movie;
use App\Models\MovieDetail;
use Arr;
use FFMpeg\FFMpeg;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EditMovie extends EditRecord
{
    protected static string $resource = MovieResource::class;

    protected const STORAGE_PREFIX = '/storage/';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('delete')
                ->label('Delete Movie')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()->action(fn($record) => self::deleteMovie($record)),
        ];
    }

    protected static function deleteMovie(MovieDetail $record): void
    {
        $movie = $record->movie;
        Storage::disk('public')->delete(str_replace(self::STORAGE_PREFIX, '', $movie->poster_path));
        Storage::disk('public')->delete(str_replace(self::STORAGE_PREFIX, '', $movie->cover_path));
        Storage::disk('public')->delete(str_replace(self::STORAGE_PREFIX, '', $movie->file_path));
        $movie->details()->delete();
        $movie->delete();

        Notification::make()
            ->title('Deleted successfully')
            ->success()
            ->send();
    }


    public function mutateFormDataBeforeFill(array $data): array
    {
        $movie = Movie::findOrFail($data['movie_id']);

        $data['video'] = str_replace(self::STORAGE_PREFIX, '', $movie->file_path);

        return $data;
    }

    public function mutateFormDataBeforeSave(array $data): array
    {

        try {
            $video = $this->editMovie($data['video'], $data['movie_id']);

            unset($data['video']);
            $data['movie_id'] = $video->id;


            if (isset($data['poster_path']) && Storage::disk('public')->exists(str_replace(self::STORAGE_PREFIX, "", $video->poster_path))) {
                Storage::disk('public')->delete(str_replace(self::STORAGE_PREFIX, "", $video->poster_path));
            }

            return $data;
        } catch (\Exception $e) {
            Storage::disk('public')->delete($data['video']);
            throw $e;
        }
    }

    protected function editMovie($videoPath, string $id)
    {

        $fullPath = Storage::disk('public')->path(str_replace(self::STORAGE_PREFIX, '', $videoPath));

        $ffmpeg = FFMpeg::create();
        $ff_video = $ffmpeg->open($fullPath);

        $streams = $ff_video->getStreams()->videos();
        $width = $streams->first()->get('width');
        $height = $streams->first()->get('height');

        try {
            DB::beginTransaction();
            $video = Movie::findOrFail($id);

            if (Storage::disk('public')->exists(str_replace(self::STORAGE_PREFIX, '', $video->file_path))) {
                Storage::disk('public')->delete(str_replace(self::STORAGE_PREFIX, '', $video->file_path));
            }

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
