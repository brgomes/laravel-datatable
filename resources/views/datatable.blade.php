<div class="datatable" data-datatableid="{{ $datatableId }}">
    @if (($perPage > 0) || (count($actions) > 0) || $filter || $search['visible'] || (count($buttons) > 0) || (count($modals) > 0))
        <div class="row" style="margin-bottom:15px">
            <div class="col-lg-8 col-md-6">
                <a href="{{ request()->url() }}" class="btn btn-default btn-transparent" title="Listagem inicial"><i class="fa fa-list"></i></a>

                @if (count($buttons) > 0)
                    @foreach ($buttons as $button)
                        @if ((isset($button['can']) && auth()->user()) && !auth()->user()->can($button['can']))
                            @continue
                        @endif

                        @if ($button['type'] == 'button')
                            <button class="btn btn-default btn-transparent" title="{{ $button['title'] }}" id="{{ $button['id'] }}">
                                {!! $button['content'] !!}
                            </button>
                        @elseif ($button['type'] == 'modal')
                            <button class="btn btn-default btn-transparent" title="{{ $button['title'] }}" data-toggle="modal" data-target="#{{ $button['modal'] }}" id="{{ $button['id'] }}">
                                {!! $button['content'] !!}
                            </button>
                        @elseif ($button['type'] == 'a')
                            <a href="{{ $button['href'] }}" class="btn btn-default btn-transparent" title="{{ $button['title'] }}" id="{{ $button['id'] }}">
                                {!! $button['content'] !!}
                            </a>
                        @endif
                    @endforeach
                @endif

                <a href="" class="btn btn-default btn-transparent" title="Atualizar"><i class="fa fa-refresh"></i></a>

                @if ($perPage > 0)
                    <div class="dropdown" title="Itens por página">
                        <button class="btn btn-default btn-transparent dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            {{ $perPage }}&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                        </button>

                        @if (config('datatable.default_view') == 'bootstrap-3')
                            <ul class="dropdown-menu">
                                <!--<li><a href="{{ request()->fullUrlWithQuery([$perPageQuery => 5, 'page' => 1]) }}">5</a></li>-->
                                <li><a href="{{ request()->fullUrlWithQuery([$perPageQuery => 10, 'page' => 1]) }}">10</a></li>
                                <li><a href="{{ request()->fullUrlWithQuery([$perPageQuery => 15, 'page' => 1]) }}">15</a></li>
                                <li><a href="{{ request()->fullUrlWithQuery([$perPageQuery => 20, 'page' => 1]) }}">20</a></li>
                                <li><a href="{{ request()->fullUrlWithQuery([$perPageQuery => 25, 'page' => 1]) }}">25</a></li>
                                <li><a href="{{ request()->fullUrlWithQuery([$perPageQuery => 50, 'page' => 1]) }}">50</a></li>
                                <li><a href="{{ request()->fullUrlWithQuery([$perPageQuery => 100, 'page' => 1]) }}">100</a></li>
                            </ul>
                        @elseif (config('datatable.default_view') == 'bootstrap-4')
                            <div class="dropdown-menu">
                                <!--<a class="dropdown-item" href="{{ request()->fullUrlWithQuery([$perPageQuery => 5, 'page' => 1]) }}">5</a>-->
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery([$perPageQuery => 10, 'page' => 1]) }}">10</a>
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery([$perPageQuery => 15, 'page' => 1]) }}">15</a>
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery([$perPageQuery => 20, 'page' => 1]) }}">20</a>
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery([$perPageQuery => 25, 'page' => 1]) }}">25</a>
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery([$perPageQuery => 50, 'page' => 1]) }}">50</a>
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery([$perPageQuery => 100, 'page' => 1]) }}">100</a>
                            </div>
                        @endif
                    </div>
                @endif

                @if (count($actions) > 0)
                    <div class="dropdown">
                        <button class="btn btn-default btn-transparent dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Ações&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                        </button>

                        @if (config('datatable.default_view') == 'bootstrap-3')
                            <ul class="dropdown-menu dropdown-menu-actions">
                                @foreach ($actions as $action)
                                    @if ((isset($action['can']) && auth()->user()) && !auth()->user()->can($action['can']))
                                        <li>
                                            <a href="#" data-toggle="modal" data-target="#datatable-modal-forbidden{{ $datatableId }}" class="disabled">{!! $action['label'] !!}</a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="#" data-toggle="modal" data-target="#datatable-modal-action{{ $datatableId }}" data-url="{{ $action['url'] }}">
                                                @if (isset($action['icon']))
                                                    <i class="{{ $action['icon'] }}"></i>
                                                @endif
                                                {!! $action['label'] !!}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @elseif (config('datatable.default_view') == 'bootstrap-4')
                            <div class="dropdown-menu dropdown-menu-actions">
                                @foreach ($actions as $action)
                                    @if ((isset($action['can']) && auth()->user()) && !auth()->user()->can($action['can']))
                                        @continue
                                    @endif

                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#datatable-modal-action{{ $datatableId }}" data-url="{{ $action['url'] }}">
                                        @if (isset($action['icon']))
                                            <i class="{{ $action['icon'] }}"></i>
                                        @endif
                                        {!! $action['label'] !!}
                                    </a>
                                @endforeach
                                </div>
                        @endif
                    </div>
                @endif

                @if (isset($filter))
                    <button class="btn btn-default btn-transparent btn-radius" title="Filtrar dados" data-toggle="modal" data-target="#{{ $filter }}">
                        <i class="fa fa-filter"></i>
                    </button>
                @endif

                @if (count($modals) > 0)
                    @foreach ($modals as $modal)
                        @if ((isset($modal['can']) && auth()->user()) && !auth()->user()->can($modal['can']))
                            @continue
                        @endif

                        <button class="btn btn-default btn-radius" title="{{ $modal['title'] }}" data-toggle="modal" data-target="#{{ $modal['modal'] }}">
                            <i class="{{ $modal['icon'] }}"></i>
                        </button>
                    @endforeach
                @endif
            </div>
            <div class="col-lg-4 col-md-6 mt-sm-10">
                @if ($search['visible'])
                    <form action="{{ isset($search['action']) ? $search['action'] : null }}" method="get">
                        <div>
                            <div class="form-group">
                                @if (config('datatable.default_view') == 'bootstrap-3')
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                        <input type="text" name="{{ $search['name'] }}" value="{{ request()->input($search['name']) }}" class="form-control" placeholder="{{ $search['placeholder'] }}">
                                    </div>
                                @elseif (config('datatable.default_view') == 'bootstrap-4')
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="{{ $search['name'] }}" value="{{ request()->input($search['name']) }}" class="form-control" placeholder="{{ $search['placeholder'] }}">
                                    </div>
                                @endif

                                <input type="hidden" name="perPage" value="{{ $perPage}}" />
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        @if (($perPage > 0) && ($items->total() > 0))
            <hr>
            <div class="row datatable-header">
                <div class="col-md-12">
                    <div>
                        {{ number_format($items->firstItem(), 0, '', '.') }}-{{ number_format($items->lastItem(), 0, '', '.') }} de {{ number_format($items->total(), 0, '', '.') }}
                    </div>
                    <div style="justify-content:right">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        @endif
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <form method="post" id="datatable-form{{ $datatableId }}">
                    @csrf
                    <table class="table table-condensed cut-off" id="datatable{{ $datatableId }}">
                        <thead>
                            <tr>
                                @if (count($actions) > 0)
                                    <th style="width:25px">
                                        <input type="checkbox" class="datatable-select">
                                    </th>
                                @endif

                                @foreach ($headers as [$label, $width])
                                    <th style="width: {{ $width }}">
                                        {!! $label !!}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    @if ((count($actions) > 0) && $autoCheckbox)
                                        <td>
                                            <input type="checkbox" value="{{ $item->id }}" name="datatable_checkboxes[]">
                                        </td>
                                    @endif

                                    @include($view, $item)
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="modal fade" id="datatable-modal-action{{ $datatableId }}">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Executar ação em massa</h4>
                                </div>
                                <div class="modal-body">
                                    <div id="datatable-msg-no-items{{ $datatableId }}" style="display:none">
                                        ⚠️
                                        Você deve selecionar pelo menos um item da lista para executar a ação.
                                    </div>
                                    <div id="datatable-msg-confirm{{ $datatableId }}" style="display:none">
                                        Confirma o envio das informações?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="datatable-btn-confirm{{ $datatableId }}">Sim</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (($perPage > 0) && ($items->total() > 0))
        <div class="row datatable-footer">
            <div class="col-md-12">
                <div>
                    {{ number_format($items->firstItem(), 0, '', '.') }}-{{ number_format($items->lastItem(), 0, '', '.') }} de {{ number_format($items->total(), 0, '', '.') }}
                </div>
                <div style="justify-content:right">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    @endif

    <form id="datatable-form-link{{ $datatableId }}" action="" method="post">
        @csrf
        <div class="modal fade" id="datatable-modal-link{{ $datatableId }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        Confirma a execução da ação selecionada?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Sim</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="datatable-modal-forbidden{{ $datatableId }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ação não permitida</h4>
                </div>
                <div class="modal-body">
                    ⚠️
                    Você não tem permissão para executar esta ação.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
