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
            
            echo "<table style='border:none;'><tr><td style='border:none;'><div id='pn_panel_btn'>";
            echo "<div class='browse-wrap' style='width: 250px;'>"
            ."<input class='title' value='Zaczytaj ofertę dostawcy głównego' style='margin: 0px;text-align: left;width: 250px;'/>"
            ."<input onchange='wczytaj(this);' type='file' name='upload_0' class='upload'>"
            ."</div>";
            echo "<div class='browse-wrap' style='width: 250px;'>"
            ."<input class='title' value='Zaczytaj ofertę dostawcy nr 2' style='margin: 0px;text-align: left;width: 250px;'/>"
            ."<input onchange='wczytaj(this);' type='file' name='upload_1' class='upload'>"
            ."</div>";
            /*
           
            
            */
        //    echo "<input type='button' value='Zaczytaj ofertę dostawcy głównego' onclick='wczytaj(0);'></input><br>";
        //    echo "<input type='button' value='Zaczytaj ofertę dostawcy nr 1' onclick='wczytaj(1);'></input><br>";
            echo "</div></td><td style='border:none;'>";
        
            if(isset($_POST['q'])){
                
                $czesci = explode("\n", $_POST['q']); 
                $count = count($czesci);
                echo "<label id='lb_liczba_produktow' style='visibility:hidden;'>".$count."</label>";
                                
                echo "<table id='tab_produkty'>"
                . "<thead><tr>"
                        . "<th>Kod kreskowy</th>"
                        . "<th>Nazwa</th>"
                        . "<th>Dostawca główny</th></tr></thead>";
                   /*     . "<th>Dostawca 1</th>"
                        . "<th>Dostawca 2</th>";
                    . "<tfoot><tr>"
                        . "<td> </td>"
                        . "<td> </td>"
                        . "<td> </td>"
                    . "</tr></tfoot>";*/
                
                for($i = 0; $i < $count-1; $i++)
                {                    
                    $str = $czesci[$i];
                    $tab = explode("|",$str); 
                    
                    $dost0 = $tab[2];
                 //   $dost1 = $tab[3];//*$roznica_procentowa;
                //    $dost2 = $tab[4];
                    
                    $str = "<tr>"
                            . "<td >".$tab[0]."</td>"
                            . "<td >".$tab[1]."</td>"
                            . "<td style='backgroundColor: #FFFFFF;' id='dost0_".$i."'>".$dost0."</td>"
                          //  . "<td style='backgroundColor: #FFFFFF;' id='dost1_".$i."'>".$dost1."</td>"
                          //  . "<td style='backgroundColor: #FFFFFF;' id='dost2_".$i."'>".$dost2."</td>"
                            . "</tr>";
                 //   $str = iconv(mb_detect_encoding($str), "utf-8//IGNORE",$str);                     
                    echo $str;
                }
                echo "</td></tr></table><br></td></tr></table>";
            }
        ?>
             
        <br><br>
        <input id="txt_roznica_procentowa" type="number" value="0" min="0" max="100" ></input><label>  %  </label>
        <input id="btn_roznica_procentowa" type="button" onclick="modify()" value="Zatwierdź" ></input>
        <script>
        var kolor1 = "#66CC66";
        var kolor2 = "#FFFFFF";
        
        function modify(){
            var a = parseInt(document.getElementById('txt_roznica_procentowa').value);
            var row = parseInt(document.getElementById('tab_produkty').rows.length);
            var col = parseInt(document.getElementById('tab_produkty').rows[0].cells.length)-2;
            
          //  alert(col+" "+row);
            var e0,e1,e2;
            if(a==0)
            {
                for(var i=0;i<row;i++)
                {
                  //  alert(col);
                    var elem_ = [];
                    for(var j = 0;j<col;j++ )
                    {
                        elem_.push(parseFloat(document.getElementById('dost'+j+'_'+i).innerHTML));
                    //    alert(elem_[j]);
                    }
                  /*  elem_ = [,
                            parseFloat(document.getElementById('dost1_'+i).innerHTML),
                            parseFloat(document.getElementById('dost2_'+i).innerHTML)];*/
    
                    var wart = Math.min.apply(null, elem_);
                    wart = elem_.indexOf(wart);  
                    
                    for(var j = 0;j<col;j++ )
                    {                        
                        elem_.push(parseFloat(document.getElementById('dost'+j+'_'+i).innerHTML));
                        document.getElementById('dost'+j+'_'+i).style.backgroundColor = kolor2;
                      //  alert(elem_[j]);
                    }                    
               //     document.getElementById('dost0_'+i).style.backgroundColor = kolor2;
                //    document.getElementById('dost1_'+i).style.backgroundColor = kolor2;
                //    document.getElementById('dost2_'+i).style.backgroundColor = kolor2;             
                    document.getElementById('dost'+wart+'_'+i).style.backgroundColor = kolor1;
                }                             
            }
            else
            {
                for(var i=0;i<row;i++)
                {
                    var elem_ = [];
                    for(var j = 0;j<col;j++ )
                    {                        
                        elem_.push(parseFloat(document.getElementById('dost'+j+'_'+i).innerHTML));
                        document.getElementById('dost'+j+'_'+i).style.backgroundColor = kolor2; 
                    //    alert(elem_[j]);
                    }  
                                        
                    e0 = roznica_procentowa(elem_[0],a);
                    
                    var e_ = [];
                                        
                //    alert(e0);
                    for(var y=1;y<elem_.length;y++)
                    {
                        if(elem_[y]>e0){
                            e_.push(elem_[y] - e0);
                        }else{
                            e_.push(e0 - elem_[y]);
                        }                      
                    }
                    
                    var wart = Math.min.apply(null, e_);
                    wart = e_.indexOf(wart);
                     
                  //  alert("różnica procentowa = "+e0+"  "+elem_[1]+"="+e1+"  --  "+elem_[2]+"="+e2);
                    document.getElementById('dost'+(wart+1)+'_'+i).style.backgroundColor = kolor1;
                }     
            }
        }     
        
        function wczytaj(elem){            
        //    alert(elem.name);
         //   var uploader = document.getElementsByName(elem.name);
          //  uploader.files[i];            
            var reader = new FileReader();
            var spr_1="";
            reader.onload = function (evt) {
                if (evt.target.readyState == FileReader.DONE) {
                    var s = evt.target.result;
                    spr_1 = s.split("\n");                   
                    var arr = [];
                                           
                    for(var i=0;i<spr_1.length;i++)
                    {  
                        arr.push(spr_1[i]);
                  /*      spr_2 = spr_1[i].split("|");
                        var pos = reg.test(spr_2[0]);                                               
                        if(spr_2[0].length <= 14 && !pos && spr_2[1].length <= 44)
                        {
                            str += spr_1[i]+"\n"; 
                            arr
                        }*/
                    }  
                //    alert(str);
                    var div_btn = document.getElementById("pn_panel_btn");
                    var numer = div_btn.childElementCount+1;
                    var node = document.createElement("DIV");
                    node.setAttribute("class", "browse-wrap");
                    node.style.width = "250px";
                    var tit = document.createElement("INPUT");
                    tit.setAttribute("class", "title");
                    tit.value="Zaczytaj ofertę dostawcy nr "+numer;
                    tit.style.margin = "0px";
                    tit.style.textAlign = "left";
                    tit.style.width = "250px";            
                    node.appendChild(tit);
                    var upl = document.createElement("INPUT");       
                    upl.type = "file";
                    upl.name = "upload_"+numer;
                    upl.addEventListener(
                        'change',
                        function() { wczytaj(this); },
                        false
                     );
                    upl.setAttribute("class", "upload");
                    node.appendChild(upl); /**/
                    div_btn.appendChild(node);
                    
                 //   alert();   
                    
                    var tab_produkty = document.getElementById("tab_produkty");
                    var tblHeadObj = tab_produkty.tHead;
                    for (var h=0; h<tblHeadObj.rows.length; h++) {
                            var newTH = document.createElement('th');
                            tblHeadObj.rows[h].appendChild(newTH);
                            newTH.innerHTML = 'Dostawca '+(numer-2);
                    }
                    var rows = tab_produkty.rows.length;
                 //   alert(rows);
                // alert(numer-2);
                    var spr_2 = [];
                    var tblBodyObj = tab_produkty.tBodies[0];
                    for (var i=0; i<rows; i++) {
                            var newCell = tblBodyObj.rows[i].insertCell(numer);
                          //  alert(arr[i]);
                            spr_2 = arr[i].split("|");
                            newCell.id="dost"+(numer-2)+"_"+i;
                            newCell.innerHTML = ""+spr_2[2];
                    }
                       
                    /*
            ."<input onchange='wczytaj(this);'       
             type='file' name='upload_1' class='upload' title='Wybierz plik do odczytania'>"
         
                     */
                }
            };
            reader.readAsText(elem.files[0]);//uploader.files[0]);
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


