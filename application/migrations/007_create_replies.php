<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_replies extends CI_Migration {
    public function up()
    {
        $this->dbforge->drop_table('replies');
		
		$this->dbforge->add_field(array(
			'topic_id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'body' => array(
                'type' => 'TEXT',
            ),
            'user_id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
            'state' => array(
            	'type' => 'TINYINT',
            	'constraint' => '3',
                'unsigned' => TRUE,
			),
			'created_at' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
				'null' => TRUE
			),
			'updated_at' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
				'null' => TRUE
			),
		));
        $this->dbforge->create_table('replies');
    }
    
    public function down()
    {
        $this->dbforge->drop_table('replies');
    }
}