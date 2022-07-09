@extends('panel.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">
                   تفاصيل الفاتورة  

                    <div style="float:left">
                        <button type="button" class="btn btn-primary">
                            <a href="{{ route('invoices.create') }}" style="color:#fff;">إضافة </a>
                        </button>  
                    </div>
                </h3>

                <div class="card-body">
                    @if(session()->has('message'))
                        <div class="alert {{session('alert') ?? 'alert-info'}}">
                            {{ session('message') }}
                        </div>
                    @endif

                    <table class="table  data-table">

                        <thead>
                            <tr>
                                <th scope="col">اسم الصنف</th>
                                <th scope="col">الوحدة</th>
                                <th scope="col">سعر الوحدة</th>
                                <th scope="col">الكمية</th>
                                <th scope="col">السعر</th>
                               
                            </tr>
                        </thead>


                        <tbody>
                           
                            @foreach ($invoice->items as $item)
                                
                                <tr>
                                    <td>{{ \App\Models\Item::whereId($item->item_id)->first()->name }}</td>
                                    <td>{{ \App\Models\Unit::whereId($item->unit_id)->first()->name }}</td>
                                    <td>{{ \App\Models\ModerateTable::whereExchangeStoreId($invoice->exchange_store_id)->whereItemId($item->item_id)->whereUnitId($item->unit_id)->first()->price ?? '' }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->price }}</td>
                                </tr>

                                
                            @endforeach

                            <tr>
                                <td>الصافى</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{ $invoice->sub_total  }}</td>
                            </tr>


                            <tr>
                                <td>الخصم</td>
                                <td>{{ $invoice->discount_sort }}</td>
                                <td></td>
                                <td></td>
                                <td>{{ $invoice->discount  }}</td>
                            </tr>

                            <tr>
                                <td>الإجمالى</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{ $invoice->total  }}</td>
                            </tr>


                        </tbody>
                       

                          
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
