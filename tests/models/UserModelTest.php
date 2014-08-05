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
	private $uim;
	private $users;
	private $user_identities;
	
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
	 * Global Providers
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
		$res = $user->update();
		$this->assertTrue($res,'Checking user update');
		$this->assertEquals(strlen($confirmation),24);
		$this->assertEquals($user->status,User_model::STATUS_WAITING);

		$user = $this->um->check_confirmation($confirmation);
		$this->assertNotFalse($user);
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
	/**
	 * @dataProvider GetNewUser
	 */
	public function testInsert_NewIdentity($email,$password,$name) {
		$user = $this->um->get_by_email($email);
		$this->assertEmpty($user);

		$user2 = new User_model();
		$user2->um->email = $email;
		$user2->um->password = $password;
		$res = $user2->um->insert();
		$this->assertNotEmpty($res);
	}
	
	/**
	 * @dataProvider GetNewUserExistingEmail
	 */
	public function testInsert_ExistingEmail($email,$password,$name) {
		$user = $this->um->get_by_email($email);
		$this->assertNotEmpty($user);
		
		$user2 = new User_model();
		$user2->um->email = $email;
		$user2->um->password = $password;
		$res = $user2->um->insert();
		$this->assertFalse($res);
	}
	
	public function GetNewUser() {
		$res = array();
		for ($i=0; $i < 4; $i++) { 
			$name = $this->makename();
			$email = (is_null($name))?'unknow':strtolower($name);
			$res[] = array($email.'@thde.pro',$this->makepassword(),$name);
		}
		return $res;
	}
	
	public function GetNewUserExistingEmail() {
		$res = array();
		foreach ($this->users as $user) {
			$res[] = array($user['email'],$this->makepassword(),$this->makename());
		}	
		return $res;
	}
	
	
	protected function makepassword() {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    	return substr(str_shuffle($chars),0,8);
	}
	
	protected function makename() {
		$names = array(NULL,'Jules','Ann','Carolina','Joe','Yvette','Leonardo','Julien','Esteban','John','Luke');
		$k = array_rand($names);
		return $names[$k];
	}
	
	
	
	
	
	
}