<?php

namespace App\Filament\Resources\MenuItems;

use App\Filament\Resources\MenuItems\Pages\CreateMenuItem;
use App\Filament\Resources\MenuItems\Pages\EditMenuItem;
use App\Filament\Resources\MenuItems\Pages\ListMenuItems;
use App\Filament\Resources\MenuItems\Schemas\MenuItemForm;
use App\Filament\Resources\MenuItems\Tables\MenuItemsTable;
use App\Models\MenuItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Menü Öğeleri';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                \Filament\Forms\Components\Select::make('menu_id')
                    ->label('Menü')
                    ->relationship('menu', 'name')
                    ->required()
                    ->searchable()
                    ->helperText('Bu öğenin hangi menüye ait olduğu'),
                \Filament\Forms\Components\Select::make('parent_id')
                    ->label('Üst Menü Öğesi')
                    ->relationship('parent', 'title')
                    ->searchable()
                    ->helperText('Alt menü için üst öğeyi seçin'),
                \Filament\Forms\Components\TextInput::make('title')
                    ->label('Menü Başlığı')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Örn: Hakkımızda')
                    ->helperText('Menüde görünecek başlık'),
                \Filament\Forms\Components\TextInput::make('slug')
                    ->label('Menü Kodu')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->placeholder('about-us')
                    ->helperText('Menü öğesinin benzersiz kodu'),
                \Filament\Forms\Components\Select::make('type')
                    ->label('Tür')
                    ->options([
                        'link' => 'Bağlantı',
                        'page' => 'Sayfa',
                        'custom' => 'Özel',
                    ])
                    ->default('link')
                    ->required()
                    ->helperText('Menü öğesinin türü'),
                \Filament\Forms\Components\TextInput::make('url')
                    ->label('URL Adresi')
                    ->maxLength(255)
                    ->placeholder('https://example.com')
                    ->helperText('Bağlantı türü için URL adresi'),
                \Filament\Forms\Components\Select::make('page_id')
                    ->label('Bağlanacak Sayfa')
                    ->relationship('page', 'title')
                    ->searchable()
                    ->helperText('Sayfa türü için bağlanacak sayfa')
                    ->visible(fn ($get) => $get('type') === 'page'),
                \Filament\Forms\Components\Select::make('target')
                    ->label('Hedef')
                    ->options([
                        '_self' => 'Aynı Pencere',
                        '_blank' => 'Yeni Pencere',
                    ])
                    ->default('_self')
                    ->helperText('Bağlantının nasıl açılacağı'),
                \Filament\Forms\Components\TextInput::make('icon')
                    ->label('İkon')
                    ->maxLength(255)
                    ->placeholder('heroicon-o-home')
                    ->helperText('Menü öğesi için ikon (Heroicon)'),
                \Filament\Forms\Components\TextInput::make('order')
                    ->label('Sıralama')
                    ->numeric()
                    ->default(0)
                    ->helperText('Menüdeki sıralama (0 = en üst)'),
                \Filament\Forms\Components\Textarea::make('description')
                    ->label('Açıklama')
                    ->rows(2)
                    ->maxLength(500)
                    ->placeholder('Menü öğesi hakkında kısa açıklama...')
                    ->helperText('Menü öğesi için açıklama (opsiyonel)'),
                \Filament\Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Menü öğesinin görünür olup olmadığı'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('menu.name')
                    ->label('Menü')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('parent.title')
                    ->label('Üst Öğe')
                    ->sortable(),
                \Filament\Tables\Columns\BadgeColumn::make('type')
                    ->label('Tür')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'link' => 'info',
                        'page' => 'success',
                        'custom' => 'warning',
                    }),
                \Filament\Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
                \Filament\Tables\Columns\TextColumn::make('order')
                    ->label('Sıralama')
                    ->sortable(),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('menu')
                    ->label('Menü')
                    ->relationship('menu', 'name'),
                \Filament\Tables\Filters\SelectFilter::make('type')
                    ->label('Tür')
                    ->options([
                        'link' => 'Bağlantı',
                        'page' => 'Sayfa',
                        'custom' => 'Özel',
                    ]),
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ])
            ->defaultSort('order', 'asc');
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
            'index' => ListMenuItems::route('/'),
            'create' => CreateMenuItem::route('/create'),
            'edit' => EditMenuItem::route('/{record}/edit'),
        ];
    }
}
