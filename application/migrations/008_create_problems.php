<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_problems extends CI_Migration {
    public function up()
    {
        $this->dbforge->drop_table('problems');
		
		$this->dbforge->add_field(array(
			'id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
            ),
            'body' => array(
                'type' => 'TEXT',
            ),
            'user_id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
            'solutions_count' => array(
            	'type' => 'TINYINT',
            	'constraint' => '5',
                'unsigned' => TRUE,
                'default' => 0,
			),
			'score' => array(
            	'type' => 'TINYINT',
            	'constraint' => '5',
                'unsigned' => TRUE,
                'default' => 0,
			),
			'category_id' => array(
                'type' => 'TINYINT',
                'constraint' => '3',
                'unsigned' => TRUE,
            ),
            'issolve' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'unsigned' => TRUE,
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
        $this->dbforge->create_table('problems');

    }
    
    public function down()
    {
        $this->dbforge->drop_table('problems');
    }
}