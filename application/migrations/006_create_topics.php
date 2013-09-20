<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_topics extends CI_Migration {
    public function up()
    {
        $this->dbforge->drop_table('topics');
		
		$this->dbforge->add_field(array(
			'id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'node_id' => array(
                'type' => 'TINYINT',
                'constraint' => '3',
                'unsigned' => TRUE,
                'default' => 1,
            ),
            'body' => array(
                'type' => 'TEXT',
            ),
            'user_id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
            'replies_count' => array(
            	'type' => 'TINYINT',
            	'constraint' => '3',
                'unsigned' => TRUE,
                'default' => 0,
			),
			'last_reply_user_id' => array(
				'type' => 'MEDIUMINT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'null' => TRUE,
			),
			'replied_at' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
				'null' => TRUE
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
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('topics');

    }
    
    public function down()
    {
        $this->dbforge->drop_table('topics');
    }
}