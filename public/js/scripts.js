$(document).ready(function(){

  //-----DATA TABLES-----//


  $('#postTable').DataTable({
    "paging":   true,
    "ordering": true,
    "info":     true,
    "searching": true
  });

   $('#postTable-categoria1').DataTable({
    "paging":   true,
    "ordering": true,
    "info":     true,
    "searching": true
  });

  $('#postTable-categoria2').DataTable({
    "paging":   true,
    "ordering": true,
    "info":     true,
    "searching": true
  });

  $('#postTable-categoria3').DataTable({
    "paging":   true,
    "ordering": true,
    "info":     true,
    "searching": true
  });
  
  //-----DATA TABLES-----//

  $('.filter-check input:radio').first().attr('checked', true);

  $('.boxiCheck').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat-blue'
  });

  radioMostrarInput();
  showChechboxes();
  modaldeleteAsistant();
  setFormRegistro();
  dateMask();
  // getdeleteAsistant();
});

function radioMostrarInput(){
	$('.rbSearch').change(function(){
		$rbSelected = $('.rbSearch:checked').val();
		$('.rbSearch').attr('checked', false).removeClass('rbCheck');
		$(this).attr('checked', true).addClass('rbCheck');
	});
}

function showChechboxes(){
  $('.chbExtra *').click(function(){
    if ($('.chbExtra div').first().hasClass('checked')) {
      $('div.box-check').toggleClass('hidden');
    }else{
      $('div.box-check').toggleClass('hidden');
    }
  });
}

function modaldeleteAsistant(){
  $('.del-asist').on('click',function(){
    $('.delted-name').text($(this).data('name'));
    $('.deleted-id').val($(this).data('id'));

    $('#deleteAsistentes').modal('show');
  });
}

function getdeleteAsistant(){
  $.ajax({
    type: 'POST',
    url: 'getdelasist',
    data: {
      '_token': $('input[name=_token]').val(),
      'deleted-user': $('#deleted-user').val()
    },
    success:function(data){
      // alert('Soy respuesta del ajax');
      $('.delted-name').html(data.msg);
    }
  });
}

function setFormRegistro(){
  $('#tipo-form-reg').bind('change', function (e){
    switch($(this).val()){
      case '1'://Asistente
      case '4'://Staff
        $('#input-enterprise').addClass('hidden');
        $('#input-enterprise input').attr('required',false);

        $('#datos-institucionales, #full-mail').removeClass('hidden');
        $('#full-mail input, #full-uid input').attr('required',true);
        break;
      case '2'://Preparatoria
        $('#input-enterprise').removeClass('hidden');
        $('#datos-institucionales, #input-enterprise .inp-empresa, #full-mail').addClass('hidden');
        $('#input-enterprise .inp-uid').removeClass('col-md-12 col-lg-12');
        $('#input-enterprise .inp-uid').addClass('col-md-6 col-lg-6');
        $('.inp-uid input, .mid-mail input').attr('required',true);
        $('#full-mail input, #full-uid input, .inp-empresa input').attr('required',false);

        break;
      case '3'://Invitado Especial
      case '5'://Tallerista
      case '6'://Prensa
        $('#input-enterprise, #input-enterprise *').removeClass('hidden');
        $('#input-enterprise .inp-uid').removeClass('col-md-6 col-lg-6');
        $('#input-enterprise .inp-uid').addClass('col-md-12 col-lg-12');
        $('#full-mail, #datos-institucionales').addClass('hidden');

        $('#input-enterprise input').attr('required',true);
        $('#full-mail input, #full-uid input').attr('required',false);
        break;
      default://Default
        break;
    }
  }).trigger('change');
}

function dateMask(){
  $('.formatTime').inputmask(
      "hh:mm:ss", {
        placeholder: "HH:MM:SS", 
        insertMode: false, 
        showMaskOnHover: true,
        hourFormat: 12
  });
}