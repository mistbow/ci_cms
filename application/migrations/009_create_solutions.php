<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_solutions extends CI_Migration {
    public function up()
    {
        $this->dbforge->drop_table('solutions');
		
		$this->dbforge->add_field(array(
			'id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
			'problem_id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
            'body' => array(
                'type' => 'TEXT',
            ),
            'user_id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
            'best_solution' => array(
            	'type' => 'TINYINT',
            	'constraint' => '1',
                'default' => 0,
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
        $this->dbforge->create_table('solutions');
    }
    
    public function down()
    {
        $this->dbforge->drop_table('solutions');
    }
}