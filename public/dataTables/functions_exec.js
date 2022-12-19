function execDataTables() {
    var input = '.datatables';
    var url = ($(input).data('url') && $(input) ? $(input).data('url') : false);
    if (url) {
        $(input).DataTable({
            processing: true,
            serverSide: true,
            ajax: url,
            language: obj_ptbr,
            destroy: true
        });
    }
}
execDataTables();

/*
 $('.nav-link').click(function () {
 var word = this.toString();
 if (word.indexOf('admin/reports') >= 0) {
 setTimeout(function () {
 execDataTables(reportsAjax, '#example');
 }, 1000);
 }
 });
 function extractId() {
 var index = window.location.pathname;
 if (index.indexOf('admin/reports/') >= 0) {
 var partsA = index.split("/");
 return partsA[3];
 }
 }
 $('#show-box-all').click(function () {
 console.log(showBoxAjax + extractId())
 execDataTables(showBoxAjax + extractId(), '#box-client');
 $('#show-box-all').attr('disabled', 'disabled');
 });
 function mountdate_begin() {
 return $('#date-begin').val();    
 }
 function mountdate_end() {
 return $('#date-end').val();    
 }
 var id = false;
 let btnShowReportPrint = $('#show-report-print');
 
 $('#show-box-client').click(function () {
 btnShowReportPrint.attr('data-target', '#modalExemplo3');
 });
 
 $('#show-folder-client').click(function () {
 btnShowReportPrint.attr('data-target', '#modalExemplo4');
 });
 
 $('#btn-show-report-print').click(function () {
 
 var bar = '/';
 var msg = $('.msg-return');
 msg.html('');
 var datebegin = mountdate_begin();
 var dateend = mountdate_end();
 
 var intbegin = parseInt(datebegin.replaceAll('-', ''));
 var intend = parseInt(dateend.replaceAll('-', ''));
 
 var calc = intbegin - intend;
 var calcOk;
 var msgDate;
 if (calc < 1) {
 calcOk = true;
 } else {
 calcOk = false
 if (!datebegin || !dateend) {
 msgDate = '';
 } else {
 msgDate = '<br>Data de início não pode ser maior que a data fim.';
 }
 }
 
 if (datebegin !== '' && dateend !== '' && calcOk === true) {
 
 var box = $('#show-box-client').is(':checked');
 var folder = $('#show-folder-client').is(':checked');
 var boxorfolder = $('#box-or-folder');
 var typeConfirm = 'box';
 if (box === true && folder === false) {
 boxorfolder.html('Caixa');
 typeConfirm = 'box';
 } else if (box === false && folder === true) {
 boxorfolder.html('Envelope');
 typeConfirm = 'folder';
 }
 //paga tabela filtrada do html para imprimir o que foi filtrado
 //ideal para usar em uma outra tela html para realizar o print 
 //ou enviar para processar e montar um excel
 //var tableExport = false;//document.getElementById('view-report-print').outerHTML;        
 //document.querySelectorAll('.sorting')[2].style.display = 'none'
 var route = searchBoxAjax + extractId() + bar + datebegin + bar + dateend + bar + box + bar + folder;
 
 switch (typeConfirm) {
 case 'box':
 id = '#view-report-print-box';
 execDataTables(route + bar + null, id);
 break;
 case 'folder':
 id = '#view-report-print-folder';
 execDataTables(route + bar + null, id);
 break;
 
 default:
 break;
 }
 
 $('.export-excel-route').attr({'href': route + bar + true});
 btnShowReportPrint.trigger("click");
 
 
 } else {
 msg.html('Erro: Verifique os campos Data!' + msgDate);
 }
 });
 
 $('#create-report').click(function () {
 //busca as datas para o select
 ajax_fetch_select(searchDateAjax + extractId());
 });
 */