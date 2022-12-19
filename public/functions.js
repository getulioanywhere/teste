//var btnCopy = document.getElementsByName('btn-copy');
//var btnCopyTeste = document.getElementsByClassName('teste');
//exec_copy()

function exec_copy() {
    document.getElementById('btn-copy').addEventListener('click', function () {
        copy('clone', 'cloned');

    });

}

function copy(conteudoCopy, recebeCopy) {
    var conteudo_copy = document.getElementsByClassName(conteudoCopy);
    var recebe_copia = document.getElementsByClassName(recebeCopy);
    for (var i = 0; i < recebe_copia.length; i++) {
        if (recebe_copia[i].innerText === '') {             
            //.insertAdjacentElement('beforebegin', tempDiv);
            //insertAdjacentHTML(position, text)

            recebe_copia[i].insertAdjacentHTML('afterend', conteudo_copy[i].outerHTML);
            //recebe_copia[i].innerHTML = conteudo_copy[i].outerHTML;   
            //conteudo_copy[i].classList.remove(conteudoCopy);
        }
    }
// beforebegin 
//<p>
//   afterbegin 
//  foo
//   beforeend 
//</p>
// afterend 
// https://developer.mozilla.org/en-US/docs/Web/API/Element/insertAdjacentHTML
    //var clone = $('.'+conteudoCopy).clone(); 
    //clone += '<div class="col-md-2 cloned"></div>';
    //console.log(clone);
    //$('.'+recebeCopy).append(clone);
    //$(recebeCopy).append('<div class="col-md-2 cloned"></div>');
}

//******************manipula os botões de imagem mostra e delete*******************
$('.preview-img').map(function () {
    if ($(this)[0].src) {
        let deletar = $(this).parents('.teste').find('#deletar1');
        deletar[0].style.display = 'block';
    }
});

$('.file-button').on('click', function () {
    let filechoose = $(this).parent().find('#imagem01');
    var deletar = $(this).parent().find('#deletar1');
    let previewImg = $(this).parents('.teste').find('.preview-img');
    let linkImage = $(this).parents('.teste').find('#linkimg');

    $(this).bind('click', filechoose.click())

    filechoose.on('change', function (e) {
        var fileToUpload = e.target.files.item(0);
        previewImg[0].dataset.nameImg = fileToUpload.name;

        let reader = new FileReader();
        reader.onload = e => {
            previewImg[0].src = e.target.result;
        }
        reader.readAsDataURL(fileToUpload);
        deletar[0].style.display = 'block';

        if (linkImage) {
            linkImage[0].value = fileToUpload.name;
        }
    })
})

$('.media-delete').on('click', function () {
    let previewImg = $(this).parents('.teste').find('.preview-img');
    let linkImage = $(this).parents('.teste').find('#linkimg');

    previewImg[0].dataset.nameImg = '';
    previewImg[0].src = '';
    if (linkImage) {
        linkImage[0].value = '';
    }
    $(this)[0].style.display = 'none';
});