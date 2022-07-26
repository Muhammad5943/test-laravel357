<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $rand1 = 0;
        static $rand2 = 1;
        static $rand3 = 5;
        static $rand4 = 4;
        static $rand5 = 2;
        static $rand6 = 9;
        $rand1++;
        $rand2++;
        $rand3++;
        $rand4++;
        $rand5++;
        $rand6++;


        $rand_pic = $this->faker->randomElement([$rand1,$rand2,$rand3,$rand4,$rand5,$rand6]);

        return [
            'group_id' => Group::inRandomOrder()->limit(1)->pluck('id')->first(),
            'nama' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'alamat' => $this->faker->address,
            'hp' => $this->faker->phoneNumber,
            'profile_pic' => $this->faker->randomElement([
                                'https://picsum.photos/800/600?random=1296'.$rand_pic.$rand_pic,
                                'https://picsum.photos/'.$rand_pic.'00/'.($rand_pic+1).'00?grayscale',
                            ]),

        ];
    }
}
