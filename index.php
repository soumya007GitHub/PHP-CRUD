<!-- PHP starts here -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";
$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
    die("<br>Failed to connect to the database".mysqli_connect_error());
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $title = $_POST["title"];
    $desc = $_POST["desc"];
    $sql = "INSERT INTO `notes` (`sl`, `title`, `description`, `time`) VALUES (NULL, '$title', '$desc', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong> failed to submit the note.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    else{
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Your response has been submitted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
}
 ?>
<!-- PHP ends here -->

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <!-- CSS Link -->
    <link rel = "stylesheet" href = "//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    
  </head>
  <body>
    <!-- Form starts here -->
    <div class="container mt-3" style = "width : 900px;">
    <h2>iNotes</h2>
    <form action = "/soumya/index.php" method = "post">
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control mb-3" id="title" name = "title" required>
    <label for="floatingTextarea2">Comments</label>
    <div class="form-floating">
  <textarea class="form-control mb-3" id="desc" name = "desc" style="height: 100px" required></textarea>
</div>
  <button type="submit" class="btn btn-primary">Save note</button>
</form>
    </div>
    <dic class="container">
    <table class="table mb-3" id = "myTable">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM `notes`";
    $result = mysqli_query($conn, $sql);
    
    //Find the number of records returned
    $num = mysqli_num_rows($result);
    
    // display all records unless and until NULL is found at last
    
    if($num > 0){
        $count = 1;
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>
            <th scope = 'row'>".$count."</th>".
            "<td>".$row["title"]."</td>".
            "<td>".$row["description"]."</td>".
            "<td><button class = 'edit btn btn-sm btn-primary'>Edit</button><a class = 'delete' href = '/del'>delete </a></td>
            </tr>";
            $count = $count + 1;
        }
    }
  ?>
  </tbody>
</table>
    </dic>
<!-- Form ends here -->

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">





<script src = "//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    // let table = new DataTable('#myTable');
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
</script>
  </body>
</html>