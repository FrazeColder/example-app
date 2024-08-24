<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Order extends Model
{
    use HasFactory;

    /**
     * @Protected_variables
     */

    protected $table = 'orders';

    /**
     * @Public_variables
     */

    public const OPEN = 'OPEN';
    public const AWAITING_CUSTOMER_RESPONSE = 'AWAITING CUSTOMER RESPONSE';
    public const IN_REVISION = 'IN REVISION';
    public const REJECTED = 'REJECTED';
    public const PRINTING = 'PRINTING';
    public const SHIPPING = 'SHIPPING';
    public const DONE = 'DONE';

    /**
     * @Relationships
     */

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
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

    /**
     * @return string[]
     *
     * @codeCoverageIgnore
     */
    public static function ordersToBeDone(): array
    {
        return [Order::OPEN, Order::AWAITING_CUSTOMER_RESPONSE, Order::IN_REVISION, Order::REJECTED];
    }
}
