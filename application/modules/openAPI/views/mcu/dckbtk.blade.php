@layout('template/front/main')

@section('scripts-css')
<style type="text/css">
    table {
        border-color: black;
        width: 100%;
        border-spacing: 0px;
    }

    td,
	th {
        padding-left: 10px;
    }

    .identitas {
        border-right: solid;
        padding-left: 10px;
        border-width: 1px
    }

    * {
        border width: 1px;
        border-spacing: 0px;
    }

    th {
        border-top: solid;
    }

    .kiri {
        border-left: solid;
        border-right: solid;
        border-width: 1px
    }

    .bukankiri {
        border-right: solid;
        border-width: 1px
    }
</style>
@endsection

@section('content')
<div class="box">
    <div id="cetak" style="color: black; font-size: 12px;">
        <div>
            <img src="{{ base_url('assets/images/headerdckbtk.jpg') }}" alt="" width="100%">
            <br><br>
        </div>
        <div style="margin-left: 80px;margin-right:80px ">
            <div>
                <table style="border-style: solid; border-spacing: 0px;border-width: 1px">
                    <tr>
                        <td class="identitas">Nama</td>
                        <td class="identitas">{{ $siswa->siswa_nama }}</td>
                        <td class="identitas">Jenis Kelamin</td>
                        <td class="">{{ $siswa->siswa_kelamin == "L" ? "Laki-Laki" : "Perempuan" }}</td>
                    </tr>
                    <tr>
                        <td class="identitas">NIS</td>
                        <td class="identitas">{{ $siswa->siswa_nis }} </td>
                        <td class="identitas">Tangal Lahir</td>
                        <td class=""> {{ formatTanggal($siswa->siswa_tgl_lahir) }}</td>
                    </tr>
                    <tr>
                        <td class="identitas">Kelas</td>
                        <td class="identitas">{{ $jenjang }} - {{ $siswa->kelas_tingkat }}{{ $siswa->kelas_rombel }}</td>
                        <td class="identitas">Tanggal @if($mcu->periode_name == "MCU") MCU @else General Screening @endif</td>
                        <td class="">{{ formatTanggal($mcu->mcu_date) }}</td>
                    </tr>
                    <tr>
                        <td class="identitas"> Umur </td>
                        <td class="identitas">{{ $mcu->mcu_ageY ?? '' }} Tahun {{ $mcu->mcu_ageM ?? '' }} Bulan</td>
                        <td class="identitas"></td>
                        <td class="" style="border-collapse: collapse;"></td>
                    </tr>
                </table>
            </div>

            <center>
                <p>
                    <b><h4>HASIL PEMERIKSAAN @if($mcu->periode_name == "MCU") MEDICAL CHECK UP @else GENERAL SCREENING @endif</h4></b>
                </p>
            </center>

            <p style="font-size: 18px; margin-top:0px; margin-bottom: 0px;"><b> A.Grafik IMT</b></p>
            <center>
                <div id="curve_chart" style="width: 100%; height: 240px ;padding-left:0px; width: 800px"></div>
            </center>
            <div>
                <p style="font-size: 18px"> <b> B. Hasil Medical Checkup </b></p>
                <table style="width:100%;padding: 5px;border-width: 1px;">
                    <tr style="border-bottom: solid;border-width: 1px">
                        <th class="kiri">URAIAN PEMERIKSAAN</th>
                        <th class="bukankiri">HASIL</th>
                        <th class="bukankiri">UNIT</th>
                        <th class="bukankiri">NILAI RUJUKAN</th>
                        <th class="bukankiri">KETERANGAN</th>
                    </tr>
                    <tr>
                        <td class="kiri"> <b>Pemeriksaan Status Gizi</b></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">Berat Badan</td>
                        <td class="bukankiri"> {{ $gizi->bb ?? '' }}</td>
                        <td class="bukankiri">kg</td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">Tinggi Badan</td>
                        <td class="bukankiri"> {{ $gizi->tb ?? '' }}</td>
                        <td class="bukankiri">cm</td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">Lingkar Kepala</td>
                        <td class="bukankiri"> {{ $gizi->lk ?? '' }}</td>
                        <td class="bukankiri">cm</td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">Lingkar Lengan</td>
                        <td class="bukankiri"> {{ $gizi->lla ?? '' }}</td>
                        <td class="bukankiri">cm</td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">Lingkar Perut</td>
                        <td class="bukankiri"> {{ $gizi->lp ?? '' }}</td>
                        <td class="bukankiri">cm</td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                    </tr>
                    <tr>
                        <td class="kiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                    </tr>
                    <tr>
                        <td class="kiri"><b>Kategori Status Gizi</b></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">IMT</td>
                        <td class="bukankiri"> {{ $gizi->pimt ?? '' }}</td>
                        <td class="bukankiri">kg/㎡</td>
                        <td class="bukankiri">{{ $imt->batas_bawah ?? '' }} - {{ $imt->batas_atas ?? '' }}</td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">Status Gizi</td>
                        <td class="bukankiri">
							@if (isset($gizi->status_gizi))
                                @if ($gizi->status_gizi == '1')
                                    Sangat Kurus
                                @elseif ($gizi->status_gizi == '2')
                                    Kurus
                                @elseif ($gizi->status_gizi == '3')
                                    Normal
                                @elseif ($gizi->status_gizi == '4')
                                    Gemuk
                                @elseif ($gizi->status_gizi == '5')
                                    Sangat Gemuk
                                @endif
                            @endif
                        </td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri">Normal</td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">BB/U</td>
						<td class="bukankiri">{{ isset($gizi->bbperu) ? ($gizi->bbperu == '2' ? 'Ya' : 'Tidak') : '' }}</td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri">Tidak</td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri"> <b>Pemeriksaan Langit-Langit Mulut</b> </td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">Celah Bibir/Langit-Langit</td>
						<td class="bukankiri">{{ isset($mulut->bibir) ? ($mulut->bibir == '2' ? 'Ya' : 'Tidak') : '' }}</td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri">Tidak</td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">Luka Pada Sudut Mulut</td>
                        <td class="bukankiri">{{ isset($mulut->sudut_mulut) ? ($mulut->sudut_mulut == '2' ? 'Ya' : 'Tidak') : '' }}</td>
						<td class="bukankiri"></td>
                        <td class="bukankiri">Tidak</td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">Sariawan</td>
                        <td class="bukankiri">{{ isset($mulut->sariawan) ? ($mulut->sariawan == '2' ? 'Ya' : 'Tidak') : '' }}</td>
						<td class="bukankiri"></td>
                        <td class="bukankiri">Tidak</td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">Lidah Kotor</td>
                        <td class="bukankiri">{{ isset($mulut->lidah) ? ($mulut->lidah == '2' ? 'Ya' : 'Tidak') : '' }}</td>
						<td class="bukankiri"></td>
                        <td class="bukankiri">Tidak</td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">Luka Lainnya</td>
                        <td class="bukankiri">{{ isset($mulut->luka_lain) ? ($mulut->luka_lain == '2' ? 'Ya' : 'Tidak') : '' }}</td>
						<td class="bukankiri"></td>
                        <td class="bukankiri">Tidak</td>
                        <td class="bukankiri">{{ $mulut->ket_masalah_lain_rongga_mulut ?? '' }}</td>
                    </tr>

                    <tr style="margin-top: 10px">
                        <td class="kiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                    </tr>
                    <tr>
                        <td class="kiri"><b> Pemeriksaan Kesehatan Gigi dan Gusi</b></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">Caries</td>
                        <td class="bukankiri">{{ isset($mulut->caries) ? ($mulut->caries == '2' ? 'Ya' : 'Tidak') : '' }}</td>
						<td class="bukankiri"></td>
                        <td class="bukankiri">Tidak</td>
						<td class="bukankiri">@if ($jenjang != "SMP") {{ $mulut->ket_caries ?? '' }} @endif </td>
                    </tr>

                    <tr style="margin-top: 10px">
                        <td class="kiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri"><b> Pemeriksaan Kesehatan Penglihatan</b></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">Tajam Penglihatan</td>
                        <td class="bukankiri">
							@if (isset($matatelinga->penglihatan))
                                @if ($matatelinga->penglihatan == '1')
                                    Normal
                                @elseif ($matatelinga->penglihatan == '2')
                                    Low Vission
                                @elseif ($matatelinga->penglihatan == '3')
                                    Kebutaan
                                @elseif ($matatelinga->penglihatan == '4')
                                    Kelainan Refraksi
                                @endif
                            @endif
						</td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri">Normal</td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">Pemakaian Kacamata</td>
                        <td class="bukankiri">{{ isset($matatelinga->kacamata) ? ($matatelinga->kacamata == '2' ? 'Ya' : 'Tidak') : '' }}</td>
						<td class="bukankiri"></td>
                        <td class="bukankiri">Tidak</td>
                        <td class="bukankiri">{{ $matatelinga->ket_kacamata ?? '' }}</td>
                    </tr>

                    <tr style="margin-top: 10px">
                        <td class="kiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                    </tr>
                    <tr>
                        <td class="kiri"><b> Pemeriksaan Pendengaran</b></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri">Serumen / Kotoran Telinga</td>
                        <td class="bukankiri">{{ isset($matatelinga->kot_telinga) ? ($matatelinga->kot_telinga == '2' ? 'Ya' : 'Tidak') : '' }}</td>
						<td class="bukankiri"></td>
                        <td class="bukankiri">Tidak</td>
                        <td class="bukankiri">{{ $matatelinga->ket_kot_telinga ?? '' }}</td>
                    </tr>

                    <tr style="margin:20px ;border-bottom:  solid;border-width: 1px">
                        <td class="kiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                        <td class="bukankiri"></td>
                    </tr>

                    <tr>
                        <td class="kiri" colspan="5">
                            <h5> Kesimpulan dan Saran</h5>
                        </td>
                    </tr>

                    <tr style="height: 40px;">
                        <td style="word-break: break-all;" colspan="5" class="kiri">
							Kesimpulan : {{ $lain->kesimpulan ?? '' }}
                            <br>
                            Saran : {{ $lain->saran ?? '' }}
                        </td>
                    </tr>
                    <tr style="margin:20px ;border-bottom:  solid;border-width: 1px">
                        <td colspan="5" class="kiri"></td>
                    </tr>
                    <tr>
                        <td class="kiri" colspan="5">
                            <h5> Follow Up</h5>
                        </td>
                    </tr>
                    <tr style="height: 40px; border-bottom: solid;border-width: 1px">
                        <td style="word-break: break-all;" colspan="5" class="kiri">
							{{ $lain->followup ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="kiri" style="border: none;" colspan="5">
                            Catatan : Data diatas diambil saat pelaksanaan Pemeriksaan
                        </td>
                    </tr>
                    <tr>
                        <td class="kiri" style="border: none;" colspan="5"></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td></td>
                        <td>Sleman, {{ formatTanggal($mcu->mcu_date) }} </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td> Pemeriksa </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
							@if($dokter)
                                @if(isset($dokter->dokter_signature))
                                <img src="{{base_url($dokter->dokter_signature)}}?v=2" style="width: 4cm; height: 2cm; max-width: 4cm; max-height: 2cm;">
                                @else
                                <div style="width: 4cm; height: 2cm"></div>
                                @endif
                            @else
                                <p class="text-center">-</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="border: none;text-align:center" width="4" colspan="1">{{ $dokter->dokter_fullname ?? "Dokter tidak ditemukan" }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div> <!-- akhir div cetak -->
    <br>
    @if($dokter)
        <center><button class="btn btn-primary" onclick="generatePdf()">Generate PDF</button> </center>
    @else
        <center><button class="btn btn-primary" disabled>Proses Belum Selesai</button> </center>
    @endif
    <br><br>
</div>
@endsection

@section('scripts-js')
<script type="text/javascript" src="{{ base_url('assets/plugins/google-chart/loader.js') }}"></script>
<script type="text/javascript" src="{{ base_url('assets/plugins/html2pdf/html2pdf.bundle.js') }}"></script>
<script type="text/javascript">
	google.charts.load('current', {
		'packages': ['corechart']
	});
	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {
		var data = google.visualization.arrayToDataTable({{ json_encode($grafik_data, JSON_NUMERIC_CHECK) }});
        var options = {
            title: 'PERKEMBANGAN IMT SISWA',
            curveType: 'line',
            chartArea: {
                left: "5%"
            },
            legend: {
                position: 'bottom',
                textStyle: {
                    fontSize: 12
                }
            },
            vAxis: {
                minValue: 0
            },
            hAxis: {
                title: 'Umur (Tahun / Bulan)',
                format: 0
            }
        };
        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
	}

    function generatePdf() {
        const invoice = this.document.getElementById("cetak");
        var opt = {
            margin: 0,
            filename: "{{$siswa->siswa_nama; }}-{{formatTanggal($mcu->mcu_date)}}.pdf",
            image: {
                type: "jpeg",
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: "in",
                format: "legal",
                orientation: "portrait"
            }
        };
        html2pdf().from(invoice).set(opt).save();
    }
</script>
@endsection