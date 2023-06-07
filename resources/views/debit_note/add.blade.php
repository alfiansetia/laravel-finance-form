@extends('components.template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Add {{ $title }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('debit.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="id_division">Name Division</label>
                                <select class="form-control" id="id_division" name="id_division" required>
                                    @foreach ($division as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="invoice_date">Invoice Date</label>
                                <input type="date" id="invoice_date" name="invoice_date" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="received_date">Received Date</label>
                                <input type="date" id="received_date" name="received_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="contract">Contract</label>
                                <input type="text" id="contract" name="contract" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date_pr">PR Voucher Date</label>
                                <input type="date" id="date_pr" name="date_pr" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name_beneficiary">Name Beneficiary</label>
                                <input type="text" id="name_beneficiary" name="name_beneficiary" class="form-control"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bank_account">Bank A/C</label>
                                <input type="text" id="bank_account" name="bank_account" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="currency">Type Currency</label>
                                <select class="form-control" id="currency" name="currency" required>
                                    <option value="idr" selected>IDR</option>
                                    <option value="usd">USD</option>
                                    <option value="sgd">SGD</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row" id="add_desc_form">
                            <div class="form-group col-md-6 desc_form">
                                <label>Description</label>
                                <input type="text" name="description[]" class="form-control" maxlength="120" required>
                            </div>
                            <div class="form-group col-md-6 price_form">
                                <label>Price</label>
                                <input type="number" name="price[]" class="form-control" min="0" required>
                            </div>
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
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="for">For</label>
                                <input type="text" id="for" name="for" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="due_date">Due Date</label>
                                <input type="number" id="due_date" name="due_date" class="form-control"
                                    min="0">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="wht">WHT</label>
                                <select class="custom-select" id="wht" name="wht">
                                    <option value="">Select</option>
                                    <option value="2">WHT 21</option>
                                    <option value="3">WHT 22</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="bank_charge">Bank Charges</label>
                                <input type="number" name="bank_charge" class="form-control" min="0">
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('debit.index') }}" class="btn btn-md btn-secondary ml-auto mr-2"><i
                                    class="fas fa-backward mr-1"></i>Back</a>
                            <button type="submit" class="btn btn-md btn-primary float-right"><i
                                    class="fab fa-telegram-plane mr-1"></i>Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('debit.store') }}" method="POST">
        @csrf
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="form-group">
                    <strong>No Invoice</strong>
                    <input type="number" name="no_invoice" class="form-control mt-1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Invoice Date</strong>
                    <input type="date" name="invoice_date" class="form-control mt-1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Tax Invoice Serial No</strong>
                    <input type="text" name="tax_invoice_serial_no" class="form-control mt-1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Tax Invoice Date</strong>
                    <input type="date" name="tax_invoice_date" class="form-control mt-1">
                </div>
            </div>
        </div>

        <div class="row" id="a">
            <div class="col-md-6" id="desc_form">

            </div>
            <div class="col-md-6" id="price_form">
                <div class="form-group">
                    <strong>Type Currency</strong>
                    {{-- <input type="number" name="price[]" class="form-control mt-1">  --}}
                    <select class="form-control mt-1" name="is_dolar">
                        <option selected value="0">Rupiah</option>
                        <option value="1">Dolar</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
            </div>
        </div>

        <div class="row" id="add_desc_form">
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
                    <input type="text" name="received_bank" class="form-control mt-1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>For</strong>
                    <input type="text" name="for" class="form-control mt-1">
                </div>
            </div>
            <div class="col-md-6">
                <strong>WHT</strong>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">%</span>
                    </div>
                    <input type="number" class="form-control" name="wht" class="form-control mt-1" step=0.01
                        aria-describedby="inputGroupPrepend">

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Bank Charges</strong>
                    <input type="number" name="bank_charge" class="form-control mt-1">
                </div>
            </div>
            <div class="col-md-6">
                <strong>Received From</strong>
                <input type="text" class="form-control" name="received_from" class="form-control mt-1">
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Debit Note Date</strong>
                    <input type="date" name="debit_note_date" class="form-control mt-1">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-md btn-primary float-right">Save</button>
    </form>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var today = new Date().toISOString().split('T')[0];
            $('input[type=date]').val(today);
        });
    </script>
    <script>
        let totalDesc = 1;

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
@endpush
