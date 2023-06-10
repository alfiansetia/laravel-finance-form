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

        .pd-xs {
            white-space: nowrap;
            font-family: "Calibri", sans-serif;
            padding-left: 5pt;
            padding-right: 5pt;
            margin-right: 3pt;
            font-size: 9px;
        }

        .pd-small {
            white-space: nowrap;
            font-family: "Calibri", sans-serif;
            padding-left: 5pt;
            padding-right: 5pt;
            font-size: 9px;
        }

        .pd-big {
            white-space: nowrap;
            font-family: "Calibri", sans-serif;
            padding-left: 5pt;
            padding-right: 5pt;
            font-size: 11px;
        }

        .pd-header {
            white-space: nowrap;
            padding-left: 60px;
            padding-right: 1pt;
            font-size: 19px;
            margin: 0;
            margin-top: 0;
            padding-top: 0;
            font-weight: bold;
            margin-bottom: 15pt;
            margin-right: 5pt;
        }
    </style>
</head>

<body>
    <table style="border-collapse:collapse;border:none; margin-left: auto;margin-right: auto; width: 100%;">
        <tbody>
            <tr>
                <td colspan="9"
                    style="border-top: 1pt solid black;border-right: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-bottom: none;padding: 0mm;height: 70pt;vertical-align: middle;">
                    <img src="{{ $path_logo }}" width="114" height="45" style="margin-left: 8pt;margin-top: 0;">
                    <div class="pd-header">
                        <span style="font-family:'Calibri', sans-serif;float: left;">
                            {{ $payment->division->name }}
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
                    <span class="pd-small">{{ $payment->no_pr }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="7"
                    style="border-top: none;border-right: none;border-bottom: none;border-image: initial;border-left: 1pt solid black;padding: 0mm;height: 3pt;vertical-align: middle;">
                    <strong><span class="pd-small">{{ $payment->name_beneficiary }}</span></strong>
                </td>

                <td
                    style="border-top: none;border-left: 1pt solid black;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 3pt;vertical-align: middle;">
                    <span class="pd-small">DATE</span>
                </td>
                <td
                    style="text-align: right;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 3pt;vertical-align: middle;">
                    <span class="pd-small">{{ date('d-M-y', strtotime($payment->date_pr)) }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="9"
                    style="border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: middle;">
                    <strong><span class="pd-small">FOR : {{ $payment->for }}</span></strong>
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
                $sisa = 21 - count($payment->desc);
            @endphp
            @foreach ($payment->desc as $item)
                <tr>
                    <td colspan="8"
                        style="border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: middle;">
                        <span class="pd-small">{{ $item->value }}</span>
                    </td>
                    <td
                        style="text-align: right;width: 82pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
                        <span
                            class="pd-small">{{ number_format($item->price, $payment->currency != 'idr' ? 2 : 0, ',', ',') }}</span>
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
                        <span class="pd-small">VAT 11%</span>
                    </td>
                    <td
                        style="text-align: right;width: 82pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
                        <span
                            class="pd-small">{{ number_format($payment->result_vat, $payment->currency != 'idr' ? 2 : 0, ',', ',') }}</span>

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
                        <span class="pd-small">WHT</span>
                    </td>
                    <td
                        style="text-align: right;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: middle;">
                        <span
                            class="pd-small">{{ number_format($payment->result_wht, $payment->currency != 'idr' ? 2 : 0, ',', ',') }}</span>

                    </td>
                </tr>
            @endif
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
                            {{ $payment->currency == 'idr' ? 'Rp' : ($payment->currency == 'usd' ? '$' : 'S$') }}</span></strong>
                </td>
                <td class="bold-border">
                    <strong><span
                            class="pd-small">{{ number_format($payment->result_wht, $payment->currency != 'idr' ? 2 : 0, ',', ',') }}</span></strong>
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
                    <strong><span class="pd-small">Convert to
                            {{ $payment->currency == 'idr' ? 'Rp' : ($payment->currency == 'usd' ? '$' : 'S$') }}</span></strong>
                </td>
                <td class="bold-border">
                    <strong><span class="pd-small"></span></strong>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="bold-no-border">
                    <strong><span class="pd-small">Bank charges
                            {{ $payment->currency == 'idr' ? 'Rp' : ($payment->currency == 'usd' ? '$' : 'S$') }}</span></strong>
                </td>
                <td class="bold-border">
                    <strong><span
                            class="pd-small">{{ $payment->bank_charge > 0 ? number_format($payment->bank_charge, $payment->currency != 'idr' ? 2 : 0, ',', ',') : '' }}</span></strong>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="bold-no-border"
                    style="border-bottom: 3pt solid black;border-top: 1pt solid black">
                    <strong><span class="pd-small">TOTAL
                            {{ $payment->currency == 'idr' ? 'Rp' : ($payment->currency == 'usd' ? '$' : 'S$') }}</span></strong>
                </td>
                <td class="bold-border" style="border-bottom: 3pt solid black">
                    <strong><span
                            class="pd-small">{{ number_format($payment->total, $payment->currency != 'idr' ? 2 : 0, ',', ',') }}</span></strong>
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
                    <span class="pd-small">{{ $payment->beneficiary_bank }}</span>
                </td>
                <td colspan="3"
                    style="border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
                    <span class="pd-small">{{ $payment->name_beneficiary }}</span>
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
                    <span class="pd-small">&nbsp;{{ $payment->contract }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="white-space: nowrap;border-top: none;border-left: 1pt solid black;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <span class="pd-small">{{ $payment->division->name }}</span>
                </td>
                <td colspan="3"
                    style="white-space: nowrap;border: none;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <span class="pd-small">{{ $payment->bank_account }}</span>
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
                <td colspan="3" style="border: none;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <p style='margin:0mm;margin-left:8.7pt;line-height:8.6pt;'>
                        <span class="pd-small"></span>
                    </p>
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
                <td colspan="3" style="border: none;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <span class="pd-small"></span>
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
                    <p style='margin:0mm;margin-left:8.7pt;line-height:8.6pt;'>
                        <span class="pd-small"></span>
                    </p>
                </td>
                <td colspan="3"
                    style="border-top: none;border-bottom: none;border-left: 1pt solid black;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: middle;">
                    <span class="pd-xs">[ &nbsp; &nbsp; &nbsp;] COPY OF NPWP</span>
                </td>
            </tr>
            <tr>
                <td colspan="2"
                    style="border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 9.55pt;vertical-align: middle;">
                    <span class="pd-small">Paid by</span>
                </td>
                <td
                    style="white-space: nowrap;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
                    <span class="pd-small">{{-- Internet Banking --}}</span>
                </td>
                <td colspan="2"
                    style="border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
                    <span class="pd-small">INVOICE DATE</span>
                </td>
                <td
                    style="text-align: right;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
                    <span class="pd-small">{{ date('d-M-y', strtotime($payment->invoice_date)) }}</span>
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
                    style="text-align: center;width: 30px;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
                    <span class="pd-small">{{ $payment->due_date < 1 ? 'ASAP' : $payment->due_date }}
                    </span>
                </td>
                <td
                    style="text-align: right;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
                    <span class="pd-small">{{ date('d-M-y', strtotime($payment->deadline)) }}</span>
                </td>
                <td colspan="2"
                    style="border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
                    <span class="pd-small">INVOICE RECEIPT ON</span>
                </td>
                <td
                    style="text-align: right;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
                    <span class="pd-small">{{ date('d-M-y', strtotime($payment->received_date)) }}</span>
                </td>
                <td colspan="3"
                    style="border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: middle;">
                    <span class="pd-xs">[ &nbsp; &nbsp; &nbsp;] COPY OF PURCHASE ORDER</span>
                </td>
            </tr>
            <tr>
                <td style="height: 1pt;border-left:1pt solid black;border-bottom:1pt solid black;" colspan="3">
                </td>
                <td colspan="2"></td>
                <td style="height: 1pt;border-right:1pt solid black;border-bottom:1pt solid black;" colspan="1">
                </td>
                <td style="height: 1pt;border-right:1pt solid black;" colspan="3"></td>
            </tr>
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
                <td colspan="3"
                    style="border-left: 1pt solid black;border-right: 1pt solid black;vertical-align: middle;">
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
                <td colspan="3"
                    style="border-left: 1pt solid black;border-right: 1pt solid black;vertical-align: middle;">
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
                <td colspan="3"
                    style="border-left: 1pt solid black;border-right: 1pt solid black;vertical-align: middle;">
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
                <td colspan="3"
                    style="border-left: 1pt solid black;border-right: 1pt solid black;vertical-align: middle;">
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
    </table>
</body>

</html>
