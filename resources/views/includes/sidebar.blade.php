<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    @if (auth()->user()->userType == 1)
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts"
                           aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                            Users
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                             data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('institute.index') }}">New Institute
                                </a>
                                <a class="nav-link" href="{{ route('adminstudent.index') }}">Student Report</a>
                            </nav>
                        </div>
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
                                <a class="nav-link" href="{{ route('isessions.index') }}"> Institute Sessions </a>
                                <a class="nav-link" href="{{ route('handicap.index') }}">New Handicap</a>
                                <a class="nav-link" href="{{ route('course.index') }}">New Course</a>
                                <a class="nav-link" href="{{ route('subject.index') }}">New Subject</a>
                                <a class="nav-link" href="{{ route('document.index') }}">Identity Document</a>
                                </a>
                                <a class="nav-link" href="{{ route('license.index') }}">Lincense </a>
                                <a class="nav-link" href="{{ route('practisetypename.index') }}">Practise Type</a>

                                </a>
                            </nav>
                        </div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"></div>
                            <a class="nav-link" href="{{ route('revenue.index') }}"><i class="fa fa-credit-card"></i>&nbsp;Revenue
                            </a>
                        </a>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"></div>
                            <a class="nav-link" href="{{ route('custemNotification.index') }}"><i
                                    class="fa fa fa-comments"></i>&nbsp; Notice</a>
                        </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as: Super Admin</div>
                {{ auth()->user()->name }}
            </div>
            @elseif (auth()->user()->userType == 2)
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('instituteadmin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts"
                   aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    New Creation
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('studentType.index')}}">Student Type</a>
                        <a class="nav-link" href="{{ route('itimings.index')}}">Batch Timings</a>
                        <a class="nav-link" href="{{ route('coursefees.index')}}">Course Fees</a>
                        <a class="nav-link" href="{{(route('grnumbers.index'))}}">GR Number</a>
                        <a class="nav-link" href="{{ route('students.index')}}">New Student</a>
                        <a class="nav-link" href="{{ route('instructors.index') }}">New Instructor</a>
                    <!--  <a class="nav-link" href="{{ route('language.index') }}">Language</a> -->
                    {{--  <a class="nav-link" href="{{ route('mcqtype.index') }}"> Create MCQ Type</a>  --}}

                        <a class="nav-link" href="{{ route('instituteNotification.index') }}">Notice</a>
                        <!-- <a href="/download">download</a> -->
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                   aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fa fa-credit-card"></i></div>
                    Finance
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        </a>
                        <a class="nav-link" href="{{route('studentinstallments.index')}}"> Student Installment</a>
                        <a class="nav-link" href="{{route('instructorpayments.index')}}">Instructor Payment</a>
                        <a class="nav-link" href="{{ route('studentinstallments.revenue') }}">Revenue Report </a>
                        </a>
                    </nav>
                </div>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        </a>
                    </nav>
                </div>


                <a class="nav-link" href="{{ route('attendance.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-newspaper-o"></i></div>
                    Attendance
                </a>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepage"
                   aria-expanded="false" aria-controls="collapse">
                    <div class="sb-nav-link-icon"><i class="fa fa-registered"></i></div>
                    Reports
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsepage" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                    <!-- <a class="nav-link" href="{{ route('noticereport.index') }}">Notice </a> -->
                        <a class="nav-link" href="{{ route('studentreport.index')}}">Total Student </a>
                        <a class="nav-link" href="{{ route('studentinstallments.session')}}">Student Installment
                            Report </a>
                        <a class="nav-link" href="{{ route('instructorpayments.payment_report') }}">Instructor Payment
                            Report </a>
                        <a class="nav-link" href="{{ route('instructors.report')}}">Instructor Report </a>
                        <a class="nav-link" href="{{ route('students.grnumber') }}">General Register </a>
                        <!-- <a class="nav-link" href="#">Institute Sessions </a> -->
                        <a class="nav-link" href="{{ route('studentgrowth.index') }}">Student Growth </a>
                        {{--                <a class="nav-link" href="#">Session-Wise Report </a>--}}
                    <!-- <a class="nav-link" href="{{ route('typingtestreport.index') }}">Typing Test Report </a>

                     <a class="nav-link" href="{{ route('typingtestreport.indexofmcq') }}">MCQ Test Report </a> -->
                    </nav>
                </div>

                {{--  <a class="nav-link" href="{{ route('studentgrowth.index') }}">
                    <div class="sb-nav-link-icon"> <i class="fa fa-line-chart"></i></div>
                    Student Growth
                </a>  --}}

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsemcq"
                   aria-expanded="false" aria-controls="collapse">
                    <div class="sb-nav-link-icon"><i class="fa fa-desktop"></i></div>
                    MCQ Creation For Practise
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsemcq" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('mcqtype.index') }}"> Create MCQ Type</a>
                        {{--                <a class="nav-link" href="{{ route('section.index') }}"> Create Section</a>--}}
                        <a class="nav-link" href="{{ route('practicemcq.index') }}"> Create MCQ Questions</a>
                        {{-- <a class="nav-link" href="{{ route('mcq_bank.decide') }}">Generate Practise Paper </a>
                        <a class="nav-link" href="{{ route('practise_exam.index') }}">Create Practise Exam</a> --}}
                    {{--                <a class="nav-link" href="{{ route('typingtest.index') }}">Create Typing Test</a>--}}
                    {{--                <a class="nav-link" href="{{ route('typing_word_practices.index') }}">Create Typing Word Practices</a>--}}


                    <!-- <a class="nav-link" href="{{ route('mcqtest.index') }}">Test MCQ </a>    -->
                    </nav>
                </div>


                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsemcqdata"
                   aria-expanded="false" aria-controls="collapse">
                    <div class="sb-nav-link-icon"><i class="fa fa-desktop"></i></div>
                    MCQ Creation For Practise Test Paper
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down">
                        </i></div>
                </a>
                <div class="collapse" id="collapsemcqdata" aria-labelledby="headingOne" data-parent=#sidenavAccordion>
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link"
                           href="{{ route('practise_mcqtestpaper.index') }}">
                            Generate MCQ Practise Test Paper
                        </a>


                        <a href="{{ route('practiseexam.index_exam')}}" class="nav-link">Create Practise
                            Exam</a>

