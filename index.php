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
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-2" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/przycisk.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
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
           <!-- -->   <input type="submit" value="Odczytaj" name="submit" class="title" style="visibility: collapse"/> 
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
                        var fileDisplayArea = document.getElementById('fileDisplayArea');
                        var textType = /text.*/;
                        var file = [];
                        var _s; 
                        var s_;
                        var str = "q=";
                                              
                      //  alert(this.files[1].name+"   "+this.files.length);
                     /*   for(var x=0;x<this.files.length;x++){
                           // alert(this.files[x].name+"  "+x);
                           // setTimeout(g, 1000);
                       //     span[0].innerHTML = this.files[x].name;  
                          //  alert();    
                            file.push(this.files[x]); 
                        }*/
                        
                          //  if(file[x].type.match(textType))
                         //   {
                             //   var reader = new FileReader();  
                              //  alert(file[x]);
                              //  setTimeout(g, 1000);
                            /*    reader.onload = function(e) {
                                //  alert(reader.result);
                                    var s  = reader.result.split("\n"); 
                                    _s = "";  
                                    for(var u=0; u<s.length; u++)
                                    { 
                                    //    alert(s[u]);
                                        var a = s[u];                               
                                        for (n = 1; n < a.length; ++n)
                                        {
                                         //   alert(a[n]);
                                            _s += a[n];
                                        }   
                                        _s +="\n";
                                    }     
                                //    str += reader.result+"\n";  
                                    str += _s;                      
                                //    alert(str);
                                };*/
                           //     reader.readAsText(file);  
                                
                                var j = 0, k = this.files.length;
                                for (var i = 0; i < k; i++) {
                                    var reader = new FileReader();
                                 //   alert();
                                     reader.onloadend = function (evt) {
                                        if (evt.target.readyState == FileReader.DONE) {
                                            
                                         //   alert(evt.target.result+"");
                                            
                                           // data["File_Content" + j] = evt.target.result;
                                            str += evt.target.result+"\n";
                                            
                                            j++;
                                        /*    if (j == k){
                                                alert('All files read');
                                            }*/
                                        }
                                    };
                                    reader.readAsBinaryString(this.files[i]);
                                }
                                /*
                                
                                
                                var j = 0, k = files.length;
                                for (var i = 0; i < k; i++) {
                                    var reader = new FileReader();
                                    reader.onloadend = function (evt) {
                                        if (evt.target.readyState == FileReader.DONE) {
                                            data["File_Content" + j] = btoa(evt.target.result);
                                            j++;
                                            if (j == k){
                                                alert('All files read');
                                            }
                                        }
                                    };
                                    reader.readAsBinaryString(files[i]);
                                }
                                
                                */
                              //  alert(_s);                                
                              //  alert(str);   
                         /*   }
                            else 
                            {
                                fileDisplayArea.innerText = "File not supported!";
                            }*/
                           // alert(x);
                    //    }
                        
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
                        //    alert(str);
                            xmlHTTP.send(str);
                        }
                        setTimeout(f, 800);
                      //  xmlHTTP.send(str);
                    };
                }    
            </script>                
            <!-- 
            <input type="file" name="file" value="" width="100" />            
            -->            
        </form>
           
        <pre id="fileDisplayArea">
            

        </pre>
        
    </body>
</html>
