<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    @if(auth()->user()->userType == 4)
    @php
                        $institute = DB::table('users')
                        ->where('id', auth()->user()->student->institute_id)
                          ->first();
    @endphp
        <a class="navbar-brand" href="">{{ $institute->name }}</a>

    @elseif(auth()->user()->userType == 2)
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">{{ auth()->user()->name }}</a>
        @elseif(auth()->user()->userType == 1)
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">ESWIFT</a>

                    @elseif(auth()->user()->userType == 3)
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">{{ auth()->user()->instructor->institute->user->name }}</a>
        @elseif(auth()->user()->userType == 1)
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">ESWIFT</a>


        @endif



            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>


            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">


                    <!-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div> -->


                </div>
            </form>
