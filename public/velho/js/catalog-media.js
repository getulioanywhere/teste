import Table from "./table.js";

class CatalogMedia
{
    init()
    {
        var elementTable = $('.product-datatable');
        var baseUrl = elementTable.data('base-url-ml');
        var modelId = elementTable.data('model-id-ml');
        var listUrl = `${baseUrl}/data/${modelId}`;
        var storageUrl = elementTable.data('storage-url-ml');

        let columns = [
            {
                data: null,
                render: function (params) {
                    return `
                        <img class="product-media" src="${storageUrl}/${params.source}" alt="${params.name}"/>
                    `
                }
            },
            {
                data: null,
                class: 'actions',
                render: function (params) {
                    return `
                        <button 
                            data-id-ml="${params.id}"
                            data-source-ml="${params.source}"
                            data-reference-ml="#media-form-container"
                            class="datatable-edit btn btn-default"
                        >
                            Editar
                        </button>
                        <button
                            data-reference-ml="#media-form-container"
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
            let source = data.data('source-ml');
            let preview = form.find('.preview');
            let upload = form.find('.upload');

            preview.attr('style', '')
            upload.attr('style', 'display:none')
            preview.find('img').attr('src', `${storageUrl}/${source}`)
            
            form.on('submit', function () {
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
        $('.btn-store-medias').on('click', function () {
            var container = $(this).data('reference-ml');
            $(container).show(function () {
                let form = $(container).find('form');
                form.attr('action', `${baseUrl}/store`)
                form.attr('method', 'POST')

                let preview = form.find('.preview');
                let upload = form.find('.upload');

                preview.attr('style', 'display:none')
                upload.attr('style', 'display:block')
                preview.find('img').attr('src', '')

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

export default CatalogMedia