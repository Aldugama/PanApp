$('.dropdown-toggle').on('click', function(e) {
    e.stopPropagation();
    e.preventDefault();
  
    var self = $(this);
    if(self.is('.disabled, :disabled')) {
      return false;
    }
    self.parent().toggleClass("open");
  });
  
  $(document).on('click', function(e) {
    if($('.dropdown').hasClass('open')) {
      $('.dropdown').removeClass('open');
    }
  });

  /*$('.nav-btn.nav-slider').on('click', function() {
    $('.overlay').show();
    $('nav').toggleClass("open");
  });
  
  $('.overlay').on('click', function() {
    if($('nav').hasClass('open')) {
      $('nav').removeClass('open');
    }
    $(this).hide();
  });*/



//* Guarda automáticamente el pedido *//
    /*setTimeout(() => {
        $('#pedido').submit();
        console.log('pedido guardado');
    }, 3000);*/

    //Para los close-buttons de las notificaciones. Cierra toda la notificación.
    $('.close').click(e => {
        $(e.target).parent().parent().fadeOut('slow');
    })

    $('#log a').click(() => {
        $('#log').submit();
    })

    $('.nav-btn').click(e => {
        $('nav').slideToggle();
    });

    $('#select_pedido').change(e => {
        $('#choose_pedido').submit();
    });
    
    $('#categoriasSelect').change(e => {
        let id_producto = e.target.value;
        location.href = "http://localhost/tienda/productos/" + id_producto;
    });