/* 
 * Philllware Software
 * http://www.philllware.com
 * Open-Source Software
 * 
 * jQueryzss360 Version 0.1B (last change Aug 12, 2012)
 * 
 * 
 */


//You need an anonymous function to wrap around your function to avoid conflict
(function($){
 
    //Attach this new method to jQuery
    $.fn.extend({ 
         
        //This is where you write your plugin's name
        borderRadius: function(options) {
           
            
       
            var defaults ={};
            
            
     
            var options = $.extend(defaults, options);
            
            //Iterate over the current set of matched elements
            return this.each(function() {
             
                
                var o = options;
            
                //hammer time!
                if(o.topleft == undefined || o.topright == undefined || o.bottomleft == undefined || o.bottomright == undefined){
                    if(o.top == undefined || o.bottom == undefined){
                        if(o.r == undefined){
                            o.topleft = 5;
                            o.topright = 5;
                            o.bottomleft = 5;
                            o.bottomright = 5;
                        }else{
                            o.topleft = o.r;
                            o.topright = o.r;
                            o.bottomleft = o.r;
                            o.bottomright = o.r;  
                        }
                    }
                    else{
                        o.topleft = o.top;
                        o.topright = o.top;
                        o.bottomleft = o.bottom;
                        o.bottomright = o.bottom;
                    }
                }
             
                //Assign current element to variable, in this case is UL element
                //                var obj = $(this);
                
                var roundness = "border-top-left-radius:"+ o.topleft +"px;";//recommended
                roundness += "border-top-right-radius:"+ o.topright +"px;";
                roundness += "border-bottom-right-radius:"+ o.bottomright +"px;";
                roundness += "border-bottom-left-radius:"+ o.bottomleft +"px;";
                
                //FIREFOX 3.6 and earlier
                roundness += "-moz-border-bottom-left-radius:"+ o.bottomleft +"px;";
                roundness += "-moz-border-bottom-right-radius:"+ o.bottomright +"px;";
                roundness += "-moz-border-top-left-radius:"+ o.topleft +"px;";
                roundness += "-moz-border-top-right-radius:"+ o.topright +"px;";
                roundness += ($(this).attr('style') != undefined) ? $(this).attr('style') : "";
                $(this).attr('style', roundness);
                
             
            });
        },
        
        boxShadow: function(options) { 
              
            var defaults = {
                x: 5,
                y: 5,
                blur: 0,
                spread: 0,
                color: "#000000",
                inset: ""
                  
            }
            var options = $.extend(defaults, options);
            //Iterate over the current set of matched elements
            return this.each(function() {
                
                var o = options;
                
                var oStyle = ($(this).attr('style') != undefined) ? $(this).attr('style') : "";
                
                var shadow = oStyle + " box-shadow: " +o.x + "px " + o.y + "px " + o.blur + "px " + o.color + " " + o.inset +";";
             
                //code to be inserted here
                $(this).attr('style', shadow);
            });
        },
        
        
        backgroundSize: function(options){
            
            return this.each(function (){
               
                //RECOMMENDED SUPPORTS IE, SAFARI/CHROME OPERA
               
                var background = "background-size: " + options + ";";
                background += "-moz-background-size: " + options + ";";//FIREFOX
                background += ($(this).attr('style') != undefined) ? $(this).attr('style') : "";
                
                $(this).attr('style', background);
               
            });
            
        },
        
        gradient: function (options){
            
            var defaults = {
                
                direction: 'top',
                stops: [
                {
                    origin: '50%', 
                    color: '#FFFFFF'
                },
                {
                    origin: '99%', 
                    color: '#000000'
                }
               
                ]  
        
            }
            
            var options = $.extend(defaults, options);
            
            return this.each(function() {
                 
                var o = options;
                 
                //traverse color stops
                 
                var stops = "";
                 
                $.each(o.stops, function(index){
                     
                    stops += o.stops[index].color+" "+o.stops[index].origin+","
                     
                });
                 
                //right trim stops for that last comma
                 
                stops = stops.replace(/(^,)|(,$)/g, '');
                 
                //background: -webkit-linear-gradient(top, #006e2e 0%,#00f93a 99%);
                var gradeient ="";
                var browsers = new Array('-webkit-', '-ms-', '-o-', '-moz-', '');
                 
                for(x = 0; x < browsers.length; x++)
                    gradeient += "background: "+browsers[x]+"linear-gradient("+o.direction+", "+stops+");";
                 
                 
                gradeient += ($(this).attr('style') != undefined) ? $(this).attr('style') : "";
                 
                $(this).attr('style', gradeient);
                 
            });
            
        }
        
        
        
        
       
        
        
    });
     
//pass jQuery to the function, 
//So that we will able to use any valid Javascript variable name 
//to replace "$" SIGN. But, we'll stick to $ (I like dollar sign: ) )       
})(jQuery);