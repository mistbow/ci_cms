<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_userinfos extends CI_Migration {
    public function up()
    {
        // Drop table 'userinfos' if it exists
        $this->dbforge->drop_table('userinfos');
		
		// Table structure for table 'userinfos'
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
            'created_on' => array(
                'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
            ),
			'avatar' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
			'tagline' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE,
            ),
            'school' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
		));
		
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('userinfos');

        // Dumping data for table 'users'
        $data = array(
            'id' => '10001',
            'user_id' => 10001,
            'created_on' => time(),
            'avatar' => '8cm.jpg',
            'tagline' => '好好学习，天天向上',
            'school' => 'california',
        );
        $this->db->insert('userinfos', $data);
    }
    
    public function down()
    {
        $this->dbforge->drop_table('userinfos');
    }
}