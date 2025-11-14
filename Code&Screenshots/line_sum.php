    <?php
    function lineSum($filename, $lineNumber) {
        if (!file_exists($filename)) {
            return 0; // file not found
        }

        $sum = 0;
        $fp = fopen($filename, 'r');
        while (($line = fgets($fp)) !== false) {
            $line = trim($line);
            if ($line === '' || substr($line, 0, 1) === '#') {
                continue; // ignore blank lines or comments
            }
            if ($count === $lineNumber) {
                break; // found the target line
            }
            $count++;
        }
        fclose($fp);
        if ($count !== $lineNumber) {
            return 0; // requested line not found
        }

        $tokens = explode(' ', trim($line));
        foreach ($tokens as $token) {
            if (filter_var($token, FILTER_VALIDATE_INT)) {
                $sum += (int)$token;
            }
        }
        return $sum;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $filename = $_POST['filename'];
        $lineNumber = (int)$_POST['lineno'];

        echo "The sum of the integers on line {$lineNumber} of file {$filename} is: " . lineSum($filename, $lineNumber) . "<br>";
    }
    ?>