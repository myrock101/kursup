<nav class="vertical_nav author-nav">
    <div class="left_section menu_left" id="js-menu">
        <div class="left_section">
            <ul>
                <li class="menu--item">
                    <a href="https://kursup.com"
                        class="menu--link {{request()->is('/') ? 'active' : ''}}">
                        <i class="uil uil-home-alt menu--icon"></i>
                        <span class="menu--label">{{__('Home')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('ins-home') }}"
                        class="menu--link {{request()->is('author/home') ? 'active' : ''}}">
                        <i class="uil uil-apps menu--icon"></i>
                        <span class="menu--label">{{__('Dashboards')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('courses.index') }}"
                        class="menu--link {{request()->is('author/courses') ? 'active' : ''}}">
                        <i class='uil uil-book-alt menu--icon'></i>
                        <span class="menu--label">{{__('My Courses')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('ins-analytics') }}"
                        class="menu--link {{request()->is('author/analytics') ? 'active' : ''}}">
                        <i class='uil uil-analysis menu--icon'></i>
                        <span class="menu--label">{{__('Analyics')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('courses.create') }}"
                        class="menu--link {{request()->is('author/courses/create') ? 'active' : ''}}">
                        <i class='uil uil-plus-circle menu--icon'></i>
                        <span class="menu--label">{{__('Create Course')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('ins-messages') }}"  class="menu--link {{request()->is('author/messages*') ? 'active' : ''}}">
                        <i class='uil uil-comments menu--icon'></i>
                        <span class="menu--label">{{__('Messages')}}</span>
                    </a>
                </li>
               
                <li class="menu--item">
                    <a href="{{route('ins-notification')}}"
                        class="menu--link {{request()->is('author/notifications') ? 'active' : ''}}">
                        <i class='uil uil-bell menu--icon'></i>
                        <span class="menu--label">{{__('Notifications')}}</span>
                    </a>
                </li>
                <!-- <li class="menu--item">
                    <a href="{{ route('live-stream.index')}}"
                        class="menu--link {{request()->is('author/live-stream') ? 'active' : ''}} ">
                        <i class='uil uil-film menu--icon'></i>
                        <span class="menu--label">{{__('Live')}}</span>
                    </a>
                </li> -->

                <li class="menu--item">
                    <a href="{{ route('review.index') }}"
                        class="menu--link {{request()->is('author/review') ? 'active' : ''}}">
                        <i class='uil uil-star menu--icon'></i>
                        <span class="menu--label">{{__('Reviews')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ url('author/earning') }}"
                        class="menu--link {{request()->is('author/earning') ? 'active' : ''}}">
                        <i class='uil uil-dollar-sign menu--icon'></i>
                        <span class="menu--label">{{__('Earning')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ url('author/payout') }}"
                        class="menu--link {{request()->is('author/payout') ? 'active' : ''}}">
                        <i class='uil uil-wallet menu--icon'></i>
                        <span class="menu--label">{{__('Payout')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ url('author/statements') }}"
                        class="menu--link {{request()->is('author/statements') ? 'active' : ''}}">
                        <i class='uil uil-file-alt menu--icon'></i>
                        <span class="menu--label">{{__('Statements')}}</span>
                    </a>
                </li>
                <!-- <li class="menu--item">
                    <a href="{{ route('verification.index') }}"
                        class="menu--link {{request()->is('author/verification') ? 'active' : ''}}">
                        <i class='uil uil-check-circle menu--icon'></i>
                        <span class="menu--label">{{__('Verification')}}</span>
                    </a>
                </li> -->
            </ul>
        </div>
        <div class="left_section pt-2">
            <ul>
                <li class="menu--item">
                    <a href="{{ route('profile.edit') }}"
                        class="menu--link {{request()->is('author/profile') ? 'active' : ''}}" title="Setting">
                        <i class='uil uil-cog menu--icon'></i>
                        <span class="menu--label">{{__('Setting')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ url('author/help') }}"
                        class="menu--link {{request()->is('author/help') ? 'active' : ''}}" title="Help">
                        <i class='uil uil-question-circle menu--icon'></i>
                        <span class="menu--label">{{__('Help')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ url('author/feedback') }}"
                        class="menu--link {{request()->is('author/feedback') ? 'active' : ''}}"
                        title="Send Feedback">
                        <i class='uil uil-comment-alt-exclamation menu--icon'></i>
                        <span class="menu--label">{{__('Send Feedback')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>