{{--                <a href="{{ route('practiseexam.index_exam')}}" class="nav-link">Create Practise Exam</a>--}}
        </nav>
    </div>


 @foreach(auth()->user()->institute->institutecourse as $key=> $course_value)

@if($course_value->course->name == "GCC-TBC")
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsedata"
       aria-expanded="false" aria-controls="collapse">
        <div class="sb-nav-link-icon"><i class="fa fa-desktop"></i></div>
        Typing Creation
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapsedata" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
        <!-- <a class="nav-link" href="{{ route('homekey.index') }}">Home Key</a>
                <a class="nav-link" href="{{ route('upperkey.index') }}"> Upper Key</a>
                <a class="nav-link" href="{{ route('lowerkey.index') }}"> Lower Key</a>
                <a class="nav-link" href="{{ route('capitalword.index') }}">Capital Word </a> -->

            <a class="nav-link" href="{{ route('practiseType.index')}}">Practise Type</a>
            <a class="nav-link" href="{{ route('keboardPractice.index') }}">Keyboard Practices </a>
            <a class="nav-link" href="{{ route('typingPractise.index') }}">Typing Practices </a>
            <a class="nav-link" href="{{ route('typingtest.index') }}">Typing Tests</a>


        <!-- <a class="nav-link" href="{{ route('mcqtest.index') }}">Test MCQ </a>    -->
        </nav>
    </div>
    @endif
    @endforeach

    {{--  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsetype"
       aria-expanded="false" aria-controls="collapse">
        <div class="sb-nav-link-icon"><i class="fa fa-book"></i></div>
        Demo Exam
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapsetype" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="{{ route('examBatches.index')}}">Create Exam Batches</a>
            <a class="nav-link" href="{{ route('hallticket.index')}}">Generate Hall-Ticket</a>
            <!-- <a class="nav-link" href="#">MCQ Exam</a>
            <a class="nav-link" href="#">Exam Typing</a>
            <a class="nav-link" href="#">Report</a>  -->
        </nav>

    </div>
  --}}
    {{--  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterData" aria-expanded="false" aria-controls="collapsePages">
        <div class="sb-nav-link-icon"><i class="fa fa-book"></i></div>
       Demo Exam
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>  --}}


    {{--  <div class="collapse" id="collapseMasterData" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
  --}}


            {{-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                Typing Creation
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a> --}}
            {{--  <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="">Typing Exam</a>
                     <a class="nav-link" href="">Subject Level</a>  --}}
                  {{--  </nav>
            </div>  --}}

             {{--  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                MCQ Creation
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>


             <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('question.index') }}"> Create MCQ Questions</a>
                        <a class="nav-link" href="{{ route('question_bank.decide') }}">Generate Paper </a>
                        <a class="nav-link" href="{{ route('exam.index') }}">Create Exam</a>  --}}
                         {{-- <a class="nav-link" href="{{ route('hallticket.index')}}">Generate Hall-Ticket</a> --}}


            {{-- <a class="nav-link" href="{{ route('examBatches.index')}}">Create Exam Batches</a>  --}}
                  {{--  </nav>
            </div>  --}}


            {{--  <a class="nav-link" href="{{ route('exam_name.index')}}">Create Exam Name</a>

            <a class="nav-link" href="{{ route('examBatches.index')}}">Create Exam Batches</a>

            <a class="nav-link" href="{{ route('studentbatchallocation.index')}}">Student Batch Alloaction</a>

            <a class="nav-link" href="{{ route('typing_exam.index')}}">Create Typing Exam</a>


        </nav>
    </div>  --}}
    <a class="nav-link" href="{{ route('licensepayment.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Purchase License
    </a>

    <a class="nav-link" href="{{ route('studentinfo.index') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-trash"></i></div>
        Deleted Student Info
    </a>
