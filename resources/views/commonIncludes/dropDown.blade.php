
<style>
    #HoverMenu{
        position:absolute;
        width:100%;
        height:200px;
        background-color:white;
        z-index:100000;
        margin:10px;
        border:1px solid black;
        position: fixed;
        display:none;
    }

</style>

<script>
    $("nav, #HoverMenu").mouseover(function(){
        $("#HoverMenu").slideDown();
    });
    
    $("nav").mouseout(function () {
   $("#HoverMenu").fadeOut(100);

});
    
</script>

<div id="HoverMenu">
    
    AAA
</div>