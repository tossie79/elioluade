<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Product::create([
            'name' => 'The Masterpeice',
            'imagePath' => 'https://francinerivers.com/wp-content/uploads/2017/07/Masterpiece300.jpg',
            'description' => 'Two lost souls, bound by guilt to their pasts, discover that the very wounds which hold them captive can lead to the incredible grace needed to set them free.',
            'price' => '12',
        ]);
        Product::create([
            'name' => 'Earth Psalms',
            'imagePath' => 'https://francinerivers.com/wp-content/uploads/2016/03/Earth-Psalms.jpg',
            'description' => 'Reflections on How God Speaks through Nature',
            'price' => '142',
        ]);
        Product::create([
            'name' => 'Bridge to Haven',
            'imagePath' => 'https://francinerivers.com/wp-content/uploads/2015/11/Bridge-to-Haven_3001.jpg',
            'description' => 'A tale of temptation, grace, and unconditional love.',
            'price' => '125',
        ]);
        Product::create([
            'name' => 'Redeeming Love',
            'imagePath' => 'https://francinerivers.com/wp-content/uploads/2015/11/Redeeming-Love_300.jpg',
            'description' => 'A retelling of the biblical love story of Gomer and Hosea, set against the romantic backdrop of the California Gold Rush.',
            'price' => '120',
        ]);
        Product::create([
            'name' => 'A Voice in the Wind',
            'imagePath' => 'https://francinerivers.com/wp-content/uploads/2015/11/A-Voice-in-the-Wind_300.jpg',
            'description' => 'The ill-fated romance between a steadfast Christian slave girl, Hadassah, and Marcus, the handsome aristocrat destined to love her, set in 70 A.D. Jerusalem.',
            'price' => '150',
        ]);
    }

}
