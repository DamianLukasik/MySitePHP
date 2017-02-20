<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/przycisk.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
        <style>
        table, th, td {
            border: 1px solid black;
            padding: 1px;
        }
        table {
            border-spacing: 2px;
        }
        </style>
    </head>
    <body>
        <?php echo 'Tabelka z produktami<br>'; ?>

        <?php
            if(isset($_POST['q'])){

                echo "<table>"
                . "<thead><tr><th>Kod kreskowy</th><th>Nazwa</th><th>Dostawca główny</th></tr></thead>";
                  /*  . "<tfoot><tr>"
                        . "<td> </td>"
                        . "<td> </td>"
                        . "<td> </td>"
                    . "</tr></tfoot>";*/
                                
                $czesci = explode("\n", $_POST['q']);
                
                for($i = 0, $count = count($czesci); $i < $count; $i++)
                {
                    $str = $czesci[$i];
                    $tab = explode("|",$str);  
                    $str = "<tr><td>".$tab[0]."</td><td>".$tab[1]."</td><td>".$tab[2]."</td></tr>";
                    $str = iconv("utf-8", "iso-8859-2//IGNORE", $str);  
                    echo $str;
                }

                
                echo "</td></tr></table>";
            }
        ?>
                
    </body>
</html>


