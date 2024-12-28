<?php
require_once "../../app/classes/VehicleManager.php";

$id = $_GET['id'] ?? null ;

if($id == null){
    header("Location: ../index.php");
    exit;
}
$vehicleManager = new VehicleManager('','','','');
$vehicles = $vehicleManager->getVehicles();
$vehicle = $vehicles[$id] ?? null;

if($vehicle == null){
    header("Location: ../index.php");
    exit;
}
if($_SERVER['REQUEST_METHOD']==="POST"){
    $vehicleManager->editVehicle($id,[
        "name" => htmlspecialchars($_POST["name"]),
        "type" => htmlspecialchars($_POST["type"]),
        "price" => htmlspecialchars($_POST["price"]),
        "image" => htmlspecialchars($_POST["image"])
    ]);  
    header("Location: ../index.php");
    exit;
}
include './header.php';
?>


<div class="container my-4">
    <h1>Edit Vehicle</h1>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Vehicle Name</label>
            <input type="text" name="name" class="form-control" value="<?= $vehicle['name']?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Vehicle Type</label>
            <input type="text" name="type" class="form-control" value="<?= $vehicle['type']?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" value="<?= $vehicle['price']?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Image URL</label>
            <input type="text" name="image" class="form-control" value="<?= $vehicle['image']?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Vehicle</button>
        <a href="../index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>