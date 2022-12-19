$(function(){
    datatables();
    tableSortable();
    bootstrapToggle();
    nestables();
    modals();
    imageUpload();
    repeatable();
    activateTogglers();
    editors();
    masks();
});

function datatables() {

    $('.datatable', document).each(function () {
        var $this = $(this);

        let tableMaster;

        if ($this.closest('.dataTables_wrapper').length === 0) {
            tableMaster = $this.DataTable({
                aaSorting: [],
                pageLength: $this.data('page-length') ? $this.data('page-length') : 25,
                responsive: true,
                searching: !$this.hasClass('table-no-search'),
                paging: !$this.hasClass('table-no-paginate'),
                // language: {
                //     sEmptyTable: lang.trans('datatable.empty_table'),
                //     sInfo: lang.trans('datatable.info'),
                //     sInfoEmpty: lang.trans('datatable.info_empty'),
                //     sInfoFiltered: lang.trans('datatable.info_filtered'),
                //     sInfoPostFix: lang.trans('datatable.info_post_fix'),
                //     sInfoThousands: lang.trans('datatable.info_thousands'),
                //     sLengthMenu: lang.trans('datatable.length_menu'),
                //     sLoadingRecords: lang.trans('datatable.loading_records'),
                //     sProcessing: lang.trans('datatable.processing'),
                //     sZeroRecords: lang.trans('datatable.zero_records'),
                //     sSearch: lang.trans('datatable.search'),
                //     oPaginate: {
                //         sNext: lang.trans('datatable.paginate.next'),
                //         sPrevious: lang.trans('datatable.paginate.previous'),
                //         sFirst: lang.trans('datatable.paginate.first'),
                //         sLast: lang.trans('datatable.paginate.last')
                //     },
                //     oAria: {
                //         sSortAscending: lang.trans('datatable.aria.sort_asc'),
                //         sSortDescending: lang.trans('datatable.aria.sort_desc')
                //     }
                // },
                drawCallback: function () {
                    $('.dt-bootstrap4 ul.pagination').addClass('pagination-sm');
                }
            }).responsive.recalc();

            tableMaster.on( 'page.dt',   function () {
                setTimeout(() => {
                    $('[data-currency]', document).each(function () {
                        var $this = $(this);
                        $this.maskMoney({
                            thousands: '.',
                            decimal: ','
                        });
                    });
                }, 1000);
            });

            // Para exportar para Excel a tabela diretamente da maneira como ela está ordenada/filtrada
            if ($this.hasClass('table-export')) {
                // Coloca o botão
                let formClass = $this.attr('id') + '_export_excel';
                $this.closest('.dataTables_wrapper').append(`
                    <form class="${formClass} mb-0" action="/admin/export/excel" method="POST">
                        <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                        <input type="hidden" name="data">
                        <input type="hidden" name="filename" value="${$this.data('export-filename')}">
                        <button type="button" class="btn btn-info d-block ml-auto mt-1 mr-1">Exportar para Excel</button>
                    </form>
                `);
                $(`.${formClass}`).insertBefore($this.closest('.dataTables_wrapper'));

                // Event listener para exportar
                $this.closest('.dataTables_wrapper').siblings(`.${formClass}`).find('button').on('click', function() {
                    let headers = tableMaster.columns().header().toArray().map(x => x.innerText);
                    let rows = tableMaster.rows({/*page:'current',*/ search: 'applied'}).data().toArray().map(x => x);
                    if (rows.length) {
                        dataTableDirectExport(headers, rows, this);
                    } else {
                        alert('Nenhum registro na tabela.');
                    }
                })
            }
            tableMaster.on('click', '[data-delete]', e => deleteFromTable(e, tableMaster));
        }
    });
}

function tableSortable(ctx) {
    var fixHelper = function(e, ui) {
        ui.children().each(function() {
            $(this).width($(this).width());
        });
        return ui;
    }

    $('[data-table-sortable]', ctx || document).each(function () {
        var $this = $(this);
        var $tbody = $this.find('tbody');

        $tbody.sortable({
            opacity: 0.6,
            cursor: 'move',
            placeholder: 'placeholder',
            helper: fixHelper,
            axis: 'y',
            update: function() {
                var order = $tbody.sortable('serialize');
                // $.post($this.data('url'), order, function(data) {});
                $.ajax({
                    data: order,
                    dataType: 'json',
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: $this.data('url'),
                });
            }
        });
        $tbody.on('click', '[data-delete]', deleteFromTable);
    });
}

