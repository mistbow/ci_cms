<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_vips extends CI_Migration {
    public function up()
    {
        // Drop table 'vips' if it exists
        $this->dbforge->drop_table('vips');
		
		// Table structure for table 'vips'
		
		$this->dbforge->add_field(array(
			'id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
            'vip_level' => array(
				'type' => 'TINYINT',
				'constraint' => '1',
				'unsigned' => TRUE,
				'default' => 0,
			),
            'start_time' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
				'null' => TRUE,
			),
			'end_time' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
				'null' => TRUE,
			),
		));
		
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('vips');

    }
    
    public function down()
    {
        $this->dbforge->drop_table('vips');
    }
}