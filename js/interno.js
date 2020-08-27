$(document).ready(function(){});

function concordo(id_postagem){

	var concordo_id = 'concordo'+id_postagem;
	var discordo_id = 'discordo'+id_postagem;
	var hidden = 'hidden'+id_postagem;
	var submit='submit'+id_postagem;
	var form = 'form'+id_postagem;
	var imagem = 'imagem'+id_postagem+'[]';
	
	//alert("concordo: "+form);
	document.getElementById(concordo_id).style.display= "block";
	document.getElementById(discordo_id).style.display= "none";
	//document.getElementById(form).style.display="block";
	document.getElementById(submit).style.display="block";
	document.getElementById(imagem).style.display="block";
	document.getElementById(hidden).setAttribute('value','concordo');
	document.getElementById(concordo_id).focus();
	
	
	//$('discordo'+id_postagem).style.display= "none";	

}

function discordo(id_postagem){

	var concordo_id = 'concordo'+id_postagem;
	var discordo_id = 'discordo'+id_postagem;
	var hidden = 'hidden'+id_postagem;
	var submit='submit'+id_postagem;
	var form = 'form'+id_postagem;
	var imagem = 'imagem'+id_postagem+'[]';

	//alert("discordo: "+form);
	document.getElementById(concordo_id).style.display= "none";
	document.getElementById(discordo_id).style.display= "block";
	//document.getElementById(form).style.display="block";
	document.getElementById(submit).style.display="block";
	document.getElementById(imagem).style.display="block";
	document.getElementById(hidden).setAttribute('value','discordo');
	
	document.getElementById(discordo_id).focus(); 
}



function like_postagem(id){

	//alert("entrou na função like_postagem");

$.post('like_postagem.php',{id_postagem: id},function(retorno){

	var devolucao = jQuery.parseJSON(retorno);

	

	if(devolucao.status==1){
		$("#like_postagem"+id).attr("src","http://localhost/against-censorship/img/like.jpg");
	}
	else if(devolucao.status==0){
		$("#like_postagem"+id).attr("src","http://localhost/against-censorship/img/neutro.jpg");
	}

	$("#likes_postagem"+id).text(devolucao.likes);

});

}
function obter_listagem_imagens(id){

	var x = document.getElementById(id);

	var retorno = [];

	for(var i=0; i < x.files.length; i++){

		//console.log(x.files[i]["name"]);
		retorno.push(x.files[i]["name"]);
	}
	return retorno;
}

//document.querySelector('#imagem').addEventListener("change", carregar_arquivos);

function carregar_arquivos() {


	var imagens=obter_listagem_imagens("imagem");

	var itensImagens = document.getElementById("itensImagens");
	while (itensImagens.hasChildNodes()) {  
		itensImagens.removeChild(itensImagens.firstChild);
	  }

	var carouselInner = document.getElementById("carouselInner");
	while (carouselInner.hasChildNodes()) {  
		carouselInner.removeChild(carouselInner.firstChild);
	}

	for(var i=0; i<imagens.length;i++){
	
		var novoLI = document.createElement("li");
		novoLI.setAttribute("data-target", "#carouselImagens");
		novoLI.setAttribute("data-slide-to",""+i+"");

		novoDIV = document.createElement("div");

		novoIMG = document.createElement("img");
		novoIMG.setAttribute("src","/vsm/"+imagens[i]);
		novoIMG.setAttribute("class","d-block w-100");


		if(i==0){
			novoLI.setAttribute("class","active");
			novoDIV.setAttribute("class","carousel-item active")
		}
		else{
			novoDIV.setAttribute("class","carousel-item")
		}

		itensImagens.appendChild(novoLI);
		novoDIV.appendChild(novoIMG);
		carouselInner.appendChild(novoDIV);
		
	}
}
//}


$(function () {
    $("#imagem").change(function () {
        if (typeof (FileReader) != "undefined") {
            var dvPreview = $("#dvPreview");
            dvPreview.html("");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
                var file = $(this);
                if (regex.test(file[0].name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = $("<img />");
                        img.attr("style", "height:100px;width: 100px");
                        img.attr("src", e.target.result);
                        dvPreview.append(img);
                    }
                    reader.readAsDataURL(file[0]);
                } else {
                    alert(file[0].name + " is not a valid image file.");
                    dvPreview.html("");
                    return false;
                }
            });
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    });
});









/*
$(function () {
    $("#imagem").change(function () {


		var itensImagens = $("#itensImagens");
	
		var carouselInner = $("#carouselInner");
		
        if (typeof (FileReader) != "undefined") {
            var dvPreview = $("#teste");
			dvPreview.html("");
			var contador=0;
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
				var file = $(this);
				
                if (regex.test(file[0].name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {

						

                        let img = $("<img />");
						img.attr("style", "height:100px;width: 100px");
						//img.attr("class","d-block w-100");
                        img.attr("src", e.target.result);
						dvPreview.append(img);

						let novoLI = $("<li>");
						novoLI.attr("data-target", "#carouselImagens");
						novoLI.attr("data-slide-to",""+contador+"");
				
						novoDIV = $("<div>");			
				
						if(contador==0){
							novoLI.attr("class","active");
							novoDIV.attr("class","carousel-item active")
						}
						else{
							novoDIV.attr("class","carousel-item")
						}
				
						itensImagens.append(novoLI);
						novoDIV.append(img);
						carouselInner.append(novoDIV);

                    }
					reader.readAsDataURL(file[0]);
					contador++;
                } else {
                    alert(file[0].name + " is not a valid image file.");
                    //dvPreview.html("");
                    return false;
                }
            });

		} else {
            alert("This browser does not support HTML5 FileReader.");
        }
    });
});




/*
<div id="carouselImagens" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators" id="itensImagens">
    <li data-target="#carouselImagens" data-slide-to="0" class="active"></li>
    <li data-target="#carouselImagens" data-slide-to="1"></li>
    <li data-target="#carouselImagens" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" id="carouselInner">
    <div class="carousel-item active">
      <img src="..." class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselImagens" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselImagens" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>



function readURL(input) {
	alert("aqui");
	if (input.files && input.files[0]) {
	  var reader = new FileReader();
	  
	  reader.onload = function(e) {
		$('#Imagem').attr('src', e.target.result);
	  }
	  
	  reader.readAsDataURL(input.files[0]); // convert to base64 string
	}
  }
  
  $("#imagem[]").change(function() {
	readURL(this);
  });
  //<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  /*<form runat="server">
	<input type='file' id="imagem[]" />
	<img id="blah" src="#" alt="your image" />
  </form>
*/


// incluir nos locais devidos o carousel do bootstrap abaixo:

/*

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="..." class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

*/