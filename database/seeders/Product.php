<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Product extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'ANABOLIC ISO WHEY 2 kg',
                'description' => 'يحتوي ANABOLIC ISO WHEY
                 على بروتين مصل اللبن المعزول عالي الجودة، وهو مصدر سريع 
                 الامتصاص للأحماض
                  الأمينية الأساسية التي يحتاجها جسمك لبناء وإصلاح الأنسجة العضلية.',
                'price' => 3.400 ,
           
                'category_id' => 2,
                'brand_id' => 6,
                'sku' => 10,
                
                'image' => 'Category/zIBqVw9b4RCmuIjLAj8AcMvM5J6TtgDwT72AlNLb.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Commandos Hellfire Creatine 100 serv',
                'description' => 'هذا المكمل الغذائي عالي الجودة يوفر لك جرعة قوية من الكرياتين مونوهيدرات،
                 مما يساعدك على زيادة قوتك وتحملك بشكل ملحوظ. حقق أقصى استفادة من تماريناتك وابني جسمًا قويًا.',
                'price' => 1.050,
                'category_id' => 2,
                'brand_id' => 5,
                'sku' => 10,
                'image' => 'Category/zIBqVw9b4RCmuIjLAj8AcMvM5J6TtgDwT72AlNLb.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
