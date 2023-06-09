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
                    <form action="{{ route('payment.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="id_division">Name Division *</label>
                                <select class="form-control @error('id_division') is-invalid @enderror"" id="id_division"
                                    name="id_division" required>
                                    @foreach ($division as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="beneficiary_bank">Bank *</label>
                                <input type="text" id="beneficiary_bank" name="beneficiary_bank"
                                    class="form-control @error('beneficiary_bank') is-invalid @enderror"
                                    value="{{ old('beneficiary_bank') }}" required>
                                @error('beneficiary_bank')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="invoice_date">Invoice Date *</label>
                                <input type="date" id="invoice_date" name="invoice_date"
                                    class="form-control @error('invoice_date') is-invalid @enderror"
                                    value="{{ old('invoice_date') }}" required>
                                @error('invoice_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="received_date">Received Date *</label>
                                <input type="date" id="received_date" name="received_date"
                                    class="form-control @error('received_date') is-invalid @enderror"
                                    value="{{ old('received_date') }}" required>
                                @error('received_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date_pr">PR Voucher Date *</label>
                                <input type="date" id="date_pr" name="date_pr"
                                    class="form-control @error('date_pr') is-invalid @enderror"
                                    value="{{ old('date_pr') }}" required>
                                @error('date_pr')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name_beneficiary">Name Beneficiary *</label>
                                <input type="text" id="name_beneficiary" name="name_beneficiary"
                                    class="form-control @error('name_beneficiary') is-invalid @enderror"
                                    value="{{ old('name_beneficiary') }}" required>
                                @error('name_beneficiary')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="bank_account">Bank A/C *</label>
                                <input type="text" id="bank_account" name="bank_account"
                                    class="form-control @error('bank_account') is-invalid @enderror"
                                    value="{{ old('bank_account') }}" required>
                                @error('bank_account')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="for">For *</label>
                                <input type="text" id="for" name="for"
                                    class="form-control @error('for') is-invalid @enderror" value="{{ old('for') }}"
                                    required>
                                @error('for')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            {{-- <div class="form-group col-md-6">
                                <label for="contract">Contract</label>
                                <input type="text" id="contract" name="contract"
                                    class="form-control @error('contract') is-invalid @enderror"
                                    value="{{ old('contract') }}">
                                @error('contract')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}
                            <div class="form-group col-md-6">
                                <label for="currency">Type Currency *</label>
                                <select class="form-control @error('currency') is-invalid @enderror" id="currency"
                                    name="currency" required>
                                    <option value="idr" selected>IDR</option>
                                    <option value="usd">USD</option>
                                    <option value="sgd">SGD</option>
                                </select>
                                @error('currency')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row" id="add_desc_form">
                            <div class="form-group col-md-6 desc_form">
                                <label>Description *</label>
                                <input type="text" name="description[]" class="form-control" maxlength="120" required>
                            </div>
                            <div class="form-group col-md-6 price_form">
                                <label>Price *</label>
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
                                <label>VAT *</label><br>
                                <div class="form-check form-check-inline">
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="vat" value="yes"
                                            checked>
                                        <span class="form-radio-sign">Yes</span>
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="vat" value="no">
                                        <span class="form-radio-sign">No</span>
                                    </label>
                                </div>
                                @error('vat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="wht">WHT</label>
                                <select class="custom-select @error('wht') is-invalid @enderror" id="wht"
                                    name="wht">
                                    <option value="">Select Wht</option>
                                    @foreach ($wht as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('wht')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="due_date">Due Date</label>
                                <input type="number" id="due_date" name="due_date"
                                    class="form-control @error('due_date') is-invalid @enderror"
                                    value="{{ old('due_date', 0) }}" min="0">
                                @error('due_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bank_charge">Bank Charges *</label>
                                <input type="number" id="bank_charge" name="bank_charge"
                                    class="form-control @error('bank_charge') is-invalid @enderror"
                                    value="{{ old('bank_charge', 0) }}" min="0">
                                @error('bank_charge')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <div class="text-right">
                            <a href="{{ route('payment.index') }}" class="btn btn-md btn-secondary ml-auto mr-2"><i
                                    class="fas fa-backward mr-1"></i>Back</a>
                            <button type="submit" class="btn btn-md btn-primary float-right"><i
                                    class="fab fa-telegram-plane mr-1"></i>Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    @stack('js')
    <script>
        $(document).ready(function() {
            var today = new Date().toISOString().split('T')[0];
            $('input[type=date]').val(today);
        });


        let totalDesc = 1;

        function addDesc(count) {
            if (totalDesc < 16) {
                totalDesc++;
                var form = $(`
                            <div class="form-group col-md-6 desc_form">
                                <label>Description *</label>
                                <input type="text" name="description[]" class="form-control" maxlength="120" required>
                            </div>
                            <div class="form-group col-md-6 price_form">
                                <label>Price *</label>
                                <input type="number" name="price[]" class="form-control" min="0" required>
                            </div>
            `);
                $('#before').before(form);
            } else {
                alert('input description can not be more than 15');
            }
        }

        function removeDesc() {
            if (totalDesc > 1) {
                $('#add_desc_form').find('.desc_form').last().remove()
                $('#add_desc_form').find('.price_form').last().remove()
                totalDesc--;
            }
        }
    </script>
@endpush