</div>
</div>

<div class="sb-sidenav-footer">
    <div class="small">Logged in as: Admin</div>
    {{ auth()->user()->name }}
</div>
@elseif (auth()->user()->userType == 3)
    <div class="sb-sidenav-menu-heading">Core</div>
    <a class="nav-link" href="{{ route('instructortadmin.dashboard') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Dashboard
    </a>
    <div class="sb-sidenav-menu-heading">Interface</div>
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false"
       aria-controls="collapseLayouts">
        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
        New Creation
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="{{ route('students.index')}}">New Student</a>
            <a class="nav-link" href="{{ route('instituteNotification.index') }}">Notice</a>
        <!-- <a class="nav-link" href="{{ route('hallticket.index')}}">Generate Hall-Ticket</a> -->
        </nav>
    </div>
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false"
       aria-controls="collapsePages">
        <div class="sb-nav-link-icon"><i class=" fa fa-credit-card"></i></div>
        Finance
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
            </a>
            <a class="nav-link" href="{{route('studentinstallments.index')}}">Student Installment</a>
        </nav>
    </div>
    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
            </a>
        </nav>
    </div>
    <a class="nav-link" href="{{ route('attendance.index') }}">
        <div class="sb-nav-link-icon"><i class="fa fa-newspaper-o"></i></div>
        Attendance
    </a>
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepage"
       aria-expanded="false" aria-controls="collapse">
        <div class="sb-nav-link-icon"><i class="fa fa-registered"></i></div>
        Reports
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapsepage" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
        <!-- <a class="nav-link" href="{{ route('noticereport.index') }}">Notice </a> -->
            <a class="nav-link" href="{{ route('studentreport.index')}}">Total Student </a>
            <a class="nav-link" href="{{ route('studentinstallments.session')}}">Student Installment
                Report </a>
            <a class="nav-link" href="{{ route('instructorpayments.payment_report') }}">Instructor Payment
                Report </a>
            <a class="nav-link" href="{{ route('instructors.report')}}">Instructor Report </a>
            <a class="nav-link" href="{{ route('students.grnumber') }}">General Register </a>
            <!-- <a class="nav-link" href="#">Institute Sessions </a> -->
            <a class="nav-link" href="{{ route('studentgrowth.index') }}">Student Growth </a>
            {{--                <a class="nav-link" href="#">Session-Wise Report </a>--}}
            <a class="nav-link" href="#">Typing Test Report </a>
        </nav>
    </div>

    {{--  <a class="nav-link" href="{{ route('studentgrowth.index') }}">
        <div class="sb-nav-link-icon"> <i class="fa fa-line-chart"></i></div>
        Student Growth
    </a>  --}}

    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsemcq"
       aria-expanded="false" aria-controls="collapse">
        <div class="sb-nav-link-icon"><i class="fa fa-desktop"></i></div>
        MCQ Creation For Practise
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapsemcq" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="{{ route('mcqtype.index') }}"> Create MCQ Type</a>
            {{--                <a class="nav-link" href="{{ route('section.index') }}"> Create Section</a>--}}
            <a class="nav-link" href="{{ route('practicemcq.index') }}"> Create MCQ Questions</a>
            {{-- <a class="nav-link" href="{{ route('mcq_bank.decide') }}">Generate Practise Paper </a>
            <a class="nav-link" href="{{ route('practise_exam.index') }}">Create Practise Exam</a> --}}
        {{--                <a class="nav-link" href="{{ route('typingtest.index') }}">Create Typing Test</a>--}}
        {{--                <a class="nav-link" href="{{ route('typing_word_practices.index') }}">Create Typing Word Practices</a>--}}


        <!-- <a class="nav-link" href="{{ route('mcqtest.index') }}">Test MCQ </a>    -->
        </nav>
    </div>


    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsemcqdata"
       aria-expanded="false" aria-controls="collapse">
        <div class="sb-nav-link-icon"><i class="fa fa-desktop"></i></div>
        MCQ Creation For Practise Test Paper
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down">
            </i></div>
    </a>
    <div class="collapse" id="collapsemcqdata" aria-labelledby="headingOne" data-parent=#sidenavAccordion>
        <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link"
               href="{{ route('practise_mcqtestpaper.index') }}">
                Generate MCQ Practise Test Paper
            </a>


            <a href="{{ route('practiseexam.index_exam')}}" class="nav-link">Create Practise
                Exam</a>

