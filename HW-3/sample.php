
            <html>
                <head>
                    
                    
                    <script>
                        function myAlbums()
                        {
                            
                            var mydiv=document.getElementById('divAlbums');
                            if(mydiv.style.display==='block'||mydiv.style.display==='')
                                mydiv.style.display='none';
                            else
                                mydiv.style.display='block';
                            
                        }
                    function swipe()
                {
                    //imgsrc=$pic_url;
                    //window.open(imgsrc);
                    window.open(this.src)
                    //return true;
                }
                     
                    
                        function hidediv() {
                    var ddlPassport = document.getElementById("state");
                    var dvPassport = document.getElementById("hidediv");
                    dvPassport.style.display = ddlPassport.value == "place" ? "block" : "none";
                }
                    </script>
                    
                   
                    
                    
                    <script>
                    function formReset()
                {
                    document.getElementById("myForm").reset();
                }

                    </script>
                    
                    
                    
                <style>
                    #mainbox
                    {
                        width: 600px;
                        margin: 0 auto;
                        border: 1px solid grey;
                        padding: 10px;
                        line-height: 20pt;
                        background-color:lightgrey;
                    }
                    #displayTable
                    {
                        width: 618px;
                        margin: 0 auto;
                        border: 1px solid grey;
                        padding: 10px;
                        line-height: 20pt;

                    }
                    #detailsbox
                    {
                        width: 600px;
                        margin: 0 auto;
                        border: 1px solid grey;
                        padding: 10px;
                        line-height: 20pt;
                        background-color:lightgrey;
                    }
                    #divAlbums
                    {
                        width: 600px;
                        margin: 0 auto;
                        border: 1px solid grey;
                        padding: 10px;
                        line-height: 20pt;
                        background-color:lightgrey;
                    }
                    #divPosts
                    {
                        width: 600px;
                        margin: 0 auto;
                        border: 1px solid grey;
                        padding: 10px;
                        line-height: 20pt;
                        background-color:lightgrey;
                    }
                    #divDetails
                    {
                        width: 600px;
                        margin: 0 auto;
                        border: 1px solid grey;
                        padding: 10px;
                        line-height: 20pt;
                        background-color:lightgrey;
                    }
                </style>
                </head>
                
                
                
                <body>
                    
                    
                    <?php
                // define variables and set to empty values
                    $name = $email= $p_id="";
                    $loc = $dist= "";
                    //$flag=TRUE;
                     

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  $name = test_input($_POST["keyword"]);
                  $email = test_input($_POST["state"]);

                    //echo $name;
                    //echo $email;
                }

                function test_input($data) {
                  $data = trim($data);
                  $data = stripslashes($data);
                  $data = htmlspecialchars($data);
                  return $data;
                }
                    
                    
                ?>
                    
                    
                    
                    <div id="mainbox">

                <form id="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
                <h2 style="text-align: center;font-size:27px;font-family:tahoma;font-weight:300;margin-top:7px;"><i>Facebook Search</i></h2>
                                <hr style="margin-top:2px;color:darkgrey;">
                                Keyword: 
                        <input type="text" name="keyword" value="" required>
                        <br>
                    Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                <select name="state" id ="state" onchange="hidediv()">
                <br>
                                <option value="user">Users</option>
                                <option value="page">Pages</option>
                                <option value="event">Events</option>
                                <option value="place">Places</option>
                                <option value="group">Groups</option>
                                </select>
                                <br>

                    <div id="hidediv" style="display:none">
                            Location <input type="text" name="location" id="location" size="25"/>   
                            Distance(meters) <input type="text" name="distance" id="distance"/> 
                                </div>

                    

                    <div id="button_group">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;Search</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <button type="reset" onclick="formReset()" value="Reset form">&nbsp;Clear&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                            <br/>
                        </div>
                
                </form>
            </div>
                   
                    
                     
                    
                    <div id="secondbox">

                    <?php   
                    
                    //DIV FOR THE TABLE// 
                        
                        
                        $counter = 0;
                $_GET['detailsFlag'] = 0;
                if($_GET['detailsFlag'] == 0 || !(isset($_GET['detailsFlag'])))
                {   
                    $counter ++;
                    $_GET['detailsFlag'] = 1;
                    
                    
                     
                    
                    require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
                    $fb=new Facebook\Facebook(['app_id'=>'133216680547582','app_secret'=>'90826c4213a18d4acb68a88331d80fff','default_graph_version'=>'v2.8',]);
                    $fb->setDefaultAccessToken('EAAB5KOzsFP4BAG3ltqn2Taznj52DGNYuqxJ1YtSdGl0TpZB4pCVFZAkqt3H3FESZALvXZAEl4ra82ZCUNKQWN8r8CtAp2ZBOZBC79DVZAKrZAtuZCJW4oYjBlh5eZCOD0UQ8f2LYQlBmZBLw3Nyyo1nEcW1T');
                    //echo "<div id=\"divDetails\">";
                    
                    
                     if(isset($_GET['Details']) and isset($_GET['albums']))
                        {
                            echo "<div id=\"divAlbums\">";
                            $query = "/".$_GET['Details']."/"."albums";
                            //echo $query;
                            $res = $fb->get($query);
                            $re = $res -> getDecodedBody();
                            $count = 0;
                            foreach ($re['data'] as $album)
                            {
                                echo "<a href=''>".$album['name']."</a>";
                                echo "<br>";
                                
                                echo "<br>";
                                $count ++;
                                if($count == 5)
                                {
                                    break;
                                }
                            }
                            
                            
                            /*$response = $fb->get(''.$_GET['Details'].'?&fields=id,name,picture,width(700),height(700),albums.limit(5){name,photos,limit(2){name,picture}}', 'EAACIoCZBlIPkBAJFxoBTF8d8Wtk0WZC7HIRHvlxaIMdLvJLA38ufxx4LJc1FBPRRKPDLY0Qddvv1ZBoykfuA0WN3bLPw16nokEGn5wervRMvbXH98AfqG8x5wv1IUGeaD3OS0yCf3L9yogLcNeedje0lbqsTX4ZD');
                            $fb_response=$response->getDecodedBody();
                            print_r($fb_response);*/
                            
                            
                            echo "</div>";
                           // var_dump($re);
                        }
                           echo "<div id=\"divPosts\">";
                        if(isset($_GET['Details']) and isset($_GET['posts']))
                        
                        
                        {
                            $query = "/".$_GET['Details']."/"."posts";
                            //echo $query;
                            $res = $fb->get($query);
                            $re = $res -> getDecodedBody();
                            $count = 0;
                            foreach ($re['data'] as $post)
                            {
                                echo $post['message'];
                                echo "<br>";
                                $count ++;
                                if($count == 5)
                                {
                                    break;
                                }
                            }
                            //var_dump($re);
                        }
                    
                    echo "</div>";
                    if(isset($_GET['details_flag']))
                        {
                               // echo $_GET['details_flag'];
                                echo "<div id='detailsbox'>";
                                echo "<a href='sample.php?Details=".$_GET['details_flag']."&albums=1"."'>albums</a>";
                                echo "<br>";
                            echo "</div>";
                                echo "<br>";
                            echo "<div id='detailsbox'>";
                                echo "<a href='sample.php?Details=".$_GET['details_flag']."&posts=1"."'>posts</a>";
                                echo "</div>";
                        }
                    //echo "</div>";
                    try {

                        if($email=="user"||$email=="page"||$email=="group")
                        {
                            $response = $fb->get('search?q='.$name.'&type='.$email.'&fields=id,name,picture.width(700).height(700)', 'EAAB5KOzsFP4BAG3ltqn2Taznj52DGNYuqxJ1YtSdGl0TpZB4pCVFZAkqt3H3FESZALvXZAEl4ra82ZCUNKQWN8r8CtAp2ZBOZBC79DVZAKrZAtuZCJW4oYjBlh5eZCOD0UQ8f2LYQlBmZBLw3Nyyo1nEcW1T');
                             $fb_response=$response->getDecodedBody();
                            
                        
                            
                        }
                        if($email=="place")
                        {
                        $loc = test_input($_POST["location"]);
                        $dist = test_input($_POST["distance"]);
                        $geoURL = "https://maps.googleapis.com/maps/api/geocode/json?address=";
                         $geoKey = "AIzaSyDzJOkanrsOuaNDzaUdSRLlmlsHczJ0dwg";
                         $address = urlencode($name);
                         $geoURL = $geoURL . $address;
                         $geoURL = $geoURL . $address . "&key=" . $geoKey;
                        //echo $geoURL;

                        $jsonData   = file_get_contents($geoURL);

                        $data = json_decode($jsonData,true);
                        //print_r($data);
                         $lat = $data['results']['0']['geometry']['location']['lat'];
                        $lng = $data['results']['0']['geometry']['location']['lng'];

                    //echo $lat;
                    //echo $lng;
                    //echo $loc;
                    //echo $dist;
                       $response = $fb->get('search?q='.$name.'&type='.$email.'&center='.$lat.','.$lng.'&distance='.$dist.'&fields=id,name,picture.width(700).height(700)', 'EAAB5KOzsFP4BAG3ltqn2Taznj52DGNYuqxJ1YtSdGl0TpZB4pCVFZAkqt3H3FESZALvXZAEl4ra82ZCUNKQWN8r8CtAp2ZBOZBC79DVZAKrZAtuZCJW4oYjBlh5eZCOD0UQ8f2LYQlBmZBLw3Nyyo1nEcW1T');
                             $fb_response=$response->getDecodedBody();
                        }
                        
                        if($email=="event")
                        {
                            $response = $fb->get('search?q='.$name.'&type='.$email.'&fields=id,name,picture.width(700).height(700),place', 'EAAB5KOzsFP4BAG3ltqn2Taznj52DGNYuqxJ1YtSdGl0TpZB4pCVFZAkqt3H3FESZALvXZAEl4ra82ZCUNKQWN8r8CtAp2ZBOZBC79DVZAKrZAtuZCJW4oYjBlh5eZCOD0UQ8f2LYQlBmZBLw3Nyyo1nEcW1T');
                            //echo "event";
                             $fb_response=$response->getDecodedBody();
                            
                        }
                        //$resp = $fb->get('/me','EAACIoCZBlIPkBAJFxoBTF8d8Wtk0WZC7HIRHvlxaIMdLvJLA38ufxx4LJc1FBPRRKPDLY0Qddvv1ZBoykfuA0WN3bLPw16nokEGn5wervRMvbXH98AfqG8x5wv1IUGeaD3OS0yCf3L9yogLcNeedje0lbqsTX4ZD');
                        //$userNode = $response->getGraphUser();

                        //$plainOldArray=$resp->getDecodedBody();
                       //$fb_response=json_decode($response->getBody(),true);
                        //$fb_response=$response->getDecodedBody();
                        //$fb_response=json_decode($userNode,true);
                        //print_r($fb_response);
                        //print_r($plainOldArray);


                        

                    } 
                    catch(Facebook\Exceptions\FacebookResponseException $e) {
              // When Graph returns an error
                        echo 'Graph returned an error: ' . $e->getMessage();
                        exit;
                    } 
                    catch(Facebook\Exceptions\FacebookSDKException $e) 
                        {
                            // When validation fails or other local issues
                            echo 'Facebook SDK returned an error: ' . $e->getMessage();
                            exit;
                            //echo 'Logged in as ' . $userNode->getName();

                        }
                

                    
                    if(empty($fb_response))
                    {
                        echo "<div id=\"mainbox\">";
                        echo "<p>No Records found</p>";
                        echo "</div>";
                    }

                    else
                    {
                     if($email=="user"||$email=="place"||$email=="group"||$email=="page")
                     {
                         //echo $email;
                    echo "<table  align=\"center\" border =\"2px\" id=\"displayTable\" >";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Profile Photo</th>";
                    echo "<th>Name</th>";
                    echo "<th>Details</th>";

                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    foreach($fb_response as $respo)
                    {
                       foreach($respo as $i)
                       {

                           $profile_pic =  isset($i["id"])?"https://graph.facebook.com/".$i["id"]."/picture?width=30&height=40":" ";
                           $pic_url = isset($i["id"])?"https://graph.facebook.com/".$i["id"]."/picture?width=30&height=40&redirect=false":" ";
                           echo "<tr>";
                           echo "<td><img src=\" " . $profile_pic . "\" onclick=\"window.open(this.src)\"></td>";
                           $name=isset($i["name"])?$i["name"]:" ";
                           //$id=isset($i["id"])?$i["id"]:" ";
                           
                            echo "<td>$name </td>";
                           
                          //echo "<td><a href=\"http://cs-server.usc.edu:12339/sample.php?id=true">Details</a></td>";
                           //echo "<td"><a href=?id=".$id.">"."Details"."</a></td>";
                           
                           //echo "<td><a style=\"text-decoration:underline;\" onclick=myFunction(pid);>Details</a></td>";
                           
                           //echo "<td><a href='sample.php?details_flag=".$i["id"]."'>details</a></td>";
                           
                            echo "<td><a href='sample.php?details_flag=".$i['id']."'>details</a></td>";
                           
                           echo "</tr>";
                            
                       }

                   }
                         
                         /*function myFunction()
                            {
                                echo "document.getElementById('secondbox').innerHTML = '';";
                                echo '<script type="text/javascript" language="javascript">';
                            }*/
                         
                         

                    echo "</tbody>";
                    echo "</table>";
                    }
                        
                        
                  
                    if($email=="event")
                    {
                        echo "event page";
                        echo "<table  align=\"center\" border =\"2px\" id=\"displayTable\" >";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Profile Photo</th>";
                        echo "<th>Name</th>";
                        echo "<th>Place</th>";

                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        foreach($fb_response as $respo)
                        {
                       foreach($respo as $i)
                       {

                           $profile_pic =  isset($i["id"])?"https://graph.facebook.com/".$i["id"]."/picture?width=30&height=40":" ";
                           $pic_url = isset($i["id"])?"https://graph.facebook.com/".$i["id"]."/picture?width=30&height=40&redirect=false":" ";
                           echo "<tr>";
                           echo "<td><img src=\"" . $profile_pic . "\" onclick=\"window.open(this.src)\"></td>";
                           $name=isset($i["name"])?$i["name"]:" ";
                           
                            echo "<td>$name </td>";
                           $place=isset($i["place"]["name"])?$i["place"]["name"]:" ";
                           echo "<td>$place </td>";
                           echo "</tr>";
                           

                       }

                   } 
                        echo "</tbody>";
                    echo "</table>";
                    }
                      
                    }
                          
                }
                        else
                {
                    //echo "1";
                    $counter ++;
                    $_GET['detailsFlag'] = 0;
                    
                    //details flow
                    
                   echo "<p>not found!!!</p>";
                    
                    //details flow
                    
                }
                        
                        ?>

                    </div>
                    
                    
                    
                   
                  
                     
                    
                    
                </body>
                </html>