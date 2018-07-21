<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8" />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

	<script type="text/javascript">

	$('.loader').hide();	

	uri = "http://pdpmagdalenacentro.org/api";
	token = "jGffO7RLMaPnqZAt4zU7EUBj7w2qR5VVJHI7MLOZhv8p7z6sjP6baHk/7oKI2rSn1svXB5uQnPuzmrkDFJPDxQ==";	
		
    $.ajax({ 

        url: uri, 
        type:'POST', 
        data:{token: token}, 
        dataType:'json', 
        beforeSend: function(){ 

            $('.loader').show();
                            
        },
        error:function(jqXHR,text_status,strError){ 
            
           $('.loader').hide();
           alert(jqXHR+text_status+strError);
       }, 
        timeout:20000, 
         success:function(data){ 
           $(".content_app").html("");                                 
                                           
             $('.loader').hide();
            
              if (data.state == "0") {

              	alert('No se envió el token de seguridad');
              }

              else if(data.state == "1"){

              	alert('El token de seguridad no es valido');
              }

              else{

                for (var i = 0; i in data; i++) {             


                 $(".content_app").append("<ul>"+      
                                            "<li>Nombre: "+ data[i]['name']+"</li>"+
                                            "<li>Apellido: "+ data[i]['lastname']+" </li>"+
                                            "<li>Email: "+ data[i]['email']+"</li>"+
                                            "<li>Contraseña: "+ data[i]['pass']+"</li>"+
                                            "<li>Estado: "+ data[i]['state']+"</li>"+
                                            "<li>Id: "+ data[i]['id']+"</li>"+
                                          "</ul>");
                } 


              }

             

                  
         } 
    })

	</script>

 

	<div class="loader">Cargando...</div>

  <div class="content_app">
	
    

  </div>
	
</body>
</html>