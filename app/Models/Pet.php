<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Pet extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['name', 'description', 'last_location', 'status', 'species', 'breed', 'is_protected', 'reported_by'];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function getSpeciesName()
    {
        return match ($this->species) {
            'cat' => 'Gato',
            'dog' => 'Perro',
            default => 'Otro',
        };
    }

    public function getStatusName()
    {
        return $this->status == 'missing' ? 'Perdido' : 'Encontrado *';
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by', 'id');
    }
}
