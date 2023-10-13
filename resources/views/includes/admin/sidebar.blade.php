<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <!-- check if user can create user or not  -->
                            @can ('create',App\Models\Institute::class)
                            <div class="sb-sidenav-menu-heading">Interface</div>

                            <!-- Users -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Users
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">

                                    <a class="nav-link" href="{{ route('admin.institute.index') }}">Institue
                                    </a>

                                    <a class="nav-link" href="{{ route('admin.student.index') }}">Student</a>

                                    <a class="nav-link" href="{{ route('admin.subject_expert.index') }}">Subject Expert</a>

                                    <a class="nav-link" href="{{ route('admin.subject_expert.index') }}">Question Bank Generator</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            @endcan


                            <div class="sb-sidenav-menu-heading">Addons</div>

                            @can ('create',App\Models\Institute::class)

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Master Data
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>


                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">


                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Subject
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ route('admin.subject.index') }}">Subject</a>
                                            <a class="nav-link" href="{{ route('admin.subject_level.index') }}">Subject Level</a>
                                        </nav>
                                    </div>

                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>


                                </nav>
                            </div>

                            @endcan

                            <a class="nav-link" href="{{ route('admin.question.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-question"></i></div>
                                Question
                            </a>
                            <!-- <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Recycle
                            </a> -->

                            @can ('create',App\Models\Institute::class)
                            <div class="sb-sidenav-menu-heading">Recycle Bin</div>

                            <!-- Users -->
                            <a class="nav-link" href="{{ route('recycle.user') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-recycle"></i></div>
                                User
                            </a>

                            <a class="nav-link" href="{{ route('recycle.question') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-recycle"></i></div>
                                Question
                            </a>
                            @endcan

                        </div>


                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">
                            @can ('create',App\Models\Institute::class)
                            Logged in as: Admin
                            @endcan

                            @cannot ('create',App\Models\Institute::class)
                            Logged in as: Subject Expert
                            @endcan
                        </div>
                        {{ auth()->user()->name }}
                    </div>
                </nav>
            </div>