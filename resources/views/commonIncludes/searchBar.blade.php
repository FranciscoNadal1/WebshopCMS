<script>
    

        function doStuff(mytext)
            {
                
                var urlToLoad = "/search/" + mytext ;
                
            
                 $('#wrapper').load(urlToLoad, function () {
                              var obj = { Title: "Buscador", Url: "/buscador/"+mytext };
                            history.pushState(obj, obj.Title, obj.Url);
                });
            
            }
    
</script>




<form id="buscador" class="input-group input-group-lg" method="GET" action="/buscar/">
    <input  onkeyup="doStuff(this.value)" onkeydown="doStuff(this.value)" id="query" 
    name="query" 
    required="required" 
    class="form-control form-control" 
    placeholder='Busca en {{ \GetSettings::companyName() }}' 
    autocomplete="off" 
    type="text">
</form>