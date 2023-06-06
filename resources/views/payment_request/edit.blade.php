
@extends('components.template')

@section('content')

<form action="{{ route('update_payment_request') }}" method="POST">
    @csrf

    <div class="mt-5">
        <h2>Edit Payment Request</h2>
    </div>

    <input type="hidden" name="id" value="{{$data->id}}">

     <div class="row mt-5">
        <div class="col-md-6">
            <div class="form-group">
                 <strong>Name Division</strong>
                 <select class="form-control" name="id_division" readonly > 
                     @foreach($division as $item)
                         <option value="{{ $item->id }}" {{$data->id_division == $item->id ? "selected" : "hidden" }}>{{ $item->name}}</option>
                     @endforeach
                 </select>
            </div>
        </div>
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>Invoice Date</strong>
                <input type="date" name="invoice_date" class="form-control mt-1" value="{{ \Carbon\Carbon::parse($data->invoice_date)->format('Y-m-d') }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>Received Date</strong>
                <input type="date" name="received_date" class="form-control mt-1" value="{{ \Carbon\Carbon::parse($data->received_date)->format('Y-m-d') }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>Contract</strong>
                <input type="text" name="contract" class="form-control mt-1" value="{{$data->contract}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>PR Voucher Date</strong>
                <input type="date" name="date_pr" class="form-control mt-1" value="{{ \Carbon\Carbon::parse($data->date_pr)->format('Y-m-d') }}" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>Name Beneficiary</strong>
                <input type="text" name="name_beneficiary" class="form-control mt-1" value="{{ $data->name_beneficiary }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>Bank A/C</strong>
                <input type="text" name="bank_account" class="form-control mt-1" value="{{ $data->bank_account }}">
            </div>
        </div>
    </div>

    <div class="row" id="a">
        <div class="col-md-6" id="desc_form">
           
        </div>
        <div class="col-md-6" id="price_form">
            <div class="form-group">
                <strong>Type Currency</strong>
                 <select class="form-control mt-1" name="is_dolar" >
                    <option value="0" {{$data->is_dolar == 0 ? "selected" : "" }}>Rupiah</option>
                    <option value="1"  {{$data->is_dolar == 1 ? "selected" : "" }}>Dolar</option> 
                </select>
            </div>
        </div> 
        <div class="col-md-12">
        </div>
    </div>

    <div class="row" id="add_desc_form"> 
        @foreach ($desc as $item)
            <div class="col-md-6" id="desc_form">
                <div class="form-group">
                    <strong>Description</strong>
                    <input type="text" name="description[]" class="form-control mt-1" value="{{$item->value}}">
                </div>
            </div>
            <div class="col-md-6" id="price_form">
                <div class="form-group">
                    <strong>Price</strong>
                    <input type="number" name="price[]" class="form-control mt-1" value="{{$item->price}}"> 
                </div>
            </div> 
        @endforeach
        <div class="col-md-12">
            <a id="add_form_desc" onclick="addDesc()"  class="btn btn-sm btn-success float-right mt-2" style="color: white;" >Add Description</a>
            <a id="remove_form_desc" onclick="removeDesc()" class="btn btn-sm btn-danger float-right mt-2 mr-1" style="color: white;">Remove Description</a>
        </div>
    </div>

     
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <strong>Bank</strong>
                <input type="text" name="beneficiary_bank" class="form-control mt-1" value="{{ $data->beneficiary_bank }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>For</strong>
                <input type="text" name="for" class="form-control mt-1" value="{{ $data->for }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>Due Date</strong>
                <input type="number" name="due_date" class="form-control mt-1" value="{{ $data->due_date }}">
            </div>
        </div>
        <div class="col-md-6">
            <strong>WHT</strong>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">%</span>
                </div>
                <input type="number" class="form-control" name="wht" class="form-control mt-1"  step=0.01 aria-describedby="inputGroupPrepend" value="{{ (100 * $data->total_wht) / $total_description }}">
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>Bank Charges</strong>
                <input type="number" name="bank_charge" class="form-control mt-1" value="{{ $data->bank_charge }}">
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-md btn-primary float-right">Update</button>
</form>



<script>

    var data = @json($desc); 

    let totalDesc = data.length; 

    function addDesc(count) {
        
        if (totalDesc < 16) {
            totalDesc ++;
            var form = $(`
                <div class="col-md-6" id="desc_form">
                    <div class="form-group">
                        <strong>Description</strong>
                        <input type="text" name="description[]" class="form-control mt-1">
                    </div>
                </div>
                <div class="col-md-6" id="price_form">
                    <div class="form-group">
                        <strong>Price</strong>
                        <input type="number" name="price[]" class="form-control mt-1">
                    </div>
                </div>
            `);
            $('#add_desc_form').prepend(form);
        } else {
            alert('input description can not be more than 15');
        }
        console.log(totalDesc);
    }

    function removeDesc() {
        $('#desc_form').remove();
        $('#price_form').remove();
        totalDesc --;
        console.log(totalDesc);

    }


</script>
@endsection