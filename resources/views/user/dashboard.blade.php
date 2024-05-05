@extends('user.master')

@section('user.main')
<div class="container-fluid p-0">
  {{-- Total Balance --}}
  <section class="container-fluid balance balance-star bg-success text-white p-2 mb-3 rounded-3">
    <div class="balance-header d-flex justify-content-between">
      <div class="d-flex align-items-center">
        <span class="pe-1">Balance</span>
        <button id="balanceToggler" class="btn p-0">
          <span class="fa fa-eye-slash fa-fw text-white"></span>
        </button>
      </div>
      <a href="/user/transaction/history">Transaction History &gt;</a>
    </div>
    <div class="balance-action">
      <div class="account-balance">
        <span class="star-balance">*****</span>
        <span class="currency">₦</span>
        <span class="amount">{{ number_format(Auth::user()->wallet->balance, 2) }}</span>
      </div>
      {{-- <div class="account-swiftpoint">
        <span>swiftpoints: </span>
        <span class="star-balance">*****</span>
        <span class="amount">{{ Auth::user()->wallet->swiftpoints }}</span>
      </div> --}}
    </div>
  </section>
  {{-- Last three transaction history --}}
  {{-- Services --}}
  <section class="services p-2 rounded-3">
    <div class="services-header">
      <span>Services</span>
    </div>
    <div class="services-cards pt-2">
      <div class="service card p-3" data-su-toggle data-su-service-type="data" data-su-template="service-DataBundle">
        <div class="fa fa-wifi fa-3x text-success"></div>
        <span class="text">Data</span>
      </div>
      <div class="service card p-3" data-su-toggle data-su-service-type="airtime" data-su-template="service-AirtimeTopUp">
        <div class="fa fa-phone fa-3x text-success"></div>
        <span class="text">Airtime</span>
      </div>
    </div>
  </section>

</div>
<section class="modal fade" id="serviceModal">
  <div class="modal-dialog modal-fullscreen-md-down modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"></h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div id="serviceOperators" class="border p-3 mb-2">
          <p class="text-center"><strong>Select Network Operator</strong></p>
          <div class="row">
            <div class="col-3 operator p-3" data-operator-id="1">
              <span class="fa fa-check"></span>
              <img class="shadow-sm" src="{{ asset('/img/mtn-logo.png') }}" alt="MTN" width="100%">
            </div>
            <div class="col-3 operator p-3" data-operator-id="2">
              <span class="fa fa-check"></span>
              <img class="shadow-sm" src="{{ asset('/img/airtel-logo.png') }}" alt="Airtel" width="100%">
            </div>
            <div class="col-3 operator p-3" data-operator-id="3">
              <span class="fa fa-check"></span>
              <img class="shadow-sm" src="{{ asset('/img/glo-logo.png') }}" alt="Glo" width="100%">
            </div>
            <div class="col-3 operator p-3" data-operator-id="4">
              <span class="fa fa-check"></span>
              <img class="shadow-sm" src="{{ asset('/img/9mobile-logo.png') }}" alt="9 Mobile" width="100%">
            </div>
          </div>
        </div>
        <div class="content"></div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
  var serviceModalElem = $('#serviceModal');
  var serviceModal = new bootstrap.Modal(serviceModalElem[0]);

  function showServiceContent(type, operator, template) {
    var fragment = $(`template[name=${template}]`).eq(0);

    console.log(fragment, template);
    serviceModalElem.find('.content').html(fragment.html())
  }

  $("#balanceToggler").click(function (el) {
    var balance = $(el.target).parents('.balance');

    balance.toggleClass('balance-star');
    balance.find("#balanceToggler span").toggleClass("fa-eye")
    balance.find("#balanceToggler span").toggleClass("fa-eye-slash")
  });

  $('.service[data-su-toggle]').each(function () {
    $(this).click(function() {
      var serviceBtn = $(this);
      
      $('#serviceOperators .operator').removeAttr('selected');
      serviceModalElem.find('.content').html("")
      
      if (serviceBtn.data('su-service-type') == 'airtime') {
        serviceModalElem.find('.modal-title').text("Airtime Purchase");
      } else {
        serviceModalElem.find('.modal-title').text("Data Bundle Purchase");
      }
      serviceModalElem.data('service-type', serviceBtn.data('su-service-type'));
      serviceModalElem.data('service-template', serviceBtn.data('su-template'));
      
      serviceModal.show()
    });
  });
  
  $('#serviceOperators .operator').each(function () {
    $(this).click(function () {
      var operator = $(this);

      $('#serviceOperators .operator').removeAttr('selected');
      showServiceContent(
        serviceModalElem.data('service-type'),
        operator.data('operator-id'),
        serviceModalElem.data('service-template'),
      );
      operator.attr('selected', true)
      console.log(serviceModalElem.data('service-type'), 'for', operator.data('operator-id'));
    });
  });
</script>
@endpush

@push('templates')
<template name="service-AirtimeTopUp">
  <div id="serviceAirtimeTopUp-ModalBody">
    <form method="POST">
      <input type="hidden" name="operator" value="">
      <div class="border set-amount p-3 mb-3">
        <p class="text-center"><strong>Choose airtime amount</strong></p>
        <div class="select p-3 row">
          @foreach ([100, 200, 300, 400, 500, 1000, 2000, 3000, 4000] as $amount)
            <div class="col-4 d-grid">
              <button
                class="btn btn-block border rounded-3 py-3 mb-2"
                data-su-amount="{{$amount}}" type="button"><strong>₦ {{number_format($amount)}}</strong></button>
            </div>
          @endforeach
        </div>
        <p class="text-center mb-2"><strong>Or enter preferred amount (₦ {{$system['airtime_min']}} - ₦ {{number_format($system['airtime_max'])}})</strong></p>
        <input type="number" class="form-control" placeholder="Amount">
      </div>
      <div class="d-flex mb-3">
        <input class="flex-grow-1 form-control me-1" type="tel" name="mobile_number" placeholder="Mobile Number">
        <button class="btn bg-secondary text-white rounded-pill px-4"><strong>Pay</strong></button>
      </div>
    </form>
  </div>
</template>
<template name="service-DataBundle">
  <div id="serviceDataBundle-ModalBody">
    <h4>Data Bundle</h4>
    <p class="small" style="font-weight: 300;">Please choose a bundle you like</p>

    <div class="container-fluid mt-3 text-center">
      <div class="row data-bundle p-3 rounded-3 mb-3">
        <div class="col-4 border-end">
          <p class="small"><span class="fa fa-wifi"></span> Name</p>
          <p><strong>1GB</strong></p>
        </div>
        <div class="col-4 border-end">
          <p class="small"><span class="fa fa-clock-o"></span> Validity</p>
          <p>30 days</p>
        </div>
        <div class="col-4">
          <p class="small"><span class="fa fa-money"></span> Price</p>
          <p>₦ {{number_format(255)}}</p>
        </div>
      </div>
    </div>
  </div>
</template>
<template name="services-operator">
  <div class="col-3 operator p-3" data-operator-id="1"><img src="" alt="" width="100%"></div>
</template>
@endpush