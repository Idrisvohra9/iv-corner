<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
// use Closure;
use DateTime;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PostResource extends Resource
{
	protected static ?string $model = Post::class;

	protected static ?string $navigationIcon = 'heroicon-o-document-text';
	protected static ?string $navigationGroup = "Content";

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Section::make("Create and share your blog to the world!")
					->schema([
						Grid::make(2)->schema([
							Forms\Components\TextInput::make('title')
								->required()
								->maxLength(60)
								// To create a automatic slug generation on state change of the title field
								// Make the field reactive
								->reactive()
								->afterStateUpdated(fn ($state, callable $set) => $set("slug", Str::slug($state))),
							Forms\Components\TextInput::make('slug')
								->required()
								->maxLength(60),
						]),
						Forms\Components\FileUpload::make('thumbnail')
							// ->directory("uploads")
							->image()
							->imageEditor()
							->preserveFilenames(),
						Section::make()
							->schema([
								Forms\Components\Select::make('category_id')
									->multiple()
									->relationship('categories', 'title')
									->required()
									->columnSpan(8),
								Forms\Components\Toggle::make('active')
									->required()
									->columnSpan(4),
							]),
						Forms\Components\MarkdownEditor::make('body')
							->toolbarButtons([
								// 'attachFiles',
								'blockquote',
								'bold',
								'bulletList',
								'codeBlock',
								'heading',
								'italic',
								'link',
								'orderedList',
								'redo',
								'strike',
								'table',
								'undo',
							])
							->required()
							->columnSpanFull(),

					])
			])->columns(12);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				Tables\Columns\ImageColumn::make('thumbnail')
					->searchable(),
				Tables\Columns\TextColumn::make('title')
					->searchable(),
				Tables\Columns\IconColumn::make('active')
					->boolean(),
				Tables\Columns\TextColumn::make('published_at')
					->dateTime()
					->sortable(),
				Tables\Columns\TextColumn::make('user.name')
					->numeric()
					->sortable(),
				Tables\Columns\TextColumn::make('created_at')
					->dateTime()
					->sortable()
					->toggleable(isToggledHiddenByDefault: true),

				Tables\Columns\TextColumn::make('updated_at')
					->dateTime()
					->sortable()
					->toggleable(isToggledHiddenByDefault: true),
			])
			->filters([
				//
			])
			->actions([
				// Tables\Actions\ViewAction::make(),
				Tables\Actions\EditAction::make(),
				Tables\Actions\DeleteAction::make(),
			])
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			]);
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
			'index' => Pages\ListPosts::route('/'),
			'create' => Pages\CreatePost::route('/create'),
			'view' => Pages\ViewPost::route('/{record}'),
			'edit' => Pages\EditPost::route('/{record}/edit'),
		];
	}
}
