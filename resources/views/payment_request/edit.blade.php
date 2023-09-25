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
                                <div class="form-group col-md-3">
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
                                <div class="form-group col-md-3">
                                    <label for="deadline">Deadline</label>
                                    <input type="date" id="deadline" name="deadline"
                                        class="form-control @error('deadline') is-invalid @enderror" required readonly>
                                    @error('deadline')
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
                                        @foreach ($vendor as $key => $item)
                                            <option {{ $data->vendor_id == $item->id ? 'selected' : '' }}
                                                data-bank="{{ $item->bank }}" value="{{ $item->id }}">
                                                {{ $item->beneficary }} ({{ $item->detail }})</option>
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
                                        value="{{ $data->for }}" maxlength="120" required>
                                    @error('for')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
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
                                    @if ($item->type == 'reg')
                                        <div class="form-group col-md-6 desc_form">
                                            <label>Description <font style="color: red;">*</font></label>
                                            <input type="text" name="description[]" class="form-control"
                                                maxlength="120" value="{{ $item->value }}" required>
                                        </div>
                                        <div class="form-group col-md-6 price_form">
                                            <label>Price <font style="color: red;">*</font></label>
                                            <input type="text" name="price[]" class="form-control mask-angka"
                                                value="{{ $item->price }}" required>
                                        </div>
                                    @endif
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
                            <div class="form-row" id="add_desc_form_add">
                                @foreach ($data->desc as $item)
                                    @if ($item->type == 'add')
                                        <div class="form-group col-md-6 desc_form_add">
                                            <label>Description <font style="color: red;">*</font></label>
                                            <input type="text" name="description_add[]" class="form-control"
                                                maxlength="120" value="{{ $item->value }}" required>
                                        </div>
                                        <div class="form-group col-md-6 price_form_add">
                                            <label>Price <font style="color: red;">*</font></label>
                                            <input type="text" name="price_add[]" class="form-control mask-angka"
                                                value="{{ $item->price }}" required>
                                        </div>
                                    @endif
                                @endforeach
                                <div class="form-group col-md-12" id="before_add">
                                    <a id="add_form_desc_add" onclick="addDesc_add()"
                                        class="btn btn-sm btn-success float-right mt-2" style="color: white;">Add
                                        Description</a>
                                    <a id="remove_form_desc_add" onclick="removeDesc_add()"
                                        class="btn btn-sm btn-danger float-right mt-2 mr-1" style="color: white;">Remove
                                        Description</a>
                                </div>
                            </div>
                            <div class="text-right mt-2">
                                <button type="button" id="btn_add" class="btn btn-primary">Show Additional</button>
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
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            mask_angka();

            set_deadline()

            $('#beneficiary').change(function() {
                var selectedOption = $(this).find(':selected');
                var bankValue = selectedOption.data('bank');
                $('#bank_account').val(bankValue)
            })

            $('.select2').select2({
                theme: 'bootstrap4'
            })

            $('#received_date').change(function() {
                set_deadline()
            })

            $('#due_date').change(function() {
                set_deadline()
            })



        });


        var data = @json($data->desc);
        var add = 0
        for (let i = 0; i < data.length ?? 0; i++) {
            if (data[i]['type'] == 'add') {
                add = add + 1
            }
        }


        var show = true

        if (add > 0) {
            show = false
        }

        set_text_btn()

        $('#btn_add').click(function() {
            set_text_btn()
        })

        function set_text_btn() {
            let html = element_form()
            if (show) {
                $('#add_desc_form_add').html('')
                $('#add_desc_form_add').hide()
                show = false
                $('#btn_add').text('Show Additonal')
            } else {
                $('#add_desc_form_add').html(html)
                $('#add_desc_form_add').show()
                show = true
                $('#btn_add').text('Hide Additonal')
            }
            mask_angka()
            cek_desc()
        }


        function set_deadline() {
            var received_date = moment($('#received_date').val());
            var dueDate = parseInt($('#due_date').val())
            var deadline = received_date.clone().add(dueDate, 'days');
            $('#deadline').val(deadline.format('YYYY-MM-DD'));
        }

        function element_form() {
            let htm = ''
            if (add > 0) {
                data.forEach(item => {
                    if (item.type == 'add') {
                        htm += `<div class="form-group col-md-6 desc_form_add">
                        <label>Description <font style="color: red;">*</font></label>
                        <input type="text" name="description_add[]" class="form-control" maxlength="120"
                          value="${item.value}" required>
                    </div>
                    <div class="form-group col-md-6 price_form">
                        <label>Price <font style="color: red;">*</font></label>
                        <input type="text" name="price_add[]" class="form-control mask-angka" value="${item.price}" required>
                    </div>`
                    }
                });
                htm += `<div class="form-group col-md-12" id="before_add">
                        <a id="add_form_desc_add" onclick="addDesc_add()"
                            class="btn btn-sm btn-success float-right mt-2" style="color: white;">Add
                            Description</a>
                        <a id="remove_form_desc_add" onclick="removeDesc_add()"
                            class="btn btn-sm btn-danger float-right mt-2 mr-1" style="color: white;">Remove
                            Description</a>
                    </div>`
            } else {
                htm = element_form_blank()
            }
            return htm
        }

        function element_form_blank() {
            return `<div class="form-group col-md-6 desc_form_add">
                        <label>Description <font style="color: red;">*</font></label>
                        <input type="text" name="description_add[]" class="form-control" maxlength="120"
                            required>
                    </div>
                    <div class="form-group col-md-6 price_form">
                        <label>Price <font style="color: red;">*</font></label>
                        <input type="text" name="price_add[]" class="form-control mask-angka" required>
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
            if (totalDesc < 15) {
                var form = $(`
                            <div class="form-group col-md-6 desc_form_add">
                                <label>Description <font style="color: red;">*</font></label>
                                <input type="text" name="description_add[]" class="form-control" maxlength="120" required>
                            </div>
                            <div class="form-group col-md-6 price_form_add">
                                <label>Price <font style="color: red;">*</font></label>
                                <input type="text" name="price_add[]" class="form-control mask-angka" required>
                            </div>
                        `);
                $('#before_add').before(form);
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
                digits: 0,
                rightAlign: false,
                removeMaskOnSubmit: true,
            });
        }
    </script>
@endpush
