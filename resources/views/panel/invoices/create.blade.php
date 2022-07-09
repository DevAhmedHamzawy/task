@extends('panel.layouts.app')

@section('content')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1 class="text-center">اضافة فاتورة</h1></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('invoices.store') }}">
                    @csrf

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="date" class="col-md-2 col-form-label text-md-right">التاريخ</label>
                    
                                <div class="col-md-10">
                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date" autofocus>
                    
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">إسم العميل</label>
                    
                                <div class="col-md-10">
                    
                                    <select name="client_id" id="client_id" class="form-control">
                    
                                        <option value="">اختر الإسم ...</option>
                    
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                    
                                    </select>

                                    <a href=javascript:void(0)"  data-toggle="modal" data-target="#exampleModal">اضافة عميل جديد</a>



                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            
                                            <div class="modal-body">
                                            <input type="text" class="form-control" id="client_name" placeholder="إسم العميل">
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                            <button type="button" onclick="saveClient()" class="btn btn-primary">حفظ</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>



                                </div>
                            </div>

                    
                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">خزينة الدفع</label>
                    
                                <div class="col-md-10">
                    
                                    <select name="payment_safe_id"  class="form-control">
                    
                                        <option value="">اختر الإسم ...</option>
                    
                                        @foreach ($paymentSafes as $safe)
                                            <option value="{{ $safe->id }}">{{ $safe->name }}</option>
                                        @endforeach
                    
                                    </select>
                                </div>
                            </div>
                    
                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">مخزن الصرف</label>
                    
                                <div class="col-md-10">
                    
                                    <select class="form-control" id="exchange_store" name="exchange_store_id">
                    
                                        <option value="">اختر الإسم ...</option>
                    
                                        @foreach ($exchangeStores as $store)
                                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                                        @endforeach
                    
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                        
                            <div class="form-group row">
                                <label for="item" class="col-md-2 col-form-label text-md-right">الصنف</label>
                            
                                <div class="col-md-10">
                                    

                                    <select class="form-control" id="item">
                
                                        <option value="">اختر الإسم ...</option>
                    
                                        @foreach ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                    
                                    </select>

                                

                                    @error('item')
                                        <span class="invalid-feedback" country="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-6">
                                    <input id="qty" type="text" placeholder="الكمية" class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty') }}" required autocomplete="qty" autofocus>

                                    @error('qty')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-md-6">
                        
                                    <select  class="form-control" id="unit" onchange="getPrice(this);">
                        
                                        <option value="">اختر الوحدة ...</option>
                        
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                        
                                    </select>
                                </div>


                            </div>

                            <div class="form-group row">
                    
                                <div id="price" style="display: none;"></div>

                                <div class="col-md-12">
                                    <input id="selling_price" type="text" placeholder="سعر البيع" class="form-control @error('selling_price') is-invalid @enderror"  value="{{ old('selling_price') }}" required autocomplete="selling_price" autofocus>
                    
                                    @error('selling_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        
                            
                            <div class="btn btn-success" onclick="addItem()">أضف</div>

                        </div>



                        <table class="table">
                        

                            <thead>
                                <tr>
                                    <th scope="col">الصنف</th>
                                    <th scope="col">الكمية</th>
                                    <th scope="col">الوحدة</th>
                                    <th scope="col">سعر الوحدة</th>
                                    <th scope="col">الإجمالى</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>

                        </table>

                
                    </div>
      

        

                    <div class="form-group row mb-0">
                        <button type="submit" class="btn btn-primary col-md-12">
                            إضافة فاتورة 
                        </button>
                    </div>
                    </form>


                </div></div></div></div></div>

@endsection


@section('footer')

 <script>
      function getPrice(unit){

            var exchange_store = $('#exchange_store').val();
            var item = $('#item').val();
            var unit = unit.value;
            var qty = $('#qty').val();

            axios.get('../../items/'+exchange_store+'/'+item+'/'+unit+'/'+qty)
                .then((data) => {
                console.log(data);
                if(data.data == false) { alert('لا يوجد'); return; }
               
                $('#price').empty();
                $('#price').append(data.data[0])

                $('#selling_price').empty();
                $('#selling_price').val(data.data[1]);
            })
    }

    function addItem()
    {
        var item = $('#item :selected').text();
        var unit = $('#unit :selected').text();
        var qty = $('#qty').val();
        var price = $('#price').text();
        var selling_price = $('#selling_price').val();

        var item_value = $('#item').val();
        var unit_value = $('#unit').val();


        console.log('item '+item,'unit '+unit,'qty '+qty,'price '+price,'selling_price '+selling_price);

        $('.table tbody').append('<input type="hidden" name="items[]" value="'+item_value+'" >');
        $('.table tbody').append('<input type="hidden" name="units[]" value="'+unit_value+'" >');
        $('.table tbody').append('<input type="hidden" name="qtys[]" value="'+qty+'" >');
        $('.table tbody').append('<input type="hidden" name="selling_prices[]" value="'+selling_price+'" >');
        $('.table tbody').append('<input type="hidden" name="prices[]" value="'+price+'" >');


        $('.table tbody').append('<tr><td>'+item+'</td><td>'+qty+'</td><td>'+unit+'</td><td>'+price+'</td><td>'+selling_price+'</td></tr>');
        
    }

    function saveClient()
    {
        
        axios.get('../../save_client/'+$('#client_name').val())
            .then((data) => {
                console.log(data)

                $('#client_id').empty()

                $('#client_id').append('<option value="">اختر الإسم ...</option>')

                data.data.forEach(element => {

                    $('#client_id').append('<option value="'+element.id+'">'+element.name+'</option>')

                    
                });

                $('#exampleModal').modal('toggle');


            });
    }

 </script>

@endsection