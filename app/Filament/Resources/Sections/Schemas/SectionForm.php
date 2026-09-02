<?php

namespace App\Filament\Resources\Sections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Section')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Internal')
                            ->helperText('Nama untuk memudahkan identifikasi, mis. "Tentang Saya"')
                            ->required(),
                        Select::make('type')
                            ->label('Tipe Section')
                            ->options([
                                'hero' => 'Hero',
                                'about' => 'Tentang',
                                'skills' => 'Keahlian',
                                'projects' => 'Proyek',
                                'contact' => 'Kontak',
                                'custom' => 'Kustom (teks bebas)',
                            ])
                            ->required()
                            ->native(false),
                        TextInput::make('title')
                            ->label('Judul')
                            ->columnSpanFull(),
                        TextInput::make('subtitle')
                            ->label('Sub Judul')
                            ->columnSpanFull(),
                    ]),
                Section::make('Konten')
                    ->columns(1)
                    ->schema([
                        RichEditor::make('content')
                            ->label('Konten (untuk section Tentang / Kustom)')
                            ->helperText('Kosongkan untuk tipe hero, skills, projects, dan contact — mereka otomatis diisi dari data masing-masing.'),
                        FileUpload::make('image_path')
                            ->label('Gambar Pendukung')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('sections'),
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
