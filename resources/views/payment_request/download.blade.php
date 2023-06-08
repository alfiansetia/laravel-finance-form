<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <style>
        .bold-right {
            text-align: right;
        }

        .bold-no-border {
            /* width: 46.25pt; */
            border-top: none;
            border-bottom: none;
            border-left: 1pt solid black;
            border-image: initial;
            border-right: 1pt solid black;
            padding: 0mm;
            height: 12.6pt;
            vertical-align: bottom;
            margin: 0mm;
            font-size: 15px;
            font-family: "Calibri", sans-serif;
            margin-top: 1.15pt;
            text-indent: 5.0pt;
            text-align: right;
            /* padding-right: 8pt; */
        }

        .bold-border {
            /* width: 76.05pt; */
            border-top: none;
            border-left: none;
            border-bottom: 1pt solid black;
            border-right: 1pt solid black;
            padding: 0mm;
            height: 12.6pt;
            vertical-align: bottom;
            margin: 0mm;
            font-size: 15px;
            font-family: "Calibri", sans-serif;
            margin-top: 1.15pt;
            margin-right: 2.8pt;
            margin-bottom: .0001pt;
            margin-left: 0mm;
            text-align: right;
        }

        .sbls-pd-rg {
            font-size: 11px;
            padding-right: 5pt;
        }
    </style>
</head>

