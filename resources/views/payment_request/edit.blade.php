@extends('components.template')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Edit {{ $title }} {{ $data->no_pr }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('payment.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="id_division">Name Division <font style="color: red;">*</font></label>
                                    <select class="form-control @error('id_division') is-invalid @enderror" id="id_division"
                                        name="id_division" readonly disabled>
                                        <option value="{{ $data->division->id }}">{{ $data->division->name }}</option>
                                    </select>
                                    @error('id_division')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="beneficiary_bank">Bank <font style="color: red;">*</font></label>
                                    <select name="beneficiary_bank" id="beneficiary_bank"
                                        class="form-control @error('beneficiary_bank') is-invalid @enderror" required>
                                        <option value="">Select Bank</option>
                                        @foreach ($bank as $item)
                                            <option {{ $data->bank_id == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->name }}
                                                {{ $item->division->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('beneficiary_bank')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="invoice_date">Invoice Date <font style="color: red;">*</font></label>
                                    <input type="date" id="invoice_date" name="invoice_date"
                                        class="form-control @error('invoice_date') is-invalid @enderror"
                                        value="{{ date('Y-m-d', strtotime($data->invoice_date)) }}" required>
                                    @error('invoice_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="due_date">Due Date <font style="color: red;">*</font></label>
                                    <input type="number" id="due_date" name="due_date"
                                        class="form-control @error('due_date') is-invalid @enderror" min="0"
                                        value="{{ $data->due_date ?? 0 }}" required>
                                    @error('due_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="received_date">Received Date <font style="color: red;">*</font></label>
                                    <input type="date" id="received_date" name="received_date"
                                        class="form-control @error('received_date') is-invalid @enderror"
                                        value="{{ date('Y-m-d', strtotime($data->received_date)) }}" required>
                                    @error('received_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date_pr">PR Voucher Date <font style="color: red;">*</font></label>
                                    <input type="date" id="date_pr" name="date_pr"
                                        class="form-control @error('date_pr') is-invalid @enderror"
                                        value="{{ date('Y-m-d', strtotime($data->date_pr)) }}" readonly required>
                                    @error('date_pr')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="contract">Contract</label>
                                    <input type="text" id="contract" name="contract"
                                        class="form-control @error('contract') is-invalid @enderror"
                                        value="{{ $data->contract }}">
                                    @error('contract')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- <div class="form-group col-md-6">
                                    <label for="name_beneficiary">Name Beneficiary <font style="color: red;">*</font>
                                    </label>
                                    <input type="text" id="name_beneficiary" name="name_beneficiary"
                                        class="form-control @error('name_beneficiary') is-invalid @enderror"
                                        value="{{ $data->name_beneficiary }}" required>
                                    @error('name_beneficiary')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> --}}
                                <div class="form-group col-md-6">
                                    <label for="beneficiary">Name Beneficiary <font style="color: red;">*</font></label>
                                    <select class="form-control select2 @error('beneficiary') is-invalid @enderror"
                                        id="beneficiary" name="beneficiary" style="width: 100%;" required>
                                        <option value="">Select beneficiary</option>
                                        @foreach ($vendor as $item)
                                            <option {{ $data->vendor_id == $item->id ? 'selected' : '' }}
                                                data-bank="{{ $item->bank }}" value="{{ $item->id }}">
                                                {{ $item->beneficary }}</option>
                                        @endforeach
                                    </select>
                                    @error('beneficiary')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="bank_account">Bank A/C <font style="color: red;">*</font></label>
                                    <textarea class="form-control @error('bank_account') is-invalid @enderror" name="bank_account" id="bank_account"
                                        disabled readonly required>{{ $data->vendor->bank }}</textarea>
                                    @error('bank_account')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="for">For <font style="color: red;">*</font></label>
                                    <input type="text" id="for" name="for"
                                        class="form-control @error('for') is-invalid @enderror"
                                        value="{{ $data->for }}" required>
                                    @error('for')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row" id="add_desc_form">
                                <div class="form-group col-md-6">
                                    <label for="currency">Type Currency <font style="color: red;">*</font></label>
                                    <select class="form-control @error('currency') is-invalid @enderror" id="currency"
                                        name="currency" required>
                                        <option {{ $data->currency == 'idr' ? 'selected' : '' }} value="idr">IDR
                                        </option>
                                        <option {{ $data->currency == 'usd' ? 'selected' : '' }} value="usd">USD
                                        </option>
                                        <option {{ $data->currency == 'sgd' ? 'selected' : '' }} value="sgd">SGD
                                        </option>
                                    </select>
                                    @error('currency')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row" id="add_desc_form">
                                @foreach ($data->desc as $item)
                                    <div class="form-group col-md-6 desc_form">
                                        <label>Description <font style="color: red;">*</font></label>
                                        <input type="text" name="description[]" class="form-control" maxlength="120"
                                            value="{{ $item->value }}" required>
                                    </div>
                                    <div class="form-group col-md-6 price_form">
                                        <label>Price <font style="color: red;">*</font></label>
                                        <input type="text" name="price[]" class="form-control mask-angka"
                                            min="1" value="{{ $item->price }}" required>
                                    </div>
                                @endforeach
                                <div class="form-group col-md-12" id="before">
                                    <a id="add_form_desc" onclick="addDesc()"
                                        class="btn btn-sm btn-success float-right mt-2" style="color: white;">Add
                                        Description</a>
                                    <a id="remove_form_desc" onclick="removeDesc()"
                                        class="btn btn-sm btn-danger float-right mt-2 mr-1" style="color: white;">Remove
                                        Description</a>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="vat">VAT <font style="color: red;">*</font></label>
                                    <div class="input-group">
                                        <input type="number" id="vat" name="vat"
                                            class="form-control @error('vat') is-invalid @enderror" min="0"
                                            value="{{ $data->vat ?? 0 }}" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">%</div>
                                        </div>
                                        @error('vat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="wht">WHT</label>
                                    <select class="custom-select @error('wht') is-invalid @enderror" id="wht"
                                        name="wht">
                                        <option value="">Select Wht</option>
                                        @foreach ($wht as $item)
                                            <option {{ $data->wht_id == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->name }}</option>
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
                                    <label for="bank_charge">Bank Charges <font style="color: red;">*</font></label>
                                    <input type="text" id="bank_charge" name="bank_charge"
                                        class="form-control mask-angka @error('bank_charge') is-invalid @enderror"
                                        min="0" value="{{ $data->bank_charge ?? 0 }}" required>
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
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            mask_angka();

            $('#beneficiary').change(function() {
                var selectedOption = $(this).find(':selected');
                var bankValue = selectedOption.data('bank');
                $('#bank_account').val(bankValue)
            })

            $('.select2').select2({
                theme: 'bootstrap4'
            })
        });

        var data = @json($data->desc);

        let totalDesc = data.length;

        function addDesc(count) {
            if (totalDesc < 15) {
                totalDesc++;
                var form = $(`
                    <div class="form-group col-md-6 desc_form">
                        <label>Description</label>
                        <input type="text" name="description[]" class="form-control" maxlength="120" required>
                    </div>
                    <div class="form-group col-md-6 price_form">
                        <label>Price</label>
                        <input type="text" name="price[]" class="form-control mask-angka" min="1" required>
                    </div>
                `);
                $('#before').before(form);
                mask_angka()
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

        function mask_angka() {
            $('.mask-angka').inputmask({
                alias: 'numeric',
                groupSeparator: '.',
                autoGroup: true,
                digits: 0,
                rightAlign: false,
                removeMaskOnSubmit: true,
            });
        }
    </script>
@endpush
