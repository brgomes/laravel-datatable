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
                            <button class="btn btn-default btn-transparent" title="{{ $button['title'] }}" data-toggle="modal" data-target="{{ $button['modal'] }}" id="{{ $button['id'] }}">
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
                                            @if (isset($action['url']))
                                                <a href="#" data-modal="#datatable-modal-action{{ $action['id'] }}" data-action-id="{{ $action['id'] }}">
                                                    @if (isset($action['icon']))
                                                        <i class="{{ $action['icon'] }}"></i>
                                                    @endif
                                                    {!! $action['label'] !!}
                                                </a>
                                            @elseif (isset($action['modal']))
                                                <a href="#" data-modal="{{ $action['modal'] }}" data-action-id="{{ $action['id'] }}">
                                                    @if (isset($action['icon']))
                                                        <i class="{{ $action['icon'] }}"></i>
                                                    @endif
                                                    {!! $action['label'] !!}
                                                </a>
                                            @elseif (isset($action['js']))
                                                <a href="{{ $action['js'] }}" data-js="true">
                                                    @if (isset($action['icon']))
                                                        <i class="{{ $action['icon'] }}"></i>
                                                    @endif
                                                    {!! $action['label'] !!}
                                                </a>
                                            @endif
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

                                    @if (isset($action['url']))
                                        <a href="#" class="dropdown-item" data-modal="#datatable-modal-action{{ $action['id'] }}" data-action-id="{{ $action['id'] }}">
                                            @if (isset($action['icon']))
                                                <i class="{{ $action['icon'] }}"></i>
                                            @endif
                                            {!! $action['label'] !!}
                                        </a>
                                    @elseif (isset($action['modal']))
                                        <a href="#" class="dropdown-item" data-modal="{{ $action['modal'] }}" data-action-id="{{ $action['id'] }}">
                                            @if (isset($action['icon']))
                                                <i class="{{ $action['icon'] }}"></i>
                                            @endif
                                            {!! $action['label'] !!}
                                        </a>
                                    @endif
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

                @if ((count($modals) > 0) && ($items->count() > 0))
                    @foreach ($modals as $modal)
                        @if ((isset($modal['can']) && auth()->user()) && !auth()->user()->can($modal['can']))
                            @continue
                        @endif

                        <button class="btn btn-default btn-transparent btn-radius" title="{{ $modal['title'] }}" data-toggle="modal" data-target="{{ $modal['modal'] }}">
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
        @else
            <div class="row datatable-header">
                <div class="col-md-12">
                    Total: {{ number_format($items->count(), 0, '', '.') }}
                </div>
            </div>
        @endif
    @endif

    @if ($items->count() == 0)
        <div style="padding:15px 0 40px 0">
            Nenhum registro foi encontrado.
        </div>
    @else
        <div class="row">
            @if (isset($viewResponsive))
                <div class="col-md-12 hidden-lg" id="datatable-responsive{{ $datatableId }}">
                    @foreach ($items as $item)
                        @include($viewResponsive, ['item' => $item])
                    @endforeach
                </div>
            @endif
            <div class="col-md-12 @if (isset($viewResponsive)) hidden-xs hidden-sm hidden-md @endif">
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

                                        @include($view, ['item' => $item])
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{--<div class="modal fade" id="datatable-modal-action{{ $datatableId }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="datatable-modal-action-modal-title">Executar ação em massa</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p id="datatable-modal-action-p-message{{ $datatableId }}">
                                            Confirma o envio das informações?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" id="datatable-btn-confirm{{ $datatableId }}">SIM</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>--}}
                    </form>
                </div>
            </div>
        </div>
    @endif

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
    @else
        <div class="row datatable-footer">
            <div class="col-md-12">
                Total: {{ number_format($items->count(), 0, '', '.') }}
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
                        <button type="submit" class="btn btn-primary">Sim</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if (count($actions) > 0)
        @foreach ($actions as $action)
            @if (isset($action['url']))
                <form method="post" action="{{ $action['url'] }}" id="datatable-form-action{{ $action['id'] }}">
                    @csrf
                    <div class="modal fade" id="datatable-modal-action{{ $action['id'] }}">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">
                                        @if (isset($action['modal-title']))
                                            {!! $action['modal-title'] !!}
                                        @else
                                            Executar ação em massa
                                        @endif
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    @if ($action['sensible'])
                                        <div class="alert-modal">
                                            ⚠️ &nbsp; Esta ação não pode ser desfeita.
                                        </div>
                                    @endif

                                    <div>
                                        @if (isset($action['message']))
                                            {!! nl2br($action['message']) !!}
                                        @else
                                            Confirma o envio das informações?
                                        @endif
                                    </div>

                                    @if (isset($action['keyword']))
                                        <div class="form-group" style="margin-top:20px">
                                            <label for="datatable-modal-action-keyword{{ $action['id'] }}" style="font-weight:normal">Para confirmar a ação, digite "{{ $action['keyword'] }}" abaixo:</label>
                                            <input type="text" name="keyword" value="" class="form-control" id="datatable-modal-action-keyword{{ $action['id'] }}" placeholder="{{ $action['keyword'] }}" required>
                                        </div>
                                    @endif

                                    @if (isset($action['input']))
                                        <div class="form-group" style="margin-top:20px">
                                            <label for="datatable-modal-action-input{{ $action['id'] }}" style="font-weight:normal">{{ $action['input']['label'] }}</label>
                                            <input type="{{ $action['input']['type'] }}" name="{{ $action['input']['name'] }}" value="" class="form-control" id="datatable-modal-action-input{{ $action['id'] }}" placeholder="{{ $action['input']['placeholder'] }}" @if ($action['input']['required']) required @endif>
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="ids" value="">

                                    <button type="submit" class="btn {{ isset($action['submit-color']) ? 'btn-' . $action['submit-color'] : 'btn-primary' }}">
                                        @if (isset($action['submit-label']))
                                            {!! $action['submit-label'] !!}
                                        @else
                                            Sim
                                        @endif
                                    </button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        @endforeach
    @endif

    <div class="modal fade" id="datatable-modal-no-items-selected{{ $datatableId }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Executar ação em massa</h4>
                </div>
                <div class="modal-body">
                    <div class="alert-modal">
                        ⚠️ &nbsp; Você deve selecionar pelo menos um item da lista para executar a ação.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="datatable-modal-forbidden{{ $datatableId }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ação não permitida</h4>
                </div>
                <div class="modal-body">
                    <div class="alert-modal">
                        ⚠️ &nbsp; Você não tem permissão para executar esta ação.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
