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

$('.dropdown-menu-actions li a').on('click', function(e) {
    var id = $(e.target).closest('div.datatable').data('datatableid');

    if (id != undefined) {
        e.preventDefault();
        var table = $('#datatable' + id);
        var modal = $(e.target).data('modal');
        var items = $('td:first-child input:checkbox:checked', table);

        if (items.length == 0) {
            $('#datatable-modal-no-items-selected' + id).modal();
        } else {
            var values = items.map(function(){
                return $(this).val();
            }).get();

            $(modal).children().children().find('input[type=hidden][name="ids"]').val(values.join(','));
            $(modal).modal();
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
