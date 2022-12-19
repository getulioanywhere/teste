import Table from "./table.js";

class Block
{
    init()
    {
        var elementTable = $('.datatable-block');

        var baseUrl = elementTable.data('base-url-ml');
        var modelId = elementTable.data('model-id-ml');
        var listUrl = `${baseUrl}/${modelId}/data`;

        let columns = [
            {data: 'title'},
            {
                data: null,
                class: 'actions',
                render: function (params) {
                    return `
                        <button 
                            data-id-ml="${params.id}"
                            data-title-ml="${params.title}"
                            data-body-ml="${params.body}"
                            data-active-ml="${params.active}"
                            data-reference-ml="#block-container"
                            class="datatable-edit btn btn-default"
                        >
                            Editar
                        </button>
                        <button
                            data-reference-ml="#block-container"
                            data-delete-ml="${params.id}"
                            class="datatable-destroy btn btn-danger"
                        >
                            <i class="fa fa-trash"></i>
                        </button>
                    `;
                }
            }
        ];

        let table = new Table(elementTable, listUrl, baseUrl, columns);
        table.init()

        table.edit(function (data, form, container) {
            let title = data.data('title-ml')
            let body = data.data('body-ml')
            let active = data.data('active-ml')
            let inputTitle = form.find('input[name=title]');
            let inputBody= form.find('textarea[name=body]');
            let inputActive = form.find('input[name=active]');
            
            inputTitle.val(title)
            inputBody.val(body)
            inputActive.val(active)

            data.on('submit', function () {
                setTimeout(() => {
                    table.init(true).reload();
                }, 3000);

                $(container).hide(600);
            })
        });
        
        table.destroy(function () {
            table.init(true).reload();
        })

        this.store(baseUrl, modelId, table)
    }
    store(baseUrl, modelId, table)
    {
        $('.btn-store-block').on('click', function () {
            var container = $(this).data('reference-ml');
            $(container).show(function () {
                let form = $(container).find('form');
                let store = `${baseUrl}/store/${modelId}`;
                form.attr('action', store)
                form.attr('method', 'POST')

                let inputName = form.find('input[name=name]')
                inputName.val('')

                form.on('submit', function () {
                    setTimeout(() => {
                        table.init(true).reload();
                    }, 3000);
                    
                    $(container).hide(600);
                });
            })
        })
    }
}

export default Block