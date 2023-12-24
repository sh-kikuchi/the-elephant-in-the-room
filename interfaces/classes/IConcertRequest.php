<?php

namespace app\classes;

interface IConcertRequest {
    public function setId($id);
    public function setUserId($user_id);
    public function setName($name);
    public function setDate($date);
    public function setPlace($place);

    public function getId();
    public function getUserId();
    public function getName();
    public function getDate();
    public function getPlace();

    public function getArrayData();

    public function validate($data);
}
