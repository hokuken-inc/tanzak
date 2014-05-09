<?php

class CategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->truncate();

        Category::create(array(
                'name' => 'テンプレート',
                'order' => '1',
                // :
        ));
        
        Category::create(array(
                'name' => 'パーツ',
                'order' => '2',
                // :
        ));

        Category::create(array(
                'name' => 'プラグイン',
                'order' => '3',
                // :
        ));
        
        Category::create(array(
                'name' => 'アイコン',
                'order' => '4',
                // :
        ));
        
    }
}