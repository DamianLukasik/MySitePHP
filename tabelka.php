<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta http-equiv=”Content-type” content=”text/html; charset=UTF-8″>      
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/przycisk.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
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
        <?php 
        
            echo "Tabelka z produktami<br><br>";             
                    
           /* date_default_timezone_set('Europe/Warsaw');
            mb_internal_encoding('UTF-8');
            setlocale(LC_ALL, 'pl_PL.UTF-8','pl.UTF-8','pol.UTF-8','plk.UTF-8','polish.UTF-8','poland.UTF-8');
            header('Content-type: text/html; charset=utf-8');
			
            define('PL_ISO_ALL', 'ąćęłńóśźżĄĆĘŁŃÓŚŹŻ');
            define('PL_WIN_ALL', 'ąćęłńóśźżĄĆĘŁŃÓŚŹŻ');
			
            setlocale(LC_ALL, 'Polish_Poland.1250');	
            setlocale(LC_ALL, 'pl_PL.ISO8859-2');
                     
            define('PL_ISO_ALL', "\xb1\xe6\xea\xb3\xf1\xf3\xb6\xbc\xbf\xa1\xc6\xca\xa3\xd1\xd3\xa6\xac\xaf");
            define('PL_ISO_ALL_UPPER', "\xa1\xc6\xca\xa3\xd1\xd3\xa6\xac\xaf");
                 */       
            $roznica_procentowa = 0.2;
        
            if(isset($_POST['q'])){
                
                $czesci = explode("\n", $_POST['q']); 
                $count = count($czesci);
                echo "<label id='lb_liczba_produktow' style='visibility:hidden;'>".$count."</label>";
                   
                
                   
                /*
            //    echo mb_detect_encoding($czesci[0])."\t".$czesci[0]."\n";                
            //    $czesci[0] = iconv(mb_detect_encoding($czesci[0]), "ISO-8859-2//IGNORE",$czesci[0]);                        
           //     echo $czesci[0].'';
                */
                
                                
                echo "<table>"
                . "<thead><tr><th>Kod kreskowy</th><th>Nazwa</th><th>Dostawca główny</th><th>Dostawca 1</th><th>Dostawca 2</th></tr></thead>";
                  /*  . "<tfoot><tr>"
                        . "<td> </td>"
                        . "<td> </td>"
                        . "<td> </td>"
                    . "</tr></tfoot>";*/
                
                for($i = 0; $i < $count-1; $i++)
                {                    
                    $str = $czesci[$i];
                    $tab = explode("|",$str); 
                    //problem z kodowaniem
                    /*
                //    echo iconv("ISO-8859-1","UTF-8","To jest test<br>");
                 //   echo iconv("ISO 8859-1","UTF-8","JabÅko")."<br><br>";
                    
                   
                    echo mb_detect_encoding($tab[1])."   -   ".$tab[1]."<br>";
                    $encode = "".mb_detect_encoding($tab[1]);
                    $tab[1] = iconv($encode,'iso-8859-2//IGNORE',$tab[1]); 
                    echo mb_detect_encoding($tab[1])."   -   ".$tab[1]."<br>";
                   
                    
                 //   echo mb_detect_encoding($tab[0])."\t".$tab[0]."\n";
                  //  echo mb_detect_encoding($tab[1])."\t".$tab[1]."\n";
                  //  echo mb_detect_encoding($tab[2])."\t".$tab[2]."\n";
                                                           
                    
                //    $tab[0] = iconv(mb_detect_encoding($tab[0]), "utf-8//IGNORE",$tab[0]); 
                 //   $tab[1] = iconv(mb_detect_encoding($tab[1]), "iso-8859-2//IGNORE",$tab[1]); 
                 //   $tab[2] = iconv(mb_detect_encoding($tab[2]), "utf-8//IGNORE",$tab[2]); 
                 //   
                 //   echo mb_detect_encoding($tab[1])."\t".$tab[1]."\n";
                    */
                    $dost0 = $tab[2];
                    $dost1 = $tab[3];//*$roznica_procentowa;
                    $dost2 = $tab[4];
                    
                    $str = "<tr><td>".$tab[0]."</td><td>".$tab[1]."</td>"
                            . "<td style='backgroundColor: #FFFFFF;' id='dost0_".$i."'>".$dost0."</td>"
                            . "<td style='backgroundColor: #FFFFFF;' id='dost1_".$i."'>".$dost1."</td>"
                            . "<td style='backgroundColor: #FFFFFF;' id='dost2_".$i."'>".$dost2."</td>"
                            . "</tr>";
                 //   $str = iconv(mb_detect_encoding($str), "utf-8//IGNORE",$str); 
                    
                    
                    
                    echo $str;
                }
                echo "</td></tr></table>";
            }
        ?>
             
        <br><br>
        <input id="txt_roznica_procentowa" type="number" value="0" min="0" max="100" ></input><label>  %  </label>
        <input id="btn_roznica_procentowa" type="button" onclick="modify()" value="Zatwierdź" ></input>
        <script>
        
        function modify(){
            var a = parseInt(document.getElementById('txt_roznica_procentowa').value);     
            var count = document.getElementById('lb_liczba_produktow').innerHTML;
            var myElement;
            var kolor1 = "#66CC66";
            var kolor2 = "#FFFFFF";
            var elem_;
            var e0,e1,e2;
            if(a==0)
            {
                for(var i=0;i<count-1;i++)
                {
                    elem_ = [parseFloat(document.getElementById('dost0_'+i).innerHTML),
                            parseFloat(document.getElementById('dost1_'+i).innerHTML),
                            parseFloat(document.getElementById('dost2_'+i).innerHTML)];
                    var wart = Math.min(elem_[0],elem_[1],elem_[2]);
                    wart = elem_.indexOf(wart);   
              
                    document.getElementById('dost0_'+i).style.backgroundColor = kolor2;
                    document.getElementById('dost1_'+i).style.backgroundColor = kolor2;
                    document.getElementById('dost2_'+i).style.backgroundColor = kolor2; 
            
                    document.getElementById('dost'+wart+'_'+i).style.backgroundColor = kolor1;
                }                             
            }
            else
            {
                for(var i=0;i<count-1;i++)
                {
                    elem_ = [parseFloat(document.getElementById('dost0_'+i).innerHTML),
                            parseFloat(document.getElementById('dost1_'+i).innerHTML),
                            parseFloat(document.getElementById('dost2_'+i).innerHTML)];
                    e0 = roznica_procentowa(elem_[0],a);
                //    alert(e0);
                    if(elem_[1]>e0){
                     //   alert(elem_[1]+" t "+e0);
                        //5 2
                        e1 = elem_[1] - e0;
                    }else{
                      //  alert(elem_[1]+" f "+e0);
                        e1 = e0 - elem_[1];
                    }
                    if(elem_[2]>e0){
                     //   alert(elem_[2]+" t "+e0);
                        //5 2
                        e2 = elem_[2] - e0;
                    }else{
                    //    alert(elem_[2]+" f "+e0);
                        e2 = e0 - elem_[2];
                    }
                  //  alert("różnica procentowa = "+e0+"  "+elem_[1]+"="+e1+"  --  "+elem_[2]+"="+e2);
                    document.getElementById('dost0_'+i).style.backgroundColor = kolor2;
                    if(e1>e2)
                    {                        
                        document.getElementById('dost2_'+i).style.backgroundColor = kolor1;
                        document.getElementById('dost1_'+i).style.backgroundColor = kolor2;
                    }
                    else
                    {
                        document.getElementById('dost1_'+i).style.backgroundColor = kolor1;
                        document.getElementById('dost2_'+i).style.backgroundColor = kolor2;
                    }
                }     
            }
            
            var myElement = document.getElementById('dost1_0');
         //   myElement.style.backgroundColor = "#66CC66";
         //   alert();
        }             
        
        function roznica_procentowa(wart, procent){            
            var wynik = ((100-procent)*wart)/(100);
            return wynik;
        }
        
        function netto2brutto(a){   
            var x = a*0.23;
            a = x + a;
            return a;
        }
        
        /*
            x=((100-procent_wpr)*35)/(100)
                        
         *          
            35--- 100%
            28----x%
            x=28*100/35
            x=80%
            100%-80%=20%
            Różnica wynosi 20%
        */
        </script>
        
    </body>
</html>


