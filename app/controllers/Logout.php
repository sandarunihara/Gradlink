<?php
class Logout
{
	use Controller;

	public function index()
	{
		// Unset all session variables
		session_unset();

		// Destroy the session
		session_destroy();

		// Redirect to the 'home' page
		redirect('home');
	}
}
