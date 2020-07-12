<?php
    if(isset($_POST['submit'])){
        $serverName = $_POST['serverName'];
        $userName = $_POST['userName'];
        $password = $_POST['password'];

        if($password == ''){
            $password = 'null';
        }

        $setupData = $serverName." ".$userName." ".$password." ";

        if(file_exists('setup.txt')){
            file_put_contents('setup.txt', $setupData);
            echo "<script>window.location.href = 'createDB.php'</script>";
        }else{
            $setupFile = fopen('setup.txt', 'w') or die("Something Went Wrong");
            fwrite($setupFile, $setupData);
            fclose($setupFile);
            echo "<script>window.location.href = 'createDB.php'</script>";
        }
        

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Setup</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font.css">
    <link rel="stylesheet" href="assets/css/primary.css">
    <!-- <link rel="stylesheet" href="assets/css/secondary.css"> -->

    <style>
       
    </style>
</head>
<body>
    
    <section id="setup_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form action="setup.php" method="POST" class="form-group">
                        <h1 class="text-info mt-3 mb-3">Setup Connection</h1>
                        <label for="serverName">Server Name : </label>
                        <input type="text" name='serverName' placeholder="Enter Server Name" class="form-control mb-3" autocomplete="off" required>
                        <label for="userName">User Name : </label>
                        <input type="text" name='userName' placeholder="Enter User Name" class="form-control mb-3" autocomplete="off" required>
                        <label for="password">Password : </label>
                        <input type="password" name='password' placeholder="If Password Is Not Set Leave It Blank" class="form-control" autocomplete="off">
                        <input type="submit" name='submit' value="Continue" class="btn btn-outline-dark mt-4">
                    </form>
                </div>
            </div>
        </div>
    </section>


     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="assets/script/jquery-3.5.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
     <script src="assets/script/bootstrap.min.js"></script>
     <script src="assets/script/primary.js"></script>
     <!-- <script src="assets/script/secondary.js"></script> -->

     <script>

     </script>
</body>
</html>