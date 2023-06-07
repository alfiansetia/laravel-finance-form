@extends('components.template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Edit Payment Request</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('update_payment_request') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="id_division">Name Division</label>
                                <select class="form-control" id="id_division" name="id_division" readonly>
                                    @foreach ($division as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $data->id_division == $item->id ? 'selected' : 'hidden' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="invoice_date">Invoice Date</label>
                                <input type="date" id="invoice_date" name="invoice_date" class="form-control"
                                    value="{{ date('Y-m-d', strtotime($data->invoice_date)) }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="received_date">Received Date</label>
                                <input type="date" id="received_date" name="received_date" class="form-control"
                                    value="{{ date('Y-m-d', strtotime($data->received_date)) }}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="contract">Contract</label>
                                <input type="text" id="contract" name="contract" class="form-control"
                                    value="{{ $data->contract }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date_pr">PR Voucher Date</label>
                                <input type="date" id="date_pr" name="date_pr" class="form-control"
                                    value="{{ date('Y-m-d', strtotime($data->date_pr)) }}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name_beneficiary">Name Beneficiary</label>
                                <input type="text" id="name_beneficiary" name="name_beneficiary" class="form-control"
                                    value="{{ $data->name_beneficiary }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bank_account">Bank A/C</label>
                                <input type="text" id="bank_account" name="bank_account" class="form-control"
                                    value="{{ $data->bank_account }}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="currency">Type Currency</label>
                                <select class="form-control" id="currency" name="currency" required>
                                    <option {{ $data->currency == 'idr' ? 'selected' : '' }} value="idr">IDR</option>
                                    <option {{ $data->currency == 'usd' ? 'selected' : '' }} value="usd">USD</option>
                                    <option {{ $data->currency == 'sgd' ? 'selected' : '' }} value="sgd">SGD</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row" id="add_desc_form">
                            @foreach ($desc as $item)
                                <div class="form-group col-md-6 desc_form">
                                    <label>Description</label>
                                    <input type="text" name="description[]" class="form-control" maxlength="120"
                                        value="{{ $item->value }}" required>
                                </div>
                                <div class="form-group col-md-6 price_form">
                                    <label>Price</label>
                                    <input type="number" name="price[]" class="form-control" min="0"
                                        value="{{ $item->price }}" required>
                                </div>
                            @endforeach
                            <div class="form-group col-md-12" id="before">
                                <a id="add_form_desc" onclick="addDesc()" class="btn btn-sm btn-success float-right mt-2"
                                    style="color: white;">Add Description</a>
                                <a id="remove_form_desc" onclick="removeDesc()"
                                    class="btn btn-sm btn-danger float-right mt-2 mr-1" style="color: white;">Remove
                                    Description</a>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="currency">Bank</label>
                                <input type="text" id="beneficiary_bank" name="beneficiary_bank" class="form-control"
                                    value="{{ $data->beneficiary_bank }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="for">For</label>
                                <input type="text" id="for" name="for" class="form-control"
                                    value="{{ $data->for }}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="due_date">Due Date</label>
                                <input type="number" id="due_date" name="due_date" class="form-control"
                                    min="0" value="{{ $data->due_date }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="wht">WHT</label>
                                <select class="custom-select" id="wht" name="wht">
                                    <option {{ ceil((100 * $data->total_wht) / $total_description) < 1 ? '' : 'selected' }}
                                        value="">
                                        Select</option>
                                    <option {{ ceil((100 * $data->total_wht) / $total_description) == 2 ? 'selected' : '' }}
                                        value="2">
                                        WHT 21</option>
                                    <option {{ ceil((100 * $data->total_wht) / $total_description) == 3 ? 'selected' : '' }}
                                        value="3">
                                        WHT 22</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="bank_charge">Bank Charges</label>
                                <input type="number" name="bank_charge" class="form-control" min="0"
                                    value="value="{{ $data->bank_charge }}"">
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('payment_request') }}" class="btn btn-md btn-secondary ml-auto mr-2"><i
                                    class="fas fa-backward mr-1"></i>Back</a>
                            <button type="submit" class="btn btn-md btn-primary float-right"><i
                                    class="fab fa-telegram-plane mr-1"></i>Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var data = JSON.parse("{{ $data }}");

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
