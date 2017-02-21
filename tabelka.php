<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-2" />
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
         /*   date_default_timezone_set('Europe/Warsaw');
            mb_internal_encoding('UTF-8');
            setlocale(LC_ALL, 'pl_PL.UTF-8','pl.UTF-8','pol.UTF-8','plk.UTF-8','polish.UTF-8','poland.UTF-8');
            header('Content-type: text/html; charset=utf-8');*/
            if(isset($_POST['q'])){

                echo "<table>"
                . "<thead><tr><th>Kod kreskowy</th><th>Nazwa</th><th>Dostawca główny</th></tr></thead>";
                  /*  . "<tfoot><tr>"
                        . "<td> </td>"
                        . "<td> </td>"
                        . "<td> </td>"
                    . "</tr></tfoot>";*/
                                
                $czesci = explode("\n", $_POST['q']);     
                
            //    echo mb_detect_encoding($czesci[0])."\t".$czesci[0]."\n";
                
            //    $czesci[0] = iconv(mb_detect_encoding($czesci[0]), "ISO-8859-2//IGNORE",$czesci[0]);
                        
           //     echo $czesci[0].'';
                
                for($i = 0, $count = count($czesci); $i < $count; $i++)
                {                    
                    $str = $czesci[$i];
                    $tab = explode("|",$str); 
                    //problem z kodowaniem
                 //   echo mb_detect_encoding($tab[0])."\t".$tab[0]."\n";
                    echo mb_detect_encoding($tab[1])."\t".$tab[1]."\n";
                  //  echo mb_detect_encoding($tab[2])."\t".$tab[2]."\n";
                    
                //    $tab[0] = iconv(mb_detect_encoding($tab[0]), "utf-8//IGNORE",$tab[0]); 
                    $tab[1] = iconv(mb_detect_encoding($tab[1]), "iso-8859-2//IGNORE",$tab[1]); 
                 //   $tab[2] = iconv(mb_detect_encoding($tab[2]), "utf-8//IGNORE",$tab[2]); 
                 //   
                    echo mb_detect_encoding($tab[1])."\t".$tab[1]."\n";
                    
                    $str = "<tr><td>".$tab[0]."</td><td>".$tab[1]."</td><td>".$tab[2]."</td></tr>";
                 //   $str = iconv(mb_detect_encoding($str), "utf-8//IGNORE",$str); 
                    
                    
                    
                    echo $str;
                }
                echo "</td></tr></table>";
            }
        ?>
                
    </body>
</html>