function deleteFromTable(e, table = null) {
    var $this = $(e.currentTarget); //$(this);
    let confirmed = true;

    if (!$this.data('direct-delete')) {
        confirmed = confirm('Deseja mesmo deletar esse registro?');
    }
    if (confirmed) {
        $.ajax({
            dataType: 'json',
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: $this.data('href'),
            success: function (data) {
                if (table && table.row) {
                    table.row($this.parents('tr')).remove().draw();
                } else {
                    $this.parents('tr').remove();
                }
                toastr.success('Registro deletado.');
            }
        });
    }
}

function nestables(ctx) {
    $('[data-nestable]', ctx || document).each(function () {
        var $nestable = $(this);
        $nestable.nestable();

        if ($nestable.data('update-url')) {
            $nestable.on('change', function() {
                var data = $nestable.nestable('serialize');
                $.ajax({
                    data: {data},
                    dataType: 'json',
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: $nestable.data('update-url'),
                });
            });
        }
    });
}

function bootstrapToggle(ctx) {
    $('[data-switch]', ctx || document).each(function () {
        var $this = $(this);

        function toggleVisibility() {
            if ($this.data('toggle-visibility')) {
                var $elements = $($this.data('toggle-visibility'));
                var checked = $this.prop('checked');

                if (checked) {
                    $elements.show();
                } else {
                    $elements.hide();
                }
            }
        }

        toggleVisibility();

        $this.bootstrapToggle({
            on: $this.data('on'),
            off: $this.data('off'),
            size: $this.data('size'),
            width: 70
        }).change(function () {
            toggleVisibility();
        });
    });
}

function modals(ctx) {
    // $(ctx || document).on('click', '[data-toggle=modal]', function () {
    $('[data-toggle=modal]').on('click', function () {
        var $this = $(this);
        var $target = $($this.data('target'));

        $target.find('.modal-content').load($this.attr('href'), function () {
            // editors($target, false);
            bootstrapToggle($target);
            imageUpload($target);
            // repeatable($target);
        });

        $target.on('hidden.bs.modal', function () {
            $target.find('.modal-content').empty();
            $target.unbind();
        });
    });
}

function imageUpload(ctx) {
    $('.image-close', document).click(function (e) {
        var $this = $(this);
        var $container = $this.closest('.image-upload');
        var $preview = $container.find('.preview');
        var $upload = $container.find('.upload');
        var $inp = $container.find('[data-image-upload]');
        var $post = $('#post-' + $inp.attr('id'));

        $upload.show();
        $preview.hide().find('img').attr('src', '');
        console.log($post.val());
        $post.val('');

        e.preventDefault();
    });
    
    $('[data-image-upload]', document).change(function (e) {
        var $this = $(this);
        var $container = $this.closest('.image-upload');
        var $preview = $container.find('.preview');
        var $upload = $container.find('.upload');
        var $post = $('#post-' + $this.attr('id'));
        var $icon = $container.find('.image-icon');

        var formData = new FormData();
        formData.append($this.data('name'), e.target.files[0]);

        $container.removeClass('is-invalid');
        $icon.html('<i class="fas fa-circle-notch fa-spin"></i>');

        $.ajax({
            url: $this.data('url'),
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $upload.hide();
                $preview.show().find('img').attr('src', data.preview);
                $post.val(data.name);

                $icon.html('<i class="fa fa-upload"></i>');
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $container.addClass('is-invalid');
                    $container.after('<div class="invalid-feedback">' + errors[$this.data('name')][0] + '</div>')
                }

                $icon.html('<i class="fa fa-upload"></i>');
            },
            cache: false,
            contentType: false,
            processData: false,
            xhr: function() {
                var xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', function(e) {
                        if (e.loaded >= e.total) {
                            $icon.html('<i class="fa fa-upload"></i>');
                        } else {

                        }
                    }, false);
                }
                return xhr;
            }
        });
    });
}

