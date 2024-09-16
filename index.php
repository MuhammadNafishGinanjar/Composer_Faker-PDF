<?php
session_start();
require_once 'vendor/autoload.php';

// Generate random data for display and PDF
$faker = Faker\Factory::create('id_ID');
$display_data = [];

for ($i = 0; $i < 10; $i++) {
    $display_data[] = [
        'name' => $faker->name(),
        'email' => $faker->email(),
    ];
}

// Serialize the data so it can be sent via POST
$serialized_data = serialize($display_data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Nama Palsu dengan Email</title>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tbody tr:hover {
        background-color: #f1f1f1;
    }

    </style>
</head>
<body>

    <h1>Daftar Nama Palsu dan Email (Tampilan Acak)</h1>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($display_data as $i => $data): ?>
                <tr>
                    <td><?php echo ($i + 1); ?></td>
                    <td><?php echo htmlspecialchars($data['name']); ?></td>
                    <td><?php echo htmlspecialchars($data['email']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>

    <!-- Form to send the data to generate_pdf.php via POST -->
    <form action="generate_pdf.php" method="post">
        <!-- Send serialized data as hidden input -->
        <input type="hidden" name="data" value="<?php echo htmlspecialchars($serialized_data); ?>">
        <button type="submit">Generate PDF</button>
    </form>

</body>
</html>
