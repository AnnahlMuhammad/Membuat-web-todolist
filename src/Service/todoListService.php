<?php 

namespace Service {

    use Entity\ProfileEntity;
    use Entity\TodolistEntity;
    use Repository\ProfileRepository;
    use Repository\TodolistRepository;
    interface TodolistService {
        public function addTodolist(string $todo):void;

        public function removeTodolist(string $todo):void;

        public function showTodolist():array;

        public function addData(string $email, string $password):void;

        public function cekData(string $data):bool;

        public function cekDataLogin(string $email, string $password):bool;

        public function cekGambar(string $profile);
    }

    class TodolistServiceImpl implements TodolistService{
        private TodolistRepository $todolistRepository;

        public function __construct(TodolistRepository $todolistRepository)
        {
            $this->todolistRepository = $todolistRepository;
        }

        public function addTodolist(string $todo): void
        {   
            $todo = new TodolistEntity($todo);
            $this->todolistRepository->save($todo);
        }

        public function removeTodolist(string $todo): void
        {
            if ($this->todolistRepository->remove($todo)){

            }   
            
        }

        public function showTodolist(): array
        {
            echo "TODOLIST" .PHP_EOL;
            $todolist = $this->todolistRepository->getAll();
            return $todolist;
        }

        public function addData(string $email = "", 
                                string $password = "",
                                string $birthday ="",
                                string $gender ="",
                                string $pekerjaan = "",
                                string $foto = ""): void
        {
            $data = new ProfileEntity($email, $password, $birthday, $gender, $pekerjaan, $foto);
            $this->todolistRepository->saveData($data);
        }

        public function cekData(string $data): bool
        {
            if ($this->todolistRepository->cekData($data)) {
                return true;
            } else {
                return false;
            }

        }

        public function cekDataLogin(string $email, string $password): bool
        {
            if($this->todolistRepository->cekDataLogin($email, $password)){
                return true;
            } else{
                return false;
            }
        }

        public function cekGambar(string $profile)
        {
           if ($this->todolistRepository->ambilGambar($profile)){
               
           }
        }
    }
}

?>