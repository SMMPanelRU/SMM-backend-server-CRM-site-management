<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OrderItem
 *
 * @property int                             $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int                             $order_id
 * @property int                             $product_id
 * @property int                             $count
 * @property int|null                        $done_count
 * @property int                             $export_system_product_id
 * @property int|null                        $export_system_status
 * @property string|null                     $export_system_status_description
 * @property-read \App\Models\ExportSystem   $exportSystem
 * @property-read \App\Models\Order          $order
 * @property-read \App\Models\Product        $product
 * @method static Builder|OrderItem newModelQuery()
 * @method static Builder|OrderItem newQuery()
 * @method static Builder|OrderItem query()
 * @method static Builder|OrderItem whereCount($value)
 * @method static Builder|OrderItem whereCreatedAt($value)
 * @method static Builder|OrderItem whereDoneCount($value)
 * @method static Builder|OrderItem whereExportSystemProductId($value)
 * @method static Builder|OrderItem whereExportSystemStatus($value)
 * @method static Builder|OrderItem whereExportSystemStatusDescription($value)
 * @method static Builder|OrderItem whereId($value)
 * @method static Builder|OrderItem whereOrderId($value)
 * @method static Builder|OrderItem whereProductId($value)
 * @method static Builder|OrderItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderItem extends Model
{
    use HasFactory;

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function exportSystem(): BelongsTo
    {
        return $this->belongsTo(ExportSystem::class);
    }
}
