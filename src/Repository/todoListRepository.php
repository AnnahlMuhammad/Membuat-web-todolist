<?php 

namespace Repository{

    use Entity\ProfileEntity;
    use Entity\TodolistEntity;
    use PDO;

    interface TodolistRepository{
        public function save(TodolistEntity $todo):void;

        public function remove (string $todo):bool;

        public function getAll():array;

        public function saveData(profileEntity $data):void;

        public function cekData (string $data):bool;
        
        public function cekDataLogin (string $email, string $password):bool;
        
        public function ambilGambar(string $namaGambar);

        // public function findProfile(string $person);
    }

    class TodolistRepositoryImpl implements TodolistRepository{
        private PDO $connection;

        public function __construct(PDO $connection)
        {
            $this->connection = $connection;
        }

        public function save(TodolistEntity $todo): void
        { 
            $sql = "INSERT INTO todolist (todo) VALUES (?)";
            $statement= $this->connection->prepare($sql);
            $statement->execute([$todo->getTodoList()]);    
        }

        public function remove(string $todo): bool
        {
            $sql = "SELECT * FROM todolist WHERE todo=?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$todo]);
            $row = $statement->fetch();

            if ($row){
                $sql = "DELETE FROM todolist WHERE todo=?";
                $statement = $this->connection->prepare($sql);
                $statement->execute([$todo]);
                return true;
            } else {
                echo "Gagal menghapus todolist".PHP_EOL;
                return false;
            }

            
            
        }

        public function getAll(): array
        {
            $data = [];

            $sql = "SELECT id, todo from todolist";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            foreach ($statement as $row){
                $todolist = new TodolistEntity();
                $todolist->setid($row["id"]);
                $todolist->setTodolist($row["todo"]);

                $data[] = $todolist;
            }
            return $data;
        }

        public function saveData(ProfileEntity $data): void
        {
            $sql = "INSERT INTO dataprofile (email, password, birthday, gender, profesi, image) VALUES (?,?,?,?,?,?)";
            $statement= $this->connection->prepare($sql);
            $statement->execute([$data->getEmail(), $data->getPassword(), $data->getBirthday(), $data->getGender(), $data->getPekerjaan(), $data->getFoto()]); 
        }

        public function cekData(string $data): bool
        {
            $sql = "SELECT email FROM dataprofile WHERE email=?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$data]);
            $row = $statement->fetch();

            if ($row){
                return true;
            } else {
                return false;
            }
        }

        public function cekDataLogin(string $email, string $password): bool
        {
            $sql = "SELECT email, password FROM dataprofile WHERE email=? AND password=?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$email, $password]);
            $row = $statement->fetch();

            if ($row){
                return true;
            } else {
                return false;
            }
        }

        public function ambilGambar(string $profile)
        {
            $sql = "SELECT image FROM dataprofile WHERE email=?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$profile]);
            $row = $statement->fetch();
            

            if($row){
                return $row["image"];
            } else {
                return false;
            }

        }

        // public function findProfile(string $person)
        // {
        //     $sql = "SELECT email FROM dataprofile WHERE email=?";
        //     $statement = $this->connection->prepare($sql);
        //     $statement->execute([$person]);
        //     $row = $statement->fetch();

        //     if ($row){
        //         return $row['email'];
        //     }

        // }
    }



}

?>