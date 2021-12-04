<?php
$customer = false;

session_start();
if (isset($_SESSION["customer"])) {
    $customer = json_decode($_SESSION["customer"]);
} else {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1><?php printf("%s %s %s", $customer->name, $customer->surname1, $customer->surname2); ?></h1>
    <table>
    <tr>
            <th>Nombre</th>
            <td><?php echo $customer->name; ?></td>
        </tr>
        <tr>
            <th>Apellido 1</th>
            <td><?php echo $customer->surname1; ?></td>
        </tr>
        <tr>
            <th>Apellido 2</th>
            <td><?php echo $customer->surname2; ?></td>
        </tr>
        <tr>
            <th>Nacimiento</th>
            <td><?php echo $customer->birthdate->date; ?></td>
        </tr>
        <tr>
            <th>Dirección</th>
            <td><?php echo $customer->streetName; ?></td>
        </tr>
        <tr>
            <th>Número</th>
            <td><?php echo $customer->streetNumber; ?></td>
        </tr>
        <tr>
            <th>Código Postal</th>
            <td><?php echo $customer->postalCode; ?></td>
        </tr>
        <tr>
            <th>Localidad</th>
            <td><?php echo $customer->city; ?></td>
        </tr>
        <tr>
            <th>Provincia</th>
            <td><?php echo $customer->province; ?></td>
        </tr>
        <tr>
            <th>País</th>
            <td><?php echo $customer->country; ?></td>
        </tr>
        <tr>
            <th>Teléfono 1</th>
            <td><?php echo $customer->phoneNumber1; ?></td>
        </tr>
        <tr>
            <th>Teléfono 2</th>
            <td><?php echo $customer->phoneNumber2; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $customer->email; ?></td>
        </tr>
    </table>
    <a href="endsession.php">Salir</a>
</body>
</html>