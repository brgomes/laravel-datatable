<?php

namespace Brgomes\LaravelDatatable;

use Illuminate\Database\Eloquent\Builder;

class Datatable
{
    private $content = [];

    public $builder;

    public $perPage;

    public $perPageQuery = 'perPage';

    public function __construct(Builder $builder, $perPage = null)
    {
        $this->builder = $builder;

        $this->perPage = config('datatable.per_page', 20);

        if (isset($perPage)) {
            $this->perPage = $perPage;
        }
    }

    public function __get($key)
    {
        return $this->content[$key] ?? null;
    }

    public function __set($key, $value)
    {
        $this->content[$key] = $value;
    }

    public function builder(Builder $builder)
    {
        $this->builder = $builder;

        return $this;
    }

    public function perPage($perPage)
    {
        $this->perPage = $perPage;

        return $this;
    }

    /**
     * Array lido em App\View\Components\Datatable, como as configurações default
     */
    public function toArray(): array
    {
        return [
            'view' => $this->view,
            'filter' => $this->filter,
            'builder' => $this->builder,
            'perPage' => $this->perPage,
            'perPageQuery' => $this->perPageQuery,
            'headers' => $this->headers(),
            'search' => $this->search(),
            'buttons' => $this->buttons(),
            'actions' => $this->actions(),
            'modals' => $this->modals(),
            'autoCheckbox' => $this->autoCheckbox,
        ];
    }

    public function headers(): array
    {
        return [];
    }

    /**
     * type: button | modal | a
     * button: id, title, content
     * modal: id, title, modal, content
     * a: id, href, title, content
     */
    public function buttons(): array
    {
        return [];
    }

    public function search(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [];
    }

    public function modals(): array
    {
        return [];
    }

    /*public function perPage(int $qtde)
    {
        $this->perPage = $qtde;

        return $this;
    }

    public function builder(Builder $builder)
    {
        $this->builder = $builder;

        return $this;
    }*/
}
