<?php

namespace App\Filament\Resources\SiteSettings;

use App\Filament\Resources\SiteSettings\Pages\ManageSiteSettings;
use App\Models\SiteSetting;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $modelLabel = 'Pengaturan Situs';

    protected static ?string $pluralModelLabel = 'Pengaturan Situs';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Settings')
                    ->columns(2)
                    ->tabs([
                        Tab::make('Hero & Identitas')
                            ->icon(Heroicon::OutlinedHome)
                            ->schema([
                                TextInput::make('site_title')
                                    ->label('Judul Situs (tab browser)')
                                    ->columnSpanFull(),
                                TextInput::make('hero_greeting')
                                    ->label('Sapaan Hero'),
                                TextInput::make('hero_name')
                                    ->label('Nama di Hero')
                                    ->required(),
                                TextInput::make('hero_tagline')
                                    ->label('Tagline Hero')
                                    ->columnSpanFull(),
                                FileUpload::make('photo_path')
                                    ->label('Foto Profil')
                                    ->image()
                                    ->imageEditor()
                                    ->disk('public')
                                    ->directory('settings')
                                    ->columnSpanFull(),
                                TextInput::make('cv_url')
                                    ->label('URL CV / Resume')
                                    ->url()
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Tentang Saya')
                            ->icon(Heroicon::OutlinedUser)
                            ->schema([
                                RichEditor::make('about_text')
                                    ->label('Tentang Saya')
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Kontak')
                            ->icon(Heroicon::OutlinedEnvelope)
                            ->schema([
                                TextInput::make('email')
                                    ->label('Email')
                                    ->email(),
                                TextInput::make('phone')
                                    ->label('Nomor Telepon')
                                    ->tel(),
                                TextInput::make('whatsapp')
                                    ->label('Nomor WhatsApp (format internasional, mis. 62812xxxxxxx)')
                                    ->tel(),
                                TextInput::make('address')
                                    ->label('Alamat / Lokasi')
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Sosial Media')
                            ->icon(Heroicon::OutlinedShare)
                            ->schema([
                                Repeater::make('socials')
                                    ->label('Tautan Sosial Media')
                                    ->schema([
                                        TextInput::make('platform')
                                            ->label('Platform (mis. GitHub, LinkedIn, Instagram)')
                                            ->required(),
                                        TextInput::make('url')
                                            ->label('URL')
                                            ->url()
                                            ->required(),
                                    ])
                                    ->reorderable()
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hero_name')
                    ->label('Nama'),
                TextColumn::make('email')
                    ->label('Email'),
                IconColumn::make('photo_path')
                    ->label('Foto')
                    ->boolean(),
            ])
            ->recordActions([
                EditAction::make()
                    ->modalHeading('Edit Pengaturan Situs')
                    ->modalWidth('4xl'),
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSiteSettings::route('/'),
        ];
    }
}
