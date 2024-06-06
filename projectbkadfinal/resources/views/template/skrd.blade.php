<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKRD</title>
    <style type="text/css">
        body {
            background: rgb(70, 68, 68);
        }

        .heigth {
            height: 10px;
        }

        .right {
            text-align: right;
        }

        page[size="A4"] {
            background: rgb(255, 255, 255);
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

            border-right-width: 1px;
            border-right-style: solid;

            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <page size="A4">
        <div style="padding: 0px 0px 0px 0px">
            <div>
                <table cellspacing="0" cellpadding="1">
                    <tr>
                        <td style="border-top-width: 1px; border-bottom-width: 0px; width: 8cm;">
                            <center><strong>PEMERINTAH DAERAH KOTA MADIUN</strong><br /></center>
                            <center><strong>BADAN KEUANGAN DAN ASET DAERAH</strong><br /></center>
                            <center><strong>KOTA MADIUN</strong><br /></center>
                        </td>
                        <td colspan="2" style="border-top-width: 1px; border-bottom-width: 0px; width: 10cm;">
                            <center><strong>SKRD</strong><br /></center>
                            <center><strong>(SURAT KETETAPAN RETRIBUSI DAERAH)</strong></center>
                            <br />
                        </td>
                        <td
                            style="border-top-width: 1px; border-bottom-width: 0px; border-right-width: 1px; width: 2.99cm;">
                            <center><strong>NOMOR</strong><br /></center>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <center>JL. SEMANGKA NO.02 TELP.476531 <br /></center>
                            <center>MADIUN</center>
                            <br>
                        </td>
                        <td style="border-right-width: 0px; width: 3cm;">
                            &nbsp; Mulai<br>
                            &nbsp; Berakhir
                        </td>
                        <td style="border-left-width: 0px; width: 5cm;">
                            : 02-02-2023 <!-- tanggal mulai sewa --> <br />
                            : 02-02-2023 <!-- tanggal akhir sewa -->
                        </td>
                        <td style="border-right-width: 1px;">
                            <center><strong>{{ $skrd->id }}<!-- berubah sesuai urutan cetak --> <br></strong>
                            </center>
                        </td>
                    </tr>
                </table>
                <table cellspacing="0" cellpadding="3">
                    <tr>
                        <td style="border-right-width: 0px; width: 3cm;">
                            Nama <br>
                            Alamat <br>
                            NPWR <br>
                            Nama Aset <br>
                            Lokasi Aset
                        </td>
                        <td style="border-right-width: 1px; border-left-width: 0px; width: 15.93cm;">
                            : {{ $skrd->sewa->nama }}<!-- nama penyewa --> <br />
                            : {{ $skrd->sewa->alamat }}<!-- alamat --> <br />
                            : {{ $skrd->sewa->npwr }}<!-- NPWR penyewa--> <br />
                            : {{ $skrd->sewa->asset->nama }}<!-- nama aset --> <br />
                            : {{ $skrd->sewa->asset->lokasi }}<!-- lokasi aset -->
                        </td>
                    </tr>
                </table>
                <table cellspacing="0" cellpadding="3">
                    <tr>
                        <td style="width: 1cm;">
                            <center><strong>No.</strong></center>
                        </td>
                        <td style="width: 2cm;">
                            <center><strong>Kode Rek.</strong></center>
                        </td>
                        <td colspan="2" style="width: 13.53cm;">
                            <center><strong>Jenis Retribusi Daerah</strong></center>
                        </td>
                        <td style="border-right-width: 1px; width: 2cm;">
                            <center><strong>Jumlah</strong><br></center>
                            <center><strong>(Rp)</strong></center>
                        </td>
                    </tr>
                    <tr>
                        <td align=center valign=top>
                            1.
                        </td>
                        <td align=center valign=top>
                            4.1.2.02.01
                        </td>
                        <td colspan="2" style="width: 13.53cm;">
                            Retribusi Pemanfaatan Aset Daerah: <br>
                            {{ $skrd->sewa->asset->jenis->kategori->nama }}<!-- kategori aset --> <br>
                            {{ $skrd->sewa->asset->jenis->nama }}<!-- jenis aset --> <br>
                            @foreach ($skrd->sewa->sewaDetail as $resSewaDetail)
                            <!-- panjang --> x
                            {{ str_replace('.', ',', $resSewaDetail->assetDetail->panjang) }}
                            <!-- lebar --> x
                            {{ str_replace('.', ',', $resSewaDetail->assetDetail->lebar) }}
                            <!-- tarif --> x
                            {{ 'Rp. ' . number_format($resSewaDetail->tarif, 0, ',', '.') }}
                            <!-- lama_sewa --> x
                            {{ $skrd->sewa->lama_sewa }}
                            <!-- jumlah asset --> x
                            {{ $resSewaDetail->jumlah }}
                            <!-- total--> =
                            {{ 'Rp' . number_format($resSewaDetail->harga, 0, ',', '.') }}
                            <br>
                        @endforeach
                        </td>
                        <td class="right" style="border-right-width: 1px;">
                            {{ 'Rp' . number_format($skrd->sewa->sewaDetail->harga, 0, ',', '.') }} <!-- harga aset -->
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom-width: 0px;"></td>
                        <td colspan="2" style="width: 13.53cm;">
                            Jumlah Ketetapan Pokok Retribusi
                        </td>
                        <td class="right" style="border-right-width: 1px;">
                            {{ 'Rp' . number_format($skrd->sewa->sewaDetail->harga, 0, ',', '.') }}<!-- total dari harga aset -->
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom-width: 0px; border-right-width: 0px;"></td>
                        <td style="border-right-width: 0px;">
                            Jumlah Sanksi
                        </td>
                        <td style="border-left-width: 0px;">
                            Bunga/Denda
                        </td>
                        <td class="right" style="border-right-width: 1px;">{{ 'Rp' . number_format($skrd->sewa->sewaDetail->denda, 0, ',', '.') }}<!-- denda --> </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom-width: 0px;"></td>
                        <td colspan="2" style="width: 13.53cm;">
                            Jumlah Keseluruhan
                        </td>
                        <td class="right" style="border-right-width: 1px;">3
                            <!-- total (harga aset + denda) -->
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="border-bottom-width: 0px; border-right-width: 1px;"></td>
                    </tr>
                    <tr>
                        <td style="border-bottom-width: 0px;" colspan="2" class="right">Dengan Huruf: &nbsp;</td>
                        <td align=left valign=top colspan="3"
                            style="border-top-width: 1px; border-right-width: 1px;">
                            1200
                            <!-- total dengan huruf --><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="border-right-width: 1px;"></td>
                    </tr>
                </table>
                <table cellspacing="0">
                    <tr>
                        <td style="border-bottom-width: 0px; border-right-width: 0px;"></td>
                        <td style="border-bottom-width: 0px; border-left-width: 0px; width: 18.85cm;">
                            <strong><u>PERHATIAN :</u></strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom-width: 0px; border-right-width: 0px;">
                            1.
                        </td>
                        <td style="border-bottom-width: 0px; border-left-width: 0px;">
                            Harap penyetoran dilakukan melalui Bank Jatim Cab Madiun ke Rek. Kas Umum daerah No
                            0051021333 atau melalui
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom-width: 0px; border-right-width: 0px;"></td>
                        <td style="border-bottom-width: 0px; border-left-width: 0px;">
                            Badan Keuangan Dan Aset Daerah Kota Madiun dengan menggunakan Surat Ketetapan Retribusi
                            Daerah (SKRD) ini.
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom-width: 0px; border-right-width: 0px;">
                            2.
                        </td>
                        <td style="border-bottom-width: 0px; border-left-width: 0px;">
                            Apabila SKRD ini tidak atau kurang dibayar lewat waktu paling lama 30 hari sejak SKRD ini
                            diterima dikenakan sangsi
                        </td>
                    </tr>
                    <tr>
                        <td style="border-right-width: 0px;"></td>
                        <td style="border-left-width: 0px;">
                            administrasi berupa bunga 2% perbulan.
                        </td>
                    </tr>
                </table>
                <table cellspacing="0" cellpadding="2">
                    <tr>
                        <td rowspan="3" style="width: 12.03cm; border-right-width: 0px;"></td>
                        <td
                            style="border-left-width: 0px; border-right-width: 1px; border-bottom-width: 0px; width: 7cm;">
                            <center>Madiun, 021-02-2003 <!-- tanggal cetak --> <br></center>
                            <center>a.n. Kepala Badan Keuangan dan <br></center>
                            <center>Aset Daerah Kota Madiun <br></center>
                            <center>Kepala bidang Akuntansi dan Aset</center>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="border-left-width: 0px; border-right-width: 1px; border-bottom-width: 0px; height: 2.5cm;">
                        </td>
                    </tr>
                    <tr>
                        <td style="border-left-width: 0px; border-right-width: 1px;">
                            <center><strong><u>LILIK HARTUTIK, SE, MM <!-- nama PJ --></u></strong><br></center>
                            <center>Pembina <!-- jabatan PJ --> </center>
                            <center>NIP. 19691124 1993 02 2 002 <!-- NIP --> </center>
                        </td>
                    </tr>
                </table>
                <table cellspacing="0">
                    <tr>
                        <td align=center valign=top style="border-bottom-width: 0px; width: 7cm;">
                            <center>Ruang untuk Teraan<br></center>
                            <center>Kas Register/Tanda Tangan <br></center>
                            <center>Petugas Penerima</center>
                        </td>
                        <td align=center valign=top colspan="2" style="border-bottom-width: 0px; width: 9cm;">
                            <center>Diterima Oleh,<br></center>
                            <center>Petugas Tempat Pembayaran<br><br></center>
                        </td>
                        <td align=center valign=top
                            style="border-right-width: 1px; border-bottom-width: 0px; width: 5cm;">
                            <center>Penyetor</center>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="border-right-width: 0px; width: 2.5cm;">
                            &nbsp; Tanggal <br>
                            &nbsp; Tanda Tangan <br>
                            &nbsp; Nama Terang
                        </td>
                        <td style="border-left-width: 0px;">
                            : <br>
                            : <br>
                            : <br>
                        </td>
                        <td style="border-right-width: 1px;">
                            <br><br><br>
                            <center>(........................................)</center><br>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </page>
</body>

</html>
