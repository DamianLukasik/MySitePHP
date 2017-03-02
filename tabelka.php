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

		<table style='border:none;'><tr><td style='border:none;'>
	
        <?php 
				//tabela
				echo "<br>";				
				echo "Tabelka z produktami<br><br>";   				
								
				echo "<TABLE style='border:none;'><TR><TD style='border:none;'>";
				echo "<div id='pn_panel_btn_' >";
				echo "<div id='pn_panel_btn' class='browse-wrap' style='width: 250px;'>"
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
					//    echo $leng." <br>  ".$str."<br>";
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
				echo "</div></TD><TD style='border:none;'>";
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
                echo  "</tr></thead>";
           
                for($i = 0; $i < $count-1 ;$i++)
                {
                //    echo "<tr><td>".$czesci[$i]."</td></tr>";
                    $czesci_w = explode(";",$czesci[$i]); 
                    
                    if($czesci_w[0]==null)
                    {
                        break;
                    }                    
                    echo "<tr>"
                        . "<td id='dost_numer_".$i."'>".$czesci_w[0]."</td>"
                        . "<td id='dost_nazwa_".$i."'>".$czesci_w[1]."</td>";    
                    $str = "";
                    $count_w = count($czesci_w);
                    for($j = 2 ;$j < $leng_+2 ;$j++)
                    {//($leng_+2)
                        $str = $str."<td id='dost".($j-2)."_".$i."'>";
                        if($j<$count_w)      
                        {
                            $str = $str.$czesci_w[$j]."</td>";
                        }
                        else
                        {
                            $str = $str."0.00</td>";
                        }                        
                    }//$czesci_w[$j]
                    echo $str."</tr>";
					
                }  				
				echo "</table>";
				echo "</TD></TR></TABLE>";
            }
            else
            {
                echo '$_POST jest pusty';
            }
        ?>
        </td></tr>
		<tr><td style='border:none;'>
		<br><br>
			<input id='txt_roznica_procentowa' type='number' value='0' min='0' max='100' ></input><label>  %  </label>
			<input id='btn_roznica_procentowa' type='button' onclick='modify()' value='Zatwierdź' ></input>   
		</td></tr></table>
			 
        <script>
        var kolor1 = "#66CC66";
        var kolor2 = "#FFFFFF";
        var nieskończenie_duza_wartość = 999999999.99;
		
        function modify(){
            var a = parseInt(document.getElementById('txt_roznica_procentowa').value);
            var liczba_wierszy = parseInt(document.getElementById('tab_produkty').rows.length);
            var liczba_kolumn = parseInt(document.getElementById('tab_produkty').rows[0].cells.length)-2;
            wyczysc_z_kolorow();
          //  alert(col+" "+row);
            var e0,e1,e2;
            if(a==0)
            {//wyszukuje najmniejszą
                for(var id_wiersza=0;id_wiersza<liczba_wierszy;id_wiersza++)
                {
                //    alert(row);
                    var elem_ = [];
                    for(var id_kolumny = 0;id_kolumny<liczba_kolumn;id_kolumny++ )
                    {
                     //   if(i==9)
                    //    alert(j+" "+liczba_kolumn+"  "+i+"\n"+document.getElementById('dost'+j+'_'+i).innerHTML);
                        if(document.getElementById('dost'+id_kolumny+'_'+id_wiersza)!=null)
                        {
                        //    if(i==9)
                         //   alert(document.getElementById('dost'+j+'_'+i).innerHTML+"\n"+j+"\t"+i+"\n"+liczba_kolumn);
                            
                        //    if(i==9)
                       //     alert("dost"+j+"_"+i+"\n"+document.getElementById('dost'+j+'_'+i).innerHTML);
                            
                         //   if(document.getElementById('dost'+j+'_'+i).innerHTML=="brak")
                          //  {
                        //    alert(document.getElementById('dost'+j+'_'+i).innerHTML);
                        //    }
                         //   if(i==9)
                         //   alert(parseInt(document.getElementById('dost'+j+'_'+i).innerHTML)+1);
                            
                            if(parseInt(document.getElementById('dost'+id_kolumny+'_'+id_wiersza).innerHTML)!=0)
                            {//alert(""+i+"<"+liczba_wierszy+"\n"+j+"<"+liczba_kolumn+"\n\n"+document.getElementById('dost'+j+'_'+i).innerHTML);
                                elem_.push(parseFloat(document.getElementById('dost'+id_kolumny+'_'+id_wiersza).innerHTML));
                            }
							else
							{
								//alert();
								elem_.push(nieskończenie_duza_wartość);
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
							//alert(elem_);
					wart = Math.min.apply(null, elem_);						
				//	alert(wart);					
					wart = elem_.indexOf(wart);					
				//	alert(wart);
					
                 //   if(i==9)
                 //   {
                    //    alert(wart+" - "+i+" - "+elem_+"  ");
                //    }
                    for(var id_elementu = 0;id_elementu<elem_.length;id_elementu++ )
                    {
                     //   elem_.push(parseFloat(document.getElementById('dost'+j+'_'+i).innerHTML));
                        document.getElementById('dost'+id_elementu+'_'+id_wiersza).style.backgroundColor = kolor2;
                      //  alert(elem_[j]);
                    }
               //     document.getElementById('dost0_'+i).style.backgroundColor = kolor2;
                //    document.getElementById('dost1_'+i).style.backgroundColor = kolor2;
                //    document.getElementById('dost2_'+i).style.backgroundColor = kolor2;  
                    if(elem_.length>=1)
                    {
                        document.getElementById('dost'+(wart)+'_'+id_wiersza).style.backgroundColor = kolor1;
                    }                    
                 //   alert(document.getElementById('dost'+wart+'_'+i).value);
                }
            }
            else
            {//wyszukuje różnice
                for(var id_wiersza=0;id_wiersza<liczba_wierszy;id_wiersza++)//po wszystkich wierszach
                {
                    var elem_ = []; 
                    var e_;
                    for(var id_kolumny = 0;id_kolumny<liczba_kolumn;id_kolumny++ )//po wszystkich komórkach
                    {   
                        if(document.getElementById('dost'+id_kolumny+'_'+id_wiersza)!=null && 
                                parseInt(document.getElementById('dost'+id_kolumny+'_'+id_wiersza).innerHTML)!=0)
                        {
                            elem_.push(parseFloat(document.getElementById('dost'+id_kolumny+'_'+id_wiersza).innerHTML));
                            document.getElementById('dost'+id_kolumny+'_'+id_wiersza).style.backgroundColor = kolor2;                             
                        }
                        else
                        {
                            elem_.push(nieskończenie_duza_wartość);                       
                        }
                       // alert(elem_[j]);
                       // e_.push(roznica_procentowa(elem_[j],a));       
                       // alert("różnica procentowa"+e_[j]);
                    }  
                //    alert(elem_);
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

                     //   alert(" wartość argumentu = "+wart_arr+" \n\n idek wartość = "+w_idx+" wartość = "+w);    
                        if(w!="1024")
                        {
                            document.getElementById('dost'+(w_idx+1)+'_'+id_wiersza).style.backgroundColor = kolor1;       
                            break;
                        }
                        else
                        {
                            document.getElementById('dost0_'+id_wiersza).style.backgroundColor = kolor1;    
                            break;
                      //      alert();
                        }
                    }
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
			
			//naprawić
			
			
            var numer = document.getElementById("pn_panel_btn_").childElementCount-1; 
        //    alert(numer+"\n"+liczba+"\n====");
            if(numer>liczba)
            {
             //   alert("zamiana danych\n"+numer+"\t> "+liczba+" <");
				//liczba - numer kolumny, numer - liczba dostaców, nie włączajac dostawcy głównego
                //zamienia miejscami dane z wybranej kolumny
                var reader = new FileReader();
                var spr_1="";
                reader.onload = function (evt) {
                    if (evt.target.readyState == FileReader.DONE) {
                        var s = evt.target.result;
                        spr_1 = s.split("\n");                   
                        var arr = [];//alert(s+"\n\n"+spr_1.length);
                        for(var i=0;i<spr_1.length;i++)
                        {
                          //  alert("dost"+liczba+"_"+i+"   element   "+document.getElementById('dost'+liczba+'_'+i)+"\n\n"+numer+"   "+liczba+"  "+elem+"\n"+spr_1[i].split(";")[1]+"\n"+i+"\n====\n"+spr_1.length);
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
         //   alert("nowa kolumna\n"+numer+" \t "+liczba);
          /*  if(elem.name[7]==numer)
            {                
                alert(elem.name[7]+"  "+numer);
                var reader = new FileReader();
                reader.onload = function (evt) {
                    
                    
                };
                reader.readAsText(elem.files[0]);//
            }
            else
            {
               var uploader = document.getElementsByName(elem.name);
               uploader.files[i];     */       
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
                        var div_btn = document.getElementById("pn_panel_btn_");
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
                                newCell.id="dost"+(numer-2)+"_"+i;//alert("dost"+(numer-2)+"_"+i);
                                newCell.innerHTML = ""+spr_2[1];
                            }
                            else
                            {
                                spr_2 = arr[r].split(";");//alert(spr_2);
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
                                
							//	alert(arr.length+"\n"+arr);
							////
							
								newCell_2 = newRow.insertCell(2);
								newCell_2.innerHTML = spr_2[1];
								newCell_2.id="dost0_"+i;
								for(var q=3;q<=liczba+2;q++)
                                {
									newCell_2 = newRow.insertCell(q);
                                    newCell_2.innerHTML = "0.00";
									newCell_2.id="dost"+(q-2)+"_"+i;
								}
							/*
								////
                                for(var q=2;q<=liczba+2;q++)
                                {
                                //    alert(q+"  "+liczba+"  "+spr_2[1]);
                                    newCell_2 = newRow.insertCell(q);
                                    newCell_2.innerHTML = "0.00";
									newCell_2.id="dost"+(q-2)+"_"+i;
                               //     alert("dost"+(numer-3)+"_"+i);
                                }
                                newCell_2.innerHTML = spr_2[1];
                            //    alert("dost"+(numer-3)+"_"+i);
                                newCell_2.id="dost"+(numer-2)+"_"+i;
								////
								*/
								
								
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


