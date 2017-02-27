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
        //    echo ''.$_POST['q'];
            echo "<table style='border:none;'><tr><td style='border:none;'><div id='pn_panel_btn'>";
            echo "<div class='browse-wrap' style='width: 250px;'>"
            ."<input class='title' value='Zaczytaj ofertę dostawcy głównego' style='margin: 0px;text-align: left;width: 250px;'/>"
            ."<input onchange='wczytaj(this,0);' type='file' name='upload_0' class='upload'>"
            ."</div>";
            $leng_arr = array();
            if(isset($_POST['q'])){
                $czesci = explode("\n", $_POST['q']); 
                $count = count($czesci);
                for($i = 0; $i < $count-1; $i++)
                { 
                    $str = $czesci[$i];
                    $tab = explode(";",$str);
                    $leng = count($tab) - 3;
                    array_push($leng_arr,$leng);
              //      echo $leng;
                }                     
            }
            $leng_ = max($leng_arr);
            for($i=0; $i<=$leng_ ;$i++)
            {
                echo "<div class='browse-wrap' style='width: 250px;'>"
                ."<input class='title' value='Zaczytaj ofertę dostawcy nr ".($i+1)."' style='margin: 0px;text-align: left;width: 250px;'/>"
                ."<input onchange='wczytaj(this,".($i+1).");' type='file' name='upload_1' class='upload'>"
                ."</div>";
            }
            
                          
           // }
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
                        . "<th>Dostawca główny</th>";
                
                $max_arr =  array();
                $max = 0;
                
                for($i = 0; $i < $count-1; $i++)
                {  
                    $str = $czesci[$i];
                    $tab = explode(";",$str); 
                    $leng = count($tab);
                    $max = 0;
                    for($o=2; $o < $leng; $o++)
                    {
                        $max =$max + 1;
                     //   echo "<th>Dostawca ".($o-1)."</th>";
                    }
                    array_push($max_arr,$max);
                }
                
                $leng_ = max($max_arr);
                for($o=2; $o <= $leng_; $o++)
                {
                    echo "<th>Dostawca ".($o-1)."</th>";
                }
                
                   /*     . "<th>Dostawca 1</th>"
                        . "<th>Dostawca 2</th>"
                        . "<th>Dostawca 3</th>"*/
                    echo  "</tr></thead>";
                   /* . "<tfoot><tr>"
                        . "<td> </td>"
                        . "<td> </td>"
                        . "<td> </td>"
                        . "<td> </td>"
                    . "</tr></tfoot>";*/
                
                for($i = 0; $i < $count-1; $i++)
                {                    
                    $str = $czesci[$i];
                    $tab = explode(";",$str); 
                    
                    $dost0 = $tab[2];
                 //   $dost1 = $tab[3];//*$roznica_procentowa;
                //    $dost2 = $tab[4];
                    
                    //
                    
                    $str = "<tr>"
                            . "<td id='dost_numer_".$i."'>".$tab[0]."</td>"
                            . "<td id='dost_nazwa_".$i."'>".$tab[1]."</td>";                    
                    
                    $leng = count($tab);
                    for($o=2; $o < $leng; $o++)
                    {
                     //   echo "<td>".($o-2)."</td>";
                     //   $tab[$o].s
                        
                        $str = $str."<td style='backgroundColor: #FFFFFF;' id='dost".($o-2)."_".$i."'>".$tab[$o]."</td>";                        
                    }
                //    echo "</tr>"
                  //  $str = $str.""
                    //
                      //      . "<td style='backgroundColor: #FFFFFF;' id='dost0_".$i."'>".$dost0."</td>"
                          //  . "<td style='backgroundColor: #FFFFFF;' id='dost1_".$i."'>".$dost1."</td>"
                          //  . "<td style='backgroundColor: #FFFFFF;' id='dost2_".$i."'>".$dost2."</td>"
                     //       . "</tr>";
                 //   $str = iconv(mb_detect_encoding($str), "utf-8//IGNORE",$str);                     
                    echo $str;
                }
                echo "</td></tr></table><br></td></tr></table>";
            }
            else
            {
                echo '$_POST jest pusty';
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
            wyczysc_z_kolorow();
          //  alert(col+" "+row);
            var e0,e1,e2;
            if(a==0)
            {//wyszukuje najmniejszą
                for(var i=0;i<row;i++)
                {
                //    alert(row);
                    var elem_ = [];
                    for(var j = 0;j<col;j++ )
                    {
                     //   if(i==9)
                    //    alert(j+" "+col+"  ");
                        if(document.getElementById('dost'+j+'_'+i)!=null)
                        {
                        //    if(i==9)
                         //   alert(document.getElementById('dost'+j+'_'+i).innerHTML+"\n"+j+"\t"+i+"\n"+col);
                            
                        //    if(i==9)
                       //     alert("dost"+j+"_"+i+"\n"+document.getElementById('dost'+j+'_'+i).innerHTML);
                            
                         //   if(document.getElementById('dost'+j+'_'+i).innerHTML=="brak")
                          //  {
                        //    alert(document.getElementById('dost'+j+'_'+i).innerHTML);
                        //    }
                         //   if(i==9)
                         //   alert(parseInt(document.getElementById('dost'+j+'_'+i).innerHTML)+1);
                            
                            if(parseInt(document.getElementById('dost'+j+'_'+i).innerHTML)!=0)
                            {//alert(j+" "+i);
                                elem_.push(parseFloat(document.getElementById('dost'+j+'_'+i).innerHTML));
                            }
                        }                        
                        else
                        {
                            break;
                         //   alert();
                        }//alert(elem_);
                     //   alert(elem_[j]);
                    }
                  //  alert(elem_.length);
                  /*  elem_ = [,
                            parseFloat(document.getElementById('dost1_'+i).innerHTML),
                            parseFloat(document.getElementById('dost2_'+i).innerHTML)];*/
    
                    var wart = Math.min.apply(null, elem_);
                    wart = elem_.indexOf(wart);
                 //   if(i==9)
                 //   {
                    //    alert(wart+" - "+i+" - "+elem_+"  ");
                //    }
                    for(var j = 0;j<elem_.length;j++ )
                    {
                     //   elem_.push(parseFloat(document.getElementById('dost'+j+'_'+i).innerHTML));
                        document.getElementById('dost'+j+'_'+i).style.backgroundColor = kolor2;
                      //  alert(elem_[j]);
                    }
               //     document.getElementById('dost0_'+i).style.backgroundColor = kolor2;
                //    document.getElementById('dost1_'+i).style.backgroundColor = kolor2;
                //    document.getElementById('dost2_'+i).style.backgroundColor = kolor2;  
                    if(elem_.length>=1)
                    {
                        document.getElementById('dost'+(wart)+'_'+i).style.backgroundColor = kolor1;
                    }                    
                 //   alert(document.getElementById('dost'+wart+'_'+i).value);
                }
            }
            else
            {//wyszukuje różnice
                for(var i=0;i<row;i++)//po wszystkich wierszach
                {
                    var elem_ = []; 
                    var e_;
                    for(var j = 0;j<col;j++ )//po wszystkich komórkach
                    {            
                        if(document.getElementById('dost'+j+'_'+i)!=null && 
                                parseInt(document.getElementById('dost'+j+'_'+i).innerHTML)!=0)
                        {
                            elem_.push(parseFloat(document.getElementById('dost'+j+'_'+i).innerHTML));
                            document.getElementById('dost'+j+'_'+i).style.backgroundColor = kolor2;                             
                        }
                        else
                        {
                            break;                            
                        }
                       // alert(elem_[j]);
                       // e_.push(roznica_procentowa(elem_[j],a));       
                       // alert("różnica procentowa"+e_[j]);
                    }  
                    
                    var r = 0;
                    var wart_arr = [];
                    /*
                    for(var j=1;j<elem_.length;j++)
                    {
                        var roz = 0;
                        if(elem_[0]>elem_[j])
                        {
                            roz = roznica_procentowa(elem_[0],elem_[j]);
                        }
                        else
                        {
                            roz = roznica_procentowa(elem_[j],elem_[0]);
                        }  
                        if(roz>=a)
                        {
                            wart_arr.push(roz);
                        }
                        else
                        {
                            wart_arr.push(1024);
                        }
                    //    alert("różnica procentowa  > "+elem_[0]+" - "+elem_[j]+" < = "+wart);
                    }*/
                    var w;
                    var w_idx;
                    
                    for(var a__=a;a>0;a__--)
                    {
                        wart_arr = oblicz_roznice(elem_,a__);

                        w     = Math.min.apply(null, wart_arr);
                        w_idx = wart_arr.indexOf(w);

                      //  alert(wart_arr+" \n"+w_idx+"  "+w);    
                        if(w!="1024")
                        {
                            document.getElementById('dost'+(w_idx+1)+'_'+i).style.backgroundColor = kolor1;       
                            break;
                        }
                        else
                        {
                            document.getElementById('dost0_'+i).style.backgroundColor = kolor1;    
                            break;
                      //      alert();
                        }
                    }
                  /**/
                    
                    
                    /*                    
                    var max_war_ar = Math.max.apply(null, wart_arr);
                //    alert(wart_arr.length);
                    for(var k=0;k<wart_arr.length;k++)
                    {
                      //  alert(wart_arr[k] + " - " + k);
                        if(wart_arr[k]>a)// & wart_arr[k]==max_war_ar)
                        {
                            for(var j=0;j<k;j++)
                            {
                                document.getElementById('dost'+(j+1)+'_'+i).style.backgroundColor = kolor2;
                            }                             
                            document.getElementById('dost'+(k+1)+'_'+i).style.backgroundColor = kolor1;
                        }
                    }       */    
                    /*
                        if(wart>a)
                        {
                            if(j!=0)
                            {
                                                               
                            }
                            
                        }
                        else
                        {
                       //     alert();
                        }*/
                  //  }                    
                    /*
                    for(var j=0;j<col-1;j++)
                    {
                        e_ = [];
                      //  for(var k=j+1;k<col;k++)
                      //  {
                          //  alert("> "+elem_[j]+" - "+elem_[k]+" <");
                          //  e_.push(roznica_procentowa(elem_[j],elem_[k])); 
                            wart = roznica_procentowa(elem_[0],elem_[j+1]);
                          //  alert("różnica procentowa"+e_[r++]);
                            alert("różnica procentowa  > "+elem_[j]+" - "+elem_[k]+" < = "+wart);
                            if(wart>a)
                            {
                              //  document.getElementById('dost'+j+'_'+i).style.backgroundColor = kolor2;
                            }
                      //  }                        
                    }*/                    
                    /*
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
     */
                }
            }
        }
        
        function oblicz_roznice(elem_,a){
            var wart_arr = [];
            for(var j=1;j<elem_.length;j++)
            {
                var roz = 0;
                if(elem_[0]>elem_[j])
                {
                    roz = roznica_procentowa(elem_[0],elem_[j]);
                }
                else
                {
                    roz = roznica_procentowa(elem_[j],elem_[0]);
                }
                if(roz>=a)
                {
                    wart_arr.push(roz);
                }
                else
                {
                    wart_arr.push(1024);
                }//    alert("różnica procentowa  > "+elem_[0]+" - "+elem_[j]+" < = "+wart);
            }
            return wart_arr;
        }
        
        function wyczysc_z_kolorow(){
            var row = parseInt(document.getElementById('tab_produkty').rows.length);
            var col = parseInt(document.getElementById('tab_produkty').rows[0].cells.length)-2;
            for(var i=0;i<row;i++){ 
                for(var j=0;j<col;j++){ 
                    if(document.getElementById('dost'+j+'_'+i)!=null)
                    {
                        document.getElementById('dost'+j+'_'+i).style.backgroundColor = kolor2;//alert(""+j+"  "+i);
                    }                    
                }  
            }       
        }
        
        function wczytaj(elem,liczba){
            wyczysc_z_kolorow();
            var numer = document.getElementById("pn_panel_btn").childElementCount-1; 
            if(numer>liczba)
            {
                //alert("> "+liczba+" <");
                //zamienia miejscami dane z wybranej kolumny
                var reader = new FileReader();
                var spr_1="";
                reader.onload = function (evt) {
                    if (evt.target.readyState == FileReader.DONE) {
                        var s = evt.target.result;
                        spr_1 = s.split("\n");                   
                        var arr = [];
                        for(var i=0;i<spr_1.length;i++)
                        {
                         //   alert(numer+"   "+liczba+"  "+elem);
                          //  arr.push(spr_1[i]);
                          //  alert(arr[i]+"");
                          //  alert(liczba+" "+i+" "+spr_1[i]+"    "+spr_1[i].split(";")[2]);
                          //  alert(document.getElementById('dost'+liczba+'_'+i).);
                            
                        
                            document.getElementById('dost'+liczba+'_'+i).innerHTML = ""+spr_1[i].split(";")[1];
                            
                          //  document.getElementById('dost'+liczba+'_'+i).value = spr_1[i].split(";")[1];
                        }
                    }
                };
                reader.readAsText(elem.files[0]);
            }
            else
            {
         //   alert(numer);
          /*  if(elem.name[7]==numer)
            {                
                alert(elem.name[7]+"  "+numer);
                var reader = new FileReader();
                reader.onload = function (evt) {
                    
                    
                };
                reader.readAsText(elem.files[0]);//
            }
            else
            {*/
            //   var uploader = document.getElementsByName(elem.name);
             //  uploader.files[i];            
                var reader = new FileReader();
                var spr_1="";//wczytuje nowe dane
                reader.onload = function (evt) {
                    if (evt.target.readyState == FileReader.DONE) {
                        var s = evt.target.result;
                        spr_1 = s.split("\n");                 
                        var arr = [];

                        for(var i=0;i<spr_1.length;i++)
                        {
                            arr.push(spr_1[i]);
                      /*      spr_2 = spr_1[i].split(";");
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
                        tit.value="Zaczytaj ofertę dostawcy nr "+(numer-1);
                        tit.style.margin = "0px";
                        tit.style.textAlign = "left";
                        tit.style.width = "250px";            
                        node.appendChild(tit);
                        var upl = document.createElement("INPUT");       
                        upl.type = "file";
                        upl.name = "upload_"+(numer-1);//alert(numer-1);
                        upl.addEventListener(
                            'change',
                            function() { wczytaj(this,numer-1); },
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
                        var log_3 = 0;
                        var newRow;
                        for (var r=0; r<arr[r].length; r++) {
                        //    alert(tblBodyObj.rows.length+"  "+arr.length);
                            var log = -1; 
                            for(var i=0; i<arr[r].length; i++)
                            {  
                                var arr_1 = arr[r].split(";")[0];
                                if(document.getElementById('dost_numer_'+i)==null)
                                {
                                    log = -1;
                                    break;
                                  //  alert(); 
                                }
                                var arr_0 = document.getElementById('dost_numer_'+i).innerHTML;
                                                                       
                                if(arr_1===arr_0)
                                {
                                    log = r;
                                    break;
                                }  
                            }
                          //  alert(log);
                            if(log!==-1)
                            {
                                var newCell = tblBodyObj.rows[i].insertCell(numer);
                                //  alert(arr[i]);
                                spr_2 = arr[log].split(";");
                                newCell.id="dost"+(numer-2)+"_"+i;
                                newCell.innerHTML = ""+spr_2[1];                                
                            }
                            else
                            {                                
                                spr_2 = arr[r].split(";");
                                var lic_ = tblBodyObj.rows.length+1;
                            //    alert(lic_);
                                newRow = tab_produkty.insertRow(lic_);
                                
                                var newCell_0 = newRow.insertCell(0);
                                newCell_0.innerHTML = spr_2[0];
                                newCell_0.id="dost_numer_"+i;
                                var newCell_1 = newRow.insertCell(1);                                
                                newCell_1.innerHTML = spr_2[2];
                                newCell_1.id="dost_nazwa_"+i;
                                var newCell_2;
                                
                                for(var q=2;q<=liczba+2;q++)
                                {
                                //    alert(q+"  "+liczba+"  "+spr_2[1]);
                                    newCell_2 = newRow.insertCell(q);
                                    newCell_2.innerHTML = "0.00";
                               //     alert("dost"+(numer-3)+"_"+i);
                                }
                                newCell_2.innerHTML = spr_2[1];   
                            //    alert("dost"+(numer-3)+"_"+i);
                                newCell_2.id="dost"+(numer-3)+"_"+i;
                                /*
                                var cell1
                                var cell2 = row.insertCell(1);
                                                                
                                cell1.innerHTML = "NEW CELL1";
                                cell2.innerHTML = "NEW CELL2";
                            
                                = tblBodyObj.rows[i].insertCell(numer);
                                //  alert(arr[i]);
                                
                                newCell.id="dost"+(numer-2)+"_"+i;
                                newCell.innerHTML = ""+spr_2[1]; */
                            }
                            if(r==parseInt(arr.length-1))
                            {
                             //   alert("za "+tblBodyObj.rows.length+"  "+arr.length+"  = \n"
                             //               +r+"\t"+parseInt(arr.length-1));
                                if(tblBodyObj.rows.length>arr.length)
                                {                                    
                                    log_3 = 1;
                                    break;
                                }
                                else
                                {
                                 //   alert("po "+tblBodyObj.rows.length+"  "+arr.length);
                                    log_3 = 2;
                                    break;
                                }
                            }
                            //alert(log_3);
                        }
                        if(log_3===1)
                        {
                        //    alert(log_3+" < "+liczba+"\t"+arr.length+"\t"+tblBodyObj.rows.length);
                        //    alert(tblBodyObj.rows[arr.length].cells[1]);
                            newRow = tblBodyObj.rows[i+1];
                      //      alert(liczba); 
                            var newCell_n = newRow.insertCell(liczba+2);   
                            newCell_n.innerHTML = "0.00";
                        //    alert("dost"+(numer-3)+"_"+(i+1));
                            newCell_n.id="dost"+(numer-3)+"_"+(1+i);//"dost_numer_"+tblBodyObj.rows.length;//"dost"+(numer-3)+"_"+i;
                        }
                        if(log_3===2)
                        {
                      /*      alert(log_3+" > "+(numer-3)+" "+i);
                            var newCell_n = newRow.insertCell(0);    
                            newCell_n.innerHTML = "brak";
                            newCell_n.id="dost"+(numer-3)+"_"+i;*/
                        }

                       /*
                ."<input onchange='wczytaj(this);'       
                type='file' name='upload_1' class='upload' title='Wybierz plik do odczytania'>"

                        */
                    }
                };
                reader.readAsText(elem.files[0]);//uploader.files[0]);
            }
        }
        
        function roznica_procentowa(a, b){
          //  var wynik = ((100-procent)*wart)/(100);
            var wynik = (((a*100)/b)-100);
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


