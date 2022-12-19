//Por padrão os botões para submeter formulários usarão name="btn-click"
var btn = document.getElementsByName('btn-click');
//var btn_destroy = document.getElementsByName('btn-click-destroy');
clickButton(btn);
//clickButton(btn_destroy);
function clickButton(btn) {
//identificar qual dos buttons names foi acionado o evento click
    for (var i = 0; i < btn.length; i++) {
        btn[i].addEventListener('click', async function (e) {
            e.preventDefault();
            //desativa o botão confirmar
            this.disabled = true;       
            
            var process = document.getElementById('process-info');
            process.style.display = 'block';
            //executa o processo fetch api
            let ret = await fetch_ajax(e.target.form.id);
            //retorna o callback de mensagem para uma modal, 
            //ret o retorno de fetch e e.path para identificar qual modal foi acionada
            clickOpenModalMessage(ret, e);
            //reativa o botão confirmar
            process.style.display = 'none';
            this.disabled = false;
        });
    }
}
function displayrowOnDelete(idrow) {
    //efeito para ocultar a linha que foi apagada do banco
    setTimeout(function(){
        document.getElementById(idrow).style.display = 'none';
    },1000)
    //document.getElementById(idrow).style.fontWeight = '900';
    
}
function takeRowTableClick(e) {
    //funcção para pegar linha que foi clicada
    for (var i = 0; i < e.path.length; i++) {
        if (e.path[i].localName === 'tr') {
            return e.path[i].id;
        }
    }
}

function clickOpenModalMessage(message, e) {
    var bodyMessage = document.getElementById('modal-body-message');
    bodyMessage.innerHtml = '';
    setTimeout(function () {
        //close modal confirm
        for (var i = 0; i < e.path.length; i++) {
            var check = e.path[i].id;
            if (check) {
                //procurar qual modal está sendo acionada
                if (check.indexOf('modal') >= 0) {
                    //close modal confirm automaticamente
                    document.getElementById(check).click();
                }
            }
        }
        //show message        
        if (typeof message === 'string') {
            
            var array = ['success', 'error', 'empty'];
            
            for (var i = 0; i < array.length; i++) {
                if (message.indexOf(array[i]) >= 0) {
                    document.getElementById(array[i]).style.display = 'block';
                }else{
                    document.getElementById(array[i]).style.display = 'none';
                }
            }           

        } else {
            bodyMessage.innerHTML = message;
        }
        document.getElementById('btn-modal-message').click();        
    }, 1000);
    
    var array = takeDataObj(e.target.form.id);
    var url = array['url'].split('/');   
    var action = url[3].split('-');
     
    switch (action[1]) {
        case 'destroy':
            displayrowOnDelete(takeRowTableClick(e));
            break;
            
        default:
            
            break;
    }
    
    //removeRowTableOnDelete(e);//remover linha da tabela caso ocorra destroy
}
function takeDataObj(formid) {
    var form = document.getElementById(formid);//busca id do form acionado    
    var array = [];
    array['method'] = form.getAttribute('method');//usa formdata de javascript puro
    array['url'] = form.getAttribute('action');//pega url do action do form
    array['obj'] = new FormData(form);//pega url do action do form
    return array;       
}
async function fetch_ajax(formid) {
    var array = takeDataObj(formid);
    //monta header http
    var requestOptions = {
        method: array['method'],
        headers: myheaders(),
        //mode: 'no-cors',
        //credentials: "same-origin",
        //body: JSON.stringify(obj),
        body: array['obj'],
        redirected: 'follow',
    };
    //executa o fetch enviando url e header
    return await fetch_exec(array['url'], requestOptions);
}

function myheaders() {
    //monta o header - estudaer formas de segurança
    //exemplos comantados
    //application/x-www-form-urlencoded;charset=UTF-8
    var myHeaders = new Headers();
    //myHeaders.append('Content-Type', "application/json");
    //myHeaders.append('Accept', "application/json");
    //myHeaders.append('Content-Type', "application/x-www-form-urlencoded;charset=UTF-8");
    //myHeaders.append('Accept', "application/x-www-form-urlencoded;charset=UTF-8");
    //myHeaders.append('X-Requested-With', "XMLHttpRequest");

    //executa a função metatagxcsrf() para pegar o meta tag de XCSRF laravel head
    myHeaders.append('X-CSRF-TOKEN', metatagxcsrf());
    return myHeaders;
}

async function fetch_exec(url, requestOptions) {
    //executa a chamada fetch api
    var data;
    var response = await fetch(url, requestOptions);

    if (response.status === 200 || response.statusText === 'OK') {
        data = await response.json();
        if (typeof data === 'object') {
            data = data.return;
        }
    } else {
        if (response.status === 500) {
            data = await response.statusText;
        } else {
            if (typeof data === 'object') {
                data = data.return;
            }
        }
    }
    return await data;
}

function readFormData(form) {
    //executar apenas teste para checar os dados do Data Form
    var formData = new FormData(form);
    for (let [name, value] of formData) {
        console.log(`${name} = ${value}`);
    }
}

function metatagxcsrf() {
    //pegar meta tag csrf-token do head html usando javascript puro
    //$('meta[name="csrf-token"]').attr('content')
    var meta = document.getElementsByTagName("meta");
    for (var i = 0; i < meta.length; i++) {
        if (meta[i].name === 'csrf-token') {
            return meta[i].content;
        }
    }
}