$(document).ready(function(){
    $(".nose").text("Retrieved "+nos1+" Search Results for "+query);
    var html="";
    var base="http://108.55.6.113/connect/"
    for(i=1;i<nos1;i++){
        var fname=datar[i]['firstname'];
        var lname=datar[i]['lastname'];
        var email=datar[i]['email'];
        var dob=datar[i]['dob'];
        var htmlpage=datar[i]['html'];
        var image=datar[i]['image'];
        var end="?firstname="+fname+"&lastname="+lname+"&email="+email+"&image="+image;
        var href=base+htmlpage+end;
        html=html+"<a href="+href+">"+"<h3>"+fname+" "+lname+"</h3></a>"+"<p><strong>Email:</strong>"+email+"  <br/><strong>D.O.B</strong> "+dob+"</p>"+"<input type='button' id='s"+i+"' value='Add+'><br/><p class='s"+i+"'></p>";
    }
    $("input").click(function(event){
        
        window.alert(event.target.id);
        
        
    })
    
});