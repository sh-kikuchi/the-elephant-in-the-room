<?php

namespace app\services;

interface IArtistConcerService {
    public function index();
    public function read_create_form();
    public function create();
    public function delete();
}
