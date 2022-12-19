/**
 * @author Camilo
 */

const modelId = $('meta[name="model-id"]').attr('content');
const morph = $('meta[name="morph"]').attr('content'); // Nome da Model ao qual o bloco será vinculado
const dataTransfer = new DataTransfer();

$(function() {
    updateBlocksList();
    VenomFiles.init();
    $('#block-form').on('submit', e => {
        postForm(e, function() {
            updateBlocksList();
            $('#block-form-container').hide(200);
        })
    });
})

/**
 * Limpa a listagem de blocos e a remonta com requisição AJAX.
 * É como um refresh da tabela.
 */
 function updateBlocksList() {
    const $list = $('#blocks-list');
    $list.find('tbody tr').remove();
    const url = `/blocks/${morph}/${modelId}`;
    $.get(url, function(data) {
        for (let rec of data) {
            $list.find('tbody').append(`
                <tr id="order_${rec.id}" class="ui-sortable-handle">
                    <td><i class="fa fa-bars draggable"></i></td>
                    <td>${rec.key}</td>
                    <td>${rec.title || '<em>Sem título</em>'}</td>
                    <td>${rec.type}</td>
                    <td class="actions">
                        <button
                            data-action="update"
                            data-show-target="#block-form-container"
                            data-url="/blocks/${morph}/${modelId}/${rec.id}"
                            data-id="${rec.id}"
                            class="btn btn-sm btn-default block-form-toggler"
                        >
                            Editar
                        </button>
                        ${!rec.native ?
                            `<a 
                                data-href="/blocks/${rec.id}" 
                                data-delete class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>` : ''
                        }
                    </td>
                </tr>
            `);
        }
        registerListeners();
    });
}

/**
 * Preenche o formulário com os dados em formato JSON.
 * Caso nada seja passado em @param data, o formulário será limpo.
 * @param specialCases Lida com inputs que possuem valor default ou não são type text|select
 */
function fillForm(form, data = null, specialCases = {}) {
    const $form = $(form);
    VenomFiles.clear();

    if (!data) { // Limpeza
        data = specialCases.defaults
        $form.find('input[type=text], input[type=file], textarea').val('');
        $form.find('select').each(function() {
            $(this).val($(this).find('option').first().val());
        });
        $form.find('input[type=checkbox]').each(function() {
            $(this).attr('checked', false)
                .bootstrapToggle('off');
        });
    }

    Object.keys(data || {}).forEach(function(key) {
        const value = data[key];
        const $input = $($form.find(`[name=${key}]`));
        if (specialCases.checkbox.includes(key)) {
            $input.attr('checked', !!value)
                .bootstrapToggle(value ? 'on' : 'off');
        } else {
            $input.val(value);
        }
    })
}

/**
 * Registra os eventos necessários e que podem necessitar serem registrados novamente (após exclusão do elemento).
 */
function registerListeners() {
    activateTogglers(); // <-- Essa função está em `public\velho\js\app.js`

    /* --------- Preparação do formulário de edição e cadastro de blocos -------- */
    $('.block-form-toggler').on('click', function() {
        const $toggler = $(this);
        const $formContainer = $($toggler.data('show-target'));
        const $form = $formContainer.find('form');
        $form.find('input[name="_method"]').remove();
        fillForm($form, null, {
            checkbox: ['active'],
            keep: ['_token', 'active'],
            defaults: {
                'active': true
            },
        });

        /* --------- Transformando o formulário para ser de update ou store --------- */
        const url = $toggler.data('url');
        const action = $toggler.data('action');
        $form.attr('action', url);

        if (action === 'update') {
            $form.prepend('<input type="hidden" name="_method" value="PUT">');
            const url = `/blocks/${morph}/${modelId}/${$toggler.data('id')}`;
            $.get(url, function(data) {
                fillForm($form, data, {
                    checkbox: ['active']
                });
                VenomFiles.gallery(data._medias);
            });
        }
    })

    /* ---------------------------- Deleção de blocos --------------------------- */
    $('#blocks-list [data-delete]').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
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
                success: data => {
                    $this.parents('tr').remove();
                    toastr.success('Registro deletado.');
                }
            });
        }
    });
}

/**
 * Manda formulário para o controller via AJAX.
 * ! Essa função é uma leve adaptação da existente em `public\velho\js\app.js`.
 * ! Seria interessante adaptar aquela ao invés de manter essa replicação.
 * @param {function} cbckSuccess Callback a ser disparado em caso de sucesso.
 */
