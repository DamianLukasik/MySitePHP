<?php

    if(isset($_FILES['upload'])){

        $errors= array();
        $file_name = $_FILES['upload']['name'];
        $file_size =$_FILES['upload']['size'];
        $file_tmp =$_FILES['upload']['tmp_name'];
        $file_type=$_FILES['upload']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['upload']['name'])));

        $expensions= array("txt");

        if(in_array($file_ext,$expensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }

        if($file_size > '2097152'){
            $errors[]='File size must be excately 2 MB';
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta http-equiv=”Content-type” content=”text/html; charset=UTF-8″>     
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/przycisk.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>        
    </head>
    <body>
        <?php 
        $str = '<div>Program dla pana Zbyszka - Kontrolka do ładowania plków</div><br><br>';
        
    //    echo mb_detect_encoding($str)."\t".$str."\n"; 
        echo $str;
        
        ?>
        
        <form name="uploadForm" action="index.php" method="POST" enctype="multipart/form-data">         
            <div class="browse-wrap">
               <input class="title" value="Pobierz plik główny" />
               <input type="file" name="upload" class="upload" multiple title="Wybierz plik do odczytania">
           <!--    <input type="submit" value="Odczytaj" name="submit" class="title" style="visibility: collapse"/> -->
            </div>
            <span class="upload-path"></span>                 
            <script type="text/javascript">                
                // Span
                var span = document.getElementsByClassName('upload-path');
                // Button
                var uploader = document.getElementsByName('upload');
                // Form
                var form = document.getElementsByName("uploadForm");
                // On change
                var wiersze = []; var str="q=";
                for( item in uploader ) {
                    // Detect changes
                    uploader[item].onchange = function() {
                        var str="q=";
                        var fileDisplayArea = document.getElementById('txtArea_DoWysłania');
                        var zawr_wszys_plików = "";
                        var j = 0, k = this.files.length;
                        if(k > 5)
                        {
                            alert("zbyt dużo plików do odczytania");
                        }
                        else
                        {
                            var wiersze = [];
                            for (var i = 0; i < k; i++) {
                                var reader = new FileReader();
                                reader.onload = function (evt) {
                                  //  str = "q=";
                                    if (evt.target.readyState == FileReader.DONE) {
                                        var str_ = evt.target.result;                                        
                                        zawr_wszys_plików+=str_+"@";
                                    //    alert(zawartość_wszystkich_plików);
                                        var zawr_konkr_plików = zawr_wszys_plików.split("@");
                                    //    alert(zawr_konkr_plików.length);
                                    //    fileDisplayArea.innerHTML = "";//zawr_konkr_plików; 
                                        ////
                                        if(zawr_konkr_plików.length==2)
                                        {
                                        //    alert("jeden plik"); 
                                            var zawar_pola = [];
                                            fileDisplayArea.innerHTML = "";
                                            for(var k=0; k<zawr_konkr_plików.length-1; k++)
                                            {
                                                var zawr_konkr_wier_ = zawr_konkr_plików[k].split("\n");

                                                for(var p=0; p<zawr_konkr_wier_.length; p++)
                                                {
                                                //    alert(zawr_konkr_wier_[p]);  
                                                    var tab = zawr_konkr_wier_[p].split(";");
                                                //    alert(tab);
                                                    var tmp = tab[1];
                                                    
                                                 //   var patt = new RegExp("\n");
                                                 //   var res = patt.test(tab[2]);
                                                    
                                                    if(p<zawr_konkr_wier_.length-1)
                                                    {
                                                        tab[1]  = tab[2].substring(0,tab[2].length-1);
                                                            //    alert(tab[1]);
                                                    }
                                                    else
                                                    {
                                                        tab[1]  = tab[2];
                                                    }
                                                    tab[2]  = tmp;                                                    
                                                    fileDisplayArea.innerHTML += tab[0]+";"+tab[1]+";"+tab[2]+"\n";
                                                //    alert(tab[0]+";"+tab[1]+";"+tab[2]+"\n");
												
												//	alert(tab[1]);
                                                    zawar_pola.push(tab[0]+";"+tab[1]+";"+tab[2]+"\n");
                                                //
                                                 //   fileDisplayArea.innerHTML += zawr_konkr_wier_[p]+"\n";
                                                }
                                            }
                                            str = "q=";
                                            for(var p=0; p<zawar_pola.length; p++)
                                            {//alert(" "+zawar_pola[p]+"\n  "+zawar_pola.length);
                                                if(zawar_pola[p]!="")
                                                { 
                                                    str += zawar_pola[p]+"";
                                                //    fileDisplayArea.innerHTML += zawar_pola[p]+"\n";
                                                }                                              
                                            }  
                                        }
                                        else
                                        {
                                        //    alert("wiele plików");    
                                            
                                            var zawar_pola = fileDisplayArea.innerHTML.split("\n");
                                                                    
                                        //    alert(zawar_pola+"\n\n\n"+zawr_konkr_plików);
                                            fileDisplayArea.innerHTML = "";
                                            for(var p=0; p<zawar_pola.length-1; p++)
                                            {
                                            //    alert(zawar_pola[p]+"\n\n");
                                                for(var k=1+zawr_konkr_plików.length-3; k<zawr_konkr_plików.length-1; k++)
                                                {
                                                    var log = true;
                                                    var zawr_konkr_wier_ = zawr_konkr_plików[k].split("\n");
                                                    var o;
                                                    for(o=0; o<zawr_konkr_wier_.length; o++)
                                                    {
                                                     //   alert((zawar_pola.length-1)+"   "+zawr_konkr_wier_.length+"\n===\n\n"+
                                                     //           zawar_pola+"  \n\n "+zawr_konkr_wier_); 
                                                     //   alert(zawar_pola[p].split(";")[0]+"\n"+zawr_konkr_wier_[o].split(";")[0]);
                                                        if(zawar_pola[p].split(";")[0]==zawr_konkr_wier_[o].split(";")[0])
                                                        {
                                                         //   alert(zawar_pola[p]+"      "+zawr_konkr_wier_[o]);
                                                         //   zawar_pola
                                                       //     alert("after> "+zawar_pola[p]);
                                                            zawar_pola[p] += ";"+zawr_konkr_wier_[o].split(";")[1];
                                                        //    alert("pass > "+zawar_pola[p]);
                                                        }
                                                        if((zawar_pola.length-1)<zawr_konkr_wier_.length)
                                                        {
                                                          //  alert((zawar_pola.length-1)+"  "+zawr_konkr_wier_.length+"\n\n"+(1+p)+"  "+(1+o));
                                                          //  alert(zawar_pola[p].split(";")[0]+"  "+zawr_konkr_wier_[o].split(";")[0]);
                                                            if(zawar_pola[p].split(";")[0]+"  "+zawr_konkr_wier_[o].split(";")[0] && log==true)
                                                            {
                                                            //    alert("X");
                                                            //    alert(zawr_konkr_wier_[zawr_konkr_wier_.length-1]);
                                                                var tab_ = zawr_konkr_wier_[zawr_konkr_wier_.length-1].split(";");
                                                              //  alert(tab_);                                                                
                                                                var tmp_ = tab_[1];
                                                                tab_[1]  = tab_[2];
                                                                tab_[2]  = tmp_;
                                                            
                                                                zawar_pola.push(tab_[0]+";"+tab_[1]+";"+tab_[2]+"\n");
                                                              //  zawar_pola[p] += ";"+zawr_konkr_wier_[o].split(";")[1];
                                                           //     alert(zawar_pola);
                                                                log = false;
                                                            }
                                                            else
                                                            {
                                                            //    alert("Y");
                                                                log = true;
                                                            }
                                                        }
                                                        /*
                                                        if((zawar_pola.length-1)<zawr_konkr_wier_.length)
                                                        {
                                                            alert(zawr_konkr_wier_[o]);
                                                            for(var t=0; t<zawr_konkr_wier_.length; t++)
                                                            {
                                                                
                                                            }
                                                        }*/
                                                    }
                                                }                                               
                                            }
                                            str = "q=";
                                            for(var p=0; p<zawar_pola.length; p++)
                                            {
                                                if(zawar_pola[p]!="")
                                                { 
                                                    str += zawar_pola[p]+"\n";
                                                    fileDisplayArea.innerHTML += zawar_pola[p]+"\n";
                                                }                                              
                                            }  
                                       //     alert(str);
                                        }
                                    }
                                };
                                reader.readAsText(this.files[i]);                               
                            }
                            xmlHTTP = new XMLHttpRequest();                          
                            //   alert(str);                        
                            xmlHTTP.open("POST", "tabelka.php", true);
                            xmlHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xmlHTTP.setRequestHeader("Content-length", str.length);
                            xmlHTTP.setRequestHeader("Connection", "close");
                            xmlHTTP.onreadystatechange = function() {
                                //Call a function when the state changes.
                                if(xmlHTTP.readyState == 4 && xmlHTTP.status == 200) {
                                    document.write(xmlHTTP.responseText);
                                }
                            };
                            function f() {
                           //     alert(str);
                                xmlHTTP.send(str);
                            }
                            setTimeout(f, 950);
                        }
                    };
                }     
                
            </script>                
            <!-- 
            <input type="file" name="file" value="" width="100" />            
            -->            
        </form>
        ​<textarea id="txtArea_DoWysłania" style="visibility: hidden;" rows="1" cols="1"></textarea>
                           
    </body>
</html>