function repeatable(ctx) {
    $('.repeatable-container', ctx || document).each(function () {
        var $this = $(this);
        $this.repeatable({
            template: $this.data('template'),
            addTrigger: $this.data('add-trigger'),
            deleteTrigger: $this.data('delete-trigger')
        });
    });
}

function activateTogglers() {
    $('*[data-toggle-target]').off('click');
    $('*[data-hide-target]').off('click');
    $('*[data-show-target]').off('click');
    $('*[data-toggle-target]').on('click', toggleTarget);
    $('*[data-hide-target]').on('click', hideTarget);
    $('*[data-show-target]').on('click', showTarget);
}

function toggleTarget(e) {
    let target = $(this).data("toggle-target");
    try {
        target = target.split('|');
        for (let t of target) {
            $(t).toggle(200);
        }
    } catch (ex) {
    }
}

function hideTarget(e) {
    let target = $(this).data("hide-target");
    try {
        target = target.split('|');
        for (let t of target) {
            $(t).hide(200);
        }
    } catch (ex) {
    }
}

function showTarget(e) {
    let target = $(this).data("show-target");
    try {
        target = target.split('|');
        for (let t of target) {
            $(t).show(200);
        }
    } catch (ex) {
    }
}

$(document).on('submit', 'form[data-ajax-velho]', function (e) {
    e.preventDefault();
    var $this = $(e.target); // $(this)
    var $button = $this.find('button[type=submit]');
    $button.attr('disabled', true);
    $.ajax({
        data: $this.serialize(),
        url: $this.attr('action'),
        type: 'post',
        success: function (data) {
            toastr.success('Sucesso.');
            $button.attr('disabled', false);
            $('.is-invalid').removeClass('is-invalid');
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
    
                for (var field in errors) {
                    var $field = $this.find('[id=' + field.replace('.', '-') + ']:visible');
                    var error = errors[field][0];
    
                    if ($field.length > 0) {
                        var $group = $field.closest('.form-group');
                        var $error = $group.find('.invalid-feedback');
    
                        $field.addClass('is-invalid');
    
                        if ($error.length > 0) {
                            $error.html(error);
                        } else {
                            $group.append('<div class="invalid-feedback">' + error + '</div>');
                        }
                    } else {
                        toastr.error(error);
                    }
                }
            }
            if (xhr.status === 500) {
                toastr.error(xhr.message || 'Ocorreu um erro.');
            }
            $button.attr('disabled', false);
        }
    });
});

/* -------------------------------- CK Editor ------------------------------- */
// function editors(ctx, refresh) {
//     var $editor = $('[data-editor]', ctx || document);
//     var refresh = refresh === undefined ? false : refresh;

//     function MyCustomUploadAdapterPlugin( editor ) {
//         editor.plugins.get('FileRepository').createUploadAdapter = ( loader ) => {
//             return new MyUploadAdapter(loader);
//         };
//     }

//     $editor.each(function () {
//         var $this = $(this);

//         ClassicEditor
//             .create($this[0], {
//                 extraPlugins: [ MyCustomUploadAdapterPlugin ],
//                 language: window.default_locale.toLowerCase()
//             });
//     });
// }
/* ------------------------------- Summernote ------------------------------- */
function editors(ctx) {
    var $editor = $('[data-editor]', ctx || document);

    $editor.each(function () {
        var $this = $(this);

        $this.summernote({
            lang: 'pt-BR',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'hr', 'table']],
                ['misc', ['undo', 'redo', 'fullscreen', 'codeview']]
            ],
            height: 300,
            dialogsInBody: true
        });
    });
    $('.modal.link-dialog').on('hide.bs.modal', () => {
        setTimeout(() => {
            if ($('.modal:not(.link-dialog)').hasClass('show')) {
                $('body').addClass('modal-open');
            }
        }, 0);
    });
}
/* ------------------------------------ - ----------------------------------- */

function masks() {
    $('[data-mask-money]').mask('#.##0,00', {reverse: true});
}