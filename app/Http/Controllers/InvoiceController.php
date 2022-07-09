<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\PaymentSafe;
use App\Models\ExchangeStore;
use App\Models\Unit;
use App\Models\Item;
use App\Models\InvoiceItems;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with(['client', 'paymentSafe', 'exchangeStore'])->get();

        return view('panel.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('save');

        return view('panel.invoices.create', ['clients' => Client::all(),
         'paymentSafes' => PaymentSafe::all(), 
         'exchangeStores' => ExchangeStore::all(),
         'units' => Unit::all(),
         'items' => Item::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('save');

        $request->merge(['sub_total' => array_sum($request->selling_prices), 'discount_sort' => 'مبلغ' , 'discount' => 0 , 'total' => array_sum($request->selling_prices)]);
        $invoice = Invoice::create($request->except('items', 'units', 'qtys', 'selling_prices' , 'prices'));

        for ($i=0; $i < count($request->items) ; $i++) { 
            InvoiceItems::create(['invoice_id' => $invoice->id, 'item_id' => $request->items[$i], 'unit_id' => $request->units[$i], 'qty' => $request->qtys[$i], 'price' => $request->selling_prices[$i]]);
        }

        return 'ok';

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $this->authorize('show');

        $invoice = Invoice::whereId($invoice->id)->with(['items'])->first();

        return view('panel.invoices.show', compact('invoice'));
    }

    public function discount(Request $request)
    {
        $this->authorize('details');

        $invoice = Invoice::whereId($request->invoice_id)->first();

        $invoice->discount_sort = $request->discount_sort;
        $invoice->discount = $request->discount;

        $invoice->discount_sort == 'نسبة' ? $invoice->total = $invoice->sub_total * (1 - $invoice->discount / 100)  :  $invoice->total = $invoice->sub_total-$invoice->discount ;



        $invoice->update();

        return redirect()->back();

    }

}
