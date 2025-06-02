<?php
// Generate password hashes and SQL queries

$managers = [
    [
        'email' => 'manager@petdaycare.com',
        'password' => 'admin123',
        'phone' => '01712345678'
    ],
    [
        'email' => 'testmanager@petdaycare.com', 
        'password' => 'password',
        'phone' => '01812345678'
    ],
    [
        'email' => 'demo@petdaycare.com',
        'password' => 'demo123',
        'phone' => '01912345678'
    ]
];

echo "<h3>Generated SQL Queries:</h3>";
echo "<textarea rows='15' cols='80'>";

foreach ($managers as $manager) {
    $hashedPassword = password_hash($manager['password'], PASSWORD_DEFAULT);
    
    echo "-- Email: {$manager['email']}, Password: {$manager['password']}\n";
    echo "INSERT INTO managers (email, password, phone) VALUES ('{$manager['email']}', '{$hashedPassword}', '{$manager['phone']}');\n\n";
}

echo "</textarea>";

echo "<h3>Login Credentials:</h3>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Email</th><th>Password</th><th>Phone</th></tr>";

foreach ($managers as $manager) {
    echo "<tr>";
    echo "<td>{$manager['email']}</td>";
    echo "<td><strong>{$manager['password']}</strong></td>";
    echo "<td>{$manager['phone']}</td>";
    echo "</tr>";
}

echo "</table>";
?>

<style>
textarea { font-family: monospace; }
table { margin-top: 20px; border-collapse: collapse; }
th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
th { background-color: #f2f2f2; }
</style>