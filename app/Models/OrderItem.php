<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Enums\AlignPosition;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Enums\Unit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class OrderItem extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    /**
     * @Protected_variables
     */

    protected $table = 'order_items';

    /**
     * @Public_variables
     */

    public const OPEN = 'OPEN';
    public const VERIFY_BY_ADMINS = 'VERIFY BY ADMINS';
    public const AWAITING_CUSTOMER_RESPONSE = 'AWAITING CUSTOMER RESPONSE';
    public const IN_REVISION = 'IN REVISION';
    public const REJECTED = 'REJECTED';
    public const DONE = 'DONE';

    /**
     * @Relationships
     */

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    /**
     * @Attributes
     */

    /**
     * @Scopes
     */

    /**
     * @Custom_functions
     */

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('portraits')
            ->useDisk('portraitFiles');

        $this->addMediaCollection('designs')
            ->useDisk('designFiles');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('watermark')
            ->nonQueued();

        $this->addMediaConversion('thumb')
            ->nonQueued();
    }
}
