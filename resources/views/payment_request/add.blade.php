@extends('components.template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Create Payment Request</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('store_payment_request') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Name Division</strong>
                                    <select class="form-control" name="id_division" required>
                                        @foreach ($division as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Invoice Date</strong>
                                    <input type="date" name="invoice_date" class="form-control mt-1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Received Date</strong>
                                    <input type="date" name="received_date" class="form-control mt-1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Contract</strong>
                                    <input type="text" name="contract" class="form-control mt-1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>PR Voucher Date</strong>
                                    <input type="date" name="date_pr" class="form-control mt-1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Name Beneficiary</strong>
                                    <input type="text" name="name_beneficiary" class="form-control mt-1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Bank A/C</strong>
                                    <input type="text" name="bank_account" class="form-control mt-1">
                                </div>
                            </div>
                        </div>

                        <div class="row" id="a">
                            <div class="col-md-6" id="desc_form1">

                            </div>
                            <div class="col-md-6" id="price_form1">
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
                            <div class="col-md-6 desc_form" id="desc_form">
                                <div class="form-group">
                                    <strong>Description</strong>
                                    <input type="text" name="description[]" class="form-control mt-1">
                                </div>
                            </div>
                            <div class="col-md-6 price_form" id="price_form">
                                <div class="form-group">
                                    <strong>Price</strong>
                                    <input type="number" name="price[]" class="form-control mt-1">
                                </div>
                            </div>
                            <div class="col-md-12" id="before">
                                <a id="add_form_desc" onclick="addDesc()" class="btn btn-sm btn-success float-right mt-2"
                                    style="color: white;">Add Description</a>
                                <a id="remove_form_desc" onclick="removeDesc()"
                                    class="btn btn-sm btn-danger float-right mt-2 mr-1" style="color: white;">Remove
                                    Description</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Bank</strong>
                                    <input type="text" name="beneficiary_bank" class="form-control mt-1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>For</strong>
                                    <input type="text" name="for" class="form-control mt-1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Due Date</strong>
                                    <input type="number" name="due_date" class="form-control mt-1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong>WHT</strong>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">%</span>
                                    </div>
                                    <select class="custom-select" name="wht" id="inputGroupSelect01">
                                        <option value="0" selected>Choose...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    {{-- <input type="number" class="form-control" name="wht" class="form-control mt-1" step=0.01
                                        aria-describedby="inputGroupPrepend"> --}}

                                </div>
                                {{-- @error('wht')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror --}}
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Bank Charges</strong>
                                    <input type="number" name="bank_charge" class="form-control mt-1">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-md btn-primary float-right">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    @stack('js')
    <script>
        let totalDesc = 1;

        function addDesc(count) {

            if (totalDesc < 16) {
                totalDesc++;
                var form = $(`
                <div class="col-md-6 desc_form" id="desc_form">
                    <div class="form-group">
                        <strong>Description</strong>
                        <input type="text" name="description[]" class="form-control mt-1">
                    </div>
                </div>
                <div class="col-md-6 price_form" id="price_form">
                    <div class="form-group">
                        <strong>Price</strong>
                        <input type="number" name="price[]" class="form-control mt-1">
                    </div>
                </div>
            `);
                $('#before').before(form);
            } else {
                alert('input description can not be more than 15');
            }
            console.log(totalDesc);
        }

        function removeDesc() {
            if (totalDesc > 1) {
                $('#add_desc_form').find('.desc_form').last().remove()
                $('#add_desc_form').find('.price_form').last().remove()
                totalDesc--;
            }
            console.log(totalDesc);

        }
    </script>
@endpush
