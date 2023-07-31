<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form Submission</title>
</head>
<body>
    <form action="/" method="post">
        <input type="hidden"
               name="csrf_token"
               value="<?php echo $this->csrfToken; ?>"
        >
        <label for="data">Enter Data:</label><br>
        <textarea name="data" id="data" rows="10" cols="50"><?php echo $data ?? ''; ?></textarea><br>
<input type="submit" value="Submit">
</form>

<?php if (isset($submittedData)) : ?>
    <h2>Submitted Data:</h2>
    <?php
    foreach ($submittedData as $item) {
        // Ваш код для обработки элементов массива $submittedData (или объекта, если это объект)
        echo  '<p>' . $item['description'] . '</p>'; // Пример вывода элементов
    }
    ?>
<?php endif; ?>
</body>
</html>
