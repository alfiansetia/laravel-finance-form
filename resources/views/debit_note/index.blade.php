@extends('template')

@section('content')


<div class="mt-5">
    <center>
        <h3>Debit Note</h3>
    </center>
    <a  href="{{ route('add_debit_note') }}" class="btn btn-primary"><img src="{{ asset('icon') }}/add.png" alt="print" height="20" style="filter: brightness(0) invert(1);"></a>
</div>


<div class="table-responsive-xl"">
    <table class="table table-bordered mt-5" border="1">
        <tr>
            <th class="text-center">No.</th>
            {{-- <th class="text-center">No Invoice</th> --}}
            <th class="text-center">Invoice Date</th>
            {{-- <th class="text-center">Tax Invoice Serial No</th> --}}
            {{-- <th class="text-center">Tax Invoice Date</th> --}}
            <th class="text-center">No Debit Note</th>
            <th class="text-center">Description</th>
            <th class="text-center">Price</th>
            <th class="text-center">Received Bank</th>
            <th class="text-center">Received From</th>
            <th class="text-center">For</th>
            <th class="text-center">Action</th>
        </tr>
          @foreach ($data as $item)
            <tr>
                <td> {{ $i++ }} </td>
                {{-- <td>{{  $item->no_invoice }}</td> --}}
                <td> {{ date('d-M-Y', strtotime($item->invoice_date))}} </td>
                {{-- <td>{{  $item->tax_invoice_serial_no }}</td> --}}
                {{-- <td> {{ date('d-M-Y', strtotime($item->tax_invoice_date))}} </td> --}}
                <td>{{  $item->no_debit_note }}</td>
                <td>
                    @foreach ($desc as $itemDesc)
                        @if ($itemDesc->id_debit_note == $item->id)
                            {{ $itemDesc->value }}.<br>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($desc as $itemDesc)
                        @if ($itemDesc->id_debit_note == $item->id)
                            {{ $itemDesc->price }}.<br>
                        @endif
                    @endforeach
                </td>
                <td>{{ $item->received_bank}}</td>
                <td>{{ $item->received_from}}</td>
                <td>{{ $item->for}}</td>
                <td style="display: flex; gap: 10px;">
                    <a href="{{ route('print_debit_note', $item->id) }}" type="button" class="btn btn-secondary"><img src="{{ asset('icon') }}/print.png" alt="print" height="20" style="filter: brightness(0) invert(1);"></a>
                    <a href="{{ route('edit_debit_note', $item->id) }}" type="button" class="btn btn-warning"><img src="{{ asset('icon') }}/edit.png" alt="edit" height="20" style="filter: brightness(0) invert(1);"></a>
                    <form action="{{ route('delete_debit_note', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button  type="submit" class="btn btn-danger"><img src="{{ asset('icon') }}/delete.png" alt="delete" height="20" style="filter: brightness(0) invert(1);"></button>
                    </form>
                </td>
            </tr>
            @endforeach
    </table>
</div>


@endsection