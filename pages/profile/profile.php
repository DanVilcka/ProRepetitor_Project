<?php
    require_once("content.php");
    require_once("edit.php");
    session_start();

    $id = $_SESSION['id'];
    $login = $_SESSION['login'];
    $password = $_SESSION['password'];
    $class = $_SESSION['class'];
    $status = $_SESSION['status'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $phone = $_SESSION['phone'];
    $skype = $_SESSION['skype'];
    if(empty($skype)){
        $skype = 'Введите ссылку на ваш skype';
    }
    $name = $first_name . " " . $last_name;
    if($class == 1){
        $class = ' ';
    }

    if(isset($_POST['newVal'])){
            if(update_info()){
                session_unset();
                getoptions($id);
                exit("Данные сохранены");
            } else {
                exit("Ошибка сохранения");
            }
            exit;
        }

    if ($status==2) {
?>

        <head>
            <title> Profile </title>
            <link rel='stylesheet' href='/style.css'/>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="index.js"></script>
        </head>

        <body>

        <div class="horizontal_stack">
            <div class="icon">
                <figure><img src='users.png'  alt='Ученик' ></figure>
            </div>
            <div class="info" >
                    <h3 style="text-align: center; border: 3px solid black; border-radius: 20px"> Ученик </h3>
                    <p contenteditable="" id="name_id" > <?php echo $_SESSION['first_name']. ' '. $_SESSION['last_name']?></p>
                    <p contenteditable="" id="class_id"> <?php echo $_SESSION['class']?> Класс </p>
                    <p contenteditable="" id="phone_id"> <?php echo $_SESSION['phone']?></p>
                    <p contenteditable="" id="skype_id"> <?php echo $skype?> </p>
            </div>
        </div>
        <script>
            let id = "<?php echo $id; ?>";
        </script>
        </body>



<?php
    } elseif ($status==1) {

?>

        <head>
            <title> Profile </title>
            <link rel='stylesheet' href='/style.css'/>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="index.js"></script>
        </head>

        <body>

        <div class="horizontal stack">
            <div class="icon">
                <figure><img src='teacher.png'  alt='Репетитор'></figure>
            </div>
            <div class="info" >
                <h3 style="text-align: center; border: 3px solid black; border-radius: 20px"> Учитель </h3>
                <p contenteditable="" id="name_id" >  <?php echo $_SESSION['first_name'],' ',$_SESSION['last_name']?> </p>
                <p contenteditable="" id="class_id"> Предметы: <?php echo $class?></p>
                <p contenteditable="" id="phone_id"> <?php echo $_SESSION['phone']?></p>
                <p contenteditable="" id="skype_id"> <?php echo $skype?> </p>
            </div>
        </div>
        <script>
            let id = "<?php echo $id; ?>";
        </script>

        </body>

<?php
    }
?>