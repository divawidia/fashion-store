@extends('layout-user.index')
@section('title', 'Checkout Page')
@section('content')

<style>
  .container{
    margin-top:15px;
    margin-bottom:30px;
  }

  .form-control{
    font-size:10px;
  }

  li{
    font-size:15px;
  }
</style>
<!-- Breadcrumbs -->
<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="bread-inner">
          <ul class="bread-list">
            <!-- <li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
            <li class="active"><a href="blog-single.html">Checkout</a></li> -->
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Breadcrumbs -->
<!-- Start Checkout -->
<section class="shop checkout section">
<div class="container">
  <form method="post" action="{{url('/users/transaction/checkout')}}">
    <div class="row">
      <div class="col-lg-8 col-12">
        <div class="checkout-form">
          <h2>Make Your Checkout Here</h2>
          <p>Please register in order to checkout more quickly</p>
          @if (session('status'))
            <div class="mt-3 alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
              {{ session('status') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
<!-- Form -->
          <div class="form formcheckout">
            <input type="hidden" id="service" name="service" value="">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                  <label>Name<span>*</span></label>
                  <input type="text" name="name" placeholder="" value="{{auth()->user()->name}}" disabled>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                  <label>Email Address<span>*</span></label>
                  <input type="email" name="email" placeholder="" value="{{auth()->user()->email}}" disabled>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                  <label for="checkout_province">Province*</label>
									<select name="provinsi" id="provinsi" class="dropdown_item_select checkout_input cekongkir form-control" required="required">
										<option>--Pilih Provinsi--</option>
                      @foreach ($dataprovinsi as $prov)
                        <option value="{{$prov->id}}">{{$prov->name}}</option>
                      @endforeach
									</select>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                  <div class="form-group">
                  <label for="checkout_city">City/Town*</label>
									<select name="kota" id="kota" class="dropdown_item_select checkout_input cekongkir form-control" required="required">
                    <option>--Pilih Provinsi terlebih dahulu--</option>
										<option value=""></option>
									</select>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-12">
                  <div class="form-group">
                    <label>Address<span>*</span></label>
                    <input type="text" name="address" placeholder="" required="required">
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                  <div class="form-group">
                  <label for="checkout_province">Courier*</label>
									<select name="courier" id="kurir" class="dropdown_item_select checkout_input cekongkir form-control">
                    <option>--Pilih Kurir--</option>
                      @foreach ($kurir as $k)
                        <option value="{{$k->id}}">{{$k->courier}}</option>
                      @endforeach
                  </select>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                  <div class="form-group" >
                    <label for="checkout_province">Service*</label>
                    <select name="service" id="service_id" class="dropdown_item_select checkout_input form-control">
                      <option>--Pilih Servis--</option>                      
                    </select>
                  </div>

                </div>
              </div>
              {{csrf_field()}}
            </div>
<!--/ End Form -->
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="order-details">
<!-- Order Widget -->
            <div class="single-widget">
              <h2>CART TOTALS</h2>
              <div class="content">
                <ul>
                  <li>Sub Total <span class="float-right">Rp. <span id="total_price" value="{{$total_price}}"> {{$total_price}}</span></span></li>
                  <li>(+) Shipping <span class="float-right">Rp. <span id="biaya-ongkir">0</span></span></li>
                  <li class="last">Total <span class="float-right">Rp. <span id="total-biaya">0</span></span></li>
                  <li>Estimasi <span class="float-right"><span id="estimasi"></span></span></li>
                  <li>Total Berat <span class="float-right"><span id="berat" name="berat" value="{{$total_weight}}"> {{$total_weight}} Gram</span></span></li>
                </ul>
              </div>
            </div>
<!--/ End Order Widget -->
<!--/ End Payment Method Widget -->
<!-- Button Widget -->
            <div class="single-widget get-button">
              <div class="content">
                <div class="">
                  <input type="hidden" name="diskon_price" value="{{$discount_price}}">
                
                  <button type="submit" class="site-btn place-btn">Proceed to checkout</button>
                </div>
              </div>
            </div>
<!--/ End Button Widget -->
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
<!--/ End Checkout -->

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
  $(document).ready(function(){
    $('#hitung_total').onclick(function){
      var price = $('#total_price').val();
      var ongkir = $('#biaya-ongkir').val();
      var total = price + ongkir;

      console.log(total);
          
    }
  })

</script>

<script>
    $(document).ready(function(e){
        $('#provinsi').change(function(e){
            var id_provinsi = $('#provinsi').val()
            if(id_provinsi){
                jQuery.ajax({
                    url: '/users/kota/'+id_provinsi,
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        $('#kota').empty();
                        $.each(data, function(key,value){
                            $('#kota').append('<option value="'+key+'">'+value+'</option>');
                        });
                    },
                });
            }else{
                $('#kota').empty();
            }
        });


var global_scope;
        $('.cekongkir').change(function(e){
            var kurir = $('#kurir').val();
            var provinsi = $('#provinsi').val();
            var kota = $('#kota').val();
            var berat = parseInt($('#weight').val());
            if(provinsi>0 && kurir>0){
                jQuery.ajax({
                    url: "{{url('/users/ongkir')}}",
                    method: 'GET',
                    data: {
                        _token: $('#signup-token').val(),
                        destination: kota,
                        weight: berat,
                        courier: kurir,
                        prov: provinsi, 
                    },
                    success: function(result){
                        console.log(result);

                        service = result.hasil[0]['costs'];
                        document.getElementById("service_id").innerHTML += "<option selected>Pilih Service</option>";
                        global_scope = service;
                        
                        service.forEach(loopfun);
                        function loopfun(itema,index){
                          document.getElementById("service_id").innerHTML += "<option value="+index+">"+itema.service+" "+itema.cost[0].value+"</option>";
                        }
                        
                        
                    }
                });
                
            }else{
                console.log('wrong');
                console.log('provinsi: '+provinsi+' Kurir: '+kurir)
            }

        });

        $('#service_id').change(function(){
          console.log('ini');
          var id =document.getElementById("service_id").value;
          var chos = global_scope[id];
          var total = chos.cost[0].value+{{$total_price}}
          console.log(chos);
          
          $('#biaya-ongkir').text('Rp.'+chos.cost[0].value);
          $('#ongkir').val(chos.cost[0].value);
          $('#biaya-ongkir').append('<input type="hidden" name="ongkir" id="biaya-ongkir" value="'+chos.cost[0].value+'">');
          $('#estimasi').append(chos.cost[0].etd+' Hari</li>');
          $('#total-biaya').text({{$total_price}}+chos.cost[0].value);
          $('#total_harga').append('<input type="hidden" id = totharga" name="totharga" value="'+total+'">')
        });

        $('#beli').click(function(e){
          var kurir = $('#kurir').val();
          var provinsi = $('#provinsi').val();
          var kota = $('#kota').val();
          var alamat = $('#alamat').val();
          var totals = parseInt($('#total-biaya').text());
          var subtotal = parseInt('{{$total_price}}');
          var ongkir = $('#biaya-ongkir').val();
          var user = $('#user_id').val();
          console.log(totals)
          if(totals==0){
            alert('Tolong Lengkapi Masukan Data');
            return false;
          }
        });
    });
</script>
@endsection