function postForm(e, cbckSuccess = ()=>{}) {
    e.preventDefault();
    const $this = $(e.target);
    const $button = $this.find('button[type=submit]');
    $button.attr('disabled', true);

    const formData = new FormData(e.target);

    // for (let entry of formData) console.log(entry) // <-- para debug

    $.ajax({
        data: formData,
        url: $this.attr('action'),
        type: 'post',
        processData: false,
        contentType: false,
        success: function (data) {
            toastr.success('Sucesso.');
            $button.attr('disabled', false);
            $('.is-invalid').removeClass('is-invalid');
            cbckSuccess();
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
                    }
                }
            }
            if (xhr.status === 500) {
                toastr.error(xhr.message || 'Ocorreu um erro.');
            }
            $button.attr('disabled', false);
        }
    });
}


/**
 * Realiza a gerência do input das imagens no frontend.
 * ! Essa classe deve ser modularizada para reaproveitamento em outras funcionalidades.
 * ! Para isso, ajustes serão necessários para abstratizá-la mais e desvinculá-la completamente de `page_blocks`.
 */
class VenomFiles {
    static init() {
        /**
         * Permite a identificação e deleção das imagens inputadas.
         * @source Adaptado de https://codepen.io/scarulli/pen/bGGXdEZ
         */
        $("#images").on('change', function(e){
            for (var i = 0; i < this.files.length; i++){
                let fileBloc = $('<span/>', {class: 'file-block badge badge-secondary'}),
                    fileName = $('<span/>', {class: 'name', text: this.files.item(i).name});
                fileBloc.append('<span class="file-delete text-white mr-1" style="cursor:pointer"><span>&times;</span></span>')
                    .append(fileName);
                $("#images-list").append(fileBloc);
            };
            // Adicionando arquivos ao objeto DataTransfer
            for (let file of this.files) {
                dataTransfer.items.add(file);
            }
            // Atualização dos arquivos do arquivo de entrada após a adição
            this.files = dataTransfer.files;
        
            // EventListener para botão de exclusão criado
            $('span.file-delete').click(function(){
                let name = $(this).next('span.name').text();
                // Deletar a exibição do nome do arquivo
                $(this).parent().hide(200);
                setTimeout(() => $(this).parent().remove(), 200);
                for (let i = 0; i < dataTransfer.items.length; i++){
                    // Corresponder arquivo e nome
                    if (name === dataTransfer.items[i].getAsFile().name){
                        // Excluindo arquivo no objeto DataTransfer
                        dataTransfer.items.remove(i);
                        continue;
                    }
                }
                // Atualizando arquivos do input após a exclusão
                document.getElementById('images').files = dataTransfer.files;
            });
        });

        /**
         * Permite a reordenação das mídias.
         */
        $('#media-container').sortable({
            opacity: 0.6,
            cursor: 'move',
            placeholder: 'sortable-media border rounded bg-light',
            containment: 'parent',
            revert: 200,
            tolerance: 'intersect',
            cancel: '.btn-delete-media',
            update() {
                $('input[name="reorder-media"]').val($(this).sortable('toArray', {attribute: 'data-id'}));
            },
        });
        $('#media-container').disableSelection();
    }
    
    static gallery(medias) {
        const $container = $('#media-container');
        $container.empty();

        if (medias.length) {
            const $data = $('#media-data');
            $container.before('<em class="instruction px-3 mb-0 drag-tip">Arraste para reordenar</em>');
            $data.append('<input type="hidden" name="reorder-media">');
    
            for (let media of medias) {
                const $media = $('<div/>', {class: 'sortable-media border rounded bg-white', 'data-id': media.id});
                if (media.type === 'image') {
                    $media.append(`
                        <img src="${media.source_url}" class="gallery-item rounded">
                    `);
                } else if (media.type === 'video') {
                    $media.append(`
                        <div class="block-video gallery-item rounded"><i class="fa fa-video text-white"></i></div>
                    `);
                }
                $media.append(`
                    <a class="btn-open-media rounded btn btn-sm btn-default" href="${media.source_url}" target="_blank" title="Abrir em nova guia">
                        <small>
                            <i class="fas fa-external-link-alt"></i>
                        </small>
                    </a>`);
                const $deleteBtn = $('<div/>', {class: 'btn-delete-media', title: 'Remover'}).append('&times;');
                $deleteBtn.on('click', this.deleteExistent);
                $media.append($deleteBtn);
                $container.append($media);
            }
        }
    }

    static deleteExistent(e) {
        const $this = $(e.target);
        const id = $this.parent().data('id');
        const $dataContainer = $this.parents('#media-container').siblings('#media-data');
        $dataContainer.append(`<input type="hidden" name="delete-media[]" value=${id}>`);
        $this.parent().hide(200);
        setTimeout(() => $this.parent().remove(), 200);
    }

    static clear() {
        document.getElementById('images').files = null;
        dataTransfer.clearData();
        $('#block-media .drag-tip').remove();
        $('#images-list').empty();
        $('#media-container').empty();
        $('#media-data').empty();
    }
}