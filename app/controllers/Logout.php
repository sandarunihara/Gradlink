<?php
class Logout
{
	use Controller;

	public function index()
	{
		// Unset all session variables
		unset($_SESSION['USER']);

		// Destroy the session
		//session_destroy();

		// Redirect to the 'home' page
		redirect('home');
	}
}
