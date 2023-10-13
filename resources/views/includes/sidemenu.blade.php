@if (auth()->user()->userType == 2)

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{ route('demoexam.dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="false" aria-controls="collapsePages">
                         <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                         Master Data
                         <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                          data-parent="#sidenavAccordion">
                         <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                             </a>
                             <a class="nav-link" href="{{ route('exam_name.index')}}">Create Exam Name</a>

                             <a class="nav-link" href="{{ route('examBatches.index')}}">Create Exam Batches</a>

                             <a class="nav-link" href="{{ route('studentbatchallocation.index')}}">Student Batch Alloaction</a>

                             </a>
                         </nav>
                     </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterData" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fa fa-book"></i></div>
                           Demo Exam
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>


                        <div class="collapse" id="collapseMasterData" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">



                                {{-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Typing Creation
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a> --}}
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="">Typing Exam</a>
                                         <a class="nav-link" href="">Subject Level</a>  --}}
                                      </nav>
                                </div>

                                 <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    MCQ Creation
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>


                                 <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ route('question.index') }}"> Create MCQ Questions</a>
                                            <a class="nav-link" href="{{ route('question_bank.decide') }}">Generate Paper </a>
                                            <a class="nav-link" href="{{ route('exam.index') }}">Create Exam</a>
                                             {{-- <a class="nav-link" href="{{ route('hallticket.index')}}">Generate Hall-Ticket</a> --}}


                                {{-- <a class="nav-link" href="{{ route('examBatches.index')}}">Create Exam Batches</a>  --}}
                                      </nav>
                                </div>




                                <a class="nav-link" href="{{ route('typing_exam.index')}}">Create Typing Exam</a>


                        </div>

                    </div>
                    </div>

                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: Exam Admin</div>
                        {{ auth()->user()->name }}
                    </div>


</div>
@endif
