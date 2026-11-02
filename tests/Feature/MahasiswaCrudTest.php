<?php

namespace Tests\Feature;

use App\Models\Mahasiswas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MahasiswaCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_lists_all_student_fields_and_creates_a_student(): void
    {
        $response = $this->post(route('mahasiswa.store'), [
            'nama' => 'Nadia Putri',
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Jl. Merdeka No. 10',
            'no_hp' => '081234567890',
        ]);

        $response
            ->assertRedirect(route('mahasiswa.index'))
            ->assertSessionHas('success', 'Data mahasiswa berhasil ditambahkan.');

        $this->assertDatabaseHas('mahasiswa', [
            'nama' => 'Nadia Putri',
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Jl. Merdeka No. 10',
            'no_hp' => '081234567890',
        ]);

        $this->get(route('mahasiswa.index'))
            ->assertOk()
            ->assertSeeText('Nadia Putri')
            ->assertSeeText('Jl. Merdeka No. 10')
            ->assertSeeText('081234567890');
    }

    public function test_it_returns_indonesian_validation_errors_and_preserves_input(): void
    {
        $response = $this->from(route('mahasiswa.index'))
            ->post(route('mahasiswa.store'), [
                'nama' => 'Nama Uji',
                'jenis_kelamin' => 'Tidak diketahui',
                'alamat' => '',
                'no_hp' => '0812',
            ]);

        $response
            ->assertRedirect(route('mahasiswa.index'))
            ->assertSessionHasErrors([
                'jenis_kelamin' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
                'alamat' => 'Alamat wajib diisi.',
            ])
            ->assertSessionHas('_old_input.nama', 'Nama Uji')
            ->assertSessionHas('_old_input.no_hp', '0812');

        $this->assertDatabaseCount('mahasiswa', 0);
    }

    public function test_it_edits_updates_and_deletes_a_student(): void
    {
        $mahasiswa = Mahasiswas::create([
            'nama' => 'Raka Pratama',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Kenanga No. 2',
            'no_hp' => '081111111111',
        ]);

        $this->get(route('mahasiswa.edit', $mahasiswa->id))
            ->assertOk()
            ->assertSee('value="Raka Pratama"', false);

        $this->put(route('mahasiswa.update', $mahasiswa->id), [
            'nama' => 'Raka Pratama Baru',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Melati No. 3',
            'no_hp' => '082222222222',
        ])
            ->assertRedirect(route('mahasiswa.index'))
            ->assertSessionHas('success', 'Data mahasiswa berhasil diperbarui.');

        $this->assertDatabaseHas('mahasiswa', [
            'id' => $mahasiswa->id,
            'nama' => 'Raka Pratama Baru',
            'alamat' => 'Jl. Melati No. 3',
            'no_hp' => '082222222222',
        ]);

        $this->delete(route('mahasiswa.destroy', $mahasiswa->id))
            ->assertRedirect(route('mahasiswa.index'))
            ->assertSessionHas('success', 'Data mahasiswa berhasil dihapus.');

        $this->assertDatabaseMissing('mahasiswa', ['id' => $mahasiswa->id]);
    }
}
