/*
 Javascript for video galery
 controls
 PHILLLWARE 2012
*/

var videoControls = {
    setMovie: function (movieID, name, discription){
        //sets the current movie including the title and discription.
        document.getElementById("videoPlayer").src = "http://www.youtube.com/embed/" + movieID;
        $("#videoTitle").html(name);
        $("#viddisc").html(discription);
    }
    
    
}