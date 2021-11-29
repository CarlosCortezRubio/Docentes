
var preg=0;
var cont=0;
function AgregarPregunta(tipo,idexam,input) {
    var cuerpo='';
    var cabeza="<div class='form-group' id='editpreg"+preg+"'>"+
                "<div class='pregunta' id='pregunta"+preg+"'>"+ 
                
                "<h3><label>"+$(input).val()+"</label></h3></div>";
                
    switch (tipo) {
        case "1":
            cuerpo="<div class='container' id='p"+preg+"'>"+
                    "</div>"+
                    "<div class='row'>"+    
                    "<div class='col-4 ' ></div>"+
                    "<div class='input-group regiresp col'>"+
                    "<div class='input-group-prepend'>"+
                    "<button class='btn btn-success' onclick='AgregarRespuesta("+tipo+","+'"#p'+preg+'"'+","+'"#Resp'+preg+'"'+");' type='button'>+</button>"+
                    "</div>"+
                    "<input type='text' id='Resp"+preg+"' class='form-control' placeholder='Ingrese una alternativa' aria-label='' aria-describedby='basic-addon1'>"+
                    "</div>"+
                    "<div class='col-4' ></div>"+
                    "</div>"+
                    "</div>";
        break;
        case "2":
            cuerpo="<div class='container' id='p"+preg+"'>"+
                    "</div>"+
                    "<div class='row'>"+    
                    "<div class='col-4 ' ></div>"+
                    "<div class='input-group regiresp col'>"+
                    "<div class='input-group-prepend'>"+
                    "<button class='btn btn-success' onclick='AgregarRespuesta("+tipo+","+'"#p'+preg+'"'+","+'"#Resp'+preg+'"'+");' type='button'>+</button>"+
                    "</div>"+
                    "<input type='text' id='Resp"+preg+"' class='form-control' placeholder='Ingrese una alternativa' aria-label='' aria-describedby='basic-addon1'>"+
                    "</div>"+
                    "<div class='col-4' ></div>"+
                    "</div>"+
                    "</div>";
        break;
        case "3":
            cuerpo="<div class='container'>"+
                    "<div class='row'>"+
                    "<div class='col'>"+
                    "<div id='p"+preg+"'></div>"+
                    "<div class='row' >"+    
                    "<div class='col-2' ></div>"+               
                    "<div class='input-group regiresp col'>"+
                    "<div class='input-group-prepend'>"+
                    "<button class='btn btn-success' onclick='AgregarRespuesta("+tipo+","+'"#p'+preg+'"'+","+'"#Resp'+preg+'"'+");' type='button'>+</button>"+
                    "</div>"+
                    "<input type='text' id='Resp"+preg+"' class='form-control' placeholder='Ingrese una alternativa' aria-label='' aria-describedby='basic-addon1'>"+
                    "</div>"+
                    "<div class='col-2' ></div>"+
                    "</div>"+
                    "</div>"+
                    "<div class='centrar-content col' id='au"+preg+"'>"+
                    "<div class='file-field'>"+
                    "<div class='btn btn-rounded purple-gradient btn-sm float-left'>"+
                    "<span>Choose file</span>"+
                    "<input type='file' onchange='AñadirAudio(this,"+'"#audio'+preg+'"'+","+'"#au'+preg+'"'+","+preg+")' id='file"+preg+"'>"+
                    "</div>"+
                    "<div class='file-path-wrapper'>"+
                    "<input class='file-path validate' type='hidden' placeholder='Upload your file'>"+
                    "</div>"+
                    "</div>"+
                    "<audio class='row' controls='' id='audio"+preg+"'>"+
                    "<source class='resource"+preg+"' type='audio/ogg'>"+
                    "<source class='resource"+preg+"' type='audio/mp3'>"+
                    "<source class='resource"+preg+"' type='audio/mpeg'>"+
                    "<source class='resource"+preg+"' type='audio/wav'>"+
                    "</audio>"+
                    "</div>"+
                    "</div>"+
                    "</div>"+
                    "</div>";
        break;
        case "4":
            cuerpo="<div class='container' id='p"+preg+"'>"+
                    "</div>"+
                    "<div class='row'>"+    
                    "<div class='col-4 ' ></div>"+
                    "<div class='input-group regiresp col'>"+
                    "<div class='input-group-prepend'>"+
                    "<button class='btn btn-success' onclick='AgregarRespuesta("+tipo+","+'"#p'+preg+'"'+","+'"#Resp'+preg+'"'+");' type='button'>+</button>"+
                    "</div>"+
                    "<input type='text' id='Resp"+preg+"' class='form-control' placeholder='Ingrese una alternativa' aria-label='' aria-describedby='basic-addon1'>"+
                    "</div>"+
                    "<div class='col-4' ></div>"+
                    "</div>"+
                    "</div>";
        break;
        case "5":
            cuerpo="<div class='container'>"+
                    "<div class='row'>"+                       
                    "<div class='col-1' ></div>"+
                    "<div class='col'>"+
                    "<div class='row'>"+
                    "<label class='titlecenter col' >Preguntas</label>"+
                    "<label class='titlecenter col' >Verdadero</label>"+
                    "<label class='titlecenter col' >Falso</label>"+
                    "</div>"+
                    "</div>"+
                    "<div class='col-1' ></div>"+
                    "</div>"+
                    "<div class='container' id='p"+preg+"'>"+
                    "</div>"+
                    "<div class='row'>"+    
                    "<div class='col-4 '></div>"+                   
                    "<div class='input-group regiresp col'>"+
                    "<div class='input-group-prepend'>"+
                    "<button class='btn btn-success' onclick='AgregarRespuesta("+tipo+","+'"#p'+preg+'"'+","+'"#Resp'+preg+'"'+");' type='button'>+</button>"+
                    "</div>"+
                    "<input type='text' id='Resp"+preg+"' class='form-control' placeholder='Ingrese una alternativa' aria-label='' aria-describedby='basic-addon1'>"+
                    "</div>"+
                    "<div class='col-4' ></div>"+
                    "</div>"+
                    "</div>"+
                    "</div>";
        break;
        
    }
    var pie='';
    $(idexam).prepend(cabeza+cuerpo+pie);
    preg++;
}

