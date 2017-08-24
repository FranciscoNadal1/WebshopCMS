<form id="buscador" class="input-group input-group-lg" method="GET" action="/buscar/">
    <input id="query" 
    name="query" 
    required="required" 
    class="form-control form-control" 
    placeholder='Busca en {{ \GetSettings::companyName() }}' 
    autocomplete="off" 
    type="text">
</form>