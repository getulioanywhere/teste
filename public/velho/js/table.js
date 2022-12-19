class Table
{
    datatable = '';
    table = '';
    listUrl = '';
    baseUrl = '';
    cols = [];
    
    constructor(table, listUrl, baseUrl, cols, datatable)
    {
        this.datatable = datatable;
        this.table = table;
        this.listUrl = listUrl;
        this.baseUrl = baseUrl;
        this.cols = cols;
    }

    init(destroy = false)
    {
        var columns = this.columns;
        var columns = this.cols;
        var url = this.listUrl;

        this.datatable = this.table.DataTable({
            ajax: url,
            columns: [
                ...columns,
            ],
            paging: false,
            searching: false,
            destroy: destroy
        })
        return this;
    }
    reload()
    {
        this.datatable.ajax.reload();
    }
    edit(callback)
    {
        var baseUrl = this.baseUrl;

        this.table.on('click', '.datatable-edit', function () {
            var data = $(this);
            var id = $(this).data('id-ml');
            var container = $(this).data('reference-ml');

            $(container).show(function () {
                let form = $(this).find('form')
                form.attr('action', `${baseUrl}/${id}/update`)
                form.attr('method', 'POST')
                callback(data, form, container);
            })
        })
    }
    destroy(callback)
    {
        var baseUrl = this.baseUrl;

        this.table.on('click', '.datatable-destroy', function () {
            let id = $(this).data('delete-ml');
            let container = $(this).data('reference-ml');
            $.ajax({
                url: `${baseUrl}/${id}/destroy`,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            .done(callback)
            .done(function () {
                $(container).hide(300)
            })
        });
    }
}

export default Table