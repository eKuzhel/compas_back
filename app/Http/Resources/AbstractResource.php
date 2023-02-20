<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="LinksPaginatedResource",
 *     @OA\Property(property="id", type="integer", example="1"),
 *     @OA\Property(property="text", type="string", example="Кот"),
 *)
 *
 * @OA\Schema(
 *     schema="MetaPaginatedResource",
 *     @OA\Property(property="id", type="integer", example="1"),
 *     @OA\Property(property="text", type="string", example="Кот"),
 *)
 */
abstract class AbstractResource extends JsonResource
{
    /**
     * Create a new anonymous resource collection.
     *
     * @param mixed $resource
     *
     * @return \App\Http\Resources\AnonymousResourceCollection
     */
    public static function collection($resource): AnonymousResourceCollection
    {
        return tap(new AnonymousResourceCollection($resource, static::class), function ($collection) {
            if (property_exists(static::class, 'preserveKeys')) {
                $collection->preserveKeys = (new static([]))->preserveKeys === true;
            }
        });
    }
}
