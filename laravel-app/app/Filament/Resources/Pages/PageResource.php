<?php

namespace App\Filament\Resources\Pages;

use App\Filament\Resources\Pages\Pages\CreatePage;
use App\Filament\Resources\Pages\Pages\EditPage;
use App\Filament\Resources\Pages\Pages\ListPages;
use App\Filament\Resources\Pages\Schemas\PageForm;
use App\Filament\Resources\Pages\Tables\PagesTable;
use App\Models\Page;
use BackedEnum;
use Illuminate\Support\Collection;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('title')
                    ->label('Sayfa Başlığı')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Örn: Hakkımızda')
                    ->helperText('Sayfanın ana başlığı. SEO için önemlidir.'),
                TextInput::make('slug')
                    ->label('URL Adresi')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->placeholder('hakkimizda')
                    ->helperText('Sayfanın URL adresi. Türkçe karakter kullanmayın.'),
                Select::make('status')
                    ->label('Yayın Durumu')
                    ->options([
                        'draft' => 'Taslak',
                        'published' => 'Yayınlandı',
                        'private' => 'Özel',
                    ])
                    ->default('draft')
                    ->required()
                    ->helperText('Sayfanın görünürlük durumu'),
                Select::make('author_id')
                    ->label('Yazar')
                    ->relationship('author', 'name')
                    ->required()
                    ->default(auth()->id())
                    ->helperText('Sayfayı oluşturan yazar'),
                DateTimePicker::make('published_at')
                    ->label('Yayın Tarihi')
                    ->nullable()
                    ->helperText('Sayfanın yayınlanacağı tarih'),
                TextInput::make('order')
                    ->label('Sıralama')
                    ->numeric()
                    ->default(0)
                    ->helperText('Menüdeki sıralama (0 = en üst)'),
                \Filament\Forms\Components\Toggle::make('is_featured')
                    ->label('Öne Çıkan')
                    ->default(false)
                    ->helperText('Ana sayfada öne çıkarılsın mı?'),
                Textarea::make('excerpt')
                    ->label('Sayfa Özeti')
                    ->rows(3)
                    ->maxLength(500)
                    ->placeholder('Sayfanın kısa özeti...')
                    ->helperText('Sayfanın kısa açıklaması. Ana sayfada görünebilir.')
                    ->columnSpanFull(),

                RichEditor::make('content')
                    ->label('Sayfa İçeriği')
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'link',
                        'bulletList',
                        'orderedList',
                        'h2',
                        'h3',
                        'blockquote',
                        'codeBlock',
                    ])
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('pages/attachments')
                    ->fileAttachmentsVisibility('public')
                    ->helperText('Sayfanın ana içeriği. Zengin metin editörü kullanabilirsiniz.')
                    ->columnSpanFull(),

                FileUpload::make('featured_image')
                    ->label('Öne Çıkan Görsel')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1200')
                    ->imageResizeTargetHeight('675')
                    ->directory('pages/featured')
                    ->visibility('public')
                    ->helperText('Sayfanın öne çıkan görseli. 16:9 oranında olmalıdır.')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(2048)
                    ->columnSpanFull(),
                TextInput::make('meta_title')
                    ->label('Meta Başlık')
                    ->maxLength(60)
                    ->placeholder('SEO için özel başlık')
                    ->helperText('Arama motorları için özel başlık (60 karakter)'),
                Textarea::make('meta_description')
                    ->label('Meta Açıklama')
                    ->rows(3)
                    ->maxLength(160)
                    ->placeholder('Sayfanın kısa açıklaması...')
                    ->helperText('Arama motorları için açıklama (160 karakter)'),
                TextInput::make('meta_keywords')
                    ->label('Anahtar Kelimeler')
                    ->maxLength(255)
                    ->placeholder('anahtar, kelime, seo')
                    ->helperText('Virgülle ayrılmış anahtar kelimeler'),
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
                \Filament\Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),
                \Filament\Tables\Columns\BadgeColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        'private' => 'danger',
                    }),
                \Filament\Tables\Columns\TextColumn::make('author.name')
                    ->label('Yazar')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('published_at')
                    ->label('Yayın Tarihi')
                    ->dateTime()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma Tarihi')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('status')
                    ->label('Durum')
                    ->options([
                        'draft' => 'Taslak',
                        'published' => 'Yayınlandı',
                        'private' => 'Özel',
                    ]),
                \Filament\Tables\Filters\SelectFilter::make('author')
                    ->label('Yazar')
                    ->relationship('author', 'name'),
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => \App\Filament\Resources\Pages\Pages\ListPages::route('/'),
            'create' => \App\Filament\Resources\Pages\Pages\CreatePage::route('/create'),
            'edit' => \App\Filament\Resources\Pages\Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
