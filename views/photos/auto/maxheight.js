/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    
    maxheight = $(window).height()-20;
        
    $('[class=showcase]').css('max-height', maxheight);
        
    $(window).resize(function (){
        maxheight = $(this).height()-20;
        
        $('[class=showcase]').css('max-height', maxheight);
    })
        
    
    
});

