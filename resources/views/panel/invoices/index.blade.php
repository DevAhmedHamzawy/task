@extends('panel.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">
                    الفواتير 

                    @canany(['admin','save'])
                    <div style="float:left">
                        <button type="button" class="btn btn-primary">
                            <a href="{{ route('invoices.create') }}" style="color:#fff;">إضافة </a>
                        </button>  
                    </div>
                    @endcan
                   
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
                                <th scope="col">#</th>
                                <th scope="col">اسم العميل</th>
                                <th scope="col">خزنة الدفع</th>
                                <th scope="col">مخزن الصرف</th>
                                <th scope="col">الصافى</th>
                                <th scope="col">نوع الخصم</th>
                                <th scope="col">الخصم</th>
                                <th scope="col">الإجمالى</th>
                                <th scope="col">العمليات</th>
                                <th scope="col">العمليات</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($invoices as $invoice)

                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->client->name }}</td>
                                <td>{{ $invoice->paymentSafe->name }}</td>
                                <td>{{ $invoice->exchangeStore->name }}</td>
                                <td>{{ $invoice->sub_total }}</td>
                                <td>{{ $invoice->discount_sort }}</td>
                                <td>{{ $invoice->discount }}</td>
                                <td>{{ $invoice->total }}</td>
                                <td>
                                    <div class="btn btn-info" data-toggle="modal" data-target="#exampleModal">عمل خصم</div>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-body">
                                              <form method="post" action="{{ route('invoice.discount') }}">
                                                @csrf
                                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                                <input type="text" class="form-control" name="discount" id="">
                                                <select class="form-control" name="discount_sort" id="">
                                                    <option>نسبة</option>
                                                    <option>مبلغ</option>
                                                </select>
                                                <button type="submit" class="btn btn-secondary">اضافة الخصم</button>
                                              </form>  
                                            </div>
                                            
                                          </div>
                                        </div>
                                      </div>
                                </td>

                                @canany(['admin','details','show'])
                                <td>
                                    <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-primary">عرض</a>
                                </td>
                                @endcanany
                               
                            </tr>

                           

                            @endforeach
                        </tbody>
                       

                          
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
