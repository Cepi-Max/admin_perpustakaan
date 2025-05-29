<?php

namespace App\Models;

use App\Models\KategoriBerita;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{

    use HasFactory;

    protected $fillable = ['slug', 'title', 'body', 'image', 'inovator', 'seen'];
    protected $with = ['author', 'kategori_berita'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kategori_berita(): BelongsTo
    {
        return $this->belongsTo(KategoriBerita::class, 'berita_category_id');
    }

    public function scopeFilter(Builder $query, array $filter): void
    {
        $query->when($filter['search'] ?? false, 
        fn($query, $search)=>
            $query->where('title', 'like', "%{$search}%")
        );

        $query->when($filter['kategori'] ?? false, 
        fn($query, $kategori_berita)=>
            $query->whereHas('kategori_berita', fn($query)=>$query->where('slug', $kategori_berita))
        );

        $query->when($filter['admin'] ?? false, 
        fn($query, $author)=>
            $query->whereHas('author', fn($query)=>$query->where('name', $author))
        );

        $query->when($filter['author'] ?? false, 
            fn($query, $inovator) =>
                $query->where('inovator', $inovator)
        );
    }

}
