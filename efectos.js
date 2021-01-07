$(document).ready(function(){ //Hacia arriba
	$('.exito').hide();
	$('.falla').hide();
	irArriba();
	
});

function irArriba(){
	$('.ir-arriba').click(function(){ $('body,html').animate({ scrollTop:'0px' },1000); });
	$(window).scroll(function(){
	  if($(this).scrollTop() > 0){ $('.ir-arriba').slideDown(600); }else{ $('.ir-arriba').slideUp(600); }
	});
	$('.ir-abajo').click(function(){ $('body,html').animate({ scrollTop:'1000px' },1000); });
}

function desplazamiento() {
	$('.btn-menu').click(function(){ 
		$('.menu').slideToggle(700, 'linear');
	})
}

function tocarMenu() {
	$('.link-menu').click(function(){
		$('.menu').slideUp(500);
	})	 
}


if (window.screen.width <= 720){
		desplazamiento();
		tocarMenu();
}
  
