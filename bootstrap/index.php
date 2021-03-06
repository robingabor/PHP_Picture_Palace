<?php
require('webpage.php');

require('db_connect.php');

$Conn;
ConnectDB($Conn); // csatlakozás

$query="SELECT MAX(running_time) AS MaxRunningTime
        FROM movies";
$query_result = mysqli_query($Conn,$query);
$row = mysqli_fetch_row($query_result);
$running_time = $row[0] ?? '';
$language='';
if(isset($_GET['language'])){
    $language = $_GET['language'];
}
$genre ='';
if(isset($_GET['genre'])){
    $genre = $_GET['genre'];
}


// if(count($filtered_get)){ // a $_GET superglobal nem empty, akkkor jöhet a WHERE az sql-hez
//     $sql .= "WHERE ";

//     $keynames = array_keys($filtered_get); // make array of key names from $filtered_get

//     $i = 0;
//     foreach($filtered_get as $key => $value){
//         if(strcmp($key,'running_time')==0){
//             $sql.="$key <= $value"; 
//             if (count($filtered_get) > 1 && (count($filtered_get) > $key)) { // more than one search filter, and not the last
//                 $query .= " AND";
//              }           
//         }else{
//             $sql.="$key = '$value'"; // $filtered_get keyname = $filtered_get['keyname'] value
//             if (count($filtered_get) > 1 && (count($filtered_get) > $key)) { // more than one search filter, and not the last
//                 $query .= " AND";
//              }               
//         }
             
//     }
//     $sql.=";";
//     echo $sql;
//     echo $i;
// }


function filter_by($Conn,$filterBy){
    ConnectDB($Conn); // csatlakozás
                
    $stmt = $Conn->prepare("SELECT `{$filterBy}` FROM movies ");
    // $stmt->bind_param('s',$language);

    if($stmt->execute()){
        $result = $stmt->get_result();

        if($result->num_rows >0){
            $i=0;
            while ($row = $result->fetch_assoc()) {
                $options .="<option class=".$filterBy." value=".$row[$filterBy].">".$row[$filterBy]."</option>";                
            }
            print_r($row['language']);
            return $options;
            $stmt->close();
        }
    }
}

function filter_by_duration($Conn,$running_time){
    ConnectDB($Conn); // csatlakozás
                
    $stmt = $Conn->prepare("SELECT * FROM movies WHERE running_time <=? ");
    $stmt->bind_param('i',$running_time);

    if($stmt->execute()){
        $result = $stmt->get_result();

        if($result->num_rows >0){
            $i=0;
            while ($row = $result->fetch_assoc()) {
                print_r($row);               
            }
            print_r($row['language']);
            
            $stmt->close();
        }
    }
}

filter_by_duration($Conn, $running_time);


$index = new Webpage();

//we set the content to display
$index->content = "<h2>Welcome to PHP Picture Palace<h2>";


    $index->content .= "<div class='container' >";

    //Szűrők
    
    $index->content .= "<div class='row'>";
    // Genre FILTER
    $index->content .= "<div class='col-sm-12 col-md-6 col-lg-3'>";
    $index->content .= "<div class='form-group'>";
                    $index->content .= "<h3>Genre</h3>";
                        
                        $sql = "SELECT DISTINCT(genre) FROM movies
                                ORDER BY genre ";
                       $result = mysqli_query($Conn,$sql);
                       $genres = mysqli_fetch_all($result,MYSQLI_ASSOC);

                                                    
                            $index->content .="<div class='form-group row'>";
                            $index->content .="<div class='list-group-flush'>";
                            foreach($genres as $row)
                            {
                                $index->content .="<div class=''>";
                                $index->content .="<label class='form-check-label'>";
                                    $index->content .="<input type='checkbox' class='form-check-input genre' value='".$row['genre']."' >";
                                    $index->content .=$row['genre'];
                                $index->content .="</label>";
                                $index->content .="</div>";
                            }
                            $index->content .="</div>";
                            $index->content .="</div>";                                

                $index->content .= "</div>";
            $index->content .= "</div>";
            


    // Language FILTER
    $index->content .= "<div class='col-sm-12 col-md-6 col-lg-3'>";
    $index->content .= "<div class='form-group'>";
    $index->content .= "<h3>Language</h3>";
        
        $sql = "SELECT DISTINCT(language) FROM movies
                ORDER BY language ";
       $result = mysqli_query($Conn,$sql);
       $languages = mysqli_fetch_all($result,MYSQLI_ASSOC);

                                    
            $index->content .="<div class='form-group row'>";
            $index->content .="<div class='list-group-flush'>";
            foreach($languages as $row)
            {
                $index->content .="<div class=''>";
                $index->content .="<label class='form-check-label'>";
                    $index->content .="<input type='checkbox' class='form-check-input language' value='".$row['language']."' >";
                    $index->content .=$row['language'];
                $index->content .="</label>";
                $index->content .="</div>";
            }
            $index->content .="</div>";
            $index->content .="</div>";                                

    $index->content .= "</div>";
