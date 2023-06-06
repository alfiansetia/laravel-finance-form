@extends('template')

@section('content')


<div class="mt-5">
        <center>
            <h3>Payment Request</h3>
        </center>
        <a  href="{{ route('add_payment_request') }}" class="btn btn-primary"><img src="{{ asset('icon') }}/add.png" alt="print" height="20" style="filter: brightness(0) invert(1);"></a>
    </div>

    <table class="table table-bordered mt-5">
        <tr>
            <th class="text-center">No.</th>
            {{-- <th class="text-center">Invoice Date</th> --}}
            {{-- <th class="text-center">Received Date</th> --}}
            {{-- <th class="text-center">Contract / PO Number</th> --}}
            <th class="text-center">PR Voucher Date</th>
            <th class="text-center">No PR Voucher</th>
            <th class="text-center">Name Beneficiary</th>
            <th class="text-center">Bank A/C</th>
            <th class="text-center">Description</th>
            <th class="text-center">Price</th>
            <th class="text-center">Bank</th>
            <th class="text-center">Action</th>
        </tr>
          @foreach ($data as $item)
            <tr>
                <td> {{ $i++ }} </td>
                {{-- <td> {{ date('d-M-Y', strtotime($item->invoice_date))}} </td> --}}
                {{-- <td> {{ date('d-M-Y', strtotime($item->received_date))}} </td> --}}
                {{-- <td>{{  $item->contract }}</td> --}}
                <td> {{ date('d-M-Y', strtotime($item->date_pr))}} </td>
                <td>{{  $item->no_pr }}</td>
                <td>{{  $item->name_beneficiary }}</td>
                <td>{{  $item->bank_account }}</td>
                <td>
                    @foreach ($desc as $itemDesc)
                        @if ($itemDesc->id_payment_request == $item->id)
                            {{ $itemDesc->value }}.<br>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($desc as $itemDesc)
                        @if ($itemDesc->id_payment_request == $item->id)
                            {{ $itemDesc->price }}.<br>
                        @endif
                    @endforeach
                </td>
                <td>{{ $item->beneficiary_bank}}</td>
                <td style="display: flex; gap: 10px;">
                    <a href="{{ route('print_payment_request', $item->id) }}" type="button" class="btn btn-secondary"><img src="{{ asset('icon') }}/print.png" alt="print" height="20" style="filter: brightness(0) invert(1);"></a>
                    <a href="{{ route('edit_payment_request', $item->id) }}" type="button" class="btn btn-warning"><img src="{{ asset('icon') }}/edit.png" alt="edit" height="20" style="filter: brightness(0) invert(1);"></a>
                    <form action="{{ route('delete_payment_request', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button  type="submit" class="btn btn-danger"><img src="{{ asset('icon') }}/delete.png" alt="delete" height="20" style="filter: brightness(0) invert(1);"></button>
                    </form>
                </td>
            </tr>
            @endforeach
    </table>


@endsection