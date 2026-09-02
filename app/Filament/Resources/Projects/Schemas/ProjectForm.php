<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Proyek')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Proyek')
                            ->required(),
                        TextInput::make('slug')
                            ->label('Slug (opsional, dibuat otomatis jika kosong)')
                            ->helperText('Hanya huruf kecil, angka, dan tanda hubung.'),
                        TextInput::make('link')
                            ->label('Tautan (demo / GitHub)')
                            ->url()
                            ->columnSpanFull(),
                    ]),
                Section::make('Deskripsi')
                    ->columns(1)
                    ->schema([
                        TextInput::make('description')
                            ->label('Deskripsi Singkat')
                            ->helperText('Satu-dua kalimat untuk kartu proyek.'),
                        RichEditor::make('content')
                            ->label('Detail Lengkap (opsional)'),
                    ]),
                Section::make('Media & Tag')
                    ->columns(1)
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Gambar Proyek')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('projects'),
                        TagsInput::make('tags')
                            ->label('Teknologi / Tag')
                            ->placeholder('Tambahkan tag, tekan Enter'),
                    ]),
                Grid::make(2)
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_visible')
                            ->label('Tampil di Website')
                            ->default(true),
                    ]),
            ]);
    }
}
