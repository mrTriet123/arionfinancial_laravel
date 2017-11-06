<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
        @if(Session::get('RoleID') == 1 || Session::get('RoleID') == 2)
            <li><a><i class="glyphicon glyphicon-user icon"></i><?php 
          if(Session::get('RoleID') == 1)
          { 
            echo 'My Dealers'; 
          }
          elseif(Session::get('RoleID')  == 2)
          { 
            echo 'My Customer'; 
          } 
          ?><span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{!! URL('Users') !!}"><?php 
          if(Session::get('RoleID') == 1)
          { 
            echo 'Dealers List'; 
          }
          elseif(Session::get('RoleID')  == 2)
          { 
            echo 'Customer List'; 
          } 
          ?></a></li>
                    <li><a href="{!! URL('Add-User') !!}"><?php 
          if(Session::get('RoleID') == 1)
          { 
            echo 'Add Dealers'; 
          }
          elseif(Session::get('RoleID')  == 2)
          { 
            echo 'Add Customer'; 
          } 
          ?></a></li>
                </ul>
            </li>
            @endif
            
            <?php
            if(Session::get('RoleID') == 2)
            {
              echo '  <li><a><i class="glyphicon glyphicon-tags icon"></i> My Contracts <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="'.URL("add-leasing").'/'.Session::get("UserID").'">Leasing</a></li>          
                    <li><a href="'.URL("add-financing").'/'.Session::get("UserID").'">Financing</a></li>          
                </ul>
            </li>
            <li><a><i class="icon"><img src="'.URL::asset('public/images/statements-icon.png').'"></i> Statments <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="'.URL("get-statements").'">View Statments</a></li>          
                </ul>
            </li>
            <li><a><i class="glyphicon glyphicon-folder-close icon"></i> Documents <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="'.URL("lists-contract").'">List Contract</a></li>   
                    <li><a href="'.URL("leasing").'">Leasing</a></li>          
                    <li><a href="'.URL("financial").'">Financing</a></li> 
                </ul>
            </li>
            ';

            }
            if(Session::get('RoleID') == 3)
            {
              echo '
              <li><a><i class="icon ic-payment"><img src="'.URL::asset('public/images/payments-icon.png').'"></i> Payments <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                              
                </ul>
              </li>
              <li><a><i class="icon"><img src="'.URL::asset('public/images/activity-icon.png').'"></i> Activity <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">        
                </ul>
              </li>
              <li><a><i class="icon"><img src="'.URL::asset('public/images/statements-icon.png').'"></i> Statments <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="'.URL("get-statements").'">View Statments</a></li>          
                </ul>
              </li>
              <li><a><i class="icon"><img src="'.URL::asset('public/images/activity-icon.png').'"></i> Accounts Details <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="'.URL("Contracts").'/'.Session::get("UserID").'">Contract Lists</a></li>
                    <li><a href="'.URL("Account").'">Check Accounts</a></li>
                    <li><a href="'.URL("view-accounts").'">View Accounts</a></li>         
                </ul>
              </li>
            ';
            //<li><a href="'.URL("Users").'">Customer List</a></li>   
            }
            ?>


            <li><a><i class="icon fa-setting"><img src="{{URL::asset('public/images/settings-icon.png')}}"></i> Settings <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{!! URL('Profile') !!}">Profile</a></li>

                    <li>
                        <a href="{{ url('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->