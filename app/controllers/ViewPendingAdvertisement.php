<?php
class ViewPendingAdvertisement
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");
        $this->view('Coordinator/Advertisement/viewPendingAdvertisement');
    }
}
