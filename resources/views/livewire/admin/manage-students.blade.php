<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">Manajemen Siswa</h2>

    <!-- FORM -->
    <div class="bg-white p-4 rounded shadow mb-6">
        <form wire:submit.prevent="save" class="space-y-3">

            <input wire:model="name" type="text" placeholder="Nama"
                class="w-full border p-2 rounded">

            <input wire:model="nis" type="text" placeholder="NIS"
                class="w-full border p-2 rounded">

            <select wire:model="class_room_id" class="w-full border p-2 rounded">
                <option value="">Pilih Kelas</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>

            <select wire:model="parent_id" class="w-full border p-2 rounded">
                <option value="">Pilih Orang Tua</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
            </select>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                {{ $isEdit ? 'Update' : 'Tambah' }}
            </button>

        </form>
    </div>

    <!-- SEARCH -->
    <input wire:model.live="search" type="text"
        placeholder="Cari siswa..."
        class="mb-4 border p-2 rounded w-full">

    <!-- TABLE -->
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th>Nama</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Orang Tua</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($students as $student)
            <tr class="border-t">
                <td>{{ $student->name }}</td>
                <td>{{ $student->nis }}</td>
                <td>{{ $student->classRoom->name ?? '-' }}</td>
                <td>{{ $student->parent->name ?? '-' }}</td>
                <td>
                    <button wire:click="edit({{ $student->id }})">Edit</button>
                    <button wire:click="delete({{ $student->id }})">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>