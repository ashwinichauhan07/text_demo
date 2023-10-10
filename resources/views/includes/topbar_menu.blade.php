<!-- Navbar-->

 @if (auth()->user()->userType == 2)
<ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell">
                        @php


                        $custemNotification = DB::table('notifications')
                          ->Where('notifiable_id' ,auth()->id())
                          ->where('read_at',null)->where('type','App\Notifications\CustemNotification')
                          ->latest()->count();


                        echo "<label style='color: white; background-color: red; border-radius: 50%; width: 70%;height: 20px;  text-align: center;'>$custemNotification</label>";

                        @endphp
                    </i><sup style="color: red; font-weight: 700;"></sup></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">

                        @php

                        $custemNotification = DB::table('notifications')
                          ->Where('notifiable_id' ,auth()->id())
                          ->where('read_at',null)->where('type','App\Notifications\CustemNotification')
                          ->latest()->get();

                            $count = 0;
                          if(count($custemNotification) > 5) {
                          $count = 5;
                          } else {
                        $count = count($custemNotification);
                        }

                        if($count == 0)
                          {
                              echo "<label style='font-weight: bold; padding: 1px; font-size: 20px; padding-left: 10px;'>No Notices For You !!</label>";
                          }

                          else{

                          for ($i=0; $i < $count; $i++) {

                          $data = json_decode($custemNotification[$i]->data);

                          $id = ($custemNotification[$i]->id);

                           echo "<a class='dropdown-item' href='http://localhost/ESwiftProject/instituteadmin/notice/?id=$id++' > <label style='font-weight: bold;'>$i &nbsp; &nbsp; $data->message</label></a>";

                        }

                        }

                        @endphp
                    </div>
                </li>
            </ul>
             @endif



             @if (auth()->user()->userType == 3)
                <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell">
                        @php


                        $custemNotification = DB::table('notifications')
                          ->Where('notifiable_id' ,auth()->id())
                           ->where('read_at',null)->where('type','App\Notifications\CustemNotification')
                          ->latest()->count();

                        echo "<label style='color: white; background-color: red; border-radius: 50%; width: 70%;height: 20px;  text-align: center;'>$custemNotification</label>";

                        @endphp
                    </i><sup style="color: red; font-weight: 700;"></sup></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">


                        @php


                        $custemNotification = DB::table('notifications')
                          ->Where('notifiable_id' ,auth()->id())
                           ->where('read_at',null)->where('type','App\Notifications\CustemNotification')
                          ->latest()->get();

                            $count = 0;
                          if(count($custemNotification) > 5) {
                            $count = 5;
                          } else {
                           $count = count($custemNotification);
                          }

                          if($count == 0)
                          {
                              echo "<label style='font-weight: bold; padding: 1px; font-size: 20px; padding-left: 10px;'>No Notices For You !!</label>";
                          }

                          else{

                          for ($i=0; $i < $count; $i++) {

                          $data = json_decode($custemNotification[$i]->data);

                          $id = ($custemNotification[$i]->id);

                            echo "<a class='dropdown-item' href='http://localhost/ESwiftProject/instituteadmin/notice/?id=$id++' > <label style='font-weight: bold;'>$i &nbsp; &nbsp; $data->message</label></a>";

                        }

                        }

                        @endphp
                    </div>
                </li>
            </ul>
             @endif



               @if (auth()->user()->userType == 4)
                <ul class="navbar-nav ml-auto ml-md-0">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell">
                        @php
                        $custemNotification = DB::table('notifications')
                          ->Where('notifiable_id' ,auth()->id())
                          ->where('read_at',null)->where('type','App\Notifications\CustemNotification')
                          ->latest()->count();

                        echo "<label style='color: white; background-color: red; border-radius: 50%; width: 70%;height: 20px;  text-align: center;'>$custemNotification</label>";

                        @endphp
                    </i><sup style="color: red; font-weight: 700;"></sup></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">


                        @php


                        $custemNotification = DB::table('notifications')
                          ->Where('notifiable_id' ,auth()->id())
                          ->where('read_at',null)->where('type','App\Notifications\CustemNotification')
                          ->latest()->get();

                            $count = 0;
                          if(count($custemNotification) > 5) {
                            $count = 5;
                          } else {
                           $count = count($custemNotification);
                          }


                          if($count == 0)
                          {
                              echo "<label style='font-weight: bold; padding: 1px; font-size: 20px; padding-left: 10px;'>No Notices For You !!</label>";


                          }

                          else{

                          for ($i=0; $i < $count; $i++) {

                          $data = json_decode($custemNotification[$i]->data);

                          $id = ($custemNotification[$i]->id);

                          echo "<a class='dropdown-item' href='http://localhost/ESwiftProject/instituteadmin/notice/?id=$id++' > <label style='font-weight: bold;'>$i &nbsp; &nbsp; $data->message</label></a>";



                        }

                        }


                        @endphp
                    </div>
                </li>
            </ul>
             @endif



            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        @if (auth()->user()->userType == 1)
                        <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fas fa-user">
                        </i><label style="padding-left: 10px; font-weight: bold;">Profile</label></a>

                        <!-- <a class="dropdown-item" href="#"><i class="fas fa-cog"></i><label style="padding-left: 10px; font-weight: bold;">Settings</label></a> -->

                        <!-- <a class="dropdown-item" href="#"><i class="fab fa-adn"></i><label style="padding-left: 10px; font-weight: bold;">Activity Log</label></a> -->

                        <div class="dropdown-divider"></div>
                        @elseif (auth()->user()->userType == 2)
                        <a class="dropdown-item" href="{{ route('instituteadmin.profile') }}"><i class="fas fa-user">
                        </i><label style="padding-left: 10px; font-weight: bold;">Profile</label></a>

                        <a class="dropdown-item" href="{{ route('instituteadmin.checknotice')}}"><i class="fas fa-bell"></i><label style="padding-left: 10px; font-weight: bold;">Notice</label></a>

                        <!-- <a class="dropdown-item" href="#"><i class="fas fa-cog"></i><label style="padding-left: 10px; font-weight: bold;">Settings</label></a> -->

                        <!-- <a class="dropdown-item" href="#"><i class="fab fa-adn"></i><label style="padding-left: 10px; font-weight: bold;">Activity Log</label></a> -->

                        <a class="dropdown-item" href=""><i class="fas fa-envelope"></i><label style="padding-left: 10px; font-weight: bold;">Messages</label></a>

                        <a class="dropdown-item" href="{{route('instituteadmin/calender')}}"><i class="far fa-calendar-check"></i><label style="padding-left: 10px; font-weight: bold;">Calendar</label></a>

                        <div class="dropdown-divider"></div>
                         @elseif (auth()->user()->userType == 3)
                        <a class="dropdown-item" href="{{ route('instructortadmin.profile') }}"><i class="fas fa-user">
                        </i><label style="padding-left: 10px; font-weight: bold;">Profile</label></a>

                        <a class="dropdown-item" href="{{ route('instructortadmin.checknotice')}}"><i class="fas fa-bell"></i><label style="padding-left: 10px; font-weight: bold;">Notices</label></a>

                        <a class="dropdown-item" href="#"><i class="fas fa-cog"></i><label style="padding-left: 10px; font-weight: bold;">Settings</label></a>

                       <a class="dropdown-item" href="#"><i class="fab fa-adn"></i><label style="padding-left: 10px; font-weight: bold;">Activity Log</label></a>

                        <div class="dropdown-divider"></div>

                        @elseif (auth()->user()->userType == 4)

                         <a class="dropdown-item" href="{{ route('studentuser.checknotice')}}"><i class="fas fa-bell"></i><label style="padding-left: 10px; font-weight: bold;">Notices</label></a>

                        @endif
                        <form method="POST" action="{{ route('login.logout') }}">

                        {{ csrf_field() }}

                        <button class="dropdown-item" type="submit" style="padding-left: 26px; font-weight: bold;"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;logout</button>

                        </form>

                    </div>
                </li>
            </ul>
        </nav>