{{--                <a href="{{ route('practiseexam.index_exam')}}" class="nav-link">Create Practise Exam</a>--}}
</nav>
</div>
 @foreach(auth()->user()->instructor->institute->institutecourse as $key=> $course_value)
 @if($course_value->course->name == "GCC-TBC")
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsedata"
       aria-expanded="false" aria-controls="collapse">
        <div class="sb-nav-link-icon"><i class="fa fa-desktop"></i></div>
        Typing Creation
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapsedata" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
        <!-- <a class="nav-link" href="{{ route('homekey.index') }}">Home Key</a>
                <a class="nav-link" href="{{ route('upperkey.index') }}"> Upper Key</a>
                <a class="nav-link" href="{{ route('lowerkey.index') }}"> Lower Key</a>
                <a class="nav-link" href="{{ route('capitalword.index') }}">Capital Word </a> -->

            <a class="nav-link" href="{{ route('practiseType.index')}}">Practise Type</a>
            <a class="nav-link" href="{{ route('keboardPractice.index') }}">Keyboard Practices </a>
            <a class="nav-link" href="{{ route('typingPractise.index') }}">Typing Practices </a>
            <a class="nav-link" href="{{ route('typingtest.index') }}">Typing Tests</a>


        <!-- <a class="nav-link" href="{{ route('mcqtest.index') }}">Test MCQ </a>    -->
        </nav>
    </div>

     @endif
    @endforeach

</div>
</div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as: Instructor</div>
        {{ auth()->user()->name }}
    </div>
