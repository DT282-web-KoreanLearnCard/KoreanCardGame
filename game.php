<?php
session_start();
$cardNum = $_POST['pattern'];
$category = $_POST['category'];
$connect = mysqli_connect("localhost","klearning","webproject","klearning", 3306);
$maxNum = $cardNum * $cardNum;
$word=array();
$saveId=array();
$click=array(0,0);
$id=$_SESSION['id'];

function insert(){
    global $connect,$cardNum,$category,$id;

    if(!isset($_SESSION['id'])){
        echo "You cannot save the data";
        echo "You should log in to save it";
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
    <link type="text/css" rel="stylesheet" href="game.css" id="creative">

</head>
<body>

<?php
loadword();
makeCard();
?>

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
            document.getElementById(click[0]).style.backgroundColor='hotpink';
            indexs[0]=index;
        }
        else{
            var firstindex = saveIds[indexs[0]];
                if(firstindex%2==0){
                    if(saveIds[index]==firstindex+1){
                        document.getElementById(id).style.backgroundColor='black';
                        document.getElementById(click[0]).style.backgroundColor='black';
                        count++;
                        click[0]='';
                        indexs[0]=-1;
                    }
                }
                else{
                    if(saveIds[index]==firstindex-1){
                        document.getElementById(id).style.backgroundColor='black';
                        document.getElementById(click[0]).style.backgroundColor='black';
                        count++;
                        click[0]='';
                        indexs[0]=-1;
                    }
                }
            if(click[0]!=''){
                document.getElementById(click[0]).style.backgroundColor='deepskyblue';
                click[0]='';
                indexs[0]=-1;
            }
            if(count==(cardNum*cardNum)/2){
                alert("Success! <?php echo insert() ?>");

            }
        }

    }
</script>

</body>
<html>


