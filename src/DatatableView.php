<?php

namespace Brgomes\LaravelDatatable;

use Illuminate\View\Component;

class DatatableView extends Component
{
    public $datatableId;
    public $items;

    public $route;
    public $view;
    public $filter;
    public $builder;
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
            'view'          => $view,
            'filter'        => $filter,
            'builder'       => $builder,
            'perPage'       => $perPage,
            'perPageQuery'  => $perPageQuery,
            'headers'       => $headers,
            'search'        => $search,
            'actions'       => $actions,
            'autoCheckbox'  => $autoCheckbox,
            'buttons'       => $buttons,
            'modals'        => $modals,
        ] = array_merge([
            'view'          => null,
            'filter'        => null,
            'builder'       => null,
            'perPage'       => null,
            'perPageQuery'  => null,
            'headers'       => [],
            'search'        => [],
            'actions'       => [],
            'autoCheckbox'  => true,
            'buttons'       => [],
            'modals'        => [],
        ], $props->toArray());

        $param = request()->get($perPageQuery);
        $perPage = isset($param) ? $param : (int) $perPage;

        if ($perPage > 0) {
            //$items = $props->builder->paginate($perPage)->withQueryString();
            $items = $props->builder->paginate($perPage)->appends(request()->all());;
        } else {
            $items = $props->builder->get();
        }

        $this->datatableId = uniqid();
        $this->view = $view;
        $this->filter = $filter;
        $this->items = $items;
        $this->perPage = $perPage;
        $this->perPageQuery = $perPageQuery;
        $this->headers = $this->buildHeaders($headers);
        $this->search = $this->buildSearch($search);
        $this->actions = $actions;
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

    public function render()
    {
        return view('datatable::datatable', [
            'view' => $this->view,
        ]);
    }
}
