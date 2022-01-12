<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 'pekerjaan_diselesaikan',
        // 'name',
        // 'accept_by_admin',
        // 'email',
        // 'password',
        // 'no_hp',
        // 'alamat',
        // 'role' ,
        // 'jenis_kelamin',
        // 'lingkup_wilayah',
        // 'category_id',
        // 'pengalaman',
        // 'tentang',
        // 'pekerjaan',
        // 'nama_bengkel',
        // 'foto',
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'tentang' => 'saya seorang montir sejak 2005',
            'pengalaman' => '2 tahun menjadi montir',
            'pekerjaan' => 'montir',
            'nama_bengkel' => 'montirku',
            'role' => 'montir',
            'accept_by_admin' => 1,
            'alamat' => $this->faker->address(),
            'no_hp' => $this->faker->phoneNumber(),
            'jenis_kelamin' => 'wanita',
            'category_id' => 1,
            'pengalaman' => 'Tiga tahun',
            'lingkup_wilayah' => $this->faker->address(),
            'email_verified_at' => now(),
            'password' => \Hash::make(12345678),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
