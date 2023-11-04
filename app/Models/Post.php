<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\PostFactory;

class Post extends Model
{
	use HasFactory;
	protected $fillable = [
		"title",
		"slug",
		"thumbnail",
		"body",
		"active",
		"published_at",
		"user_id",
	];
// This is realted to the carbon instance of datetime formatting:
	protected $casts = [
		"published_at" => "datetime",
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function categories(): BelongsToMany
	{
		return $this->belongsToMany(Category::class);
	}

	public function shortBody():string
	{
		return Str::words(strip_tags($this->body), 30);
	}

	public function getFormattedDate(){
		return $this->published_at->format("F jS Y");
	}
	protected static function newFactory(): Factory
{
    return PostFactory::new();
}
}
