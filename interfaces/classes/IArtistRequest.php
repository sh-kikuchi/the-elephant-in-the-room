<?php

namespace app\classes;

interface IArtistRequest {
    public function setId($id);
    public function setUserId($user_id);
    public function setName($name);
    public function setDebut($debut);
    public function setStartDate($start_date);
    public function setEndDate($end_date);

    public function getId();
    public function getUserId();
    public function getName();
    public function getDebut();
    public function getStartDate();
    public function getEndDate();

    public function getArrayData();

    public function validate($data);
    public function searchConcertData();
}
