@extends('components.template')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('content')
    <form action="{{ route('debit.store') }}" method="POST">
        @csrf
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Add {{ $title }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="validator">Validator <font style="color: red;">*</font></label>
                                    <select class="form-control select2 @error('validator') is-invalid @enderror"
                                        id="validator" name="validator" style="width: 100%;" required>
                                        <option value="">Select Validator</option>
                                        @foreach ($validators as $item)
                                            <option {{ old('validator') == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">Prepared By : {{ $item->prepared_by }}, Checked
                                                By : {{ $item->checked_by }}, Approved By : {{ $item->approved_by }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('validator')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="id_division">Name Division <font style="color: red;">*</font></label>
                                    <select class="form-control select2 @error('id_division') is-invalid @enderror"
                                        id="id_division" name="id_division" style="width: 100%;" required>
                                        <option value="">Select Division</option>
                                        @foreach ($division as $item)
                                            <option {{ old('id_division') == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_division')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="received_bank">Received Bank <font style="color: red;">
                                            <font style="color: red;">*</font>
                                        </font></label>
                                    <select name="received_bank" id="received_bank"
                                        class="form-control select2 @error('received_bank') is-invalid @enderror"
                                        style="width: 100%;" required>
                                        <option value="">Select Bank</option>
                                        @foreach ($bank as $item)
                                            <option {{ old('received_bank') == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->name }}
                                                {{ $item->division->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('received_bank')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="no_invoice">No Invoice <font style="color: red;">*</font></label>
                                    <input type="number" id="no_invoice" name="no_invoice"
                                        class="form-control @error('no_invoice') is-invalid @enderror"
                                        value="{{ old('no_invoice') }}" required>
                                    @error('no_invoice')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="invoice_date">Invoice Date <font style="color: red;">*</font></label>
                                    <input type="date" id="invoice_date" name="invoice_date"
                                        class="form-control @error('invoice_date') is-invalid @enderror"
                                        value="{{ old('invoice_date') }}" required>
                                    @error('invoice_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="debit_note_date">Debit Note Date <font style="color: red;">*</font></label>
                                    <input type="date" id="debit_note_date" name="debit_note_date"
                                        class="form-control @error('debit_note_date') is-invalid @enderror"
                                        value="{{ old('debit_note_date') }}" required>
                                    @error('debit_note_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tax_invoice_serial_no">Tax Invoice Serial No <font style="color: red;">*
                                        </font></label>
                                    <input type="text" id="tax_invoice_serial_no" name="tax_invoice_serial_no"
                                        class="form-control @error('tax_invoice_serial_no') is-invalid @enderror"
                                        value="{{ old('tax_invoice_serial_no') }}" required>
                                    @error('tax_invoice_serial_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tax_invoice_date">Tax Invoice Date <font style="color: red;">*</font>
                                    </label>
                                    <input type="date" id="tax_invoice_date" name="tax_invoice_date"
                                        class="form-control @error('tax_invoice_date') is-invalid @enderror"
                                        value="{{ old('tax_invoice_date') }}" required>
                                    @error('tax_invoice_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="for">For <font style="color: red;">*</font></label>
                                    <input type="text" id="for" name="for"
                                        class="form-control @error('for') is-invalid @enderror"
                                        value="{{ old('for') }}" maxlength="120" required>
                                    @error('for')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="wht_no">WHT No <font style="color: red;">*</font></label>
                                    <input type="text" id="wht_no" name="wht_no"
                                        class="form-control @error('wht_no') is-invalid @enderror"
                                        value="{{ old('wht_no') }}" required>
                                    @error('wht_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="wht_date">WHT Date <font style="color: red;">*</font>
                                    </label>
                                    <input type="date" id="wht_date" name="wht_date"
                                        class="form-control @error('wht_date') is-invalid @enderror"
                                        value="{{ old('wht_date') }}" required>
                                    @error('wht_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="received_from">Received From <font style="color: red;">*</font></label>
                                    <input type="text" id="received_from" name="received_from"
                                        class="form-control @error('received_from') is-invalid @enderror"
                                        value="{{ old('received_from') }}" required>
                                    @error('received_from')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="currency">Type Currency <font style="color: red;">*</font></label>
                                    <select class="form-control @error('currency') is-invalid @enderror" id="currency"
                                        name="currency" required>
                                        <option {{ old('currency') == 'idrtoidr' ? 'selected' : '' }} value="idrtoidr">IDR
                                            to IDR
                                        </option>
                                        <option {{ old('currency') == 'idrtosgd' ? 'selected' : '' }} value="idrtosgd">IDR
                                            to SGD
                                        </option>
                                        <option {{ old('currency') == 'idrtousd' ? 'selected' : '' }} value="idrtousd">IDR
                                            to USD
                                        </option>
                                        <option {{ old('currency') == 'usdtousd' ? 'selected' : '' }} value="usdtousd">USD
                                            to USD
                                        </option>
                                    </select>
                                    @error('currency')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row" id="add_desc_form">
                                <div class="form-group col-md-6 desc_form">
                                    <label>Description <font style="color: red;">*</font></label>
                                    <input type="text" name="description[]" class="form-control" maxlength="120"
                                        required>
                                </div>
                                <div class="form-group col-md-6 price_form">
                                    <label>Price <font style="color: red;">*</font></label>
                                    <input type="text" name="price[]" class="form-control mask-angka" required>
                                </div>
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
                                    <label for="vat">VAT</label>
                                    <select class="custom-select @error('vat') is-invalid @enderror" id="vat"
                                        name="vat">
                                        <option value="">Select VAT</option>
                                        @foreach ($vat as $item)
                                            <option {{ old('vat') == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
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
                                        <option value="">Select WHT</option>
                                        @foreach ($wht as $item)
                                            <option {{ old('wht') == $item->id ? 'selected' : '' }}
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
                        </div>
                    </div>
                </div>

                <div class="col-md-12" id="add_desc_form_card" style="display: none">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row" id="add_desc_form_add" style="display: none">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="bank_charge">Bank Charges <font style="color: red;">*</font></label>
                                    <input type="text" id="bank_charge" name="bank_charge"
                                        class="form-control mask-angka @error('bank_charge') is-invalid @enderror"
                                        value="{{ old('bank_charge', 0) }}" min="0" required>
                                    @error('bank_charge')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="button" id="btn_add" class="btn btn-primary">Add Invoice</button>
                                <a href="{{ route('debit.index') }}" class="btn btn-md btn-secondary ml-auto mr-2"><i
                                        class="fas fa-backward mr-1"></i>Back</a>
                                <button type="submit" class="btn btn-md btn-primary float-right"><i
                                        class="fab fa-telegram-plane mr-1"></i>Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div id="vat_wht" style="display: none">
        <div class="form-group col-md-6 vat_form_add">
            <label>VAT</label>
            <select name="vat_add[]" class="form-control">
                <option value="">Select VAT</option>
                @foreach ($vat as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-6 wht_form_add">
            <label>WHT</label>
            <select name="wht_add[]" class="form-control">
                <option value="">Select WHT</option>
                @foreach ($wht as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6 pr_serial_form_add">
            <label for="bank_account">PR No Serial Tax <font style="color: red;">*</font></label>
            <input type="text" name="pr_serial[]" class="form-control" maxlength="120" required>
        </div>
        <div class="form-group col-md-6 tax_date_form_add">
            <label for="for">Tax Date <font style="color: red;">*</font></label>
            <input type="date" name="tax_date[]" class="form-control" maxlength="120" required>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            })

            var today = new Date().toISOString().split('T')[0];
            $('input[type=date]').val(today);

            mask_angka()

            var show = false

            $('#btn_add').click(function() {
                let html = element_form()
                if (show) {
                    $('#add_desc_form_add').html('')
                    $('#add_desc_form_add').hide()
                    $('#add_desc_form_card').hide()
                    show = false
                    $(this).text('Add Invoice')
                } else {
                    $('#add_desc_form_add').html(html)
                    $('#add_desc_form_add').show()
                    $('#add_desc_form_card').show()
                    show = true
                    $(this).text('Hide Invoice')
                }
                mask_angka()
                cek_desc()
            })
        });


        function element_form() {
            return `<div class="form-group col-md-6 desc_form_add">
                        <label>Description <font style="color: red;">*</font></label>
                        <input type="text" name="description_add[]" class="form-control" maxlength="120"
                            required>
                    </div>
                    <div class="form-group col-md-6 price_form">
                        <label>Price <font style="color: red;">*</font></label>
                        <input type="text" name="price_add[]" class="form-control mask-angka" required>
                    </div>
                    <div class="form-group col-md-6 vat_form_add">
                        <label>VAT</label>
                        <select name="vat_add[]" class="form-control">
                            <option value="">Select VAT</option>
                            @foreach ($vat as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 wht_form_add">
                        <label>WHT</label>
                        <select name="wht_add[]" class="form-control">
                            <option value="">Select WHT</option>
                            @foreach ($wht as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6 pr_serial_form_add">
                        <label for="bank_account">PR No Serial Tax <font style="color: red;">*</font></label>
                        <input type="text" name="pr_serial[]" class="form-control" maxlength="120" required>
                    </div>
                    <div class="form-group col-md-6 tax_date_form_add">
                        <label for="for">Tax Date <font style="color: red;">*</font></label>
                        <input type="date" name="tax_date[]" class="form-control" maxlength="120" required>
                    </div>
                    <div class="form-group col-md-12" id="before_add">
                        <a id="add_form_desc_add" onclick="addDesc_add()"
                            class="btn btn-sm btn-success float-right mt-2" style="color: white;">Add
                            Description</a>
                        <a id="remove_form_desc_add" onclick="removeDesc_add()"
                            class="btn btn-sm btn-danger float-right mt-2 mr-1" style="color: white;">Remove
                            Description</a>
                    </div>`
        }


        function set_deadline() {
            var received_date = moment($('#received_date').val());
            var dueDate = parseInt($('#due_date').val())
            var deadline = received_date.clone().add(dueDate, 'days');
            $('#deadline').val(deadline.format('YYYY-MM-DD'));
        }

        var desc = 0
        var desc_add = 0

        function addDesc(count) {
            let totalDesc = desc + desc_add
            if (totalDesc < 15) {
                var form = $(`
                            <div class="form-group col-md-6 desc_form">
                                <label>Description <font style="color: red;">*</font></label>
                                <input type="text" name="description[]" class="form-control" maxlength="120" required>
                            </div>
                            <div class="form-group col-md-6 price_form">
                                <label>Price <font style="color: red;">*</font></label>
                                <input type="text" name="price[]" class="form-control mask-angka" required>
                            </div>
            `);
                $('#before').before(form);
                mask_angka()
            } else {
                alert('input description can not be more than 15');
            }
            cek_desc()
        }

        function removeDesc() {
            if (desc > 1) {
                $('#add_desc_form').find('.desc_form').last().remove()
                $('#add_desc_form').find('.price_form').last().remove()
            }
            cek_desc()
        }

        function addDesc_add(count) {
            let totalDesc = desc + desc_add
            let ad = $('#vat_wht').html()
            if (totalDesc < 15) {
                var form = `<div class="form-group col-md-6 desc_form_add">
                                <label>Description <font style="color: red;">*</font></label>
                                <input type="text" name="description_add[]" class="form-control" maxlength="120" required>
                            </div>
                            <div class="form-group col-md-6 price_form_add">
                                <label>Price <font style="color: red;">*</font></label>
                                <input type="text" name="price_add[]" class="form-control mask-angka" required>
                            </div>`
                form += ad
                $('#before_add').before($(form));
                mask_angka()
            } else {
                alert('input description can not be more than 15');
            }
            cek_desc()
        }

        function removeDesc_add() {
            if (desc_add > 1) {
                $('#add_desc_form_add').find('.desc_form_add').last().remove()
                $('#add_desc_form_add').find('.price_form_add').last().remove()
                $('#add_desc_form_add').find('.vat_form_add').last().remove()
                $('#add_desc_form_add').find('.wht_form_add').last().remove()
                $('#add_desc_form_add').find('.pr_serial_form_add').last().remove()
                $('#add_desc_form_add').find('.tax_date_form_add').last().remove()
            }
            cek_desc()
        }

        function cek_desc() {
            desc = $('.desc_form').length ?? 0
            desc_add = $('.desc_form_add').length ?? 0
            // console.log(desc, desc_add);
        }

        function mask_angka() {
            $('.mask-angka').inputmask({
                alias: 'numeric',
                groupSeparator: '.',
                autoGroup: true,
                digits: 2,
                rightAlign: false,
                removeMaskOnSubmit: true,
            });
        }
    </script>
@endpush
