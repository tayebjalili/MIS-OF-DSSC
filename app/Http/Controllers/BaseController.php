<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class BaseController extends Controller
{
    protected $pageKey;

    public function __construct()
    {
        // Set locale globally for all child controllers
        App::setLocale(Session::get('locale', config('app.locale')));
    }

    /**
     * Apply sorting to a query
     */
    protected function applySorting($query, Request $request)
    {
        $sortConfig = config("sorting.{$this->pageKey}");

        // If no pageKey is set or config doesn't exist, return original query
        if (!$this->pageKey || !$sortConfig) {
            return $query;
        }

        $sortableFields = array_keys($sortConfig['columns']);

        $sortField = $request->get('sort', $sortConfig['default']['field']);
        $sortDirection = $request->get('direction', $sortConfig['default']['direction']);

        // Validate fields
        if (!in_array($sortField, $sortableFields)) {
            $sortField = $sortConfig['default']['field'];
        }

        if (!in_array(strtolower($sortDirection), ['asc', 'desc'])) {
            $sortDirection = $sortConfig['default']['direction'];
        }

        return $query->sort($sortField, $sortDirection);
    }

    /**
     * Get sortable columns for current page
     */
    protected function getSortableColumns()
    {
        if (!$this->pageKey || !config("sorting.{$this->pageKey}")) {
            return [];
        }

        return config("sorting.{$this->pageKey}.columns");
    }

    /**
     * Get current sort state
     */
    protected function getCurrentSort(Request $request)
    {
        if (!$this->pageKey || !config("sorting.{$this->pageKey}")) {
            return [
                'field' => null,
                'direction' => null
            ];
        }

        return [
            'field' => $request->get('sort', config("sorting.{$this->pageKey}.default.field")),
            'direction' => $request->get('direction', config("sorting.{$this->pageKey}.default.direction"))
        ];
    }

    /**
     * Common method to handle sorted index pages
     */
    protected function handleSortedIndex(Request $request, $query, $view, $additionalData = [])
    {
        $query = $this->applySorting($query, $request);
        $data = $query->paginate(15);

        $viewData = array_merge([
            'data' => $data,
            'sortableColumns' => $this->getSortableColumns(),
            'currentSort' => $this->getCurrentSort($request)
        ], $additionalData);

        return view($view, $viewData);
    }
}