<body>
    <table style="border-collapse:collapse;border:none;">
        <tbody>
            <tr>
                <td colspan="9"
                    style="border-top: 1pt solid black;
                    border-right: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-bottom: none;padding: 0mm;height: 70pt;vertical-align: middle;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:.4pt;'>
                        <img src="{{ $path_logo }}" width="114" height="45"
                            style="margin-left: 8pt;margin-top: 2pt;">
                    </p>
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:.05pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:44.65pt;'>
                        <strong><span
                                style="font-size:21px;">{{ $payment->division->name }}</span></strong><strong><span
                                style="font-size:19px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                &nbsp;</span></strong><span
                            style='font-size:24px;font-family:"Times New Roman",serif;'>PAYMENT&nbsp;REQUEST</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="7"
                    style="border-top: none;border-right: none;border-bottom: none;border-image: initial;border-left: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:8.7pt;'>
                        <strong><span style="font-size:11px;">PAID TO :</span></strong>
                    </p>
                </td>
                <td
                    style="border-top: 1pt solid black;border-right: 1pt solid black;border-bottom: 1pt solid black;border-image: initial;border-left: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:1.5pt;'>
                        <span style="font-size:11px;">NO</span>
                    </p>
                </td>
                <td
                    style="border-top: 1pt solid black;border-right: 1pt solid black;border-bottom: 1pt solid black;border-image: initial;border-left: none;padding: 0mm;height: 13pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:  2.05pt;margin-bottom:.0001pt;margin-left:0mm;text-align:  right;'>
                        <span style="font-size:11px;">{{ $payment->no_pr }}</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="7"
                    style="border-top: none;border-right: none;border-bottom: none;border-image: initial;border-left: 1pt solid black;padding: 0mm;height: 3pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:8.7pt;'>
                        <strong><span style="font-size:11px;">{{ $payment->name_beneficiary }}</span></strong>
                    </p>
                </td>

                <td
                    style="border-top: none;border-left: 1pt solid black;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 3pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:1.5pt;'>
                        <span style="font-size:11px;">DATE</span>
                    </p>
                </td>
                <td
                    style="border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 3pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:  2.05pt;margin-bottom:.0001pt;margin-left:0mm;text-align:  right;'>
                        <span style="font-size:11px;">{{ date('d-M-y', strtotime($payment->date_pr)) }}</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="9"
                    style="border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:8.7pt;'>
                        <strong><span style="font-size:11px;">FOR : {{ $payment->for }}</span></strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="8"
                    style="border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;text-align:center;'>
                        <strong><span style="font-size:11px;">DESCRIPTION</span></strong>
                    </p>
                </td>
                <td
                    style="border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:  2.75pt;margin-bottom:.0001pt;margin-left:0mm;text-align:  center;'>
                        <strong><span style="font-size:11px;">Price</span></strong>
                    </p>
                </td>
            </tr>
            @php
                $sisa = 20 - count($payment->desc);
            @endphp
            @foreach ($payment->desc as $item)
                <tr>
                    <td colspan="8"
                        style="font-family:'Calibri',sans-serif;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: middle;">
                        <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                                style="font-size:11px;padding-left: 2pt;">{{ $item->value }}</span></p>
                    </td>
                    <td
                        style="font-family:'Calibri',sans-serif;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
                        <p
                            style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:  2.75pt;margin-bottom:.0001pt;margin-left:0mm;text-align:  right;'>
                            <span
                                style="font-size:11px;">{{ number_format($item->price, $payment->currency != 'idr' ? 2 : 0, ',', ',') }}</span>
                        </p>
                    </td>
                </tr>
            @endforeach
            @if ($payment->result_vat > 0)
                @php
                    $sisa = $sisa - 1;
                @endphp
                <tr>
                    <td colspan="8"
                        style="border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: middle;">
                        <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                                style="font-size:11px;padding-left: 2pt;">VAT 11%</span></p>
                    </td>
                    <td
                        style="width: 76.05pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
                        <p
                            style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:  2.75pt;margin-bottom:.0001pt;margin-left:0mm;text-align:  right;'>
                            <span
                                style="font-size:11px;">{{ number_format($payment->result_vat, $payment->currency != 'idr' ? 2 : 0, ',', ',') }}</span>
                        </p>
                    </td>
                </tr>
            @endif
            @if ($payment->total_wht > 0)
                @php
                    $sisa = $sisa - 1;
                @endphp
                <tr>
                    <td colspan="8"
                        style="border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: middle;">
                        <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                                style="font-size:11px;padding-left: 2pt;">WHT</span></p>
                    </td>
                    <td
                        style="border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
                        <p
                            style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:  2.75pt;margin-bottom:.0001pt;margin-left:0mm;text-align:  right;'>
                            <span
                                style="font-size:11px;">{{ number_format($payment->result_wht, $payment->currency != 'idr' ? 2 : 0, ',', ',') }}</span>
                        </p>
                    </td>
                </tr>
            @endif
            @for ($i = 0; $i < $sisa; $i++)
                <tr>
                    <td colspan="8"
                        style="border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: middle;">
                        <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                                style="font-size:11px;">&nbsp;</span></p>
                    </td>
                    <td
                        style="border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
                        <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                                style="font-size:11px;">&nbsp;</span></p>
                    </td>
                </tr>
            @endfor
            <tr>
                <td colspan="8"
                    style="border-top: none;border-left: 1pt solid black;border-bottom: 1.5pt solid black;border-right: 1pt solid black;padding: 0mm;height: 12.85pt;vertical-align: middle;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                </td>
                <td
                    style="border-top: none;border-left: none;border-bottom: 1.5pt solid black;border-right: 1pt solid black;padding: 0mm;height: 12.85pt;vertical-align: middle;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="bold-no-border">
                    <strong><span class="sbls-pd-rg">To be Paid
                            {{ $payment->currency == 'idr' ? 'Rp' : ($payment->currency == 'usd' ? '$' : 'S$') }}</span></strong>
                </td>
                <td class="bold-border">
                    <strong><span
                            class="sbls-pd-rg">{{ number_format($payment->result_wht, $payment->currency != 'idr' ? 2 : 0, ',', ',') }}</span></strong>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="bold-no-border">
                    <strong><span class="sbls-pd-rg">Forex at</span></strong>
                </td>
                <td class="bold-border">
                    <strong><span class="sbls-pd-rg"></span></strong>
                </td>
            </tr>

            <tr>
                <td colspan="8" class="bold-no-border">
                    <strong><span class="sbls-pd-rg">Convert to
                            {{ $payment->currency == 'idr' ? 'Rp' : ($payment->currency == 'usd' ? '$' : 'S$') }}</span></strong>
                </td>
                <td class="bold-border">
                    <strong><span class="sbls-pd-rg"></span></strong>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="bold-no-border">
                    <strong><span class="sbls-pd-rg">Bank charges
                            {{ $payment->currency == 'idr' ? 'Rp' : ($payment->currency == 'usd' ? '$' : 'S$') }}</span></strong>
                </td>
                <td class="bold-border">
                    <strong><span
                            class="sbls-pd-rg">{{ $payment->bank_charge > 0 ? number_format($payment->bank_charge, $payment->currency != 'idr' ? 2 : 0, ',', ',') : '' }}</span></strong>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="bold-no-border"
                    style="border-bottom: 3pt solid black;border-top: 1pt solid black">
                    <strong><span class="sbls-pd-rg">TOTAL
                            {{ $payment->currency == 'idr' ? 'Rp' : ($payment->currency == 'usd' ? '$' : 'S$') }}</span></strong>
                </td>
                <td class="bold-border" style="border-bottom: 3pt solid black">
                    <strong><span
                            class="sbls-pd-rg">{{ number_format($payment->total, $payment->currency != 'idr' ? 2 : 0, ',', ',') }}</span></strong>
                </td>
            </tr>

            <tr>
                <td colspan="9"
                    style="border-top: none;border-left: 1pt solid black;border-bottom: 1.5pt double black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:8px;">&nbsp;</span></p>
                </td>
            </tr>

            <tr>
                <td colspan="3"
                    style="border-top: none;border-left: 1pt solid black;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 11.6pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.9pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:8.7pt;line-height:8.7pt;'>
                        <strong><u><span style="font-size:11px;">BANK ACCOUNT
                                    FROM&nbsp;</span></u></strong><strong><span
                                style="font-size:11px;">:</span></strong>
                    </p>
                </td>
                <td colspan="3"
                    style="border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 11.6pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.9pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:8.7pt;line-height:8.7pt;'>
                        <strong><u><span style="font-size:11px;">TRANSFERRED TO BANK ACCOUNT :</span></u></strong>
                    </p>
                </td>
                <td colspan="3"
                    style="border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 11.6pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.9pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:1.55pt;line-height:8.7pt;'>
                        <strong><span style="font-size:11px;">CHECK SUPPORTING DOCUMENT</span></strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="border-top: none;border-left: 1pt solid black;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:9.65pt;'>
                        <span style="font-size:11px;">{{ $payment->beneficiary_bank }}</span>
                    </p>
                </td>
                <td colspan="3"
                    style="border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:8.6pt;'>
                        <span style="font-size:11px;">{{ $payment->name_beneficiary }}</span>
                    </p>
                </td>
                <td colspan="2"
                    style="font-family:'Calibri',sans-serif;border-top: none;border-left: none;font-family:'Calibri',sans-serif;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 8.6pt;vertical-align: middle;">
                    <strong><span style="font-size:11px;">CONTRACT / PO No</span></strong>
                </td>
                <td
                    style="border-top: 1pt solid black;border-right: 1pt solid black;border-bottom: 1pt solid black;border-image: initial;border-left: none;padding: 0mm;height: 8.6pt;vertical-align: middle;">
                    <span style="font-size:11px;">&nbsp;{{ $payment->contract }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="white-space: nowrap;font-family:'Calibri',sans-serif;border-top: none;border-left: 1pt solid black;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <span style="font-size:11px;">{{ $payment->division->name }}</span>
                </td>
                <td colspan="3"
                    style="white-space: nowrap;font-family:'Calibri',sans-serif;border: none;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <span style="font-size:11px;">{{ $payment->bank_account }}</span>
                </td>

                {{-- <td colspan="3" rowspan="12"
                    style="font-family:'Calibri',sans-serif;font-family:'Calibri',sans-serif;border-top: none;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 10.45pt;vertical-align: middle;">
                    <p style="margin-top: 0;">
                        <span style="padding-left: 5pt;font-size:10px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL BANK GUARANTEE (Down
                            Payment)</span><br>
                        <span style="padding-left: 5pt;font-size:10px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL BANK GUARANTEE (Down
                            Payment)</span><br>
                        <span style="padding-left: 5pt;font-size:10px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL BANK GUARANTEE (Down
                            Payment)</span><br>
                        <span style="padding-left: 5pt;font-size:10px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL BANK GUARANTEE (Down
                            Payment)</span><br>
                        <span style="padding-left: 5pt;font-size:10px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL BANK GUARANTEE (Down
                            Payment)</span><br>
                        <span style="padding-left: 5pt;font-size:10px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL BANK GUARANTEE (Down
                            Payment)</span><br>
                        <span style="padding-left: 5pt;font-size:10px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL BANK GUARANTEE (Down
                            Payment)</span><br>
                        <span style="padding-left: 5pt;font-size:10px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL BANK GUARANTEE (Down
                            Payment)</span><br>
                        <span style="padding-left: 5pt;font-size:10px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL BANK GUARANTEE (Down
                            Payment)</span><br>
                        <span style="padding-left: 5pt;font-size:10px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL BANK GUARANTEE (Down
                            Payment)</span><br>
                    </p>
                </td> --}}
                <td colspan="3"
                    style="font-family:'Calibri',sans-serif;border-top: none;border-bottom: none;border-left: 1pt solid black;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <span style="font-size:8px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL INVOICE + MATERAI</span>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="border-top: none;border-left: 1pt solid black;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;text-indent:8.0pt;line-height:8.6pt;'>
                        <span style="font-size:11px;"></span>
                    </p>
                </td>
                <td colspan="3" style="border: none;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:8.6pt;'>
                        <span style="font-size:11px;"></span>
                    </p>
                </td>
                <td colspan="3"
                    style="font-family:'Calibri',sans-serif;border-top: none;border-bottom: none;border-left: 1pt solid black;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <span style="font-size:8px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL FAKTUR PAJAK</span>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="border-top: none;border-left: 1pt solid black;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;text-indent:8.0pt;line-height:8.6pt;'>
                        <span style="font-size:11px;"></span>
                    </p>
                </td>
                <td colspan="3" style="border: none;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:8.6pt;'>
                        <span style="font-size:11px;"></span>
                    </p>
                </td>
                <td colspan="3"
                    style="font-family:'Calibri',sans-serif;border-top: none;border-bottom: none;border-left: 1pt solid black;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <span style="font-size:8px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL DGT-1 WP LN ( Foreigner Consultant
                        )</span>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="border-top: none;border-left: 1pt solid black;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;text-indent:8.0pt;line-height:8.6pt;'>
                        <span style="font-size:11px;"></span>
                    </p>
                </td>
                <td colspan="3"
                    style="border: none;border-bottom: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:8.6pt;'>
                        <span style="font-size:11px;"></span>
                    </p>
                </td>
                <td colspan="3"
                    style="font-family:'Calibri',sans-serif;border-top: none;border-bottom: none;border-left: 1pt solid black;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <span style="font-size:8px;">[ &nbsp; &nbsp; &nbsp;] COPY OF NPWP</span>
                </td>
            </tr>
            <tr>
                <td colspan="2"
                    style="font-family:'Calibri',sans-serif;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 9.55pt;vertical-align: middle;">
                    <span style="font-size:11px;">Paid by</span>
                </td>
                <td
                    style="white-space: nowrap;font-family:'Calibri',sans-serif;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
                    <span style="font-size:11px;">{{-- Internet Banking --}}</span>
                </td>
                <td colspan="2"
                    style="font-family:'Calibri',sans-serif;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
                    <span style="font-size:11px;">INVOICE DATE</span>
                </td>
                <td
                    style="font-family:'Calibri',sans-serif;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
                    <span style="font-size:11px;">{{ date('d-M-y', strtotime($payment->invoice_date)) }}</span>
                </td>
                <td colspan="3"
                    style="font-family:'Calibri',sans-serif;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
                    <span style="font-size:8px;">[ &nbsp; &nbsp; &nbsp;] COPY OF QUOTATION VENDOR</span>
                </td>
            </tr>
            <tr>
                <td
                    style="white-space: nowrap;font-family:'Calibri',sans-serif;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 9.6pt;vertical-align: middle;">
                    <span style="font-size:8pt;">Due Date (days)</span>
                </td>
                <td
                    style="width: 30px;font-family:'Calibri',sans-serif;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
                    <span style="font-size:11px;">{{ $payment->due_date ?? 'ASAP' }} </span>
                </td>
                <td
                    style="font-family:'Calibri',sans-serif;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
                    <span style="font-size:11px;">{{ date('d-M-y', strtotime($payment->deadline)) }}</span>
                </td>
                <td colspan="2"
                    style="font-family:'Calibri',sans-serif;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
                    <span style="font-size:11px;">INVOICE RECEIPT ON</span>
                </td>
                <td
                    style="font-family:'Calibri',sans-serif;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
                    <span style="font-size:11px;">{{ date('d-M-y', strtotime($payment->received_date)) }}</span>
                </td>
                <td colspan="3"
                    style="font-family:'Calibri',sans-serif;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
                    <span style="font-size:8px;">[ &nbsp; &nbsp; &nbsp;] COPY OF PURCHASE ORDER</span>
                </td>
            </tr>
            <tr>
                <td style="height: 1.5pt;border-left:1pt solid black;border-bottom:1pt solid black;" colspan="3">
                </td>
                <td colspan="2"></td>
                <td style="height: 1.5pt;border-right:1pt solid black;border-bottom:1pt solid black;" colspan="1">
                </td>
                <td style="height: 1.5pt;border-right:1pt solid black;" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2"
                    style="font-family:'Calibri',sans-serif;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13.4pt;vertical-align: middle;">
                    <span style="font-size:11px;">PREPARED BY</span>
                </td>
                <td
                    style="font-family:'Calibri',sans-serif;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13.4pt;vertical-align: middle;">
                    <span style="font-size:11px;">CHECKED BY</span>
                </td>
                <td colspan="2"
                    style="border-top: none;border-left: none;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 13.4pt;vertical-align: middle;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                </td>
                <td
                    style="font-family:'Calibri',sans-serif;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13.4pt;vertical-align: middle;">
                    <span style="font-size:11px;">APPROVED BY</span>

                </td>
                <td colspan="3"
                    style="font-family:'Calibri',sans-serif;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 13.4pt;vertical-align: middle;">
                    <span style="font-size:8px;">[ &nbsp; &nbsp; &nbsp;] COPY OF CONTRACT DOCUMENT</span>
                </td>
            </tr>
            <tr>
                <td colspan="2"
                    style="font-family:'Calibri',sans-serif;border-left: 1pt solid black;border-right: 1pt solid black;">
                </td>
                <td colspan="1"
                    style="font-family:'Calibri',sans-serif;border-left: 1pt solid black;border-right: 1pt solid black;">
                </td>
                <td colspan="2"></td>
                <td colspan="1"
                    style="font-family:'Calibri',sans-serif;border-left: 1pt solid black;border-right: 1pt solid black;">
                </td>
                <td colspan="3"
                    style="font-family:'Calibri',sans-serif;border-left: 1pt solid black;border-right: 1pt solid black;">
                    <span style="font-size:8px;">[ &nbsp; &nbsp; &nbsp;] COPY OF SURAT PENUNJUKKAN REKANAN</span>
                </td>
            </tr>
            <tr>
                <td colspan="2"
                    style="font-family:'Calibri',sans-serif;border-left: 1pt solid black;border-right: 1pt solid black;">
                </td>
                <td colspan="1"
                    style="font-family:'Calibri',sans-serif;border-left: 1pt solid black;border-right: 1pt solid black;">
                </td>
                <td colspan="2"></td>
                <td colspan="1"
                    style="font-family:'Calibri',sans-serif;border-left: 1pt solid black;border-right: 1pt solid black;">
                </td>
                <td colspan="3"
                    style="font-family:'Calibri',sans-serif;border-left: 1pt solid black;border-right: 1pt solid black;">
                    <span style="font-size:8px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL BANK GUARANTEE (Down Payment)</span>
                </td>
            </tr>
            <tr>
                <td colspan="2"
                    style="font-family:'Calibri',sans-serif;border-left: 1pt solid black;border-right: 1pt solid black;">
                </td>
                <td colspan="1"
                    style="font-family:'Calibri',sans-serif;border-left: 1pt solid black;border-right: 1pt solid black;">
                </td>
                <td colspan="2"></td>
                <td colspan="1"
                    style="font-family:'Calibri',sans-serif;border-left: 1pt solid black;border-right: 1pt solid black;">
                </td>
                <td colspan="3"
                    style="font-family:'Calibri',sans-serif;border-left: 1pt solid black;border-right: 1pt solid black;">
                    <span style="font-size:8px;">[ &nbsp; &nbsp; &nbsp;] HANDING OVER DOCUMENT ORIGINAL / BAST</span>
                </td>
            </tr>
            <tr>
                <td colspan="2"
                    style="font-family:'Calibri',sans-serif;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 10.45pt;vertical-align: middle;">
                    <span style="font-size:11px;">Khouw Vivi</span>
                </td>
                <td
                    style="font-family:'Calibri',sans-serif;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 10.45pt;vertical-align: middle;">
                    <span style="font-size:11px;">Djajadi</span>
                </td>
                <td colspan="2" style="border-bottom:  1pt solid black;"></td>
                <td
                    style="font-family:'Calibri',sans-serif;width: 87.05pt;border-top: none;border-left: 1pt solid black;;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 10.45pt;vertical-align: middle;">
                    <span style="font-size:11px;">Darren Chan</span>
                </td>
                <td colspan="3"
                    style="font-family:'Calibri',sans-serif;font-family:'Calibri',sans-serif;border-top: none;border-bottom: 1pt solid black;;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 10.45pt;vertical-align: middle;">
                    <span style="font-size:8px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL BANK GUARANTEE (Down Payment)</span>
                </td>
            </tr>

        </tbody>
    </table>
    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><br></p>
    <script>
        // window.print()
    </script>
</body>

</html>
