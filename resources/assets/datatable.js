$('.datatable-select').on('change', function (e) {
    var table = $(e.target).closest('table');
    var items = $('td:first-child input:checkbox', table);
    var checked = this.checked;

    items.each(function () {
        if ($(this).prop('disabled') == false) {
            $(this).prop('checked', checked);
        }
    });
});

/*$('#modal-datatable-action').on('show.bs.modal', function(e) {
    var id = $(e.target).parent().parent().data('datatable');

    if (id != undefined) {
        e.preventDefault();
        var table = $('#datatable' + id)
        var items = $('td:first-child input:checkbox:checked', table);

        if (items.length == 0) {
            alert('Selecione pelo menos um item na lista.');
        } else {
            if (confirm('Confirma o envio das informações?')) {
                var form = $('#datatable-form' + id);
                var action = $(e.target).data('url');
                form.prop('action', action);
                form.submit();
            }
        }
    }
});*/

$('.dropdown-menu-actions li a').on('click', function(e) {
    //var id = $(e.target).parent().parent().data('datatable');
    var id = $(e.target).closest('div.datatable').data('datatableid');

    if (id != undefined) {
        e.preventDefault();
        var table = $('#datatable' + id);
        var form = $('#datatable-form' + id);
        var action = $(e.target).data('url');
        var items = $('td:first-child input:checkbox:checked', table);

        if (items.length == 0) {
            $('#datatable-msg-no-items' + id).css('display', 'block');
            $('#datatable-msg-confirm' + id).css('display', 'none');
            $('#datatable-btn-confirm' + id).css('display', 'none');
            //alert('Selecione pelo menos um item na lista.');
        } else {
            form.prop('action', action);
            $('#datatable-msg-no-items' + id).css('display', 'none');
            $('#datatable-msg-confirm' + id).css('display', 'block');
            $('#datatable-btn-confirm' + id).css('display', 'inline-block');
            /*if (confirm('Confirma o envio das informações?')) {
                var form = $('#datatable-form' + id);
                var action = $(e.target).data('url');
                form.prop('action', action);
                form.submit();
            }*/
        }
    }
});

$('a.datatable-link').on('click', function(e) {
    var id = $(e.target).closest('div.datatable').data('datatableid');

    if (id != undefined) {
        e.preventDefault();
        var modal = $('#datatable-modal-link' + id);
        var form = $('#datatable-form-link' + id);
        var title = $(e.target).data('title');
        var action = $(e.target).data('url');

        form.prop('action', action);
        modal.find('.modal-title').html(title);
        modal.modal();
    }
});

$('.data-modal').on('click', function(e) {
    e.preventDefault();

    var modal = $(this).data('modal');
    var json = $(this).data('json');

    $.each(json, function(i, item) {
        var obj = $('#' + i);

        if (obj.attr('type') == 'checkbox') {
            obj.prop('checked', (item == 1));
        } else {
            obj.val(item);
        }
    });

    $(modal).modal();
});
