<div class="container">

    <h1>Dashboard Admin</h1>

    <div style="display:flex; gap:20px; margin-bottom:20px;">

        <div style="border:1px solid #ccc; padding:15px; width:200px;">
            <h3>Total User</h3>
            <p>{{ $users->count() }}</p>
        </div>

        <div style="border:1px solid #ccc; padding:15px; width:200px;">
            <h3>Total Role</h3>
            <p>{{ count($roles) }}</p>
        </div>

    </div>

    <form action="" method="GET">
        <select name="role" onchange="this.form.submit()">
            <option value="">Semua Role</option>

            @foreach ($roles as $role)
                <option value="{{ $role }}"
                    {{ $roleFilter == $role ? 'selected' : '' }}>
                    {{ ucfirst($role) }}
                </option>
            @endforeach
        </select>
    </form>

    <br>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        Data user tidak ada
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>