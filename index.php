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
                var wiersze = [];
                for( item in uploader ) {
                    // Detect changes
                    uploader[item].onchange = function() {
                        var fileDisplayArea = document.getElementById('txtArea_DoWysłania');
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
                                    if (evt.target.readyState == FileReader.DONE) {   
                                        
                                        var zawartosc_pliku = evt.target.result;
                                       // fileDisplayArea.innerHTML = zawartosc_pliku
                                        var tabela_zawart_pliku = zawartosc_pliku.split("\n");
                                        
                                        for(var tzp_i=0;tzp_i<tabela_zawart_pliku.length;tzp_i++)
                                        {
                                            var wiersze_tab_zawart_pliku = tabela_zawart_pliku[tzp_i].split(";");                                            
                                            for(var wtzp_i=0;wtzp_i<wiersze_tab_zawart_pliku.length;wtzp_i++)
                                            {
                                                //alert(wiersze+"\n\n"+zawart_pola_tekstowego);
                                                   
                                                var zamiana = wiersze_tab_zawart_pliku[1];
                                                wiersze_tab_zawart_pliku[1] = wiersze_tab_zawart_pliku[2];
                                                wiersze_tab_zawart_pliku[2] = zamiana;
                                                alert(">  "+wiersze_tab_zawart_pliku);
                                                                                                       
                                                for(var id_wiersze=0;id_wiersze<wiersze.length;id_wiersze++)
                                                {                                                     
                                                    var okreslony_wiersz = wiersze[id_wiersze];   
                                                    
                                                }
                                                fileDisplayArea.innerHTML += wiersze_tab_zawart_pliku[wtzp_i];                                                
                                                if(wtzp_i<wiersze_tab_zawart_pliku.length-1)
                                                {
                                                //    wiersze.push(";");
                                                    fileDisplayArea.innerHTML += ";";
                                                }
                                            }
                                            for(var id_wiersze=0;id_wiersze<wiersze.length;id_wiersze++)
                                            {
                                                var tmp = wiersze[id_wiersze].split(";");
                                                //alert(id_wiersze+"-"+wiersze.length+"\n"+">\t"+wiersze[id_wiersze]+"\t<");
                                                for(var id_wiersze_=0;id_wiersze_<wiersze.length;id_wiersze_++)
                                                {
                                                    // alert(id_wiersze+"-"+wiersze.length+"\n"+">\t"+wiersze[id_wiersze]+"\t<");
                                                    var tmp_ = wiersze[id_wiersze_].split(";");
                                                    if(tmp_[2]==tmp[2])
                                                    {
                                                        if(tmp_[1]!=tmp[1])
                                                        {
                                                            alert(tmp_+"\n\n=_=_=\n\n"+tmp);
                                                            
                                                          //  wiersze[id_wiersze] = 
                                                            
                                                            alert(wiersze[id_wiersze]);
                                                                
                                                        //    tmp[1];                                                            
                                                        //    wiersze[id_wiersze] = 
                                                        }
                                                    }
                                                }
                                            }
                                            wiersze.push(tabela_zawart_pliku[tzp_i]);
                                         //   alert(wiersze_tab_zawart_pliku[0]+"\t\t"+wiersze[tzp_i]+"\n\n\t\t"+wiersze);
                                        }
                                        fileDisplayArea.innerHTML += "\n";  
                                       // wiersze.push("\n");
                                        //=======
                                        /*
                                        var zawartosc = fileDisplayArea.innerHTML;
                                
                                        var tabela_zawartosci = zawartosc.split("\n");

                                        for(var idx_tab_zawart;idx_tab_zawart<tabela_zawartosci.length-1;idx_tab_zawart++)
                                        {
                                            fileDisplayArea.innerHTML = tabela_zawartosci[idx_tab_zawart];                                    
                                        }*/
                                    }
                                };
                                reader.readAsText(this.files[i]);                               
                            }
                        }
                    };
                }     
                
            </script>                
            <!-- 
            <input type="file" name="file" value="" width="100" />            
            -->            
        </form>
        ​<textarea id="txtArea_DoWysłania" rows="30" cols="70"></textarea>
                           
    </body>
</html>
