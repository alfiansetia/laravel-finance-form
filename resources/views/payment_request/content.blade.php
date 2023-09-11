@php
    $vat_value = 0;
    $wht_value = 0;
    $total = 0;
    $grand_total = 0;
    if ($data->vat > 0) {
        $vat_value = ($data->totalreg * $data->vat) / 100;
    }
    if ($data->wht) {
        $wht_value = ($data->totalreg * $data->wht->value) / 100;
    }
    $total = $data->total + $vat_value - $wht_value;
    $grand_total = $data->total + $data->bank_charge + $vat_value - $wht_value;
    
    function breakTextIntoLines($text, $maxCharactersPerLine = 50)
    {
        $words = explode(' ', $text);
        $lines = [];
        $currentLine = '';
    
        foreach ($words as $word) {
            $newLine = $currentLine . ' ' . $word;
            $newLineLength = strlen($newLine);
    
            if ($newLineLength <= $maxCharactersPerLine) {
                $currentLine = $newLine;
            } else {
                $lines[] = trim($currentLine);
                $currentLine = $word;
            }
        }
    
        $lines[] = trim($currentLine);
    
        return $lines;
    }
    
    $text = $data->vendor->bank;
    
    $lines = breakTextIntoLines($text, 50);
    
@endphp
{{-- 
{{ count($lines) }}

@foreach ($lines as $item)
    <br>
    {{ $item }}
@endforeach --}}
<tbody>
    <tr>
        <td colspan="9"
            style="border-top: 1pt solid black;border-right: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-bottom: none;padding: 0mm;height: 70pt;vertical-align: middle;">
            <div style="margin: 0px;padding: 0px;width: 100%;"><img src="{{ $path_logo }}" width="114" height="45"
                    style="margin-left: 8pt;margin-top: 0;">
                @if ($data->status_id == 4)

                    @for ($i = 0; $i < 50; $i++)
                        &nbsp;
                    @endfor
                    <font size="18" color="green"> PAID</font>
                @endif
            </div>
            <div class="pd-header">
                <span style="font-family:'Calibri', sans-serif;float: left;">
                    {{ $data->division->name }}
                </span>
                <span style="font-family:'Times New Roman', serif;float: right;margin-right: 5pt;">PAYMENT
                    REQUEST</span>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="7"
            style="border-top: none;border-right: none;border-bottom: none;border-image: initial;border-left: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
            <strong><span class="pd-small">PAID TO :</span></strong>
        </td>
        <td
            style="border-top: 1pt solid black;border-right: 1pt solid black;border-bottom: 1pt solid black;border-image: initial;border-left: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
            <span class="pd-small">NO</span>
        </td>
        <td
            style="text-align: right;border-top: 1pt solid black;border-right: 1pt solid black;border-bottom: 1pt solid black;border-image: initial;border-left: none;padding: 0mm;height: 13pt;vertical-align: middle;">
            <span class="pd-small">{{ $data->no_pr }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="7"
            style="border-top: none;border-right: none;border-bottom: none;border-image: initial;border-left: 1pt solid black;padding: 0mm;height: 3pt;vertical-align: middle;">
            <strong><span class="pd-small">{{ $data->vendor->beneficary }}</span></strong>
        </td>

        <td
            style="border-top: none;border-left: 1pt solid black;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 3pt;vertical-align: middle;">
            <span class="pd-small">DATE</span>
        </td>
        <td
            style="text-align: right;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 3pt;vertical-align: middle;">
            <span class="pd-small">{{ date('d-M-y', strtotime($data->date_pr)) }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="9"
            style="border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: middle;">
            <strong><span class="pd-small">FOR : {{ $data->for }}</span></strong>
        </td>
    </tr>
    <tr>
        <td colspan="8"
            style="text-align: center;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: middle;">
            <strong><span class="pd-small">DESCRIPTION</span></strong>
        </td>
        <td
            style="text-align: center;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
            <strong><span class="pd-small">Price</span></strong>
        </td>
    </tr>
    <tr>
        <td colspan="9"
            style="border-top: none;border-left: 1pt solid black;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 1pt;vertical-align: middle;">
        </td>
    </tr>
    @php
        $sisa = 21 - count($data->desc ?? []);
    @endphp
    @foreach ($data->desc as $item)
        @if ($item->type == 'reg')
            <tr>
                <td colspan="8"
                    style="border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: middle;">
                    <span class="pd-small">{{ $item->value }}</span>
                </td>
                <td
                    style="text-align: right;width: 82pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
                    <span
                        class="pd-small">{{ number_format($item->price, $data->currency != 'idr' ? 2 : 0, ',', ',') }}</span>
                </td>
            </tr>
        @endif
    @endforeach
    @if ($vat_value > 0)
        @php
            $sisa = $sisa - 1;
        @endphp
        <tr>
            <td colspan="8"
                style="border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: middle;">
                <span class="pd-small">VAT {{ $data->vat }}%</span>
            </td>
            <td
                style="text-align: right;width: 82pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
                <span
                    class="pd-small">{{ number_format($vat_value, $data->currency != 'idr' ? 2 : 0, ',', ',') }}</span>

            </td>
        </tr>
    @endif
    @if ($wht_value > 0)
        @php
            $sisa = $sisa - 1;
        @endphp
        <tr>
            <td colspan="8"
                style="border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: middle;">
                <span class="pd-small">{{ $data->wht->name }}</span>
            </td>
            <td
                style="text-align: right;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
                <span class="pd-small">(
                    {{ number_format($wht_value, $data->currency != 'idr' ? 2 : 0, ',', ',') }}
                    )</span>

            </td>
        </tr>
    @endif
    @php
        $sisa = $sisa - 1;
    @endphp
    <tr>
        <td colspan="8"
            style="border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: middle;">
            <span class="pd-small"></span>
        </td>
        <td
            style="border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
            <span class="pd-small"></span>
        </td>
    </tr>

    @foreach ($data->desc as $item)
        @if ($item->type == 'add')
            <tr>
                <td colspan="8"
                    style="border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: middle;">
                    <span class="pd-small">{{ $item->value }}</span>
                </td>
                <td
                    style="text-align: right;width: 82pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
                    <span
                        class="pd-small">{{ number_format($item->price, $data->currency != 'idr' ? 2 : 0, ',', ',') }}</span>
                </td>
            </tr>
        @endif
    @endforeach
    @for ($i = 0; $i < $sisa; $i++)
        <tr>
            <td colspan="8"
                style="border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: middle;">
                <span class="pd-small"></span>
            </td>
            <td
                style="border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
                <span class="pd-small"></span>
            </td>
        </tr>
    @endfor
    <tr>
        <td colspan="8"
            style="border-top: none;border-left: 1pt solid black;border-bottom: 1.5pt solid black;border-right: 1pt solid black;padding: 0mm;height: 12.85pt;vertical-align: middle;">
            <span class="pd-small"></span>
        </td>
        <td
            style="border-top: none;border-left: none;border-bottom: 1.5pt solid black;border-right: 1pt solid black;padding: 0mm;height: 12.85pt;vertical-align: middle;">
            <span class="pd-small"></span>
        </td>
    </tr>
    <tr>
        <td colspan="8" class="bold-no-border">
            <strong><span class="pd-small">To be Paid
                    {{ $data->currency == 'idr' ? 'Rp' : ($data->currency == 'usd' ? '$' : 'S$') }}</span></strong>
        </td>
        <td class="bold-border">
            <strong><span
                    class="pd-small">{{ number_format($total, $data->currency != 'idr' ? 2 : 0, ',', ',') }}</span></strong>
        </td>
    </tr>
    <tr>
        <td colspan="8" class="bold-no-border">
            <strong><span class="pd-small">Forex at</span></strong>
        </td>
        <td class="bold-border">
            <strong><span class="pd-small"></span></strong>
        </td>
    </tr>

    <tr>
        <td colspan="8" class="bold-no-border">
            <strong><span class="pd-small">Convert to Rp
                    {{-- {{ $data->currency == 'idr' ? 'Rp' : ($data->currency == 'usd' ? '$' : 'S$') }} --}}
                </span></strong>
        </td>
        <td class="bold-border">
            <strong><span class="pd-small"></span></strong>
        </td>
    </tr>
    <tr>
        <td colspan="8" class="bold-no-border">
            <strong><span class="pd-small">Bank charges
                    {{ $data->currency == 'idr' ? 'Rp' : ($data->currency == 'usd' ? '$' : 'S$') }}</span></strong>
        </td>
        <td class="bold-border">
            <strong><span
                    class="pd-small">{{ $data->bank_charge > 0 ? number_format($data->bank_charge, $data->currency != 'idr' ? 2 : 0, ',', ',') : '' }}</span></strong>
        </td>
    </tr>
    <tr>
        <td colspan="8" class="bold-no-border" style="border-bottom: 3pt solid black;border-top: 1pt solid black">
            <strong><span class="pd-small">TOTAL
                    {{ $data->currency == 'idr' ? 'Rp' : ($data->currency == 'usd' ? '$' : 'S$') }}</span></strong>
        </td>
        <td class="bold-border" style="border-bottom: 3pt solid black">
            <strong><span
                    class="pd-small">{{ number_format($grand_total, $data->currency != 'idr' ? 2 : 0, ',', ',') }}</span></strong>
        </td>
    </tr>

    <tr>
        <td colspan="9"
            style="border-top: none;border-left: 1pt solid black;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
            <span class="pd-xs"></span>
        </td>
    </tr>
    <tr>
        <td colspan="9"
            style="border-top: none;border-left: 1pt solid black;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 1pt;vertical-align: middle;">
        </td>
    </tr>
    <tr>
        <td colspan="3"
            style="border-top: none;border-left: 1pt solid black;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 11.6pt;vertical-align: middle;">
            <strong><u><span class="pd-small">BANK ACCOUNT FROM :</span></u></strong>

        </td>
        <td colspan="3"
            style="border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 11.6pt;vertical-align: middle;">
            <strong><u><span class="pd-small">TRANSFERRED TO BANK ACCOUNT
                        :</span></u></strong>
        </td>
        <td colspan="3"
            style="border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 11.6pt;vertical-align: middle;">
            <strong><span class="pd-small">CHECK SUPPORTING DOCUMENT</span></strong>
        </td>
    </tr>
    <tr>
        <td colspan="3"
            style="border-top: none;border-left: 1pt solid black;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
            <span class="pd-small">{{ $data->bank->name }}</span>
        </td>
        <td colspan="3"
            style="border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
            <span class="pd-small">{{ $data->vendor->beneficary }}</span>
        </td>
        <td colspan="2"
            style="border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 8.6pt;vertical-align: middle;">
            {{-- <strong><span class="pd-small">CONTRACT / PO No</span></strong> --}}
            <p
                style='margin:0mm;margin-top:1.9pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:1.55pt;line-height:8.7pt;'>
                <strong><span class="pd-small">CONTRACT / PO No</span></strong>
            </p>
        </td>
        <td
            style="border-top: 1pt solid black;border-right: 1pt solid black;border-bottom: 1pt solid black;border-image: initial;border-left: none;padding: 0mm;height: 8.6pt;vertical-align: middle;">
            <span class="pd-small">&nbsp;{{ $data->contract }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="3"
            style="white-space: nowrap;border-top: none;border-left: 1pt solid black;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
            <span class="pd-small">{{ $data->division->name }}</span>
        </td>
        <td colspan="3" style="white-space: nowrap;border: none;padding: 0mm;height: 11pt;vertical-align: middle;">
            <span class="pd-small">
                @if (count($lines) < 2)
                    {{ $data->vendor->bank }}
                @elseif(count($lines) > 1)
                    {{ $lines[0] }}
                @endif
            </span>
        </td>
        <td colspan="3"
            style="border-top: none;border-bottom: none;border-left: 1pt solid black;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
            <span class="pd-xs">[ &nbsp; &nbsp; &nbsp;] ORIGINAL INVOICE + MATERAI</span>
        </td>
    </tr>
    <tr>
        <td colspan="3"
            style="border-top: none;border-left: 1pt solid black;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
            <p style='margin:0mm;text-indent:8.0pt;line-height:8.6pt;'>
                <span class="pd-small"></span>
            </p>
        </td>
        <td colspan="3" style="white-space: nowrap;border: none;padding: 0mm;height: 11pt;vertical-align: middle;">
            <span class="pd-small">
                @if (count($lines) >= 2)
                    {{ $lines[1] }}
                @endif
            </span>
        </td>
        <td colspan="3"
            style="border-top: none;border-bottom: none;border-left: 1pt solid black;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
            <span class="pd-xs">[ &nbsp; &nbsp; &nbsp;] ORIGINAL FAKTUR PAJAK</span>
        </td>
    </tr>
    <tr>
        <td colspan="3"
            style="border-top: none;border-left: 1pt solid black;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
            <p style='margin:0mm;text-indent:8.0pt;line-height:8.6pt;'>
                <span class="pd-small"></span>
            </p>
        </td>
        <td colspan="3" style="white-space: nowrap;border: none;padding: 0mm;height: 11pt;vertical-align: middle;">
            <span class="pd-small">
                @if (count($lines) >= 3)
                    {{ $lines[2] }}
                @endif
            </span>
        </td>
        <td colspan="3"
            style="border-top: none;border-bottom: none;border-left: 1pt solid black;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
            <span class="pd-xs">[ &nbsp; &nbsp; &nbsp;] ORIGINAL DGT-1 WP LN ( Foreigner
                Consultant
                )</span>
        </td>
    </tr>
    <tr>
        <td colspan="3"
            style="border-top: none;border-left: 1pt solid black;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
            <p style='margin:0mm;text-indent:8.0pt;line-height:8.6pt;'>
                <span class="pd-small"></span>
            </p>
        </td>
        <td colspan="3"
            style="border: none;border-bottom: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
            <span class="pd-small">
                @if (count($lines) >= 4)
                    {{ $lines[3] }}
                @endif
            </span>
        </td>
        <td colspan="3"
            style="border-top: none;border-bottom: none;border-left: 1pt solid black;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
            <span class="pd-xs">[ &nbsp; &nbsp; &nbsp;] COPY OF NPWP</span>
        </td>
    </tr>
    <tr>
        <td
            style="border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 9.55pt;vertical-align: middle;">
            <span class="pd-small">Paid by</span>
        </td>
        <td colspan="2"
            style="white-space: nowrap;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
            <span class="pd-small">Internet Banking</span>
        </td>
        <td colspan="2"
            style="border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
            <span class="pd-small">INVOICE DATE</span>
        </td>
        <td
            style="text-align: center;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
            <span class="pd-small">{{ date('d-M-y', strtotime($data->invoice_date)) }}</span>
        </td>
        <td colspan="3"
            style="border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
            <span class="pd-xs">[ &nbsp; &nbsp; &nbsp;] COPY OF QUOTATION VENDOR</span>
        </td>
    </tr>
    <tr>
        <td
            style="white-space: nowrap;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 9.6pt;vertical-align: middle;">
            <span class="pd-small">Due Date (days)</span>
        </td>
        <td
            style="width: 30px;text-align: center;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
            <span class="pd-small" style="color: red">{{ $data->due_date }}
            </span>
        </td>
        <td
            style="text-align: center;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
            <span class="pd-small">{{ $data->deadline }}</span>
        </td>
        <td colspan="2"
            style="border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
            <span class="pd-small">INVOICE RECEIPT ON</span>
        </td>
        <td
            style="text-align: center;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
            <span class="pd-small">{{ date('d-M-y', strtotime($data->received_date)) }}</span>
        </td>
        <td colspan="3"
            style="border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
            <span class="pd-xs">[ &nbsp; &nbsp; &nbsp;] COPY OF PURCHASE ORDER</span>
        </td>
    </tr>
    {{-- <tr>
        <td style="height: 0.5pt;border-left:1pt solid black;border-bottom:1pt solid black;" colspan="3">
        </td>
        <td colspan="2"></td>
        <td style="height: 1pt;border-right:1pt solid black;border-bottom:1pt solid black;" colspan="1">
        </td>
        <td style="height: 1pt;border-right:1pt solid black;" colspan="3"></td>
    </tr> --}}
    <tr>
        <td colspan="2"
            style="text-align: center;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13.4pt;vertical-align: middle;">
            <span class="pd-small">PREPARED BY</span>
        </td>
        <td
            style="text-align: center;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13.4pt;vertical-align: middle;">
            <span class="pd-small">CHECKED BY</span>
        </td>
        <td colspan="2"
            style="border-top: none;border-left: none;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 13.4pt;vertical-align: middle;">
            <span class="pd-small"></span>
        </td>
        <td
            style="text-align: center;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13.4pt;vertical-align: middle;">
            <span class="pd-small">APPROVED BY</span>

        </td>
        <td colspan="3"
            style="border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 13.4pt;vertical-align: middle;">
            <span class="pd-xs">[ &nbsp; &nbsp; &nbsp;] COPY OF CONTRACT DOCUMENT</span>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="border-left: 1pt solid black;border-right: 1pt solid black;">
        </td>
        <td colspan="1" style="border-left: 1pt solid black;border-right: 1pt solid black;">
        </td>
        <td colspan="2"></td>
        <td colspan="1" style="border-left: 1pt solid black;border-right: 1pt solid black;">
        </td>
        <td colspan="3" style="border-left: 1pt solid black;border-right: 1pt solid black;vertical-align: middle;">
            <span class="pd-xs">[ &nbsp; &nbsp; &nbsp;] COPY OF SURAT PENUNJUKKAN
                REKANAN</span>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="border-left: 1pt solid black;border-right: 1pt solid black;">
        </td>
        <td colspan="1" style="border-left: 1pt solid black;border-right: 1pt solid black;">
        </td>
        <td colspan="2"></td>
        <td colspan="1" style="border-left: 1pt solid black;border-right: 1pt solid black;">
        </td>
        <td colspan="3" style="border-left: 1pt solid black;border-right: 1pt solid black;vertical-align: middle;">
            <span class="pd-xs">[ &nbsp; &nbsp; &nbsp;] ORIGINAL BANK GUARANTEE (Down
                Payment)</span>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="border-left: 1pt solid black;border-right: 1pt solid black;">
        </td>
        <td colspan="1" style="border-left: 1pt solid black;border-right: 1pt solid black;">
        </td>
        <td colspan="2"></td>
        <td colspan="1" style="border-left: 1pt solid black;border-right: 1pt solid black;">
        </td>
        <td colspan="3" style="border-left: 1pt solid black;border-right: 1pt solid black;vertical-align: middle;">
            <span class="pd-xs">[ &nbsp; &nbsp; &nbsp;] HANDING OVER DOCUMENT ORIGINAL /
                BAST</span>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="border-left: 1pt solid black;border-right: 1pt solid black;">
        </td>
        <td colspan="1" style="border-left: 1pt solid black;border-right: 1pt solid black;">
        </td>
        <td colspan="2"></td>
        <td colspan="1" style="border-left: 1pt solid black;border-right: 1pt solid black;">
        </td>
        <td colspan="3" style="border-left: 1pt solid black;border-right: 1pt solid black;vertical-align: middle;">
            <span class="pd-xs">[ &nbsp; &nbsp; &nbsp;] ORIGINAL BANK GUARANTEE (Down
                Payment)</span>
        </td>
    </tr>
    <tr>
        <td colspan="2"
            style="text-align: center;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;vertical-align: middle;">
            <span class="pd-small">Khouw Vivi</span>
        </td>
        <td
            style="text-align: center;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;vertical-align: middle;">
            <span class="pd-small">Djajadi</span>
        </td>
        <td colspan="2" style="border-bottom:  1pt solid black;"></td>
        <td
            style="text-align: center;width: 76.05pt;border-top: none;border-left: 1pt solid black;;border-bottom: 1pt solid black;border-right: 1pt solid black;vertical-align: middle;">
            <span class="pd-small">Darren Chan</span>
        </td>
        <td colspan="3"
            style="border-top: none;border-bottom: 1pt solid black;;border-left: none;border-image: initial;border-right: 1pt solid black;vertical-align: middle;">
            {{-- <span class="pd-xs">[ &nbsp; &nbsp; &nbsp;] ORIGINAL BANK GUARANTEE (Down
                        Payment)</span> --}}
        </td>
    </tr>

</tbody>
