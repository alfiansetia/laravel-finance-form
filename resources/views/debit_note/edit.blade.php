@extends('components.template')

@section('content')
    <form action="{{ route('debit.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Name Division</strong>
                    <select class="form-control" name="id_division" readonly required>
                        @foreach ($division as $item)
                            <option value="{{ $item->id }}"
                                {{ $data->id_division == $item->id ? 'selected' : 'hidden' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>No Invoice</strong>
                    <input type="number" name="no_invoice" value="{{ $data->no_invoice }}" class="form-control mt-1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Invoice Date</strong>
                    <input type="date" name="invoice_date"
                        value="{{ \Carbon\Carbon::parse($data->invoice_date)->format('Y-m-d') }}" class="form-control mt-1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Tax Invoice Serial No</strong>
                    <input type="text" name="tax_invoice_serial_no" value="{{ $data->tax_invoice_serial_no }}"
                        class="form-control mt-1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Tax Invoice Date</strong>
                    <input type="date" name="tax_invoice_date"
                        value="{{ \Carbon\Carbon::parse($data->tax_invoice_date)->format('Y-m-d') }}"
                        class="form-control mt-1">
                </div>
            </div>
        </div>

        <div class="row" id="a">
            <div class="col-md-6" id="desc_form">

            </div>
            <div class="col-md-6" id="price_form">
                <div class="form-group">
                    <strong>Type Currency</strong>
                    <select class="form-control mt-1" name="is_dolar">
                        <option value="0" {{ $data->is_dolar == 0 ? 'selected' : '' }}>Rupiah</option>
                        <option value="1" {{ $data->is_dolar == 1 ? 'selected' : '' }}>Dolar</option>
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
                        <input type="text" name="description[]" class="form-control mt-1" value="{{ $item->value }}">
                    </div>
                </div>
                <div class="col-md-6" id="price_form">
                    <div class="form-group">
                        <strong>Price</strong>
                        <input type="number" name="price[]" class="form-control mt-1" value="{{ $item->price }}">
                    </div>
                </div>
            @endforeach
            <div class="col-md-12">
                <a id="add_form_desc" onclick="addDesc()" class="btn btn-sm btn-success float-right mt-2"
                    style="color: white;">Add Description</a>
                <a id="remove_form_desc" onclick="removeDesc()" class="btn btn-sm btn-danger float-right mt-2 mr-1"
                    style="color: white;">Remove Description</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Received Bank</strong>
                    <input type="text" name="received_bank" value="{{ $data->received_bank }}"
                        class="form-control mt-1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>For</strong>
                    <input type="text" name="for" value="{{ $data->for }}" class="form-control mt-1">
                </div>
            </div>
            <div class="col-md-6">
                <strong>WHT</strong>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">%</span>
                    </div>
                    <input type="text" class="form-control" name="wht" {{ $data->wht }} class="form-control mt-1"
                        step=0.01 aria-describedby="inputGroupPrepend">

                </div>
                @error('wht')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Bank Charges</strong>
                    <input type="number" name="bank_charge" value="{{ $data->bank_charge }}" class="form-control mt-1">
                </div>
            </div>
            <div class="col-md-6">
                <strong>Received From</strong>
                <input type="text" value="{{ $data->received_from }}" class="form-control" name="received_from"
                    class="form-control mt-1">
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Debit Note Date</strong>
                    <input type="date" value="{{ \Carbon\Carbon::parse($data->debit_note_date)->format('Y-m-d') }}"
                        name="debit_note_date" class="form-control mt-1" readonly>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-md btn-primary float-right">Save</button>
    </form>



    <script>
        var data = @json($desc);

        let totalDesc = data.length;

        function addDesc(count) {

            if (totalDesc < 16) {
                totalDesc++;
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
            totalDesc--;
            console.log(totalDesc);

        }
    </script>
@endsection