@elseif (auth()->user()->userType == 4)
    <div class="sb-sidenav-menu-heading">Core</div>
    <a class="nav-link" href="{{ route('dashboard') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Dashboard
    </a>
    {{--<a class="nav-link" href="{{route('studentuser.selectpractise')}}"><i class="fa fa-keyboard-o"></i>&nbsp;&nbsp;Typing</a>--}}
    <div class="sb-sidenav-menu-heading">Interface</div>
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false"
       aria-controls="collapseLayouts">
        <div class="sb-nav-link-icon"><i class="fa fa-bars"></i></div>
        Check Status
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
        <!-- <a class="nav-link" href="{{route('studenttyping.index')}}">
                                    <i class="fa fa fa-comments"></i>&nbsp;&nbsp;Notice
                                </a> -->
            <a class="nav-link" href="{{ route('studentuser.paidfees')}}"><i class="fa fa-inr"></i>&nbsp;&nbsp;Fees</a>
        </nav>
    </div>
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false"
       aria-controls="collapsePages">
        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
        Course
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
            </a>



 @foreach(auth()->user()->student->student_course as $key=> $course_value)
  @if($course_value->course->name == "GCC-TBC")

            <a class="nav-link" href="{{route('studentuser.selectpractise')}}"><i class="fa fa-keyboard-o"></i>&nbsp;&nbsp;Typing
                Practise</a>

                   @break;

                @endif
  @endforeach
            <a class="nav-link" href="{{ route('studenttheory.index') }}"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Theory
                Practise</a>
            </a>
        </nav>
    </div>
    {{--                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapse">--}}
    {{--                            <div class="sb-nav-link-icon"><i class="fas fa-desktop"></i></div>--}}
    {{--                                Typing Test--}}
    {{--                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>--}}
    {{--                        </a>--}}
    {{--                        <div class="collapse" id="collapse" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">--}}
    {{--                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">--}}
    {{--                            </a>--}}
    {{--                            <a class="nav-link" href="{{route('studenttyping.index')}}"><i class="fa fa-keyboard-o"></i>&nbsp;&nbsp;Passage</a>--}}
    {{--                            <a class="nav-link" href="studenttheory.index"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Letter</a>--}}
    {{--                            <a class="nav-link" href="studenttheory.index"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Statement</a>--}}
    {{--                            <a class="nav-link" href="studenttheory.index"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Email</a>--}}
    {{--                            <a class="nav-link" href="studenttheory.index"><i class="fa fa-pencil"></i>&nbsp;&nbsp;All Test</a>--}}
    {{--                            </a>--}}
    {{--                        </nav>--}}
    {{--                    </div>--}}
{{--    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseItems" aria-expanded="false"--}}
{{--       aria-controls="collapseItems">--}}
{{--        <div class="sb-nav-link-icon"><i class="fas fa-desktop"></i></div>--}}
{{--        Theory Test--}}
{{--        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>--}}
{{--    </a>--}}
{{--    <div class="collapse" id="collapseItems" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">--}}
{{--        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">--}}
{{--            </a>--}}
{{--            <a class="nav-link" href="{{route('studenttyping.index')}}"><i class="fa fa-keyboard-o"></i>&nbsp;&nbsp;MS-Word</a>--}}
{{--            <a class="nav-link" href="studenttheory.index"><i class="fa fa-pencil"></i>&nbsp;&nbsp;MS-Excel</a>--}}
{{--            <a class="nav-link" href="studenttheory.index"><i class="fa fa-pencil"></i>&nbsp;&nbsp;MS-Power Point</a>--}}
{{--            <a class="nav-link" href="studenttheory.index"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Fundamental & OS</a>--}}
{{--            <a class="nav-link" href="studenttheory.index"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Internet</a>--}}
{{--            </a>--}}
{{--        </nav>--}}
{{--    </div>--}}

    <a class="nav-link" href="{{ route('student_theorytest.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-desktop"></i></div>
        Theory Test
    </a>
{{--    <a class="nav-link" href="charts.html">--}}
{{--        <div class="sb-nav-link-icon"></div>--}}
{{--        --}}{{--                        <a class="nav-link" href="{{ route('students.index')}}"><i class="fa fa-user-o"></i>&nbsp;Profile Status</a>--}}
{{--    </a>--}}
{{--    <a class="nav-link" href="charts.html">--}}
{{--        <div class="sb-nav-link-icon"></div>--}}
{{--    <!-- <a class="nav-link" href="{{ route('custemNotification.index') }}"><i class="fa fa fa-comments"></i>&nbsp; Notice</a> -->--}}
{{--    </a>--}}
    <a class="nav-link" href="{{ route('student_mcqtest.dashboard') }}"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Theory
        Exam</a>

    </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as: Student</div>
        {{ auth()->user()->name }}
    </div>
    @endif
    </nav>
    </div>



