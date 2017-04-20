<?php
class User extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('challenges_model');
		$this->load->model('user_model');
		$this->load->helper('url_helper');
		$this->config->load('navigation_bar');
		$this->load->config('email');
		$this->load->helper('string');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->helper('email');
		$this->load->helper('url');
		$this->load->language("error");
	}


	public function check_username($username)
	{
		if (strlen($username) > 16 || strlen($username) < 4) {
			return false;
		}
		if(preg_match("/[\',.:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$username)){ 
			// echo "请不要在用户名中包含符号 , 只有英文字母和数字是被允许的";
			return false;
		}
		return true;
	}

	public function check_password($password)
	{
		if (strlen($password) > 16 || strlen($password) < 6) {
			// echo "password <= 16 chars >=6";
			return false;
		}
		// because the password is hashed before insert to db, so the following check is not necessary
		// if(preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$password)){ 
		//     return false;
		// }
		return true;
	}

	public function check_college($college)
	{
		if (strlen($college) > 64) {
			return false;
		}
		return true;
	}

	public function check_email($email)
	{
		return valid_email($email);
	}

	public function verify_captcha($captcha)
	{
		// First, delete old captchas
		$expiration = time() - 7200; // Two hour limit
		$this->db->where('captcha_time < ', $expiration)
			->delete('captcha');

		// Then see if a captcha exists:
		$sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
		$binds = array($captcha, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();

		if ($row->count > 0)
		{
			return true;
		}else{
			return false;
		}
	}


	private function getEncryptedPassword($passord, $salt)
	{
		return md5(md5($passord.$salt));
	}

	public function do_login($username, $password)
	{
		if($this->user_model->get_userID($username) == NULL){
			// user is not existed
			return false;
		}else {
			$userID = $this->user_model->get_userID($username);
			$current_password = $this->user_model->get_password($userID);
			$salt = $this->user_model->get_salt($userID);
			return ($this->getEncryptedPassword($password, $salt) === $current_password);
		}
	}


	public function is_username_not_exist($username)
	{
		return !($this->user_model->is_username_exist($username));
	}

	public function is_email_not_exist($email)
	{
		return !($this->user_model->is_email_exist($email));
	}

	public function send_active_code($active_code, $reciver_email)
	{
		$this->email->from('admin@sniperoj.cn', 'admin');
		$this->email->to($reciver_email);
		$this->email->subject('[No Reply] Sniper OJ Register Email');
		$this->email->message("Thank you for registering this website!\nyou can activate your account by visiting the following link, which is valid for 2 hours.\nYour active code : http://www.sniperoj.cn/user/active/".$active_code."\n");
		if($this->email->send()==1){ 
			return true;
		}else{ 
			return false;
		} 
	}


	public function send_reset_code($active_code, $reciver_email)
	{
		$this->email->from('admin@sniperoj.cn', 'admin');
		$this->email->to($reciver_email);
		$this->email->subject('[No Reply] Sniper OJ Reset Password Email');
		$this->email->message("you can reset your password by visiting the following link, which is valid for 2 hours.\nYour active code : http://www.sniperoj.cn/user/verify/".$active_code."\n");
		if($this->email->send()==1){ 
			return true;
		}else{ 
			return false;
		} 
	}


	public function do_register($username, $password, $email, $college)
	{
		$salt = random_string('alnum', 16);
		$time = time();
		$token_alive_time = $time + $this->config->item('sess_expiration');
		$token = md5($username.$time);

		$data = array(
			'username' => $username,
			'salt' => $salt,
			'password' => $this->getEncryptedPassword($password,$salt),
			'score' => 0,
			'college' => $college,
			'email' => $email,
			'registe_time' => time(),
			'registe_ip' => $this->input->ip_address(),
			'token' => $token,
			'token_alive_time' => $token_alive_time,
			'usertype' => 0,
			'verified' => 0,
		);
		if($this->db->insert('users', $data) && $this->send_active_code($token, $email)){
			return true;
		}else{
			return false;
		}
	}

	public function do_active($active_code)
	{
		// TODO create a table to save active_code
		if (strlen($active_code) < 0){
			return false;
		}

		$query = $this->db->get_where('users', array('token' => $active_code));

		$result_count = $query->result();
		if ($query->num_rows() === 1){
			// clear token , wait for user login
			$data = array(
				'verified' => '1',
				'token' => '',
				// 'token_alive_time' => 0, // is it safe ??? 
			);
			$this->db->where('token', $active_code);
			$this->db->update('users', $data);
			return true;
		}else{
			return false;
		}
	}

	public function is_overdue($token_alive_time)
	{
		$now_time = time();

		if ($now_time > $token_alive_time) {
			return true;
		}else{
			return false;
		}


	}

	// is logined
	public function is_logined()
	{
		// is set in session
		if ($this->session->userID == NULL){
			return false;
		}else{
			// is overdue
			$userID = $this->session->userID;
			$token_alive_time = $this->user_model->get_token_alive_time($userID);

			if ($this->is_overdue($token_alive_time)){
				return false;
			}else{
				return true;
			}
		}
	}

	// check whether the account is verified
	public function check_verified($username)
	{
		if($this->user_model->get_userID($username) == NULL){
			// user is not existed
			return false;
		}else {
			$userID = $this->user_model->get_userID($username);
			if ($this->user_model->get_verified($userID) === 1){
				return true;
			}else{
				return false;
			}
		}
	}


	public function login()
	{
		if($this->is_logined()){
			// login success
			$this->load->view('templates/header');
			$this->load->view('navigation_bar/navigation_bar_user');
			$this->load->view('user/profile');
			$this->load->view('templates/footer');
		}else{
			$this->load->helper('form');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('captcha', 'Captcha', 'required');

			if ($this->form_validation->run() === FALSE)
			{
				// get form data failed
				$this->load->view('templates/header');
				$this->load->view('navigation_bar/navigation_bar_visitor');
				$this->load->view('user/login');
				$this->load->view('templates/footer');
			}
			else
			{
				// get form data success
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$captcha = $this->input->post('captcha');
				$userID = $this->user_model->get_userID($username);
				$token_alive_time = $this->user_model->get_token_alive_time($userID);

				if ($this->verify_captcha($captcha)){
					// verify captcha success
					if ($this->check_username($username)){
						if ($this->check_password($password)){
							if($this->do_login($username, $password)){
								if($this->check_verified($username)){
									// login success
									// $this->load->view('templates/header',  array('navigation_bar' => $this->config->item('navigation_bar_user')));
									// $this->load->view('notice/view', array('type' => 'error', 'message' => 'Login success'));
									// $this->load->view('user/profile');
									// $this->load->view('templates/footer');
									// set session
									$this->user_model->set_session($username);
									// update db token_alive_time
									$this->user_model->set_token_alive_time($userID, time() + $this->config->item('sess_expiration'));
									redirect("/user/profile");
								}else{
									// Account have not verified
									$this->load->view('templates/header');
									$this->load->view('navigation_bar/navigation_bar_visitor');
									$this->load->view('notice/view', array('type' => 'error', 'message' => '请激活您的账号!'));
									$this->load->view('user/login');
									$this->load->view('templates/footer');
								}
							}else{
								// login failed, must be password error!
								$this->load->view('templates/header');
								$this->load->view('navigation_bar/navigation_bar_visitor');
								// $this->load->view('notice/view', array('type' => 'error', 'message' => '登录失败!'));
								$this->load->view('notice/view', array('type' => 'error', 'message' => 
									$this->lang->line('LOGIN_FAILED')));
								$this->load->view('user/login');
								$this->load->view('templates/footer');
							}
						}else{
							// password illegal
							$this->load->view('templates/header');
							$this->load->view('navigation_bar/navigation_bar_visitor');
							$this->load->view('notice/view', array('type' => 'error', 'message' => '密码长度必须大于等于 6 小于等于 16 个字符'));
							$this->load->view('user/login');
							$this->load->view('templates/footer');
						}
					}else{
						// username illegal
						$this->load->view('templates/header');
						$this->load->view('navigation_bar/navigation_bar_visitor');
						$this->load->view('notice/view', array('type' => 'error', 'message' => '用户名只可以是字母和数字的组合 , 请不要在用户名中使用符号! 长度大于等于 4 字符 , 小于等于 16 个字符'));
						$this->load->view('user/login');
						$this->load->view('templates/footer');
					}
				}else{
					// verify captcha failed
					$this->load->view('templates/header');
					$this->load->view('navigation_bar/navigation_bar_visitor');
						$this->load->view('notice/view', array('type' => 'error', 'message' => '验证码错误!'));
					$this->load->view('user/login');
					$this->load->view('templates/footer');
				}
			}
		}
	}



	public function register()
	{

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required'); // 不直接使用CI自带的验证(因为无法结果错误信息并沉浸式提示用户)
		$this->form_validation->set_rules('captcha', 'Captcha', 'required');


		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header');
			$this->load->view('navigation_bar/navigation_bar_visitor');
			$this->load->view('user/register');
			$this->load->view('templates/footer');
		}
		else
		{
			// get form data success
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$email = $this->input->post('email');
			$college = $this->input->post('college');
			$captcha = $this->input->post('captcha');

			if ($this->verify_captcha($captcha)){
				// verify captcha success
				if ($this->check_username($username)){
					if ($this->check_password($password)){
						if ($this->check_college($college)){
							if ($this->check_email($email)){
								if ($this->is_username_not_exist($username)){
									if ($this->is_email_not_exist($email)){
										if($this->do_register($username, $password, $email, $college)){
											// register success
											$this->load->view('templates/header');
											$this->load->view('navigation_bar/navigation_bar_visitor');
											$this->load->view('notice/view', array('type' => 'success', 'message' => 'Register success! Please check your mailbox to verify your account!'));
											$this->load->view('user/login'); // jump to login or profile ?
											// no , user must verify his/her account at first
											$this->load->view('templates/footer');
										}else{
											// register failed
											$this->load->view('templates/header');
											$this->load->view('navigation_bar/navigation_bar_visitor');
											$this->load->view('notice/view', array('type' => 'error', 'message' => 'Register failed! Please contact : admin@sniperoj.cn'));
											$this->load->view('user/register');
											$this->load->view('templates/footer');
										}
									}else{
										// User existed!
										$this->load->view('templates/header');
										$this->load->view('navigation_bar/navigation_bar_visitor');
										$this->load->view('notice/view', array('type' => 'error', 'message' => 'Email has been used!'));
										$this->load->view('user/register');
										$this->load->view('templates/footer');
									}
								}else{
									// User existed!
									$this->load->view('templates/header');
									$this->load->view('navigation_bar/navigation_bar_visitor');
									$this->load->view('notice/view', array('type' => 'error', 'message' => 'Username has been used!'));
									$this->load->view('user/register');
									$this->load->view('templates/footer');
								}
							}else{
								// Email illegal
								$this->load->view('templates/header');
								$this->load->view('navigation_bar/navigation_bar_visitor');
								$this->load->view('notice/view', array('type' => 'error', 'message' => 'Email illegal!'));
								$this->load->view('user/register');
								$this->load->view('templates/footer');
							}
						}else{
							// College illegal
							$this->load->view('templates/header');
							$this->load->view('navigation_bar/navigation_bar_visitor');
							$this->load->view('notice/view', array('type' => 'error', 'message' => 'College length < 64!'));
							$this->load->view('user/register');
							$this->load->view('templates/footer');
						}
					}else{
						// password illegal
						$this->load->view('templates/header');
						$this->load->view('navigation_bar/navigation_bar_visitor');
						$this->load->view('notice/view', array('type' => 'error', 'message' => '密码长度必须大于等于 6 小于等于 16 个字符'));
						$this->load->view('user/register');
						$this->load->view('templates/footer');
					}
				}else{
					// username illegal
					$this->load->view('templates/header');
					$this->load->view('navigation_bar/navigation_bar_visitor');
					$this->load->view('notice/view', array('type' => 'error', 'message' => '用户名只可以是字母和数字的组合 , 请不要在用户名中使用符号! 长度大于等于 4 字符 , 小于等于 16 个字符'));
					$this->load->view('user/register');
					$this->load->view('templates/footer');
				}
			}else{
				// verify captcha failed
				$this->load->view('templates/header');
				$this->load->view('navigation_bar/navigation_bar_visitor');
					$this->load->view('notice/view', array('type' => 'error', 'message' => 'Captcha error!'));
				$this->load->view('user/register');
				$this->load->view('templates/footer');
			}
		}
	}

	public function active()
	{
		// ??? safe ???
		$active_code = $this->uri->segment(3);
		$userID = $this->user_model->get_userID_by_token($active_code);
		$username = $this->user_model->get_username($userID);
		$time = time();
		$token_alive_time = $time + $this->config->item('sess_expiration');

		if($this->do_active($active_code)){
			$this->user_model->set_session($username);
			// update db token_alive_time
			$this->user_model->set_token_alive_time($userID, $time + $this->config->item('sess_expiration'));
			redirect("/user/profile");
		}else{
			// active failed
			$this->load->view('templates/header');
			$this->load->view('navigation_bar/navigation_bar_visitor');
			$this->load->view('notice/view', array('type' => 'error', 'message' => '激活失败!'));
			$this->load->view('user/login');
			$this->load->view('templates/footer');
		}
	}

	public function profile()
	{
		if($this->is_logined()){
			$userID = $this->session->userID;
			$submit_log = $this->user_model->get_user_submit_log($userID);
			for ($i=0; $i < count($submit_log); $i++) { 
				$challengeID = $submit_log[$i]["challengeID"];
				$submit_log[$i]["challengeName"] = $this->challenges_model->get_challenge_name($challengeID);
			}
			$user_data = array(
				'user_data' => $this->user_model->get_user_data($userID),
				'submit_log' => $submit_log,
			);
									$this->load->view('templates/header');
						$this->load->view('navigation_bar/navigation_bar_user');
			$this->load->view('user/profile', $user_data);
			$this->load->view('templates/footer');
		}else{
			$this->session->sess_destroy();
			redirect("/");
		}
	}

	public function get_all_score(){
		$data = array('scores' => $this->user_model->get_all_score());
		return $data;
	}

	public function score()
	{
		if($this->is_logined()){
			$score_data = $this->get_all_score();
			$this->load->view('templates/header');
			$this->load->view('navigation_bar/navigation_bar_user');
			$this->load->view('user/score', $score_data);
			$this->load->view('templates/footer');
		}else{
			$this->session->sess_destroy();
			redirect("/");
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect("/");
	}

	public function dump_session()
	{
		foreach ($this->session as $key => $value) {
			var_dump($key);
			echo "->";
			var_dump($value);
			echo "<br>\n";
		}
		die();
	}


	/* 忘记密码 */
	public function forget_password()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('captcha', 'Captcha', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			// get form data failed
			$this->load->view('templates/header');
			$this->load->view('navigation_bar/navigation_bar_visitor');
			$this->load->view('notice/view', array('type' => 'error', 'message' => 'Please input all fileds!'));
			$this->load->view('user/forget');
			$this->load->view('templates/footer');
		}else{
			$captcha = $this->input->post('captcha');
			$email = $this->input->post('email');

			// get form data success
			if($this->verify_captcha($captcha)){
				if ($this->check_email($email)){
					if($this->user_model->is_email_exist($email)){
						if($this->do_forget_password($email)){
							// load reset password view
							$this->load->view('templates/header');
							$this->load->view('navigation_bar/navigation_bar_visitor');
							$this->load->view('notice/view', array('type' => 'error', 'message' => 'Send reset code success! Please check your email box!'));
							$this->load->view('user/login');
							$this->load->view('templates/footer');
						}else{
							// reset error
							$this->load->view('templates/header');
							$this->load->view('navigation_bar/navigation_bar_visitor');
							$this->load->view('notice/view', array('type' => 'error', 'message' => 'System error! Please contact with admin@sniperoj.cn'));
							$this->load->view('user/forget');
							$this->load->view('templates/footer');
						}
					}else{
						// Email not existed
						$this->load->view('templates/header');
						$this->load->view('navigation_bar/navigation_bar_visitor');
						$this->load->view('notice/view', array('type' => 'error', 'message' => 'Email not exist!'));
						$this->load->view('user/forget');
						$this->load->view('templates/footer');
					}
				}else{
					// Email illegal
					$this->load->view('templates/header');
					$this->load->view('navigation_bar/navigation_bar_visitor');
					$this->load->view('notice/view', array('type' => 'error', 'message' => 'Email illegal!'));
					$this->load->view('user/register');
					$this->load->view('templates/footer');
				}
			}else{
				// verify captcha failed
				$this->load->view('templates/header');
				$this->load->view('navigation_bar/navigation_bar_visitor');
					$this->load->view('notice/view', array('type' => 'error', 'message' => 'Captcha error!'));
				$this->load->view('user/forget');
				$this->load->view('templates/footer');
			}
		}
	}

	public function get_encrypted_reset_code($email, $salt)
	{
		return md5(md5($email.$salt));
	}

	public function do_forget_password($email)
	{
		$time = time();

		$userID = $this->user_model->get_userID_by_email($email);

		$salt = random_string('alnum', 16);
		$reset_code = $this->get_encrypted_reset_code($email, $salt);
		$reset_code_alive_time = $time + $this->config->item('sess_expiration');

		$data = array(
			'userID' => $userID,
			'email' => $email,
			'salt' => $salt,
			'reset_code' => $reset_code,
			'reset_code_alive_time' => $reset_code_alive_time,
			'verified' => 0,
		);
		
		if($this->db->insert('reset_password', $data) && $this->send_reset_code($reset_code, $email)){
			return true;
		}else{
			return false;
		}
	}

	public function verify_reset_code()
	{
		$reset_code = $this->uri->segment(3);
		$time = time();
		if($this->user_model->is_reset_code_exist($reset_code)){
			$reset_code_item = $this->user_model->get_reset_code_code_item($reset_code);

			$salt = $reset_code_item['salt'];
			$email = $reset_code_item['email'];
			$current_reset_code = $reset_code_item['reset_code'];
			$reset_code_alive_time = intval($reset_code_item['reset_code_alive_time']);

			if (!$this->is_overdue($reset_code_alive_time)){
				// reset code current
				// jump to reset code
            	$this->load->helper('form');

				$data = array('reset_code' => $reset_code,);
				$this->load->view('templates/header');
				$this->load->view('navigation_bar/navigation_bar_visitor');
				$this->load->view('user/reset', $data);
				$this->load->view('templates/footer');
			}else{
				// reset code overdue
				$this->load->view('templates/header');
				$this->load->view('navigation_bar/navigation_bar_visitor');
				$this->load->view('notice/view', array('type' => 'error', 'message' => 'Reset code overdue!'));
				$this->load->view('user/login');
				$this->load->view('templates/footer');
			}
		}else{
			// reset code not exist
			$this->load->view('templates/header');
			$this->load->view('navigation_bar/navigation_bar_visitor');
				$this->load->view('notice/view', array('type' => 'error', 'message' => 'Reset code error!'));
			$this->load->view('user/login');
			$this->load->view('templates/footer');
		}
	}

	public function reset_password()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('reset_code', 'Reset code', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			// 用户体验???
			$this->load->view('templates/header');
			$this->load->view('navigation_bar/navigation_bar_visitor');
			$this->load->view('notice/view', array('type' => 'error', 'message' => 'Please input all fileds!'));
			$this->load->view('user/reset', array('reset_code' => 'NULL', ));
			$this->load->view('templates/footer');
		}
		else
		{
			// get form data success
			$new_password = $this->input->post('password');
			$reset_code = $this->input->post('reset_code');

			if($this->user_model->is_reset_code_exist($reset_code)){
				$new_salt = random_string('alnum', 16);
				$userID = $this->user_model->get_userID_by_reset_code($reset_code);
				$username = $this->user_model->get_username($userID);
				if ($this->check_password($new_password)){
					if ($this->do_reset_password($userID, $new_password, $new_salt)){
						// jmp to user profile
						$this->user_model->set_session($username);
						// update db token_alive_time
						$this->user_model->set_token_alive_time($userID, time() + $this->config->item('sess_expiration'));
						$this->destroy_reset_code($reset_code);
						redirect("/user/profile");
					}else{
						// reset code not exist
						$this->load->view('templates/header');
						$this->load->view('navigation_bar/navigation_bar_visitor');
							$this->load->view('notice/view', array('type' => 'error', 'message' => 'Reset password error!'));
						$this->load->view('user/login');
						$this->load->view('templates/footer');
					}
				}else{
					// password illegal
					$this->load->view('templates/header');
					$this->load->view('navigation_bar/navigation_bar_visitor');
					$this->load->view('notice/view', array('type' => 'error', 'message' => '密码长度必须大于等于 6 小于等于 16 个字符'));
					$this->load->view('user/register');
					$this->load->view('templates/footer');
				}
			}else{
				// reset code not exist
				redirect("/user/login");
			}
		}
	}

	public function do_reset_password($userID, $new_password, $new_salt)
	{
		$encrypted_password = $this->getEncryptedPassword($new_password, $new_salt);
		$data = array(
			'password' => $encrypted_password,
			'salt' => $new_salt,
		);
		$this->db->set($data);
		$this->db->where('userID', $userID);
		if ($this->db->update('users')){
			return true;
		}else{
			return false;
		}
	}

	public function destroy_reset_code($reset_code)
	{
		$this->user_model->destroy_reset_code($reset_code);
	}


	// public function do_update_user_info($userID, $user_info)
	// {

	// 	$this->db->where('userID', $userID);
	// 	$this->db->update('users', $user_info);
	// }


	// public function update_user_info()
	// {
	// 	$this->load->helper('form');
	// 	$this->load->library('form_validation');

	// 	$this->form_validation->set_rules('password', 'Password', 'required');
	// 	$this->form_validation->set_rules('reset_code', 'Reset code', 'required');

	// 	if ($this->form_validation->run() === FALSE)
	// 	{
	// 		// 用户体验???
	// 		$this->load->view('templates/header');
	// 		$this->load->view('navigation_bar/navigation_bar_visitor');
	// 		$this->load->view('notice/view', array('type' => 'error', 'message' => 'Please input all fileds!'));
	// 		$this->load->view('user/reset', array('reset_code' => 'NULL', ));
	// 		$this->load->view('templates/footer');
	// 	}
	// 	else
	// 	{

	// 		$user_info = array(
	// 			'verified' => '1',
	// 			'token' => '',
	// 		);

	// 	}



	// }
}
