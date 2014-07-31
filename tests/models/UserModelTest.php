<?php

/**
 * @group Model
 */

class UserModelTest extends CIUnit_TestCase
{
	protected $tables = array(
		'user'		  => 'user',
	);
	
	private $um;
	private $users;
	
	public function __construct($name = NULL, array $data = array(), $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
		$this->users = Spyc::YAMLLoad(dirname(__FILE__)."/../fixtures/user_fixt.yml");
		
	}
	
	public function setUp()
	{
		parent::tearDown();
		parent::setUp();
		
		$this->CI->load->model('User_model','um');
		$this->um = $this->CI->um;
		$this->dbfixt('user');
	}
	
	/*****
	 * Providers
	 */
	public function GetUsers() {
		return $this->users;
	}

	public function GetUser() {
		$k = array_rand($this->users);
		return array($this->users[$k]);
	}

	// ------------------------------------------------------------------------
	/**
	 * @covers User_model::get_all
	 */
	public function testgetAll()
	{
		$all = $this->um->get_all();
		$this->assertEquals(count($all),count($this->users));
	}

	// ------------------------------------------------------------------------
	/**
	 * @dataProvider GetUsers
	 * @covers User_model::get_by_id
	 */
	public function testGetById($id)
	{
		$user = $this->um->get_by_id($id);
		$this->assertNotEmpty($user);
		$this->assertEquals($user->id, $id);
	}
	
	// ------------------------------------------------------------------------
	/**
	 * @dataProvider GetUsers
	 * @covers User_model::get_by_email
	 */
	public function testGetByEmail($id,$email)
	{
		$user = $this->um->get_by_email($email);
		$this->assertNotEmpty($user);
		$this->assertEquals($user->email, $email);
	}

	// ------------------------------------------------------------------------
	/**
	 * @dataProvider GetUsers
	 * @covers User_model::get_by_id
	 * @covers User_model::set_confirmation
	 * @covers User_model::update
	 * @covers User_model::check_confirmation
	 */
	public function testSetAndCheckConfirmation($id)
	{
		$user = $this->um->get_by_id($id);
		$confirmation = $user->set_confirmation();
		$user->update();
		$this->assertEquals(strlen($confirmation),24);
		$this->assertEquals($user->status,User_model::STATUS_WAITING);

		$user = $this->um->check_confirmation($confirmation);
		$this->assertNotEmpty($user);
		$this->assertEquals($user->id,$id);
		$this->assertEquals($user->status,User_model::STATUS_ACTIVE);
	}
	
	// ------------------------------------------------------------------------
	/**
	 * @dataProvider GetUsers
	 * @covers User_model::get_by_id
	 * @covers User_model::encrypt_password
	 * @covers User_model::reset_password
	 */
	public function testResetPassword($id) {
		$user1 = $this->um->get_by_id($id);
		$previous_encrypt = $user1->password;
		$password = $user1->reset_password();
		$this->assertNotEmpty($password);
		$this->assertEquals(strlen($password),8);
		$user2 = $this->um->get_by_id($id);
		$this->assertNotEquals($previous_encrypt,$user2->password);
		$encrypt = $this->um->encrypt_password($password);
		$this->assertEquals($encrypt,$user2->password);
	}
	
	// ------------------------------------------------------------------------
		
}