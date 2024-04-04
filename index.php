<!DOCTYPE html>
<html>
<head>
    <title>Basic PHP Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="calculator-box">
    <h1>CALCULATOR</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="display" value="<?php echo isset($_POST['display']) ? $_POST['display'] : '0'; ?>" readonly><br><br>
        <input type="submit" name="number" value="1">
        <input type="submit" name="number" value="2">
        <input type="submit" name="number" value="3">
        <input type="submit" name="operator" value="+" class="plus"><br><br>
        <input type="submit" name="number" value="4">
        <input type="submit" name="number" value="5">
        <input type="submit" name="number" value="6">
        <input type="submit" name="operator" value="-"><br><br>
        <input type="submit" name="number" value="7">
        <input type="submit" name="number" value="8">
        <input type="submit" name="number" value="9">
        <input type="submit" name="operator" value="*"><br><br>
        <input type="submit" name="clear" value="C">
        <input type="submit" name="number" value="0">
        <input type="submit" name="equals" value="=">
        <input type="submit" name="operator" value="/"><br><br>
    </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['number'])) {
            $display = isset($_POST['display']) ? $_POST['display'] : '0';
            if ($display == '0' || strpos('+-*/', substr($display, -1)) !== false) {
                $display = $_POST['number'];
            } else {
                $display .= $_POST['number'];
            }
            echo '<script>document.getElementsByName("display")[0].value = "' . $display . '";</script>';
        } elseif (isset($_POST['operator'])) {
            $display = isset($_POST['display']) ? $_POST['display'] : '0';
            $lastChar = substr($display, -1);
            if (strpos('+-*/', $lastChar) === false) {
                $display .= ' ' . $_POST['operator'] . ' ';
                echo '<script>document.getElementsByName("display")[0].value = "' . $display . '";</script>';
            } elseif ($lastChar != $_POST['operator']) {
                $display = substr($display, 0, -1) . $_POST['operator'];
                echo '<script>document.getElementsByName("display")[0].value = "' . $display . '";</script>';
            }
        } elseif (isset($_POST['equals'])) {
            $display = isset($_POST['display']) ? $_POST['display'] : '0';
            if (empty($display)) {
                echo '<script>document.getElementsByName("display")[0].value = "0";</script>';
            } else {
                if (strpos('+-*/', substr($display, -1)) === false) {
                    eval('$result = ' . $display . ';');
                    echo '<script>document.getElementsByName("display")[0].value = "' . $result . '";</script>';
                }
            }
        } elseif (isset($_POST['clear'])) {
            echo '<script>document.getElementsByName("display")[0].value = "0";</script>';
        }
    }
    ?>
</body>
</html>
