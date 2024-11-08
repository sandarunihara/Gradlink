<?php
class pendingAdvertisementList
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");
        $this->view('Coordinator/Advertisement/pendingAdvertisementList');
    }
}
