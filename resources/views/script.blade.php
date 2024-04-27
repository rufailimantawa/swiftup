<script>
  var serviceOperatorsContainer = $('#serviceOperators');
  var networkInfo = {
    1: {name: "MTN NG"},
    2: {name: "Airtel NG"},
    3: {name: "Glo NG"},
    4: {name: "9 Mobile NG"},
  };
</script>
<script>
  $("#balanceToggler").click(function (el) {
    var balance = $(el.target).parents('.balance');

    balance.toggleClass('balance-star');
    balance.find("#balanceToggler span").toggleClass("fa-eye")
    balance.find("#balanceToggler span").toggleClass("fa-eye-slash")
  })

  $('.service[data-su-target]').each(function (i, el) {
    $(this).click(function () {
      // console.log(this);
    });








    $('#serviceModal .modal-body #serviceOperators .operator').each(function (i, el) {
      $(el).click(function () {
        // $('#serviceModal .modal-body > *').attr('data-su-hidden', true)
        // var selectedOperator = $(this).data('operator-id');
        
        // serviceOperatorsContainer.animate({height: '0'}, 400, 'swing', function () {
        //   serviceOperatorsContainer.hide();
        // });
        // $($(el).data('su-target')).attr('data-su-hidden', false);
      });
    })
  });
</script>