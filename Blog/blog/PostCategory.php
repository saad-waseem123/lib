<?php
Done
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PostCategory extends Seeder
{
    public function run()
    {


        $db      = \Config\Database::connect();
        $builder = $db->table('postcategories');

        $builder->truncate();

        $data = [
            [
                'id'            => 1,
                'pcat_slug'      => 'demo-postcategory-one',
                'pcat_name'      => 'Demo postCategory One',
                'pcat_short_desc'=> null,
                'pcat_desc'      => null,
                'pcat_parent_id' => 0,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'id'            => 2,
                'pcat_slug'      => 'demo-postcategory-two',
                'pcat_name'      => 'Demo postCategory Two',
                'pcat_short_desc'=> null,
                'pcat_desc'      => null,
                'pcat_parent_id' => 0,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'id'            => 3,
                'pcat_slug'      => 'demo-postcategory-three',
                'pcat_name'      => 'Demo postCategory Three',
                'pcat_short_desc'=> null,
                'pcat_desc'      => null,
                'pcat_parent_id' => 0,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'id'            => 4,
                'pcat_slug'      => 'demo-sub-postcategory-one',
                'pcat_name'      => 'Demo Sub postCategory One',
                'pcat_short_desc'=> null,
                'pcat_desc'      => null,
                'pcat_parent_id' => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            
        ];

        $builder->insertBatch($data);
    }
}
