<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <style>
        .right {
            text-align: right;
        }

        body {
            background: rgb(205, 205, 205);
        }

        page[size="A4"] {
            background: white;
            width: 21cm;
            height: 29.7cm;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }

        @media print {

            body,
            page[size="A4"] {
                margin: 0;
                box-shadow: 0;
            }
        }

        .table,
        td {
            border-top-width: 0px;
            border-top-style: solid;

            border-bottom-width: 1px;
            border-bottom-style: solid;

            border-left-width: 1px;
            border-left-style: solid;

            border-right-width: 0px;
            border-right-style: solid;

            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <page size="A4">
        <div style="padding: 0px 0px 0px 0px">
            <table cellspacing="0">
                <tr>
                    <td colspan="3" style="border-top-width: 1px; width: 16.5cm;">
                        <center><strong>PEMERINTAH KOTA MADIUN <br></strong></center>
                        <center><strong>TANDA BUKTI PEMBAYARAN RETRIBUSI DAERAH <br></strong></center>
                        <center><strong>NOMOR BUKTI: No. {{ $pembayaran->pembayaranID }}<!-- no ID Pembayaran--> <br>
                        </center>
                    </td>
                    <td align=right valign=top
                        style="width: 1.95cm; border-right-width: 1px; border-left-width: 0px; border-top-width: 1px;">
                        salinan &nbsp;</td>
                </tr>
            </table>
            <table cellspacing="0">
                <tr>
                    <td style="border-bottom-width: 0px;">&nbsp; a)</td>
                    <td colspan="4"
                        style="border-right-width: 1px; border-left-width: 0px; border-bottom-width: 0px;">
                        Bendahara Penerimaan / Bendahara Penerimaan Pembantu BKAD KOTA MADIUN
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom-width: 0px;"></td>
                    <td colspan="4"
                        style="border-right-width: 1px; border-left-width: 0px; border-bottom-width: 0px;">
                        Telah menerima uang sebesar Rp.
                        {{ number_format($pembayaran->skrd->sewa->sewaDetail->sum('harga'), 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom-width: 0px;">&nbsp; b)</td>
                    <td colspan="4"
                        style="border-right-width: 1px; border-left-width: 0px; border-bottom-width: 0px;">
                        {{ ucwords(Terbilang::make($pembayaran->skrd->sewa->sewaDetail->sum('harga'))) }} Rupiah
                        <!-- total dengan huruf -->
                    </td>
                </tr>
                <tr>
                    <td align=left valign=top style="border-bottom-width: 0px;">&nbsp; c)</td>
                    <td align=left valign=top style="border-left-width: 0px; border-bottom-width: 0px; width: 0.7cm;">
                        dari
                    </td>
                    <td style="border-left-width: 0px; border-bottom-width: 0px; width: 2.5cm;">
                        Nama <br>
                        Alamat <br>
                        NPWPD
                    </td>
                    <td style="border-left-width: 0px; border-bottom-width: 0px; width: 0.1cm;">
                        : <br>
                        : <br>
                        :
                    </td>
                    <td style="border-left-width: 0px; border-right-width: 1px; border-bottom-width: 0px;">
                        {{ $pembayaran->skrd->sewa->nama }}<!-- nama --><br>
                        {{ $pembayaran->skrd->sewa->alamat }}<!-- alamat --><br>
                        {{ $pembayaran->skrd->sewa->npwr }}<!-- NPWR -->
                    </td>
                </tr>
                <tr>
                    <td align=left valign=top style="border-bottom-width: 0px;">
                        &nbsp; d)
                    </td>
                    <td align=left valign=top colspan="2" style="border-left-width: 0px; border-bottom-width: 0px;">
                        Sebagai pembayaran
                    </td>
                    <td align=left valign=top style="border-left-width: 0px; border-bottom-width: 0px;">
                        :
                    </td>
                    <td
                        style="border-left-width: 0px; border-right-width: 1px; border-bottom-width: 0px; width: 14.53cm;">
                        Retribusi pemanfaatan aset daerah {{ $pembayaran->skrd->sewa->asset->nama }} <!-- nama aset-->
                        {{ $pembayaran->skrd->sewa->asset->jenis->kategori->nama }}
                        {{ $pembayaran->skrd->sewa->asset->lokasi }}
                        <br>
                        @foreach ($pembayaran->skrd->sewa->sewaDetail as $resSewaDetail)
                            <!-- panjang --> x
                            {{ str_replace('.', ',', $resSewaDetail->assetDetail->panjang) }}
                            <!-- lebar --> x
                            {{ str_replace('.', ',', $resSewaDetail->assetDetail->lebar) }}
                            <!-- tarif --> x
                            {{ 'Rp. ' . number_format($resSewaDetail->tarif, 0, ',', '.') }}
                            <!-- lama_sewa --> x
                            {{ $pembayaran->skrd->sewa->lama_sewa }}
                            <!-- jumlah asset --> x
                            {{ $resSewaDetail->jumlah }}
                            <!-- total--> =
                            {{ 'Rp. ' . number_format($resSewaDetail->harga, 0, ',', '.') }}
                            <br>
                        @endforeach
                    </td>
                </tr>
            </table>
            <table cellspacing="0">
                <tr>
                    <td style="border-bottom-width: 0px; width: 4cm;"></td>
                    <td colspan="9" style="border-top-width: 1px;">
                        <center>Kode Rekening (e)</center>
                    </td>
                    <td style="border-top-width: 1px; width: 9cm;">
                        <center>Jumlah (Rp)</center>
                    </td>
                    <td style="border-bottom-width: 0px; border-right-width: 1px; width: 0.12cm;"></td>
                </tr>
                <tr>
                    <td style="border-bottom-width: 0px; width: 4cm;"></td>
                    <td style="height: 0.3cm; width: 0.5cm;">
                        <center>4</center>
                    </td>
                    <td style="height: 0.3cm; width: 0.5cm;">
                        <center>1</center>
                    </td>
                    <td style="height: 0.3cm; width: 0.5cm;">
                        <center>2</center>
                    </td>
                    <td style="height: 0.3cm; width: 0.5cm;">
                        <center>0</center>
                    </td>
                    <td style="height: 0.3cm; width: 0.5cm;">
                        <center>2</center>
                    </td>
                    <td style="height: 0.3cm; width: 0.5cm;">
                        <center>0</center>
                    </td>
                    <td style="height: 0.3cm; width: 0.5cm;">
                        <center>1</center>
                    </td>
                    <td style="height: 0.3cm; width: 0.5cm;"></td>
                    <td style="height: 0.3cm; width: 0.5cm;"></td>
                    <td class="right">
                        {{ number_format($pembayaran->skrd->sewa->sewaDetail->sum('harga'), 0, ',', '.') }}<!-- total -->
                    </td>
                    <td style="border-bottom-width: 0px; border-right-width: 1px; width: 0.12cm;"></td>
                </tr>
                <tr>
                    <td style="border-bottom-width: 0px; width: 4cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="border-bottom-width: 0px; border-right-width: 1px; width: 0.12cm;"></td>
                </tr>
                <tr>
                    <td style="border-bottom-width: 0px; width: 4cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="border-bottom-width: 0px; border-right-width: 1px; width: 0.12cm;"></td>
                </tr>
                <tr>
                    <td style="border-bottom-width: 0px; width: 4cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="border-bottom-width: 0px; border-right-width: 1px; width: 0.12cm;"></td>
                </tr>
                <tr>
                    <td style="border-bottom-width: 0px; width: 4cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="height: 0.3cm;"></td>
                    <td style="border-bottom-width: 0px; border-right-width: 1px; width: 0.12cm;"></td>
                </tr>
            </table>
            <table cellspacing="0">
                <tr>
                    <td>(e)</td>
                    <td style="border-left-width: 0px; width: 3.5cm;">
                        Tanggal diterima uang
                    </td>
                    <td style="border-left-width: 0px;">
                        :
                    </td>
                    <td style="border-left-width: 0px; border-right-width: 1px; width: 14.47cm;">
                        {{ date('d/m/Y', strtotime($pembayaran->tanggal_pembayaran)) }} <!-- tanggal pembayaran -->
                    </td>
                </tr>
            </table>
            <table cellspacing="0">
                <tr>
                    <td style="border-bottom-width: 0px; width: 6cm;">
                        <center>Ruang untuk Teraan<br></center>
                        <center>Kas Register / Tanda Tangan<br></center>
                        <center>Petugas Penerima</center>
                        <br>
                        <br>
                        <br>
                    </td>
                    <td align=center valign=top colspan="2" style="width: 6cm; border-bottom-width: 0px;">
                        <center>Diterima Oleh <br></center>
                        <center>Petugas Tempat Pembayaran <br></center>
                        <center>Tanggal :
                            {{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->locale('id')->isoFormat('D MMMM Y') }}<!-- tanggal pembayaran -->
                        </center>
                        <br>
                        <br>
                        <br>
                    </td>
                    <td
                        style="border-bottom-width: 0px; border-right-width: 1px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 6.34cm;">
                        <center>Madiun,
                            {{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->locale('id')->isoFormat('D MMMM Y') }}<!-- tanggal pembayaran-->
                            <br>
                        </center>
                        <center>Penyetor</center>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </td>
                </tr>
                <tr></tr>
                <tr>
                    <td>
                        <center>{{ $pembayaran->petugas->nama }} <!-- nama petugas--></center>
                    </td>
                    <td>
                        Tanda Tangan <br>
                        Nama Terang <br>
                    </td>
                    <td style="border-left-width: 0px;">
                        : ..................... <br>
                        : .....................
                    </td>
                    <td style="border-right-width: 1px;">
                        <center>......................</center>
                    </td>
                </tr>
            </table>
        </div>
    </page>
</body>

</html>
