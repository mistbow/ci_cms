<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users extends CI_Migration {
    public function up()
    {
        // Drop table 'users' if it exists
        $this->dbforge->drop_table('users');
		
		// Table structure for table 'users'
		
		$this->dbforge->add_field(array(
			'id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'ip_address' => array(
				'type' => 'VARBINARY',
				'constraint' => '16'
			),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '80',
            ),
            'salt' => array(
				'type' => 'VARCHAR',
				'constraint' => '40'
			),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'activation_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => TRUE
			),
			'forgotten_password_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => TRUE
			),
			'forgotten_password_time' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
				'null' => TRUE
			),
			'created_on' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
			),
			'last_login' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
				'null' => TRUE
			),
            'active' => array(
				'type' => 'TINYINT',
				'constraint' => '1',
				'unsigned' => TRUE,
				'null' => TRUE
			),
		));
		
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');

        // Dumping data for table 'users'
        $data = array(
            'id' => '10001',
            'username' => 'administrator',
            'password' => '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4',
            'email' => 'admin@admin.com',
        );
        $this->db->insert('users', $data);
    }
    
    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}