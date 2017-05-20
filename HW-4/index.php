    <?php
        require_once __DIR__.'/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
        $fb = new Facebook\Facebook(['app_id' => '133216680547582','app_secret' => '90826c4213a18d4acb68a88331d80fff',
                   'default_graph_version' => 'v2.8',
                    ]);



        try
        {
            if($_GET["type"]=="details")
            {
               
/*
$a=array();
$a["a"]="o".$_GET["keyword"]."p";
    echo json_encode($a);
    */


  //echo("<script>console.log('PHP:ggggggggg');</script>");


  //echo("<script>console.log('PHP:ggggggggg');</script>");
   $id=$_GET["id"];
    //$picture=$_GET["url"];

$response=$fb->get('/'.$id.'?fields=id,name,picture.width(700).height(700),albums.limit(5){name,photos.limit(2){name, picture}},posts.limit(5)&access_token=EAAB5KOzsFP4BAG3ltqn2Taznj52DGNYuqxJ1YtSdGl0TpZB4pCVFZAkqt3H3FESZALvXZAEl4ra82ZCUNKQWN8r8CtAp2ZBOZBC79DVZAKrZAtuZCJW4oYjBlh5eZCOD0UQ8f2LYQlBmZBLw3Nyyo1nEcW1T');
//echo $response;
$fb_response=json_decode($response->getBody(),true);
$all_details=array();
$result=array();
$result_posts=array();
$count=1;

$name=$fb_response["name"];



if(!isset($fb_response["albums"])||count($fb_response["albums"]["data"])==0)
{

        $result["no_albums"]="No Albums Have Been Found";
}
else
{




foreach($fb_response["albums"]["data"] as $item)
{
 $count+=1;

if(!isset($item["photos"]))
  {

    $result[$count]=array("name"=>$item["name"]);

  }
  
  else{

    $imgs=array();
    $img_count=0;
    
    for($i=0;$i<count($item["photos"]["data"]);++$i)
    {
      
     
      $id= $item["photos"]["data"][$i]["id"];
      $hd_res=$fb->get('/'.$id.'/picture?redirect=false&access_token=EAAB5KOzsFP4BAG3ltqn2Taznj52DGNYuqxJ1YtSdGl0TpZB4pCVFZAkqt3H3FESZALvXZAEl4ra82ZCUNKQWN8r8CtAp2ZBOZBC79DVZAKrZAtuZCJW4oYjBlh5eZCOD0UQ8f2LYQlBmZBLw3Nyyo1nEcW1T');
      
       $hd=json_decode($hd_res->getBody(),true);
       $src=$hd["data"]["url"];
       $imgs[$img_count]=$src;//$item["photos"]["data"][$i]["picture"];

       $img_count+=1;
    
  }
  //$result[$count]=array("name"=>$item["name"]);
  $result[$count]=array('name'=>$item['name']);
  $temp=$result[$count];
       //array_push($temp,'asd'=>1);
 
  for($i=0;$i<count($imgs);++$i)
    {
 
// array_push($result[$count],$i=>$imgs[$i]);
       $temp = array_merge($temp, array($i=>$imgs[$i]));  
       $result[$count]=$temp;

   }

}


}
}

//posts
$post_count=0;
if(!isset($fb_response["posts"])||count($fb_response["posts"]["data"])==0)
{
         $result["no_posts"]="No posts have been Found";
}

else{

foreach($fb_response["posts"]["data"] as $item)
{
  $post_count+=1;
  
    if(!isset($item["message"]))
    {

    }
    else
    {
    $result_posts[$post_count]=array("name"=>$name,"message"=>$item["message"],"date"=>$item["created_time"],);

  }

}

}

$all_details["posts"]=$result_posts;


$all_details["albums"]=$result;
$json = json_encode($all_details);
//json_decode($response->getBody(),true));
//echo $json;
//$data2=array('Djokovic' => array(1=>2), 'Federuer' => array(1=>3));

//$json2 = json_encode($data2);
echo $json;
}
            
            
            
            
            //If the type is users,pages,groups
            elseif($_GET["type"]=="user"||$_GET["type"]=="page"||$_GET["type"]=="group")
            {
                $keyword=$_GET["search"];
                $type=$_GET["type"];
            $response=$fb->get('/search?q='.$keyword.'&type='.$type.'&fields=%20id,name,picture.width(700).height(700)&access_token=EAAB5KOzsFP4BAG3ltqn2Taznj52DGNYuqxJ1YtSdGl0TpZB4pCVFZAkqt3H3FESZALvXZAEl4ra82ZCUNKQWN8r8CtAp2ZBOZBC79DVZAKrZAtuZCJW4oYjBlh5eZCOD0UQ8f2LYQlBmZBLw3Nyyo1nEcW1T');
            //echo $response;
            $fb_response=json_decode($response->getBody(),true);

            $data=array();
            $count=1;
            foreach($fb_response["data"] as $item)
            {
                $id= $count;
                $count=$count+1;
                $data[$id]=array("id"=>$item["id"],"name"=>$item["name"],"url"=>$item["picture"]["data"]["url"],"index"=>$count-1);
            }

            //$data["paging"]=array("next"=>$fb_response["paging"]["next"]);
               /* if(isset(fb_response["paging"]["previous"]))
                {
                    $data["next"]=array("next"=>$fb_response["paging"]["next"]);
                    $data["previous"]=array("next"=>$fb_response["paging"]["next"]);
                }
                else
                {
                  $data["next"]=array("next"=>$fb_response["paging"]["next"]);  
                }*/
                
                $data["next"]=array("next"=>$fb_response["paging"]["next"]); 
            $json = json_encode($data);//json_decode($response->getBody(),true));
            echo $json;
            }
            
            
            
            //If the type is events
            elseif($_GET["type"]=="event")
            {
                $keyword=$_GET["search"];
                $type=$_GET["type"];
                $response = $fb->get('search?q='.$keyword.'&type='.$type.'&fields=id,name,picture.width(700).height(700),place', 'EAAB5KOzsFP4BAG3ltqn2Taznj52DGNYuqxJ1YtSdGl0TpZB4pCVFZAkqt3H3FESZALvXZAEl4ra82ZCUNKQWN8r8CtAp2ZBOZBC79DVZAKrZAtuZCJW4oYjBlh5eZCOD0UQ8f2LYQlBmZBLw3Nyyo1nEcW1T');
                //echo "event";
                $fb_response=$response->getDecodedBody();            
             
            $data=array();
            $count=1;
            foreach($fb_response["data"] as $item)
            {
                $id= $count;
                $count=$count+1;
                $data[$id]=array("id"=>$item["id"],"name"=>$item["name"],"url"=>$item["picture"]["data"]["url"],"index"=>$count-1);
            }

            //$data["next"]=array("next"=>$fb_response["paging"]["next"]);
               /* if(isset(fb_response["paging"]["previous"]))
                {
                    $data["next"]=array("next"=>$fb_response["paging"]["next"]);
                    $data["previous"]=array("next"=>$fb_response["paging"]["next"]);
                }
                else
                {
                  $data["next"]=array("next"=>$fb_response["paging"]["next"]);  
                }*/
                $data["next"]=array("next"=>$fb_response["paging"]["next"]);  
            $json = json_encode($data);//json_decode($response->getBody(),true));
            echo $json;
            }


            //If the type is places
            elseif($_GET["type"]=="place")
            {
                $keyword=$_GET["search"];
                $type=$_GET["type"];
                $response=$fb->get('/search?q='.$keyword.'&type='.$type.'&fields=%20id,name,picture.width(700).height(700)&access_token=EAAB5KOzsFP4BAG3ltqn2Taznj52DGNYuqxJ1YtSdGl0TpZB4pCVFZAkqt3H3FESZALvXZAEl4ra82ZCUNKQWN8r8CtAp2ZBOZBC79DVZAKrZAtuZCJW4oYjBlh5eZCOD0UQ8f2LYQlBmZBLw3Nyyo1nEcW1T');
            //echo $response;
            $fb_response=json_decode($response->getBody(),true);

            $data=array();
            $count=1;
            foreach($fb_response["data"] as $item)
            {
                $id= $count;
                $count=$count+1;
                $data[$id]=array("id"=>$item["id"],"name"=>$item["name"],"url"=>$item["picture"]["data"]["url"],"index"=>$count-1);
            }

                /*if(isset(fb_response["paging"]["previous"]))
                {
                    $data["next"]=array("next"=>$fb_response["paging"]["next"]);
                    $data["previous"]=array("next"=>$fb_response["paging"]["next"]);
                }
                else
                {
                  $data["next"]=array("next"=>$fb_response["paging"]["next"]);  
                }*/
                $data["next"]=array("next"=>$fb_response["paging"]["next"]);  
            $json = json_encode($data);//json_decode($response->getBody(),true));
            echo $json;
            }
        }
        catch(Facebook\Exceptions\FacebookResponseException $e) 
        {
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


    ?>