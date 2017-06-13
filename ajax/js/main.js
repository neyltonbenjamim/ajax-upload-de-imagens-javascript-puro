var typeImgs = ['image/jpg','image/jpeg','image/png'];
var images = document.querySelector("#file-img");
var send = document.querySelector("#form-upload");
var xhr,clearAlert,imgError;

window.addEventListener('load',function(){
	var loadimg = document.getElementsByTagName('img');
	for(let i = 0; i<loadimg.length;i++){
		if(loadimg[i].naturalWidth >= loadimg[i].naturalHeight){
			loadimg[i].style.width = '100%';
		}else{
			loadimg[i].style.height = '100%';
		}
		loadimg[i].setAttribute('src',loadimg[i].getAttribute('data-src'));
	}
	images.addEventListener('change',sendImage);
	send.addEventListener('submit',function(event){
		event.preventDefault();
		if(images.files.length > 0){
			ajax({
				url:'upload.php',
				form:this,
				img:images.files,
				progresso:document.querySelector('.barra')
			});
		}else{
			aviso({
				type:'warning',
				message: 'Escolha uma imagem para ser enviada'
			});
		}

	});
});

function sendImage(){
	if(this.files.length <= 10){
		var group = document.querySelector('.group-img');
		while(group.firstElementChild){
			group.removeChild(group.firstElementChild);
		}
		imgError = 0;
		for(var i = 0; i < this.files.length; i++){
			if(mimeType(this.files[i].type,typeImgs)){
				getFile(this.files[i]);
			}else{
				imgError++;
				aviso({
					type:'warning',
					message: 'Arquivo do tipo <strong>'+this.files[i].type+'</strong> não é permitido'
				});
			}
		}
		var len = this.files.length - imgError;
		if(len){
			aviso({
				type:'warning',
				message: (len > 1?'Foram':'Foi')+' adicionado '+len+(len > 1?' imagens':' imagem')
			});
		}
	}else{
		aviso({
			type:'info',
			message:'O limite permitido para envio é 10 imagens!'
		});
	}
}


function getFile(arquivo){
	var reader = new FileReader();
	reader.readAsDataURL(arquivo);
	reader.onload = function (e) {
		criarImg(arquivo,e.target.result);
	}
}

function ajax(data){
	var formData = new FormData(data.form);
	for(var i in data.img){
		formData.append(data.img[i].name,data.img[i]);
	}
	xhr = new XMLHttpRequest();
	xhr.responseType = 'json';

	xhr.open('POST',data.url);
	xhr.addEventListener('load',function(event){
		data.progresso.innerHTML =  'Concluido!';
		var group = document.querySelector('.group-img');
		while(group.firstElementChild){
			group.removeChild(group.firstElementChild);
		}
		document.getElementById('file-img').value ='';
		insertImg(this.response);

	});

	xhr.upload.addEventListener('progress',function(event){
		if(event.lengthComputable) {
		    var pro = (event.loaded / event.total) * 100;
			data.progresso.style.width = Math.round(pro)+'%';
			data.progresso.innerHTML =  Math.round(pro)+'%';
			if(pro == 100){
				data.progresso.innerHTML = 'Processando...';
			}
		  }
	});
	xhr.send(formData);
}

function insertImg(json){
	// <div class="content-img">
	// 			<img src="upload/<?= $image['img_src'].'/mini-'.$image['img_nome'];  ?>" data-src="upload/<?= $image['img_src'].'/original-'.$image['img_nome'];  ?>" >		
	// 		</div>
	var parent = document.querySelector('.img-enviada');
	for(let i in json.images){
		var div = document.createElement('div');
		div.setAttribute('class','content-img');
		var img = document.createElement('img');
		img.setAttribute('src','upload/'+json.images[i].src+'/mini-'+json.images[i].name);
		img.setAttribute('data-src','upload/'+json.images[i].src+'/original-'+json.images[i].name);
		img.addEventListener('load',imgLoad);
		div.appendChild(img);
		parent.insertBefore(div,parent.firstElementChild);
	}

}
function imgLoad(){
	if(this.naturalWidth >= this.naturalHeight){
		this.style.width = '100%';
	}else{
		this.style.height = '100%';
	}
	this.removeEventListener('load',imgLoad);
	this.setAttribute('src',this.getAttribute('data-src'));
}

function criarImg(arquivo,imgData){
	//Criando a tag li 
	var item = document.createElement('li');
	item.setAttribute('class','item-img');

	//Criando a box que ficará a imagem
	var imagem = document.createElement('div');
	imagem.setAttribute('class','image');
	var img = document.createElement('img');
	img.addEventListener('load',function(){
		if(img.offsetHeight > img.offsetWidth){
			img.style.height = '100%';
		}else{
			img.style.width = '100%';
		}
	});
	img.setAttribute('src',imgData);
	imagem.appendChild(img);
	item.appendChild(imagem);

	//Criando a box que ficará a info
	var info = document.createElement('div');
	info.setAttribute('class','data-image')
	//Criando titulo
	var span = document.createElement('span');
	span.innerText = arquivo.name;
	span.setAttribute('title',arquivo.name+" ("+cnv(arquivo.size)+")");
	span.setAttribute('class','title');
	info.appendChild(span);
	//Criando tamanho
	span = document.createElement('span');
	span.setAttribute('class','size');
	span.innerText = cnv(arquivo.size);
	info.appendChild(span);
	
	item.appendChild(info);

	document.querySelector('.group-img').appendChild(item);
}

function cnv(bytes){
	if(bytes >= 1024){
		bytes /= 1024;
		if(bytes >= 1024){
			bytes /= 1024;
			if(bytes >= 1024){

			}else{
				return bytes.toFixed(2)+' MB';
			}
		}else{
			return bytes.toFixed(2)+' KB';
		}
	}
}

function mimeType(mimeType,tipo){
	var r = tipo.filter(function(value){
		if(value == mimeType){
			return true;
		}
	});
	if(r.length){
		return true;
	}
	return false;
}

function aviso(objeto){
	var parent = document.body;
	if(document.querySelector('.container-message')){
		parent.removeChild(document.querySelector('.container-message'));
	}
	
	var content = document.createElement('div');
	content.setAttribute('class','container-message '+objeto.type);

	var message = document.createElement('div');
	message.setAttribute('class','body-message');
	message.innerHTML = objeto.message;

	var close = document.createElement('span');
	close.appendChild(document.createTextNode('X'));
	close.setAttribute('class','close-message');
	close.addEventListener('click',function(){
		document.querySelector('.container-message').classList.add('hide');
	});
	clearTimeout(clearAlert);
	clearAlert = setTimeout(function(){
		document.querySelector('.container-message').classList.add('hide');
	},10000);

	content.appendChild(message);
	content.appendChild(close);
	parent.insertBefore(content, parent.firstElementChild);
}