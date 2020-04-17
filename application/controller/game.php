<?php
include '../model/dbConnect.php';
session_start();
$cardNum = $_POST['pattern'];
$category = $_POST['category'];
$maxNum = $cardNum * $cardNum;
$word=array();
$saveId=array();
$click=array(0,0);
$id=$_SESSION['id'];

function insert(){
    global $connect,$cardNum,$category,$id;

    if(!isset($_SESSION['id'])){
        echo "You cannot save the data. ";
        echo "You should log in to save it.";
    }
    else{
        $sql="insert into gamelog(userid,score,categoryid) values('".$_SESSION['id']."',".$cardNum.",".$category.")";
        if($connect->query($sql)===TRUE) {
            echo $_SESSION['id'] . ", your point and game log saved successfully";
        }
        else{
            echo "Error, Data not saved";
        }
    }
}


function loadWord(){
    global $category,$word,$connect;

    if(!$connect) die('Not connected : ' . mysqli_error());

    $sql="select eword,kword from wordlist where categoryid=".$category." order by rand()";
    $result=mysqli_query($connect,$sql);
    $i=0;
    while($r = mysqli_fetch_assoc($result)){
        $word[$i++]=$r['eword'];
        $word[$i++]=$r['kword'];
    }


}
function random($min,$max,$num){
    $arr = array();
    $k=0;
    while($num>count($arr)){
        $i = rand($min,$max);
        if($k==0){
            $arr[$k++]=$i;
        }
        else {
            for ($j = 0; $j < $k; $j++) {
                if ($arr[$j] == $i){
                    break;
                } else {
                    if ($j == $k-1) {
                        $arr[$k++] = $i;
                        break;
                    }
                }
            }
        }
    }
    return $arr;
}

function saving($arr,$cnt){
    global $saveId;
    $saveId[$cnt]=$arr[$cnt];
}

function call(){
    global $saveId;
    $saveIds = json_encode($saveId);
    return $saveIds;
}


function makeCard(){
    global $maxNum,$cardNum,$word,$saveIds,$saveId;
    $cnt=0;
    $arr = random(0,$maxNum-1,$maxNum);

    for($i=0; $i<$cardNum; $i++){
        echo "<div class='bord'>";
        for($j=0;$j<$cardNum;$j++){
            $str = "card".$cnt;
            echo "<div class='card' id='".$str."' onclick=change(this.id,".$cnt.")>";
            saving($arr,$cnt);
            echo $word[$arr[$cnt++]];
            echo "</div>";
        }
        $saveIds = json_encode($saveId);
        echo "</div>";
    }

}
?>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Game</title>
    <link type="text/css" rel="stylesheet" href="../../static/css/game.css" id="creative">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../static/css/nav.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner" id="header"></header>
<script>
    $(function(){
        $('#header').load('../../static/navbar.html');
    })
</script>

<div class="main">
    <div class="signup-content">
        <?php
            loadword();
            makecard();
        ?>
        <div class = "animate" style = "background:rgb(81, 238, 162);height:0px; width:0px; display:inline-block;text-align:center;margin-left: 2px;border-radius: 50%; position: fixed; top: 30%; left: 30%;"></div>
    </div>
</div>
<script>
    var click = ['',''];
    var indexs = [-1,-1];
    var str="";
    var count =0;
    var cardNum = <?php echo $cardNum ?>;

    var saveIds = <?php echo call() ?>;

    //var saveIds = new Array(</?php echo implode(',',$saveId);?>);

    function change(id,index){
        if(click[0]==''){
            click[0]=id;
            document.getElementById(click[0]).style.backgroundColor='grey';
            indexs[0]=index;
        }
        else{
            var firstindex = saveIds[indexs[0]];
                if(firstindex%2==0){
                    if(saveIds[index]==firstindex+1){
                        document.getElementById(id).style.backgroundColor='white';
                        document.getElementById(click[0]).style.backgroundColor='white';
                        count++;
                        click[0]='';
                        indexs[0]=-1;
                    }
                }
                else{
                    if(saveIds[index]==firstindex-1){
                        document.getElementById(id).style.backgroundColor='white';
                        document.getElementById(click[0]).style.backgroundColor='white';
                        count++;
                        click[0]='';
                        indexs[0]=-1;
                    }
                }
            if(click[0]!=''){
                document.getElementById(click[0]).style.backgroundColor='black';
                click[0]='';
                indexs[0]=-1;
            }
            if(count==(cardNum*cardNum)/2){
                alert("Success! <?php echo insert() ?>");
                var div = $(".animate");

                div.animate({
                    height: '300px',
                    width: '300px'
                }, 2000);

                div.animate({
                    height: '0px',
                    width: '0px'
                }, 200);

                setTimeout(function(){location.replace("../view/card_index.html")}, 3000);

            }
        }

    }
</script>

</body>
<html>


