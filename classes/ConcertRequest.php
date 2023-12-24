<?php

namespace app\classes;

use app\anchor\toolbox\Session;
use app\anchor\https\Validator;

require_once 'interfaces\classes\IConcertRequest.php';

class ConcertRequest implements IConcertRequest {
    protected ?int    $id;
    protected ?int    $user_id;
    protected ?string $name;
    protected ?string $date;
    protected ?string $place;

    /** constructor */
    function __construct(?array $data){
        if(!isset($data['delete'])){
            $this->validate($data);
        }
        $this->id      = $data['id']      ?? 0;
        $this->user_id = $data['user_id'] ?? 0;
        $this->name    = $data['name']    ?? '';
        $this->date    = $data['date']   ?? '';
        $this->place   = $data['place']   ?? '';
	}

    /** setter */
    public function setId($id){
        $this->id = $id;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function setPlace($place){
        $this->place = $place;
    }

    /** getter */
    public function getId(){
        return $this->id;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function getName(){
        return $this->name;
    }

    public function getDate(){
        return $this->date;
    }

    public function getPlace(){
        return $this->place;
    }

    public function getArrayData(){
        return [
            'id'      => $this->id,
            'user_id' => $this->user_id,
            'name'    => $this->name,
            'date'    => $this->date,
            'place'   => $this->place
        ];
    }

    /**
     * Validate POST data.
     * @param array $postData
     * @return $void
     */
    public function validate($targetData) {
        unset($_SESSION['errors']);
        $validator       = new Validator;
        $session         = new Session;

        $errors        = [];

        $date          = $targetData['date'];
        $name          = $targetData['name'];
        $place         = $targetData['place'];

        $validator->validateString($date,'date', true, 0, null);
        $validator->validateString($name,'name', true, 0, 100);
        $validator->validateString($place,'place', true, 0, 100);

        $errors = $validator->getErrors();

        if ($errors !== [] &&  count($errors) > 0) {
            $_SESSION['errors'] = $validator->getErrors();        
            $session->oldPostValue($targetData);
            if(!empty($targetData['id'])){
                $param =  !empty($targetData['id']) ? '?id='. $targetData['id'] : '';
                header('Location: /the-elephant-in-the-room/concert/update'.$param);
                exit();
            }else{
                header('Location: /the-elephant-in-the-room/concert/create');
                exit();
            }
        }
    }
}

?>