<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .bold-right {
            text-align: right;
        }

        .bold-no-border {
            width: 46.25pt;
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
            width: 76.05pt;
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
    {{-- {{ $payment }} --}}
    <table style="margin-left:6.4pt;border-collapse:collapse;border:none;">
        <tbody>
            <tr>
                <td colspan="9"
                    style="width: 499.6pt;border-top: 1pt solid black;
                    border-right: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-bottom: none;padding: 0mm;height: 70pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:.4pt;'>
                        <img src="{{ asset('logo.jpg') }}" width="114" height="45"
                            style="margin-left: 8pt;margin-top: 2pt;">
                    </p>
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:.05pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:44.65pt;'>
                        <strong><span style="font-size:21px;">{{ $divition->name }}</span></strong><strong><span
                                style="font-size:19px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                &nbsp;</span></strong><span
                            style='font-size:24px;font-family:"Times New Roman",serif;'>PAYMENT&nbsp;REQUEST</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="7"
                    style="width: 62.4pt;border-top: none;border-right: none;border-bottom: none;border-image: initial;border-left: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:8.7pt;'>
                        <strong><span style="font-size:11px;">PAID TO :</span></strong>
                    </p>
                </td>
                <td
                    style="width: 46.25pt;border-top: 1pt solid black;border-right: 1pt solid black;border-bottom: 1pt solid black;border-image: initial;border-left: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:1.5pt;'>
                        <span style="font-size:11px;">NO</span>
                    </p>
                </td>
                <td
                    style="width: 76.05pt;border-top: 1pt solid black;border-right: 1pt solid black;border-bottom: 1pt solid black;border-image: initial;border-left: none;padding: 0mm;height: 13pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:  2.05pt;margin-bottom:.0001pt;margin-left:0mm;text-align:  right;'>
                        <span style="font-size:11px;">{{ $payment->no_pr }}</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="7"
                    style="width: 62.4pt;border-top: none;border-right: none;border-bottom: none;border-image: initial;border-left: 1pt solid black;padding: 0mm;height: 3pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:8.7pt;'>
                        <strong><span style="font-size:11px;">{{ $payment->name_beneficiary }}</span></strong>
                    </p>
                </td>

                <td
                    style="width: 46.25pt;border-top: none;border-left: 1pt solid black;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 3pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:1.5pt;'>
                        <span style="font-size:11px;">DATE</span>
                    </p>
                </td>
                <td
                    style="width: 76.05pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 3pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:  2.05pt;margin-bottom:.0001pt;margin-left:0mm;text-align:  right;'>
                        <span style="font-size:11px;">{{ date('d-M-y', strtotime($payment->date_pr)) }}</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="9"
                    style="width: 499.6pt;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:8.7pt;'>
                        <strong><span style="font-size:11px;">FOR : {{ $payment->for }}</span></strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="8"
                    style="width: 423.55pt;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;text-align:center;'>
                        <strong><span style="font-size:11px;">DESCRIPTION</span></strong>
                    </p>
                </td>
                <td
                    style="width: 76.05pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:  2.75pt;margin-bottom:.0001pt;margin-left:0mm;text-align:  center;'>
                        <strong><span style="font-size:11px;">Price</span></strong>
                    </p>
                </td>
            </tr>
            @foreach ($desc as $item)
                <tr>
                    <td colspan="8"
                        style="width: 423.55pt;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: top;">
                        <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                                style="font-size:11px;padding-left: 2pt;">{{ $item->value }}</span></p>
                    </td>
                    <td
                        style="width: 76.05pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: top;">
                        <p
                            style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:  2.75pt;margin-bottom:.0001pt;margin-left:0mm;text-align:  right;'>
                            <span style="font-size:11px;">{{ number_format($item->price, 0, ',', ',') }}</span>
                        </p>
                    </td>
                </tr>
            @endforeach
            @if ($payment->result_vat > 0)
                <tr>
                    <td colspan="8"
                        style="width: 423.55pt;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: top;">
                        <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                                style="font-size:11px;padding-left: 2pt;">VAT 11%</span></p>
                    </td>
                    <td
                        style="width: 76.05pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: top;">
                        <p
                            style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:  2.75pt;margin-bottom:.0001pt;margin-left:0mm;text-align:  right;'>
                            <span style="font-size:11px;">{{ $payment->result_vat }}</span>
                        </p>
                    </td>
                </tr>
            @endif
            @if ($payment->total_wht > 0)
                <tr>
                    <td colspan="8"
                        style="width: 423.55pt;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: top;">
                        <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                                style="font-size:11px;padding-left: 2pt;">WHT</span></p>
                    </td>
                    <td
                        style="width: 76.05pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: top;">
                        <p
                            style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.5pt;margin-right:  2.75pt;margin-bottom:.0001pt;margin-left:0mm;text-align:  right;'>
                            <span style="font-size:11px;">{{ number_format($payment->result_wht, 0, ',', ',') }}</span>
                        </p>
                    </td>
                </tr>
            @endif
            @for ($i = 0; $i < 4; $i++)
                <tr>
                    <td colspan="8"
                        style="width: 423.55pt;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13pt;vertical-align: top;">
                        <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                                style="font-size:11px;">&nbsp;</span></p>
                    </td>
                    <td
                        style="width: 76.05pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13pt;vertical-align: top;">
                        <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                                style="font-size:11px;">&nbsp;</span></p>
                    </td>
                </tr>
            @endfor
            <tr>
                <td colspan="8"
                    style="width: 423.55pt;border-top: none;border-left: 1pt solid black;border-bottom: 1.5pt solid black;border-right: 1pt solid black;padding: 0mm;height: 12.85pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                </td>
                <td
                    style="width: 76.05pt;border-top: none;border-left: none;border-bottom: 1.5pt solid black;border-right: 1pt solid black;padding: 0mm;height: 12.85pt;vertical-align: top;">
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
                            class="sbls-pd-rg">{{ number_format($payment->result_wht, 0, ',', ',') }}</span></strong>
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
                            class="sbls-pd-rg">{{ number_format($payment->bank_charge, 0, ',', ',') }}</span></strong>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="bold-no-border"
                    style="border-bottom: 3pt solid black;border-top: 1pt solid black">
                    <strong><span class="sbls-pd-rg">TOTAL
                            {{ $payment->currency == 'idr' ? 'Rp' : ($payment->currency == 'usd' ? '$' : 'S$') }}</span></strong>
                </td>
                <td class="bold-border" style="border-bottom: 3pt solid black">
                    <strong><span class="sbls-pd-rg">{{ number_format($payment->total, 0, ',', ',') }}</span></strong>
                </td>
            </tr>

            <tr>
                <td colspan="9"
                    style="width: 499.6pt;border-top: none;border-left: 1pt solid black;border-bottom: 1.5pt double black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:8px;">&nbsp;</span></p>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="width: 147.8pt;border-top: none;border-left: 1pt solid black;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 11.6pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.9pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:8.7pt;line-height:8.7pt;'>
                        <strong><u><span style="font-size:11px;">BANK ACCOUNT
                                    FROM&nbsp;</span></u></strong><strong><span
                                style="font-size:11px;">:</span></strong>
                    </p>
                </td>
                <td colspan="3"
                    style="width: 156.45pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 11.6pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.9pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:8.7pt;line-height:8.7pt;'>
                        <strong><u><span style="font-size:11px;">TRANSFERRED TO BANK ACCOUNT :</span></u></strong>
                    </p>
                </td>
                <td colspan="3"
                    style="width: 195.35pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 11.6pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:1.9pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:1.55pt;line-height:8.7pt;'>
                        <strong><span style="font-size:11px;">CHECK SUPPORTING DOCUMENT</span></strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="width: 147.8pt;border-top: none;border-left: 1pt solid black;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:9.65pt;'>
                        <span style="font-size:11px;">{{ $payment->beneficiary_bank }}</span>
                    </p>
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;text-indent:8.0pt;line-height:8.6pt;'>
                        <span style="font-size:11px;">{{ $divition->name }}</span>
                    </p>
                </td>
                <td colspan="3"
                    style="width: 156.45pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:8.6pt;'>
                        <span style="font-size:11px;">{{ $payment->name_beneficiary }}</span>
                    </p>
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:8.6pt;'>
                        <span style="font-size:11px;">{{ $payment->bank_account }}</span>
                    </p>
                </td>
                <td
                    style="width: 73.05pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: middle;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:1.55pt;line-height:8.6pt;'>
                        <strong><span style="font-size:11px;">CONTRACT / PO No</span></strong>
                    </p>
                </td>
                <td colspan="2"
                    style="width: 122.3pt;border-top: 1pt solid black;border-right: 1pt solid black;border-bottom: 1pt solid black;border-image: initial;border-left: none;padding: 0mm;height: 9.55pt;vertical-align: middle;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;{{ $payment->contract }}</span></p>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="width: 147.8pt;border-top: none;border-left: 1pt solid black;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:9.65pt;'>
                        <span style="font-size:11px;">&nbsp;</span>
                    </p>
                </td>
                <td style="width: 69.4pt;border: none;padding: 0mm;height: 11pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:9.65pt;'>
                        <span style="font-size:11px;">&nbsp;</span>
                    </p>
                </td>
                <td style="width: 19.2pt;border: none;padding: 0mm;height: 11pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:9px;">&nbsp;</span></p>
                </td>
                <td
                    style="width: 67.85pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:9px;">&nbsp;</span></p>
                </td>
                <td colspan="9"
                    style="width: 195.35pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 11pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:9.65pt;'>
                        <span style="font-size:11px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL INVOICE + MATERAI</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="width: 147.8pt;border-top: none;border-left: 1pt solid black;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 10.6pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:9px;">&nbsp;</span></p>
                </td>
                <td style="width: 69.4pt;border: none;padding: 0mm;height: 10.6pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:9px;">&nbsp;</span></p>
                </td>
                <td style="width: 19.2pt;border: none;padding: 0mm;height: 10.6pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:9px;">&nbsp;</span></p>
                </td>
                <td
                    style="width: 67.85pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 10.6pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:9px;">&nbsp;</span></p>
                </td>
                <td colspan="2"
                    style="width: 119.3pt;border: none;padding: 0mm;height: 10.6pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:9.25pt;'>
                        <span style="font-size:11px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL FAKTUR PAJAK</span>
                    </p>
                </td>
                <td
                    style="width: 76.05pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 10.6pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:9px;">&nbsp;</span></p>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="width: 147.8pt;border-top: none;border-left: 1pt solid black;border-bottom: none;border-right: 1pt solid black;padding: 0mm;height: 10.55pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:9px;">&nbsp;</span></p>
                </td>
                <td style="width: 69.4pt;border: none;padding: 0mm;height: 10.55pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:9px;">&nbsp;</span></p>
                </td>
                <td style="width: 19.2pt;border: none;padding: 0mm;height: 10.55pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:9px;">&nbsp;</span></p>
                </td>
                <td
                    style="width: 67.85pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 10.55pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:9px;">&nbsp;</span></p>
                </td>
                <td colspan="3"
                    style="width: 195.35pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 10.55pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:9.25pt;'>
                        <span style="font-size:11px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL DGT-1 WP LN ( Foreigner
                            Consultant )</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="width: 147.8pt;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 9.2pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:8px;">&nbsp;</span></p>
                </td>
                <td
                    style="width: 69.4pt;border-top: none;border-right: none;border-left: none;border-image: initial;border-bottom: 1pt solid black;padding: 0mm;height: 9.2pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:8px;">&nbsp;</span></p>
                </td>
                <td
                    style="width: 19.2pt;border-top: none;border-right: none;border-left: none;border-image: initial;border-bottom: 1pt solid black;padding: 0mm;height: 9.2pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:8px;">&nbsp;</span></p>
                </td>
                <td
                    style="width: 67.85pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.2pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:8px;">&nbsp;</span></p>
                </td>
                <td colspan="2"
                    style="width: 119.3pt;border: none;padding: 0mm;height: 9.2pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:8.2pt;'>
                        <span style="font-size:11px;">[ &nbsp; &nbsp; &nbsp;] COPY OF NPWP</span>
                    </p>
                </td>
                <td
                    style="width: 76.05pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 9.2pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:8px;">&nbsp;</span></p>
                </td>
            </tr>
            <tr>
                <td colspan="2"
                    style="width: 80.6pt;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 9.55pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:1.5pt;line-height:8.6pt;'>
                        <span style="font-size:11px;">Paid by</span>
                    </p>
                </td>
                <td
                    style="width: 67.2pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0mm;margin-right:4.15pt;margin-bottom:.0001pt;margin-left:6.1pt;text-align:center;line-height:8.6pt;'>
                        <span style="font-size:11px;">Internet Banking</span>
                    </p>
                </td>
                <td colspan="2"
                    style="width: 88.6pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:8.6pt;'>
                        <span style="font-size:11px;">INVOICE DATE</span>
                    </p>
                </td>
                <td
                    style="width: 67.85pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:18.35pt;line-height:8.6pt;'>
                        <span style="font-size:11px;">{{ date('d-M-y', strtotime($payment->invoice_date)) }}</span>
                    </p>
                </td>
                <td colspan="3"
                    style="width: 195.35pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:8.6pt;'>
                        <span style="font-size:11px;">[ &nbsp; &nbsp; &nbsp;] COPY OF QUOTATION VENDOR</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td
                    style="width: 62.4pt;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 9.6pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:1.5pt;line-height:8.6pt;'>
                        <span style="font-size:11px;">Due Date (days)</span>
                    </p>
                </td>
                <td
                    style="width: 18.2pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:7.5pt;line-height:8.6pt;'>
                        <span style="font-size:11px;">{{ $payment->due_date ?? 'ASAP' }} </span>
                    </p>
                </td>
                <td
                    style="width: 67.2pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0mm;margin-right:4.15pt;margin-bottom:.0001pt;margin-left:5.9pt;text-align:center;line-height:8.6pt;'>
                        <span style="font-size:11px;">{{ date('d-M-y', strtotime($payment->deadline)) }}</span>
                    </p>
                </td>
                <td colspan="2"
                    style="width: 88.6pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:8.6pt;'>
                        <span style="font-size:11px;">INVOICE RECEIPT ON</span>
                    </p>
                </td>
                <td
                    style="width: 67.85pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:18.35pt;line-height:8.6pt;'>
                        <span style="font-size:11px;">{{ date('d-M-y', strtotime($payment->received_date)) }}</span>
                    </p>
                </td>
                <td colspan="3"
                    style="width: 195.35pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:8.6pt;'>
                        <span style="font-size:11px;">[ &nbsp; &nbsp; &nbsp;] COPY OF PURCHASE ORDER</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="2"
                    style="width: 80.6pt;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 13.4pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:3.7pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:18.3pt;line-height:8.7pt;'>
                        <span style="font-size:11px;">PREPARED BY</span>
                    </p>
                </td>
                <td
                    style="width: 67.2pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13.4pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:3.7pt;margin-right:  4.15pt;margin-bottom:.0001pt;margin-left:6.05pt;text-align:  center;line-height:8.7pt;'>
                        <span style="font-size:11px;">CHECKED BY</span>
                    </p>
                </td>
                <td rowspan="5"
                    style="width: 69.4pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13.4pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                </td>
                <td colspan="2"
                    style="width: 87.05pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 13.4pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:3.7pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:20.75pt;line-height:8.7pt;'>
                        <span style="font-size:11px;">APPROVED BY</span>
                    </p>
                </td>
                <td colspan="3"
                    style="width: 195.35pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 13.4pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:3.7pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:8.7pt;line-height:8.7pt;'>
                        <span style="font-size:11px;">[ &nbsp; &nbsp; &nbsp;] COPY OF CONTRACT DOCUMENT</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="2" rowspan="4"
                    style="width: 80.6pt;border-right: 1pt solid black;border-bottom: 1pt solid black;border-left: 1pt solid black;border-image: initial;border-top: none;padding: 0mm;height: 10.45pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:6.9pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:22.7pt;line-height:8.7pt;'>
                        <span style="font-size:11px;">Khouw Vivi</span>
                    </p>
                </td>
                <td rowspan="4"
                    style="width: 67.2pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 10.45pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:6.9pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:22.7pt;line-height:8.7pt;'>
                        <span style="font-size:11px;">Djajadi</span>
                    </p>
                </td>
                <td colspan="2" rowspan="4"
                    style="width: 87.05pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 10.45pt;vertical-align: top;">
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><span
                            style="font-size:11px;">&nbsp;</span></p>
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:6.9pt;margin-right:0mm;margin-bottom:.0001pt;margin-left:23.55pt;line-height:8.7pt;'>
                        <span style="font-size:11px;">Darren Chan</span>
                    </p>
                </td>
                <td colspan="3"
                    style="width: 195.35pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 10.45pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:9.5pt;'>
                        <span style="font-size:11px;">[ &nbsp; &nbsp; &nbsp;] COPY OF SURAT PENUNJUKKAN REKANAN</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="width: 195.35pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 9.55pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:8.6pt;'>
                        <span style="font-size:11px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL RECEIPT / SURAT JALAN</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="width: 195.35pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0mm;height: 9.6pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:8.6pt;'>
                        <span style="font-size:11px;">[ &nbsp; &nbsp; &nbsp;] HANDING OVER DOCUMENT ORIGINAL /
                            BAST</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="3"
                    style="width: 195.35pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0mm;height: 29.85pt;vertical-align: top;">
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:8.75pt;'>
                        <span style="font-size:11px;">[ &nbsp; &nbsp; &nbsp;] ORIGINAL BANK GUARANTEE (Down
                            Payment)</span>
                    </p>
                    <p
                        style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;margin-left:8.7pt;line-height:8.75pt;'>
                        <span style="font-size:11px;">&nbsp;</span>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <p style='margin:0mm;font-size:15px;font-family:"Calibri",sans-serif;'><br></p>
</body>

</html>
