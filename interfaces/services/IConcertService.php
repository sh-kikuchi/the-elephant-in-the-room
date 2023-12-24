<?php

namespace app\services;

interface IConcertService {
    public function index();
    public function read_create_form();
    public function read_update_form();
    public function create();
    public function update();
    public function delete();
}