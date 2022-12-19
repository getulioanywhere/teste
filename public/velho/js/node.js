import Table from "./table.js";

class Node
{
    init()
    {
        var elementTable = $('.media-datatable');
        var baseUrl = elementTable.data('base-url-ml');
        var modelId = elementTable.data('model-id-ml');
        var listUrl = `${baseUrl}/data/${modelId}`;

        let columns = [
            {data: 'name'},
            {
                data: null,
                class: 'actions',
                render: function (params) {
                    return `
                        <button 
                            data-id-ml="${params.id}"
                            data-name-ml="${params.name}"
                            data-active-ml="${params.active}"
                            data-reference-ml="#node-form-container"
                            class="datatable-edit btn btn-default"
                        >
                            Editar
                        </button>
                        <button
                            data-reference-ml="#node-form-container"
                            data-delete-ml="${params.id}"
                            class="datatable-destroy btn btn-danger"
                        >
                            <i class="fa fa-trash"></i>
                        </button>
                    `;
                }
            }
        ];

        // let table = new Table(elementTable, baseUrl, nodeId, columns);
        let table = new Table(elementTable, listUrl, baseUrl, columns);
        table.init()

        table.edit(function (data, form, container) {
            let name = data.data('name-ml')
            let active = data.data('active-ml')
            let inputName = form.find('input[name=name]');
            let inputActive = form.find('input[name=active]');
            
            inputName.val(name)
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

        this.store(baseUrl, table)
    }
    store(baseUrl, table)
    {
        $('.btn-store-node').on('click', function () {
            console.log('node')
            var container = $(this).data('reference-ml');
            $(container).show(function () {
                let form = $(container).find('form');
                let store = `${baseUrl}/store`;
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

export default Node