$index->content .= "</div>";



    // Range Slider
    $index->content .= "<div class='col-sm-12 col-md-6 col-lg-3'>";
    $index->content .= "<form id='duration_select_form' >";
    $index->content .="<div class='slidecontainer'>";
    $index->content .="<label for='myRange'>Filter by Max Duration(minutes):<span id='output'></span></label>";
    $index->content .="<input type='range' min='1' max='120' value='50' name='running_time' class='slider' id='myRange'>";
    // $index->content .="<input id='myRange' type='range' min='0' max='200' oninput='output.value=myRange.value' />";
    // $index->content .="<input id='output' type='number' value='100' min='0' max='200' oninput='myRange.value=output.value' />";
    $index->content .="</div>";
    $index->content .= "</form>";
    $index->content .= "</div'>";    
    

    $index->content .= "</div>";

    // KERESŐ
    // $index->content .= "<div class=''>";
    // $index->content .= "<form action='search.php' id='search_form' >";
    // $index->content .="<label for='myRange'>If you know what you looking for: </label>";
    // $index->content .="<input type='text' placeholder='Search..' name='search' id='search'>";
    // $index->content .="<button type='submit' name='submit_search'>@</button>";
    // $index->content .= "</form>";
    // $index->content .="</div>";

    $index->content .= "</br>";

    

    // SZŰRŐVÉGE

    
    // IDE fetch-eljük a cardokat
    $index->content .= "<div id='fetch' class='row'>";
    
    $index->content .= "</div >";

    

    
    
    $index->content .= "</div >";

  

$index->Display();

?>

<!-- Jöhet egy kis jQuery a modal kezelésére -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script >

$(document).ready(function(){
    // lets submit our language selector form on change event
    $('#filteredMovies').change(function(){
        $('#language_select_form').submit();
    });
    // lets submit our genre selector form on change event
    $('#filterByGenre').change(function(){
        $('#genre_select_form').submit();
    });    

    $("#filteredMovies option[value='<?php echo $language; ?>']").attr("selected","selected");
    $("#filterByGenre option[value='<?php echo $genre; ?>']").attr("selected","selected");    
    $("#duration_select_form input").attr("value",'<?php echo $running_time; ?>');
    $("#output").html('<?php echo $running_time; ?>');

    filter_data();

    function filter_data(){
        // lets store our filtered values
        var action='fetch_data';
        var running_time= $("#myRange").val();
        var genre = get_filter('genre');
        var language = get_filter('language');
        //Now we need an ajax request
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            //data we want to send:
            data:{action:action,running_time:running_time,genre:genre,language:language},            
            success:function(data){
                $("#fetch").html(data);
            }
        });        
    }

    function get_filter(class_name){
        var filter = []; // we going to store our values of the selected checkboxes
        
        // selected class names:
        $('.'+class_name+':checked').each(function(){
            // we going to puch the selected values to our filter array
            // filter = filter.concat($(this).val());
            filter.push($(this).val());
            console.log($(this).val());
        });
        return filter;
    }
    $("input").click(function(){
        filter_data();
    });

    $('#filteredMovies').change(function(){
        filter_data();
    });

    $('#filterByGenre').change(function(){
        filter_data();
    });

    $('form input').change(function() {
        filter_data();
    });

   


    

});


// Update the current slider value (each time you drag the slider handle)
// slider.oninput = function() {    
//   output.innerHTML = this.value;    // megjelenítjuk a csúszka értékét   
//   slider.value = this.value;        // a csúszka value-ját is beszetteljük az értékére, mert visszaugtik 50-re
// //   form.submit();              // elsubmittoljuk a form-ot minden egyes változtatásná
// }

// $('#myRange').on('input', function() {
//     $('#duration_select_form').submit();
// });

</script>