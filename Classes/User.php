<?php

class User
{


    protected $id;
    protected $full_name;
    protected $email;
    protected $password;
    protected $role;

    private $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }



    // getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getFullName(): string
    {
        return $this->full_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    // setters

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setFullName(string $fullName): void
    {
        $this->full_name = $fullName;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }


    public function register(): bool{
        $isVisitor = 1;

        if($this->role == "admin"){
            return false;
        }
        else if($this->role == "guide"){
            $isVisitor = 0;
        }

        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
            return false;
        }

        

        $query = "INSERT INTO users(full_name,email,password,role,isBanned,isActive)
                VALUES(:fullname,:email,:password,:role,0,:isactive)";
        
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":fullname",$this->full_name);
        $stmt->bindParam(":email",$this->email);
        $stmt->bindParam(":password",$this->password);
        $stmt->bindParam(":role",$this->role);
        $stmt->bindParam(":isactive",$isVisitor);

        try{
            $stmt->execute();
            return true;

        }catch(PDOException $e){
            return false;
        }
        




        return true;
    }

    public function signin($email, $password)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location: ../../login.php?message=Invalid email format");
            exit();
        }

        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            header("location: ../../login.php?message=account not found");
            exit();
        }

        if (!password_verify($password, $user["password"])) {
            header("location: ../../login.php?message=password problem");
            exit();
        }

        if ($user["isBanned"] == 1) {
            header("location: ../../index.php?message=account_banned");
            exit();
        }

        session_start();
        $_SESSION["id"] = $user["id"];
        $_SESSION["role"] = $user["role"];
        $_SESSION["isActive"] = $user["isActive"];

        switch ($user["role"]) {
            case 'admin':
                header("location: ../../pages/admin/admin_dashboard.php");
                break;
            case 'guide':
                header("location: ../../pages/guide/guide_dashboard.php");
                break;
            default:
                header("location: ../../index.php");
        }
        exit();
    }


    public function getAllUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->pdo->connect()->query($query);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = count($users);

        return [
            'count' => $count,
            'users' => $users
        ];
    }
}
