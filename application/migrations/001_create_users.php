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
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '80',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'forgotten_password_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '40',
                'null' => TRUE
            ),
            'created_on' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
            'active' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'unsigned' => TRUE,
                'null' => TRUE
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE
            ),
            'qq' => array(
                'type' => 'VARCHAR',
                'constraint' => '14',
                'null' => TRUE
            )

        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');

        // Dumping data for table 'users'
        $data = array(
            'id' => '1',
            'username' => 'administrator',
            'password' => '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4',
            'email' => 'admin@admin.com',
            'forgotten_password_code' => NULL,
            'created_on' => '1268889823',
            'active' => '1',
            'phone' => '0',
            'qq' => '117064092',
        );
        $this->db->insert('users', $data);
    }
    
    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}