<?php

class AdminController extends BaseController {

    // Filters
    public function __construct() {
        // only Admin have access
        $this->beforeFilter('admin');
    }

    public function getIndex() {
        return View::make('admin');
    }
}