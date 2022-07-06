<?php 

namespace Entity {

    class TodolistEntity {
        private int $id;

        private string $todolist;



        public function __construct(string $todolist = ""){
            $this->todolist = $todolist;
        }

        public function setTodolist(string $todo):void{
            $this->todolist = $todo;
        }

        public function getTodolist():string{
            return $this->todolist;
        }

        public function setid(int $id):void{
            $this->id = $id;
        }
    
        public function getid():string{
            return $this->id;
        }
        
        }

        class ProfileEntity{
        private string $email;

        private string $password;
        
        private string $birthday;

        private string $gender;
        
        private string $pekerjaan;
        
        private string $foto;

        public function __construct(string $email = "", 
                                    string $password = "",
                                    string $birthday ="",
                                    string $gender ="",
                                    string $pekerjaan = "",
                                    string $foto = "")
        {
            $this->email = $email;
            $this->password = $password;
            $this->birthday = $birthday;
            $this->gender = $gender;
            $this->pekerjaan = $pekerjaan;
            $this->foto = $foto;
        }

        public function setPassword(string $password):void{
            $this->password = $password;
        }
    
        public function getPassword():string{
            return $this->password;
        }
        public function setEmail(string $email):void{
            $this->email = $email;
        }
    
        public function getEmail():string{
            return $this->email;
        }

        public function setBirthday(string $birthday):void{
            $this->birthday = $birthday;
        }
    
        public function getBirthday():string{
            return $this->birthday;
        }

        public function setGender(string $gender):void{
            $this->gender = $gender;
        }
    
        public function getGender():string{
            return $this->gender;
        }

        public function setPekerjaan(string $pekerjaan):void{
            $this->pekerjaan = $pekerjaan;
        }
    
        public function getPekerjaan():string{
            return $this->pekerjaan;
        }

        public function setFoto(string $foto):void{
            $this->foto = $foto;
        }
    
        public function getFoto():string{
            return $this->foto;
        }
}

    
}



?>