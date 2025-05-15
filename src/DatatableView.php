<?php

namespace Brgomes\LaravelDatatable;

use Illuminate\View\Component;

class DatatableView extends Component
{
    public $datatableId;
    public $items;

    public $route;
    public $view;
    public $viewResponsive;
    public $filter;
    public $builder;
    public $homeURL;
    public $perPage;
    public $perPageQuery;
    public $headers;
    public $search;
    public $searchPhdr;
    public $searchName;
    public $actions;
    public $autoCheckbox;
    public $buttons;
    public $modals;

    public function __construct(Datatable $props)
    {
        [
            'view'           => $view,
            'viewResponsive' => $viewResponsive,
            'filter'         => $filter,
            'homeURL'        => $homeURL,
            'builder'        => $builder,
            'perPage'        => $perPage,
            'perPageQuery'   => $perPageQuery,
            'headers'        => $headers,
            'search'         => $search,
            'actions'        => $actions,
            'autoCheckbox'   => $autoCheckbox,
            'buttons'        => $buttons,
            'modals'         => $modals,
        ] = array_merge([
            'view'           => null,
            'viewResponsive' => null,
            'filter'         => null,
            'builder'        => null,
            'homeURL'        => null,
            'perPage'        => null,
            'perPageQuery'   => null,
            'headers'        => [],
            'search'         => [],
            'actions'        => [],
            'autoCheckbox'   => true,
            'buttons'        => [],
            'modals'         => [],
        ], $props->toArray());

        if ($builder instanceof \Illuminate\Database\Eloquent\Collection) {
            $items = $builder;
        } else {
            $param = request()->get($perPageQuery);
            $perPage = isset($param) ? $param : (int) $perPage;

            if ($perPage > 0) {
                $items = $props->builder->paginate($perPage)->appends(request()->all());;
            } else {
                $items = $props->builder->get();
            }
        }

        $this->datatableId = uniqid();
        $this->view = $view;
        $this->viewResponsive = $viewResponsive;
        $this->filter = $filter;
        $this->items = $items;
        $this->homeURL = $homeURL;
        $this->perPage = $perPage;
        $this->perPageQuery = $perPageQuery;
        $this->headers = $this->buildHeaders($headers);
        $this->search = $this->buildSearch($search);
        $this->actions = $this->buildActions($actions);
        $this->autoCheckbox = $autoCheckbox;
        $this->buttons = $buttons;
        $this->modals = $modals;
    }

    private function buildHeaders($headers): array
    {
        return array_map(function ($props) {
            [
                $label,
                $width
            ] = array_pad(explode(':', $props), 2, null);

            $width = $width ?: 'auto';

            return [$label, $width];
        }, $headers);
    }

    private function buildSearch($search): array
    {
        return array_merge([
            'visible' => false,
            'name' => 'q',
            'placeholder' => 'Pesquisar',
        ], $search);
    }

    private function buildActions($actions): array
    {
        return array_map(function ($props) {
            return array_merge([
                'id' => uniqid(),
                'sensible' => false,
            ], $props);
        }, $actions);
    }

    public function render()
    {
        return view('datatable::datatable', [
            'view' => $this->view,
        ]);
    }
}