function AgregarRespuesta(tipo,idpreg,input) {
    var cuerpo='';
    var cabeza="<div class='row' id='rp"+cont+"'>"+
            "<div class='col-1' ></div>"+
            "<div class='form-check  col'>";
    switch (tipo) {
        case 1:
            cuerpo="<input type='radio' name='resp"+idpreg+"' class='respuesta1 form-check-input'>"+
                    "<input id='inp"+cont+"' class='respuesta1 form-check-label' disabled value='"+$(input).val()+"'>";
        break;
        case 2:
            cuerpo="<input type='checkbox' name='resp"+idpreg+"' class='respuesta1 form-check-input'>"+
                   "<input id='inp"+cont+"' class='respuesta1 form-check-label' disabled value='"+$(input).val()+"'>";
        break;
        case 3:
            cuerpo="<input type='radio' name='resp"+idpreg+"' class='respuesta1 form-check-input'>"+
                                    "<input id='inp"+cont+"' class='respuesta1 form-check-label' disabled value='"+$(input).val()+"'>";
        break;
        case 4:
            cuerpo="<textarea placeholder='Ingrese una respuesta valida' id='inp"+cont+"' class='respuesta1 form-check-label' disabled value='"+$(input).val()+"'></textarea>";
        break;
        case 5:
            cuerpo="<div class=' row'>"+
                        "<input id='inp"+cont+"' class='respuesta1 form-check-label col' disabled value='"+$(input).val()+"'>"+
                        "<input type='radio' class='col respuesta5' name='val"+cont+"'>"+
                        "<input type='radio' class='col respuesta5' name='val"+cont+"'>"+
                    "</div>";
                           
        break;
        }
    var pie="</div>"+
            "<a class='btn btn-primary delete' id='btn"+cont+"' onclick='ModeEdit("+'"#edit'+cont+'"'+","+'"#btn'+cont+'"'+","+'"#inp'+cont+'"'+");'><i class='fa fa-pencil' id='edit"+cont+"' ></i></a>"+
            "<a class='btn btn-danger delete' onclick='EliminarRespuesta("+'"#rp'+cont+'"'+");'><i class='fa fa-trash'></i></a>"+
            "<div class='col-1' ></div>"+
            "</div>";
    $(idpreg).append(cabeza+cuerpo+pie);
    $(input).focus();
    $(input).val('')
    cont++;
}

function EliminarRespuesta(id) {
    $(id).remove();
}
function ModeEdit(icon,boton,input) {
    $(icon).removeClass('fa-pencil');
    $(icon).addClass('fa-check');
    $(boton).removeClass('btn-primary')
    $(boton).addClass('btn-success')
    $(input).prop('disabled', false);
    $(boton).attr('onclick', 'ModeSuccess("'+icon+'","'+boton+'","'+input+'")');
    $(input).focus();
}

function ModeSuccess(icon,boton,input){
    $(icon).removeClass('fa-check');
    $(icon).addClass('fa-pencil');
    $(boton).removeClass('btn-success')
    $(boton).addClass('btn-primary')
    $(input).prop('disabled', true);
    $(boton).attr('onclick', 'ModeEdit("'+icon+'","'+boton+'","'+input+'")');
}

function AñadirAudio(idfile,idaudio,idau,preg) {
    if(idfile.files && idfile.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(idaudio).remove();
            $(idau).append("<audio class='row' controls='' id='audio"+preg+"'>"+
                    "<source class='resource"+preg+"' src='"+e.target.result+"' type='audio/ogg' >"+
                    "<source class='resource"+preg+"' src='"+e.target.result+"' type='audio/mp3'>"+
                    "<source class='resource"+preg+"' src='"+e.target.result+"' type='audio/mpeg'>"+
                    "<source class='resource"+preg+"' src='"+e.target.result+"' type='audio/wav' >"+
                    "</audio>");
            $(idaudio).focus();
        }
        reader.readAsDataURL(idfile.files[0]);
    }
}