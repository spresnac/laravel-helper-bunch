<?php
namespace spresnac\Helper;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

/**
 * Class PaginationHelper
 *
 * @package App\Helper
 */
class PaginationHelper
{
    /**
     * Generate a laravel default pagination with a collection only
     *
     * @param Collection $items The collection to be displayed as paginated object
     * @param int $perPage Ammount of items per site
     * @param null $page The actual site to be displayed
     * @param array $options Some LengthAwarePaginator options
     * @param string $path Absolute URI to be used in the "links" section
     * @return array
     */
    public static function paginate_collection($items, $perPage = 15, $page = null, $options = [], $path = '') : array
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $lap = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
        $lap->withPath($path);
        return [
            'data' => $lap ->values(),
            'links' => [
                'first' => $lap->url(1),
                'last' => $lap->url($lap->lastPage()),
                'prev' => $lap->previousPageUrl(),
                'next' => $lap->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $lap->currentPage(),
                'from' => $lap->firstItem(),
                'last_page' => $lap->lastPage(),
                'per_page' => $lap->perPage(),
                'to' => $lap->lastItem(),
                'total' => $lap->total(),
            ],
        ];
    }
}
