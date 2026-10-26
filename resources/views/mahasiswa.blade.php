
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>

    @if (session('sukses'))
        <p style="color: green;">{{ session('sukses') }}</p>
    @endif

    @if (session('gagal'))
        <p style="color: red;">{{ session('gagal') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h2>Tambah Mahasiswa</h2>

    <form action="{{ route('mahasiswa.store') }}" method="POST">
        @csrf

        <p>
            NIM<br>
            <input type="text" name="nim"
                   value="{{ old('nim') }}" required>
        </p>

        <p>
            Nama<br>
            <input type="text" name="nama"
                   value="{{ old('nama') }}" required>
        </p>

        <p>
            Email<br>
            <input type="email" name="email"
                   value="{{ old('email') }}" required>
        </p>

        <p>
            Usia<br>
            <input type="number" name="usia"
                   min="17" max="60"
                   value="{{ old('usia') }}" required>
        </p>

        <p>
            Program Studi<br>
            <select name="program_studi_id" required>
                <option value="">-- Pilih Program Studi --</option>
                @foreach ($daftarProgramStudi as $programStudi)
                    <option value="{{ $programStudi['id'] }}"
                        @selected(old('program_studi_id') == $programStudi['id'])>
                        {{ $programStudi['nama_prodi'] }}
                    </option>
                @endforeach
            </select>
        </p>

        <button type="submit">Tambah Mahasiswa</button>
    </form>

    <hr>

    <h2>Pencarian dan Filter</h2>

    <form action="{{ route('mahasiswa.index') }}" method="GET">
        <p>
            Cari mahasiswa<br>
            <input type="text" name="q"
                   value="{{ request('q') }}"
                   placeholder="NIM, nama, atau email">
        </p>

        <p>
            Filter Program Studi<br>
            <select name="program_studi_id">
                <option value="">Semua Program Studi</option>
                @foreach ($daftarProgramStudi as $programStudi)
                    <option value="{{ $programStudi['id'] }}"
                        @selected(request('program_studi_id') == $programStudi['id'])>
                        {{ $programStudi['nama_prodi'] }}
                    </option>
                @endforeach
            </select>
        </p>

        <button type="submit">Cari / Filter</button>
        <a href="{{ route('mahasiswa.index') }}">Reset</a>
    </form>

    <h2>Data Mahasiswa</h2>

    @if (count($daftarMahasiswa) > 0)
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Usia</th>
                    <th>Program Studi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($daftarMahasiswa as $index => $mahasiswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $mahasiswa['nim'] }}</td>
                        <td>{{ $mahasiswa['nama'] }}</td>
                        <td>{{ $mahasiswa['email'] }}</td>
                        <td>{{ $mahasiswa['usia'] }}</td>
                        <td>{{ $mahasiswa['nama_prodi'] }}</td>
                        <td>
                            <a href="{{ route('mahasiswa.edit', $mahasiswa['id']) }}">
                                Edit
                            </a>

                            <form action="{{ route('mahasiswa.destroy', $mahasiswa['id']) }}"
                                  method="POST"
                                  style="display: inline;"
                                  onsubmit="return confirm('Yakin ingin menghapus data mahasiswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Data mahasiswa tidak ditemukan.</p>
    @endif
</body>
</html>
