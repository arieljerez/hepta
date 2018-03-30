$(document).ready(function() {
    $('#rootwizard').bootstrapWizard(
      {
        onNext: function(tab, navigation, index) {
        if (index==2){
          if (!$('input[name="cobertura"]').is(':checked')) {

                alert('Debe seleccionar una Cobertura');
                  return false;
              }
        }

        if (index==3){
          if (!$('input[name="optionsRadios"]').is(':checked')) {

                alert('Debe seleccionar una Opción de busqueda');
                  return false;
              }
        }

        if($('input[name=optionsRadios]:radio:checked').val() == "Especialidad" ) {
          $('#rootwizard').bootstrapWizard('display', 3);
          $('#rootwizard').bootstrapWizard('display', 4);
          $('#rootwizard').bootstrapWizard('hide', 5);
        }
        if($('input[name=optionsRadios]:radio:checked').val() == "Medico" ) {
          $('#rootwizard').bootstrapWizard('hide', 3);
          $('#rootwizard').bootstrapWizard('display', 4);
          $('#rootwizard').bootstrapWizard('hide', 5);
        }
        if($('input[name=optionsRadios]:radio:checked').val() == "Estudios" ) {
          $('#rootwizard').bootstrapWizard('hide', 3);
          $('#rootwizard').bootstrapWizard('hide', 4);
          $('#rootwizard').bootstrapWizard('display', 5);
        }

    }, onTabShow: function(tab, navigation, index) {
      var $total = navigation.find('li').length;
      var $current = index+1;
      var $percent = ($current/$total) * 100;
      $('#rootwizard .progress-bar').css({width:$percent+'%'});
    }
    , onTabClick(tab, navigation, index){
      return false;
    }
  });
  window.prettyPrint && prettyPrint();

  $('#myModal').on('shown.bs.modal', function () {

  });

  $('#rootwizard .finish').click(function() {
      $('#rootwizard').find("a[href*='tab1']").trigger('click');
  });

  $('.item_check').click(function() {
    $(this).children('td').children('input').prop('checked', true);
    alert(this);
  });
  $('.item_check2').click(function() {
    alert(this);
    $(this).children('td').children('input').prop('checked', true);
  });

});
