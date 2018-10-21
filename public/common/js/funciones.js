    //---------------------------------------------
    
    var table; // Variable que va contener la tabla para luego poder recargarla
			
   function reload_table()
   {
	   table.ajax.reload(null, false); // recargar la tabla, la variable table es declarada en el script(extensión .php)
   }    
 //-------------------------------------------			
	$(function() {

	  $( ".fecha" ).datepicker({
			changeMonth: true, 
			changeYear: true,
			// defaultDate: new Date(1940, 1 - 1, 1)
	   });	

	  $(  ".fecha" ).datepicker(); 	
	   	
	});			
						
  //---------------------------------------------
  
	$(function() {
	   
	  var years, fecha, range;	
	   
	  fecha = new Date();
	  years = 1900 + fecha.getYear();
	      
	  range = (years - 100) + ':' + years;	
	  $( "#fecha_nac" ).datepicker({
			changeMonth: true, 
			changeYear: true,
	   });	

	   $( "#fecha_nac" ).datepicker( "option", "yearRange", range);		
	   	
	});	  
  
  //---------------------------------------------
			
	function info(msj){
	    var info = msj ? msj : 'Los datos se guardaron correctamente';
	    $('#info').show().addClass('alert alert-success').delay(2000).fadeOut('slow').html(info);  
	}	
			
  //----------------------------------------------
			
	function ask()
	{
	    confirm('Desear borrar el registro?');
	}			
			
  //--------------------------------------------
  
	jQuery(function($){
	      $.datepicker.regional['es'] = {
	            closeText: 'Cerrar',
	            prevText: '&#x3c;Ant',
	            nextText: 'Sig&#x3e;',
	            currentText: 'Hoy',
	            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
	            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
	            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
	            'Jul','Ago','Sep','Oct','Nov','Dic'],
	            dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
	            dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
	            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
	            weekHeader: 'Sm',
	            dateFormat: 'dd/mm/yy',
	            firstDay: 0,
	            isRTL: false,
	            showMonthAfterYear: false,
	            yearSuffix: ''};
	      $.datepicker.setDefaults($.datepicker.regional['es']);
	}); 
		
//----------------------------------------

   $(document).ready(function() {
       $('.alert-success').show().delay(3000).fadeOut('slow');
   });    
	
  //----------------------------------------		

	$(document).ready(function() {
		$('class').click(function() {
			$('class').toggleClass('hide');
		});
	});

//=========================================

	 $('#myform').submit(function(e) {
	     e.preventDefault(); 	     
		 $('#send', true).text('Guardando...'); 		  
	     send_data($(this).attr('action'), $(this).serialize());
	  });
	  

   //---------------------------------------
   
     function send_data(route='', datos='')
     {    		   				   		        
		    $.ajax({
		         type: "POST",
		         url: route,
		         data: datos,
		         dataType: "JSON",		            
		         success: function(data){
		         			         	
	                if(! data.status){	                	
	                	alert('Bad information');
	                }else if(data.status==1){
		                  $('#container_form').html('<div class="alert alert-success" role="alert"><strong>Ok...</strong> Los datos se guardaron correctamente.</div>');            		           
		                  redirect();  		                  	           		           
		           }  
		            		              
		         },
		         beforeSend:function(){
                    loading();
		         }
		   });
		        
		   return false;	          	
     }	

      
     
   //-------------------------------------------
   
		function borrar(route)
		{			
		    if(confirm('Desea borrar el registro?'))
		    {
		        $.ajax({
		            url : route,
		            type: "POST",
		            dataType: "JSON",
		            success: function(data)
		            {	 
		                reload_table();  
		                $('#modal_form').modal('hide');
		                info('El registro se borró correctamente.');
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                alert('Error borrando el registro.');
		            }
		        });
		
		    }
		}    
		
	 //=============================== 
	 
	 if($('#myform #role_id').val()>2){
	 	veriry_role($('#myform #role_id').val());	 	
	 } 
	  
	 $('#myform #role_id').change(function(){ 	
	 	veriry_role($(this).val());
	  });	 
	  
	 function veriry_role(role){	 	
	  	if(role>2) $('#myform #div_grupo').addClass('hide');
        else $('#myform #div_grupo').removeClass('hide')	
	 } 	  
	  
     //===============================		    
     
	function popup(url, ancho, alto) {	
		
		 var posicion_x, posicion_y; 		   
		 posicion_x = (screen.width/2)-(ancho/2); 
		 posicion_y = (screen.height/2)-(alto/2); 
		    
		 window.open(url, url, "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=yes,resizable=no,left="+posicion_x+",top="+posicion_y+"");
	} 
	
	/*
   	 //------------------------------------
   	 
	 $('#sends').click(function(e) {
	     e.preventDefault(); 
	     alert($('#myform').serialize());
		 $(this).attr('disabled', true).text('Guardando...'); 		  
	     cargar_formulario($('#myform').attr('action'), null, $('#myform').serialize());
	  });	   
   	 
	   	 
   	 
	 function nuevo_editar(route, title='Editar')
	 {	 	
	     $('#formulario .error').empty();	      
	     $('#send').addClass('btn-danger').removeClass('btn-success').text('Cargando...');
	     $('#formulario :input').val('').attr('disabled', true);	
	        	             	 	
	     cargar_formulario(route, title);	 
	     		 	
	 }	 
	 * */      
