<?php

namespace App\Filament\Resources;

use App\Enums\MovieGenreEnums;
use App\Enums\MovieLanguageEnums;
use App\Enums\RoleEnums;
use App\Filament\Resources\MovieResource\Pages;
use App\Filament\Resources\MovieResource\RelationManagers;
use App\Models\Movie;
use App\Models\MovieDetail;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\Contracts\Editable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class MovieResource extends Resource
{
    protected static ?string $model = MovieDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected const STORAGE_PREFIX = '/storage/';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            TextInput::make('movie_id')->hiddenOn('create')->readOnly(),
            Forms\Components\TextInput::make('title')
                    ->required(),
            Forms\Components\TextInput::make('director')
                ->required()
                ->string(),
            Forms\Components\TextInput::make('rating')
                ->numeric()
                ->default(0)
                ->minValue(0)
                ->maxValue(10),
            Select::make('genre')->options(
                collect(MovieGenreEnums::cases())
                    ->mapWithKeys(
                        fn($case) =>
                        [
                            $case->value => $case->label(),
                        ]
                    )
            )
                ->required(),
            Select::make('language')->options(
                collect(MovieLanguageEnums::cases())
                    ->mapWithKeys(
                        fn($case) =>
                        [
                            $case->value => $case->label(),
                        ]
                    )
            )
                ->default(MovieLanguageEnums::English->value)
                ->required(),
            DatePicker::make('release_year')
                ->displayFormat('Y')  // Display only the year
                ->required()
                ->withoutTime(),
            Checkbox::make('is_public')->default(false),
            Forms\Components\RichEditor::make('description')
                ->toolbarButtons([
                    'blockquote',
                    'bold',
                    'bulletList',
                    'codeBlock',
                    'h2',
                    'h3',
                    'italic',
                    'link',
                    'orderedList',
                    'redo',
                    'strike',
                    'underline',
                    'undo',
                ])
                ->required()
                ->columnSpan(2),
            FileUpload::make('poster_path')
                ->label('Poster')
                ->openable()
                ->disk('public')
                ->directory('posters')
                ->preserveFilenames()
                ->previewable()
                ->imageCropAspectRatio('2:3')
                ->imageEditor()
                ->image()
                ->columnSpan(2)
                ->required(),
            FileUpload::make('cover_path')
                ->label('Video Cover')
                ->openable()
                ->disk('public')
                ->directory('video_covers')
                ->imageEditor()
                ->imageCropAspectRatio('16:9')
                ->preserveFilenames()
                ->previewable()
                ->image()
                ->columnSpan(2)
                ->required(),
            FileUpload::make('video')
                ->label('Video Upload')
                ->maxSize(5368709120)
                ->disk('public')
                ->directory('videos')
                ->acceptedFileTypes(['video/mp4', 'video/avi', 'video/mkv']) // Restrict accepted file types
                ->columnSpan(2)
                ->previewable(false)
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
            Tables\Columns\ImageColumn::make('poster_path')
                ->height(60),
            Tables\Columns\TextColumn::make('title')
                ->sortable()
                    ->searchable(),
            Tables\Columns\TextColumn::make('director')
                ->sortable()
                    ->searchable(),
            Tables\Columns\TextColumn::make('rating')
                    ->numeric()
                    ->sortable(),
            Tables\Columns\TextColumn::make('genre')
                ->formatStateUsing(fn($state) => $state?->label())
                ->sortable(),
            Tables\Columns\TextColumn::make('language')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
            Tables\Columns\TextColumn::make('release_year')
                    ->sortable()
                ->date()
                    ->toggleable(isToggledHiddenByDefault: true),
            CheckboxColumn::make('is_public')->sortable()->searchable(),
            ])
            ->filters([
            SelectFilter::make('genre')
                ->options(
                    collect(MovieGenreEnums::cases())
                        ->mapWithKeys(
                            fn($case) =>
                            [
                                $case->value => $case->label(),
                            ]
                        )
                )
                ->preload()
                ->searchable(),
            SelectFilter::make('language')
                ->options(
                    collect(MovieLanguageEnums::cases())
                        ->mapWithKeys(
                            fn($case) =>
                            [
                                $case->value => $case->label(),
                            ]
                        )
                )
                ->preload()
                ->searchable(),
            TernaryFilter::make('is_public')->preload(),
        ])
            ->actions([
                Tables\Actions\EditAction::make(),
            Tables\Actions\Action::make('delete')
                ->label('Delete')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->action(fn($record) => self::deleteMovie($record)),
            ])
            ->bulkActions([
            Tables\Actions\BulkAction::make('delete')
                ->label('Delete Selected movies')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->action(fn($records) => $records->each(fn($record) => self::deleteMovie($record)))
            ]);
    }

    protected static function deleteMovie(MovieDetail $record): void
    {
        $movie = Movie::findOrFail($record->movie_id);
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMovies::route('/'),
            'create' => Pages\CreateMovie::route('/create'),
            'edit' => Pages\EditMovie::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = Filament::auth()->user();
        return $user && $user->hasRole(RoleEnums::Admin) || $user->hasRole(RoleEnums::Uploader);
    }
}
