<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_tokens extends CI_Migration {
    public function up()
    {
        // Drop table 'tokens' if it exists
        $this->dbforge->drop_table('tokens');
		
		// Table structure for table 'tokens'
		
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
            'third_user_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '80',
            ),
            'access_token' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
            ),
            'refresh_token' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => TRUE,
            ),
            'token_type' => array(
				'type' => 'TINYINT',
				'constraint' => '3',
				'unsigned' => TRUE,
				'default' => 1,
			),
			'expire_time' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
				'null' => TRUE
			),
			'add_time' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
			),
			'update_time' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
				'null' => TRUE
			),
		));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tokens');

    }
    
    public function down()
    {
        $this->dbforge->drop_table('tokens');
    }
}