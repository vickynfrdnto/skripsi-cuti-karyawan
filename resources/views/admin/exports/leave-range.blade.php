<!DOCTYPE html>
<html>
<head>
    <title>Laporan Cuti Pegawai</title>
    <style>
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h3>Laporan Cuti Pegawai</h3>
    <p>Periode: {{ $start_date }} s.d. {{ $end_date }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Jenis Cuti</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Akhir</th>
                <th>Alasan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($leaves as $index => $leave)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $leave->employee->user->name ?? '-' }}</td>
                    <td>{{ ucfirst($leave->reason) }}</td>
                    <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d-m-Y') }}</td>
                    <td>{{ $leave->description }}</td>
                </tr>
            @empty
                <tr><td colspan="6" align="center">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
