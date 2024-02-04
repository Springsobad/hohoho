<?php
include_once "./User.php";
$id = null;
$user = null;
if ($_GET['id']) {
    $id = $_GET['id'];
    $user =  User::find($id);
    var_dump($user);

    //var_dump($id);
} else {
    header(header: "location:./index.php");
}
$errors = [];



// Hàm xử lý edit
if (isset($_POST['edit'])) {
    $errors = validate($_POST, ['id', 'name', 'email', 'gender', 'password']);
    if (count($errors) <= 0) {
        $dataUpdate = [
            'id' => $_POST['id'],
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'gender' => $_POST['gender'],
            'password' => md5($_POST['password'])
        ];
        //var_dump($dataUpdate);
        $user = User::update($dataUpdate);
        $_SESSION['message'] = "Update success";
        $errors = [];
        header(header: "location:./index.php");
        //var_dump($user); //In ra thông tin của 1 hay nhiều biến (ra a[0] {} ở đầu dòng)
    }
} else {
    $errors = [];
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Create</title>
</head>

<body>
    <div class="container">
        <div>
            <h1>Edit User</h1>
        </div>
        <div>
            <form method="post">

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">ID</label>
                    <input type="text" name="id" value="<?= $user['id'] ?>" class="form-control">
                    <div class="text-danger">
                        <?php echo isset($errors['id']) ? $errors['id'] : "" ?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Name</label>
                        <input type="text" name="name" value="<?= $user['name'] ?>" class="form-control">
                        <div class="text-danger">
                            <?php echo isset($errors['name']) ? $errors['name'] : "" ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" value="<?= $user['email'] ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="text-danger">
                            <?php echo isset($errors['email']) ? $errors['email'] : "" ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Gender</label>
                        <input type="text" class="form-control" name="gender" value="<?= $user['Gender'] ?>">
                        <div class="text-danger">
                            <?php echo isset($errors['gender']) ? $errors['gender'] : "" ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                        <div class="text-danger">
                            <?php echo isset($errors['password']) ? $errors['password'] : "" ?>
                        </div>
                    </div>

                    <button type="submit" name="edit" class="btn btn-primary">Update</button>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>