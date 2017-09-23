<div id="auth">
  @if (Auth::guest())
                        
                            <div class="col-md-12">
                                <a href="{{ route('login') }}">Login</a></li>
                            </div>

                        @else
                        
                                
                                <div class="col-md-6">
                                    Mi cuenta : <br/>
                                    {{ Auth::user()->name }} 
                                    
                                </div>
                                
                                    
                                <div class="col-md-6">    
                                   <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                              
                                        <img src=" {{ \GetAsset::getIMG('shutdown.png') }}"      />      
                                    </a>
                                </div>    
                                
                               
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                               
                               
                        @endif
</div>






<!-- OLD VERSION -->
<!--
    <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                        
                            <li><a href="{{ route('login') }}">Login</a></li>
                            
                            
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                
                                    
                                    
                               <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                          
                                    <img src=" {{ \GetAsset::getIMG('shutdown.png') }}"      />      
                                </a>
                                
                                
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        
                    </ul>
                </div>
                
                -->