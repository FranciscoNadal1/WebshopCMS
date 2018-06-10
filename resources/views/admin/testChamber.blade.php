@extends('mainTemplates/adminTemplate')



    @section('content')
   <!--
<div >
  <div ng-controller="PieCtrl">
    <canvas id="pie" class="chart chart-pie"
      chart-data="data" chart-labels="labels" chart-options="options">
    </canvas> 
  </div>
</div>

        <div ng-app="">
    
            <p>Name: <input type="text" ng-model="name"></p>
            <p>You wrote: @{{ name }}</p> 
        
        </div>
-->



<?php

    echo infortisaApi::getStock();


    Charts::apiCalls("stocks-chart");
?>

<div id="stocks-chart" style="height:20%;width:50%;border:1px solid black"></div>


{{--
<h1>Idea</h1>
<h2>Un personalizador de los colores principales de la web, se realizará recorriendo todos los ficheros del tema y substituyendo cada color, 
previamente habiendo añadido al color //Template:1</h2>
--}}
<body ng-app="myApp">
    <div ng-controller="MyCtrl">
        <form id="test">
            <div>
                <input type="text" class="test1" name="test2" />
            </div>
            <div>
                <input type="text" class="test3" name="test4" />
            </div>
        </form>
        <div>
            <input type="button" ng-click="save('test')" value="submit" />
        </div>
    </div>
</body>

JavaScript:

<!--

<!-- ------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------


<script>
    angular.module('controllerAsExample', [])
  .controller('SettingsController1', SettingsController1);

function SettingsController1() {
  this.name = 'John Smith';
  this.contacts = [
    {type: 'phone', value: '408 555 1212'},
    {type: 'email', value: 'john.smith@example.org'}
  ];
}

SettingsController1.prototype.greet = function() {
  alert(this.name);
};

SettingsController1.prototype.addContact = function() {
  this.contacts.push({type: 'email', value: 'yourname@example.org'});
};

SettingsController1.prototype.removeContact = function(contactToRemove) {
 var index = this.contacts.indexOf(contactToRemove);
  this.contacts.splice(index, 1);
};

SettingsController1.prototype.clearContact = function(contact) {
  contact.type = 'phone';
  contact.value = '';
};
</script>
<script>
    it('should check controller as', function() {
  var container = element(by.id('ctrl-as-exmpl'));
    expect(container.element(by.model('settings.name'))
      .getAttribute('value')).toBe('John Smith');

  var firstRepeat =
      container.element(by.repeater('contact in settings.contacts').row(0));
  var secondRepeat =
      container.element(by.repeater('contact in settings.contacts').row(1));

  expect(firstRepeat.element(by.model('contact.value')).getAttribute('value'))
      .toBe('408 555 1212');

  expect(secondRepeat.element(by.model('contact.value')).getAttribute('value'))
      .toBe('john.smith@example.org');

  firstRepeat.element(by.buttonText('clear')).click();

  expect(firstRepeat.element(by.model('contact.value')).getAttribute('value'))
      .toBe('');

  container.element(by.buttonText('add')).click();

  expect(container.element(by.repeater('contact in settings.contacts').row(2))
      .element(by.model('contact.value'))
      .getAttribute('value'))
      .toBe('yourname@example.org');
});
</script>


<div id="ctrl-as-exmpl" ng-controller="SettingsController1 as settings">
  <label>Name: <input type="text" ng-model="settings.name"/></label>
  <button ng-click="settings.greet()">greet</button><br/>
  Contact:
  <ul>
    <li ng-repeat="contact in settings.contacts">
      <select ng-model="contact.type" aria-label="Contact method" id="select_">
         <option>phone</option>
         <option>email</option>
      </select>
      <input type="text" ng-model="contact.value" aria-labelledby="select_" />
      <button ng-click="settings.clearContact(contact)">clear</button>
      <button ng-click="settings.removeContact(contact)" aria-label="Remove">X</button>
    </li>
    <li><button ng-click="settings.addContact()">add</button></li>
 </ul>
</div>


-->

<!-- ------------------------------------------------------------------------------------ -->

{{--    \MailData::addMail("Subject","","This is a message") --}}

{{
$value = $request->session()->get('key')
}}
    @endsection